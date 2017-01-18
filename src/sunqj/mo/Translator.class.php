<?php

namespace sqj\mo;


class Translator
{
    private $translator;
    
    private $type;
    
    private $local;
    
    private $filenames;
    
    private $textDomain;
    
    function __construct($local, $type = "gettext")
    {
        $this->local = $local;
        $this->type = $type;
        
        $this->translator = new Gettext();
    }
    
    public function translate($message)
    {
        if (array_key_exists($message, $this->textDomain))
        {
            return $this->textDomain[$message];
        }
        else 
        {
            return $message;
        }
    }
    
    public function addTranslationPath($path)
    {
        //mo语言文件
        $moFile = $path . "/" . $this->local . ".mo";
        
        //判断路径和语言文件是否存在
        if (!file_exists($path) || !file_exists($moFile)
            || !is_file($moFile) || !is_readable($moFile))
        {
            return false;
        }
        else 
        {
            if (is_null($this->filenames))
            {
                $this->filenames = array($moFile);
                $this->textDomain = $this->translator->load($moFile);
                
                return true;
            }
            if (!in_array($moFile, $this->filenames))
            {
                array_push($this->filenames, $moFile);
                
                array_merge($this->textDomain, $this->translator->load($moFile));
                return true;
            }
            
            return false;
        }
    }
}