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
use VinceT\UrlOpener\Http\Exception\RequestException;

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
    }

    /**
     * Test open
     *
     * @return null
     */
    public function testOpen()
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/get.html');
        $content = $request->open();
        $this->assertEquals('This file is loaded with UrlOpener', $content);
    }

    /**
     * test ip functionnality
     *
     * @return null
     */
    public function testIp()
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/ip.php');
        $content = $request->open();
        $this->assertEquals('127.0.0.1', $content);
        $request->setIp('192.168.1.15');
        $content = $request->open();
        $this->assertEquals('192.168.1.15', $content);
    }

    /**
     * test cookies
     *
     * @return null
     */
    public function testCookies()
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/cookie2.php');
        $content = $request->open();
        $this->assertEquals('KO', $content);
        $request->setCookies(
            array(new Cookie('auth', 'ok'))
        );
        $content = $request->open();
        $this->assertEquals('OK', $content);
        $request->setCookies(
            array(new Cookie('auth', 'ok'), new Cookie('name', 'admin'))
        );
        $content = $request->open();
        $this->assertEquals('Hello admin', $content);
    }

    /**
     * test post
     *
     * @return null
     */
    public function testPost()
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/post.php');
        $content = $request->open();
        $this->assertEquals('Failed to auth', $content);
        $request->setPostDatas(
            array('auth'=>'ok')
        );
        $content = $request->open();
        $this->assertEquals('Auth is ok', $content);
    }

    /**
     * test headers
     *
     * @return null
     */
    public function testHeaders()
    {
        $request = new Request();
        $request->setUrl('http://www.urlopener.localhost/examples/pages/headers.php');
        $ua = 'My user agent';
        $request->setHeaders(array('User-Agent: '.$ua));
        $content = $request->open();
        $this->assertEquals('User agent is: '.$ua, $content);
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
}