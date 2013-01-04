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

namespace VinceT\UrlOpener\Http\Header;

use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;
use VinceT\UrlOpener\Http\Cookie\Cookie;

/**
 * HeaderBag class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class HeaderBag
{
    protected $rawHeaders = array();

    private $_datas = array();

    private $_cookies = null;

    /**
     * Gets a header by its name
     *
     * @param string $name Header name
     *
     * @return string|null
     */
    public function get($name)
    {
        if ( $this->has($name) ) {
            return $this->_datas[$name];
        } else {
            return null;
        }
    }

    /**
     * Sets a header by name
     *
     * @param string $name  Header name
     * @param string $value Header value
     *
     * @return \VinceT\UrlOpener\Http\Header\HeaderBag
     */
    public function set($name, $value)
    {
        $this->_datas[$name] = $value;
        return $this;
    }

    /**
     * Return true if header is defined
     *
     * @param string $name Header name
     *
     * @return Boolean
     */
    public function has($name)
    {
        return isset($this->_datas[$name]);
    }

    /**
     * Removes a header
     *
     * @param string $name Header name
     *
     * @return null
     */
    public function remove($name)
    {
        if ( $this->has($name) ) {
            unset($this->_datas[$name]);
        }
    }

    /**
     * getRawHeaders
     * 
     * @return array
     */
    public function getRawHeaders()
    {
        return $this->rawHeaders;
    }
    
    /**
     * setRawHeaders
     * 
     * @param [type] $rawHeaders [description]
     * 
     * @return null
     */
    public function setRawHeaders($rawHeaders)
    {
        $this->rawHeaders = $rawHeaders;
        $this->_hydrateDatas($rawHeaders);
        return $this;
    }

    /**
     * getCookies
     * 
     * @return [type]
     */
    public function getCookies()
    {
        return $this->_cookies;
    }
    
    /**
     * setCookies
     * 
     * @param [type] $cookies [description]
     * 
     * @return null
     */
    public function setCookies($cookies)
    {
        $this->_cookies = $cookies;
        return $this;
    }

    /**
     * Return string representation of all headers
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Return string representation of all headers
     *
     * @return string
     */
    public function __toString()
    {
        $arr = $this->_datas;
        ksort($arr);
        $s = '';
        foreach ($arr as $key => $value) {
            if ( $key !== 'Cookie' && $key !== 'Set-Cookie' ) {
                $s .= sprintf('%s: %s', $key, $value).PHP_EOL;
            }
        }
        return $s;
    }

    /**
     * hydrate datas from raw headers
     *
     * @param array $headers Array of headers
     *
     * @return null
     */
    private function _hydrateDatas(array $headers)
    {
        $this->_cookies = new CookieMemoryStorage();
        foreach ($headers as $i => $header) {
            @list($name, $value) = explode(':', $header, 2);
            if ( 'Set-Cookie' === $name ) {
                $cookie = Cookie::fromHeader($header);
                $this->_cookies->store($cookie);
            } else {
                if ( is_null($value) ) {
                    $value = $name;
                    $name = 0;
                }
                $this->set($name, $value);
            }
        }
    }


    
}