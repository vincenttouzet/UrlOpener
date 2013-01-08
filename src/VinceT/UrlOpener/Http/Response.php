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

use VinceT\UrlOpener\Http\Header\ResponseHeaderBag;

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
    private $_statusCode = null;

    /**
     * Gets StatusCode
     * 
     * @return string
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }
    
    /**
     * Sets StatusCode
     * 
     * @param string $statusCode StatusCode
     * 
     * @return Response
     */
    public function setStatusCode($statusCode)
    {
        $this->_statusCode = $statusCode;
        return $this;
    }

    /**
     * getHeaders
     * 
     * @return ResponseHeaderBag
     */
    public function getHeaders()
    {
        return $this->_headers;
    }
    
    /**
     * setHeaders
     * 
     * @param array $headers Raw headers
     * 
     * @return Response
     */
    public function setHeaders($headers)
    {
        $this->_headers = new ResponseHeaderBag();
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
     * @param string $content Content of the response
     * 
     * @return null
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }
    
}