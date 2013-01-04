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

use VinceT\UrlOpener\Http\Header\HeaderBag;

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
     * Gets the response status code
     *
     * @return string
     */
    public function getStatusCode()
    {
        $header = $this->_headers->get(0);
        $code = null;
        if ( $header ) {
            list($http, $code, $message) = explode(' ', $header, 3);
        }
        return $code;
    }

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
        $this->_headers = new HeaderBag();
        $this->_headers->setRawHeaders($headers);
        return $this;
    }

    /**
     * getContent
     * 
     * @return string
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