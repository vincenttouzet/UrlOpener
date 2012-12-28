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

use VinceT\UrlOpener\Http\Exception\RequestException;

/**
 * Request
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class Request
{
    private $_url = null;
    private $_scheme = null;
    private $_host = null;
    private $_port = null;
    private $_user = null;
    private $_pass = null;
    private $_path = null;
    private $_query = null;
    private $_fragment = null;

    private $_postDatas = array();
    private $_cookies = array();
    private $_headers = array();
    private $_ip = null;
    private $_responseHeaders = array();

    /**
     * Open url
     *
     * @return string
     */
    public function open()
    {
        if ( !$this->_url ) {
            throw new RequestException('No url given', 1);
        }
        $opts = array();
        // check if run from specific IP
        if ( $this->_ip ) {
            $opts['socket'] = array(
                'bindto' => $this->_ip.':0'
            );
        }
        $header = '';
        // cookies
        if ( $this->_cookies ) {
            $cookie_header = '';
            foreach ($this->_cookies as $c) {
                if ( $cookie_header !== '' ) {
                    $cookie_header .= '; ';
                }
                $cookie_header .= sprintf(
                    '%s=%s',
                    $c->getName(),
                    $c->getValue()
                );
            }
            $header = 'Cookie: '.$cookie_header.PHP_EOL;
        }
        // headers
        if ( $this->_headers ) {
            $header .= implode(PHP_EOL, $this->_headers);
        }
        $datas = $this->_postDatas;
        if ( is_array($datas) && count($datas) > 0 ) {
            // POST datas
            $postdata = http_build_query($datas);

            $opts['http'] = array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded'.PHP_EOL.$header,
                'content' => $postdata
            );
        } else {
            $opts['http'] = array(
                'method'  => 'GET', 
                'header'=>'Content-Type: text/html; charset=utf-8'.PHP_EOL.$header 
            );
        }
        // use context
        $context  = stream_context_create($opts);
        $res = file_get_contents($this->_url, false, $context);
        $this->_responseHeaders = $http_response_header;

        return $res;
    }
    
    /**
     * setUrl
     * 
     * @param string $url Url to open
     * 
     * @return Request
     */
    public function setUrl($url)
    {
        if ( !preg_match('/^https?:\/\//', $url) ) {
            throw new \InvalidArgumentException(sprintf('Invalid url "%s"', $url), 1);
        }
        $this->_url = $url;
        $arr = parse_url($url);
        if ( $arr ) {
            if ( isset($arr['scheme']) ) 
                $this->setScheme($arr['scheme']);
            if ( isset($arr['host']) ) 
                $this->setHost($arr['host']);
            if ( isset($arr['port']) ) 
                $this->setPort($arr['port']);
            if ( isset($arr['user']) ) 
                $this->setUser($arr['user']);
            if ( isset($arr['pass']) ) 
                $this->setPass($arr['pass']);
            if ( isset($arr['path']) ) 
                $this->setPath($arr['path']);
            if ( isset($arr['query']) ) 
                $this->setQuery($arr['query']);
            if ( isset($arr['fragment']) ) 
                $this->setFragment($arr['fragment']);
        }
        return $this;
    }

    /**
     * getScheme
     * 
     * @return string
     */
    public function getScheme()
    {
        return $this->_scheme;
    }
    
    /**
     * setScheme
     * 
     * @param string $scheme [description]
     * 
     * @return Request
     */
    public function setScheme($scheme)
    {
        $this->_scheme = $scheme;
        return $this;
    }

    /**
     * getHost
     * 
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }
    
    /**
     * setHost
     * 
     * @param string $host [description]
     * 
     * @return Request
     */
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * getPort
     * 
     * @return string
     */
    public function getPort()
    {
        return $this->_port;
    }
    
    /**
     * setPort
     * 
     * @param string $port [description]
     * 
     * @return Request
     */
    public function setPort($port)
    {
        $this->_port = $port;
        return $this;
    }
    
    /**
     * getUser
     * 
     * @return string
     */
    public function getUser()
    {
        return $this->_user;
    }
    
    /**
     * setUser
     * 
     * @param string $user [description]
     * 
     * @return Request
     */
    public function setUser($user)
    {
        $this->_user = $user;
        return $this;
    }

    /**
     * getPass
     * 
     * @return string
     */
    public function getPass()
    {
        return $this->_pass;
    }
    
    /**
     * setPass
     * 
     * @param string $pass [description]
     * 
     * @return Request
     */
    public function setPass($pass)
    {
        $this->_pass = $pass;
        return $this;
    }
    
    /**
     * getPath
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }
    
    /**
     * setPath
     * 
     * @param string $path [description]
     * 
     * @return Request
     */
    public function setPath($path)
    {
        $this->_path = $path;
        return $this;
    }
    
    /**
     * getQuery
     * 
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }
    
    /**
     * setQuery
     * 
     * @param string $query [description]
     * 
     * @return Request
     */
    public function setQuery($query)
    {
        $this->_query = $query;
        return $this;
    }
    
    /**
     * getFragment
     * 
     * @return string
     */
    public function getFragment()
    {
        return $this->_fragment;
    }
    
    /**
     * setFragment
     * 
     * @param string $fragment [description]
     * 
     * @return Request
     */
    public function setFragment($fragment)
    {
        $this->_fragment = $fragment;
        return $this;
    }
    
    /**
     * setPostDatas
     * 
     * @param array $postDatas Post datas
     * 
     * @return Request
     */
    public function setPostDatas($postDatas)
    {
        $this->_postDatas = $postDatas;
        return $this;
    }
    
    /**
     * setCookies
     * 
     * @param array $cookies Cookies
     * 
     * @return Request
     */
    public function setCookies($cookies)
    {
        $this->_cookies = $cookies;
        return $this;
    }
    
    /**
     * setHeaders
     * 
     * @param array $headers Headers
     * 
     * @return Request
     */
    public function setHeaders($headers)
    {
        $this->_headers = $headers;
        return $this;
    }
    
    /**
     * setIp
     * 
     * @param string $ip Ip to use
     * 
     * @return Request
     */
    public function setIp($ip)
    {
        $this->_ip = $ip;
        return $this;
    }

    /**
     * getResponseHeaders
     * 
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->_responseHeaders;
    }
    
}