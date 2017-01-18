<?php

namespace sqj\mo;
/**
 * File loader interface.
 */
interface FileLoaderInterface
{
    /**
     * Load translations from a file.
     *
     * @param  string $locale
     * @param  string $filename
     * @return \Zend\I18n\Translator\TextDomain|null
     */
    public function load($filename);
}