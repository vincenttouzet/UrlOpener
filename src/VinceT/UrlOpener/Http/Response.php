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

namespace VinceT\UrlOpener\Http;

/**
 * Response
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class Response
{
    private $_headers = array();
    private $_content = null;

    /**
     * getHeaders
     * 
     * @return [type]
     */
    public function getHeaders()
    {
        return $this->_headers;
    }
    
    /**
     * setHeaders
     * 
     * @param [type] $headers [description]
     * 
     * @return null
     */
    public function setHeaders($headers)
    {
        $this->_headers = $headers;
        return $this;
    }

    /**
     * getContent
     * 
     * @return [type]
     */
    public function getContent()
    {
        return $this->_content;
    }
    
    /**
     * setContent
     * 
     * @param [type] $content [description]
     * 
     * @return null
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }
    
    
}