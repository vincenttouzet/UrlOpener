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

namespace VinceT\UrlOpener\Tests\Http;

use VinceT\UrlOpener\Http\Request;
use VinceT\UrlOpener\Http\Cookie\Cookie;
use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;
use VinceT\UrlOpener\Http\Exception\RequestException;
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;

/**
 * Request test class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test getters and setters
     *
     * @return null
     */
    public function testGetSet()
    {
        $request = new Request();
        $request->setUrl('http://username:password@hostname:8080/path?arg=value#anchor');
        $this->assertEquals('http', $request->getScheme());
        $this->assertEquals('username', $request->getUser());
        $this->assertEquals('password', $request->getPass());
        $this->assertEquals('hostname', $request->getHost());
        $this->assertEquals('8080', $request->getPort());
        $this->assertEquals('/path', $request->getPath());
        $this->assertEquals('arg=value', $request->getQuery());
        $this->assertEquals('anchor', $request->getFragment());
        $request->setUseCurl(false);
        $this->assertFalse($request->getUseCurl());
        $request->setUseCurl(true);
        $this->assertTrue($request->getUseCurl());
    }

    /**
     * Test open
     *
     * @return null
     */
    public function testOpen()
    {
        $this->_testOpen(false);
        $this->_testOpen(true);
    }

    /**
     * [_testCookies description]
     *
     * @param Boolean $curl Weither curl is used to make the request
     *
     * @return null
     */
    private function _testOpen($curl)
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/get.html');
        $response = $request->open();
        $this->assertEquals('This file is loaded with UrlOpener', $response->getContent());
    }

    /**
     * test ip functionnality
     *
     * @return null
     */
    public function testIp()
    {
        $this->_testIp(false);
        $this->_testIp(true);
    }

    /**
     * [_testCookies description]
     *
     * @param Boolean $curl Weither curl is used to make the request
     *
     * @return null
     */
    private function _testIp($curl)
    {
        $request = new Request();
        $request->setUseCurl($curl);
        $request->setUrl('http://www.urlopener.localhost/examples/pages/ip.php');
        $response = $request->open();
        $this->assertEquals('127.0.0.1', $response->getContent());
        $request->setIp('192.168.1.15');
        $response = $request->open();
        $this->assertEquals('192.168.1.15', $response->getContent());
    }

    /**
     * test cookies
     *
     * @return null
     */
    public function testCookies()
    {
        $this->_testCookies(false);
        $this->_testCookies(true);
    }

    /**
     * [_testCookies description]
     *
     * @param Boolean $curl Weither curl is used to make the request
     *
     * @return null
     */
    private function _testCookies($curl)
    {
        $cookieStorage = new CookieMemoryStorage();

        $request = new Request();
        $request->setUseCurl($curl);
        $request->setUrl('http://www.urlopener.localhost/examples/pages/cookie2.php');
        $response = $request->open();
        $this->assertEquals('KO', $response->getContent());

        $cookieStorage->store(new Cookie('auth', 'ok'));
        $request->setCookies($cookieStorage);
        $response = $request->open();
        $this->assertEquals('OK', $response->getContent());

        $cookieStorage->store(new Cookie('name', 'admin'));
        $request->setCookies($cookieStorage);
        $response = $request->open();
        $this->assertEquals('Hello admin', $response->getContent());
    }

    /**
     * test post
     *
     * @return null
     */
    public function testPost()
    {
        $this->_testPost(false);
        $this->_testPost(true);
    }

    /**
     * [_testPost description]
     *
     * @param Boolean $curl Weither curl is used to make the request
     *
     * @return null
     */
    private function _testPost($curl)
    {
        $request = new Request();
        $request->setUseCurl($curl);
        $request->setUrl('http://www.urlopener.localhost/examples/pages/post.php');
        $response = $request->open();
        $this->assertEquals('Failed to auth', $response->getContent());
        $request->setPostDatas(
            array('auth'=>'ok')
        );
        $response = $request->open();
        $this->assertEquals('Auth is ok', $response->getContent());
    }

    /**
     * test headers
     *
     * @return null
     */
    public function testHeaders()
    {
        $this->_testHeaders(false);
        $this->_testHeaders(true);
    }


    /**
     * [_testHeaders description]
     *
     * @param Boolean $curl Weither curl is used to make the request
     *
     * @return null
     */
    private function _testHeaders($curl)
    {
        $request = new Request();
        $request->setUseCurl($curl);
        $request->setUrl('http://www.urlopener.localhost/examples/pages/headers.php');
        $ua = 'My user agent';
        $headers = new RequestHeaderBag();
        $headers->setUserAgent($ua);
        $request->setHeaders($headers);
        $response = $request->open();
        $this->assertEquals('User agent is: '.$ua, $response->getContent());
    }

    /**
     * test relative url
     *
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionInvalidUrl()
    {
        $request = new Request();
        $request->setUrl('/server_absolute');
    }

    /**
     * test relative url
     *
     * @expectedException \VinceT\UrlOpener\Http\Exception\RequestException
     * @return null
     */
    public function testExceptionNoUrlGiven()
    {
        $request = new Request();
        $request->open();
    }

    /**
     * test relative url
     *
     * @expectedException \VinceT\UrlOpener\Http\Exception\RequestException
     * @return null
     */
    public function testExceptionCurlError()
    {
        $request = new Request();
        $request->setUseCurl(true);
        $request->setUrl('http://test.exception.curl.error.urlopener.com');
        $request->open();
    }
}