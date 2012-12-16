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

/**
 * This file is part of VinceTUrlOpener
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

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->_cookieStorage = new CookieMemoryStorage();
    }

    /**
     * open an url
     *
     * @param string $url     [description]
     * @param array  $datas   [description]
     * @param array  $headers [description]
     *
     * @return Response
     */
    public function open($url, $datas=array(), $headers = array())
    {
        $request = new Request();
        $request->setUrl($url);
        // get cookies to send
        $cookies = $this->_cookieStorage->getDomainCookies($request->getHost());
        $request->setCookies($cookies);
        $request->setPostDatas($datas);
        $request->setHeaders($headers);
        $content = $request->open();

        $response = new Response();
        $response->setContent($content);
        $response->setHeaders($request->getResponseHeaders());
        foreach ( $response->getHeaders() as $header ) {
            $cookie = Cookie::fromHeader($header);
            if ( !is_null($cookie) ) {
                if ( !$cookie->getDomain() ) {
                    $cookie->setDomain($request->getHost());
                }
                $this->_cookieStorage->add($cookie);
            }
        }
        return $response;
    }

    /**
     * getCookieStorage
     * 
     * @return \VinceT\UrlOpener\Http\Cookie\CookieStorageInterface
     */
    public function getCookieStorage()
    {
        return $this->_cookieStorage;
    }

}