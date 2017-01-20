<?php

namespace sqj\mo;


class Translator
{
    /**
     * 构造翻译器
     *
     * Translator constructor.
     */
    function __construct()
    {
        $this->translator = new Gettext();
    }

    /**
     * 翻译信息
     * @param string $message 待翻译的字符串
     * @return mixed
     */
    public function translate($message)
    {
        //如果存在翻译数据，则返回翻译后的字符串
        if (array_key_exists($message, $this->textDomain))
        {
            return $this->textDomain[$message];
        }
        //否则原样返回
        else 
        {
            return $message;
        }
    }

    /**
     * 添加翻译器（翻译文件）
     * @param string $file 语言翻译文件
     */
    public function addTranslator($file)
    {
        //判断语言文件是否存在
        if (file_exists($file) && is_file($file) && is_readable($file))
        {
            $this->textDomain = $this->translator->load($file);
        }
    }

    private $translator;
    private $textDomain;
}