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

namespace VinceT\UrlOpener;

use VinceT\UrlOpener\Http\Request;
use VinceT\UrlOpener\Http\Response;
use VinceT\UrlOpener\Http\Cookie\Cookie;
use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;
use VinceT\UrlOpener\Http\Cookie\CookieFileStorage;
use VinceT\UrlOpener\Http\Cookie\CookieStorageInterface;
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;

/**
 * UrlOpener class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class UrlOpener
{
    private $_cookieStorage = null;

    public $config = array(
        'USE_CURL' => false, // set to true to use curl instead of file_get_contents
        'USE_IP' => false, // if you want to make requests from a specific IP 
        'COOKIE_FILE' => null, // if you want to store cookies into a file, give the file name
    );

    /**
     * __construct
     *
     * @param array $config Configuration list
     */
    public function __construct($config = array())
    {
        $this->config = array_merge($this->config, $config);
        if ( is_string($this->config['COOKIE_FILE']) ) {
            $cookieStorage = new CookieFileStorage();
            $cookieStorage->setFileName($this->config['COOKIE_FILE']);
        } else {
            $cookieStorage = new CookieMemoryStorage();
        }
        $this->setCookieStorage($cookieStorage);
    }

    /**
     * open an url
     *
     * @param string $url     Url to load
     * @param array  $datas   Post datas
     * @param array  $headers Additional headers
     *
     * @return Response
     */
    public function open($url, $datas=array(), RequestHeaderBag $headers = null)
    {
        if ( is_null($headers) ) {
            $headers = new RequestHeaderBag();
        }
        $request = new Request();
        $request->setUseCurl($this->config['USE_CURL']);
        if ( $this->config['USE_IP'] !== false ) {
            $request->setIp($this->config['USE_IP']);
        }
        $request->setUrl($url);
        // get cookies to send
        $cookies = $this->_cookieStorage->getDomainCookies($request->getHost());
        $request->setCookies($cookies);
        $request->setPostDatas($datas);
        $request->setHeaders($headers);
        $response = $request->open();

        foreach ( $response->getHeaders()->getCookies()->all() as $cookie ) {
            if ( !$cookie->getDomain() ) {
                $cookie->setDomain($request->getHost());
            }
            $this->_cookieStorage->store($cookie);    
        }
        $this->_cookieStorage->save();
        return $response;
    }

    /**
     * Gets CookieStorage
     * 
     * @return \VinceT\UrlOpener\Http\Cookie\CookieStorageInterface
     */
    public function getCookieStorage()
    {
        return $this->_cookieStorage;
    }

    /**
     * Sets CookieStorage
     * 
     * @param CookieStorageInterface $cookieStorage CookieStorage
     * 
     * @return UrlOpener
     */
    public function setCookieStorage(CookieStorageInterface $cookieStorage)
    {
        $this->_cookieStorage = $cookieStorage;
        $this->_cookieStorage->load();
        return $this;
    }
    

}