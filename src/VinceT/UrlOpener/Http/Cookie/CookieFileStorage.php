<?php
/**
 * This file is part of VinceTUrlOpener
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */

namespace VinceT\UrlOpener\Http\Cookie;


/**
 * CookieFileStorage
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class CookieFileStorage extends CookieMemoryStorage
{
    private $_fileName = null;

    /**
     * Gets FileName
     * 
     * @return string
     */
    public function getFileName()
    {
        return $this->_fileName;
    }
    
    /**
     * Sets FileName
     * 
     * @param string $fileName FileName
     * 
     * @return CookieFileStorage
     */
    public function setFileName($fileName)
    {
        $this->_fileName = $fileName;
        return $this;
    }

    /**
     * Save cookies
     *
     * @return Boolean
     */
    public function save()
    {
        if ( !$file = $this->getFileName() ) {
            throw new \InvalidArgumentException('Filename for cookie storage is not set.', 1);
        }
        return file_put_contents($file, serialize($this->cookies));
    }

    /**
     * Load cookies
     *
     * @return Boolean
     */
    public function load()
    {
        if ( !$file = $this->getFileName() ) {
            throw new \InvalidArgumentException('Filename for cookie storage is not set.', 1);
        }
        if ( !file_exists($file) ) {
            throw new \InvalidArgumentException(sprintf('File "%s" does not exist.', $file), 1);
        }
        $this->cookies = unserialize(file_get_contents($file));
        return true;
    }
}