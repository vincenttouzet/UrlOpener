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
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;
use VinceT\UrlOpener\Http\Response;

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

    private $_useCurl = true;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->setHeaders(new RequestHeaderBag());
    }

    /**
     * Open url
     *
     * @return Response
     */
    public function open()
    {
        if ( !$this->_url ) {
            throw new RequestException('No url given', 1);
        }
        $res = null;
        if ( $this->getUseCurl() && function_exists('curl_init') ) {
            $res = $this->openCurl();
        } else {
            $res = $this->openFileGetContents();
        }
        return $res;
    }

    /**
     * Open url with curl
     *
     * @return Response
     */
    protected function openCurl()
    {
        $this->_headers->setCookies($this->_cookies);

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, $this->_url);
        // include Response header in return value
        curl_setopt($curl_handle, CURLOPT_HEADER, true);
        curl_setopt($curl_handle, CURLOPT_NOBODY, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->_headers->buildRawHeaders());

        if ( $this->_ip ) {
            curl_setopt($curl_handle, CURLOPT_INTERFACE, $this->_ip);
        }

        $datas = $this->_postDatas;
        if ( is_array($datas) && count($datas) > 0 ) {
            //curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl_handle, CURLOPT_POST, 1);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $datas);
        }

        $res = curl_exec($curl_handle);

        if ( !$res ) {
            throw new RequestException(curl_error($curl_handle), 1);
        }

        $headerSize = curl_getinfo($curl_handle, CURLINFO_HEADER_SIZE);
        $header = substr($res, 0, $headerSize);
        $body = substr($res, $headerSize);

        $lines = explode(PHP_EOL, $header);
        $headers = array();
        foreach ($lines as $line) {
            if ( preg_match('/.*:.*/', $line) ) {
                $headers[] = trim($line);
            }
        }
        $response = new Response();
        $response->setContent($body);
        $response->setHeaders($headers);
        $response->setStatusCode(curl_getinfo($curl_handle, CURLINFO_HTTP_CODE));
        curl_close($curl_handle);

        return $response;
    }
    
    /**
     * Open url with file_get_contents
     *
     * @return Response
     */
    protected function openFileGetContents()
    {
        $opts = array();
        // check if run from specific IP
        if ( $this->_ip ) {
            $opts['socket'] = array(
                'bindto' => $this->_ip.':0'
            );
        }
        // headers
        $header = '';
        $this->_headers->setCookies($this->_cookies);
        
        $datas = $this->_postDatas;
        if ( is_array($datas) && count($datas) > 0 ) {
            // POST datas
            $postdata = http_build_query($datas);
            $this->_headers->setContentType('application/x-www-form-urlencoded');

            $opts['http'] = array(
                'method'  => 'POST',
                'header'  => $this->_headers->toString(),
                'content' => $postdata,
            );
        } else {
            $this->_headers->setContentType('text/html; charset=utf-8');
            $opts['http'] = array(
                'method' => 'GET', 
                'header' => $this->_headers->toString(),
            );
        }
        // use context
        $context  = stream_context_create($opts);
        $res = file_get_contents($this->_url, false, $context);

        $ret = array_shift($http_response_header);
        list($http, $code, $message) = explode(' ', $ret, 3);

        $response = new Response();
        $response->setContent($res);
        $response->setHeaders($http_response_header);
        $response->setStatusCode($code);

        return $response;
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
     * @param RequestHeaderBag $headers Headers
     * 
     * @return Request
     */
    public function setHeaders(RequestHeaderBag $headers)
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
     * Gets UseCurl
     * 
     * @return Boolean
     */
    public function getUseCurl()
    {
        return $this->_useCurl;
    }
    
    /**
     * Sets UseCurl
     * 
     * @param Boolean $useCurl UseCurl
     * 
     * @return Request
     */
    public function setUseCurl($useCurl)
    {
        $this->_useCurl = $useCurl;
        return $this;
    }
    
    
}