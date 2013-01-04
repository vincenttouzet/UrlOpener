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

namespace VinceT\UrlOpener\Tests;

use VinceT\UrlOpener\UrlOpener;

/**
 * UrlOpener test class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class UrlOpenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test get request
     *
     * @return null
     */
    public function testGet()
    {
        $urlOpener = new UrlOpener();
        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/get.html');
        $this->assertEquals('This file is loaded with UrlOpener', $response->getContent());
        $this->assertEquals('200', $response->getStatusCode());
    }

    /**
     * test post request
     *
     * @return null
     */
    public function testPost()
    {
        $urlOpener = new UrlOpener();

        // first request set a cookie
        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'fail'));
        $this->assertEquals('Failed to auth', $response->getContent());

        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'ok'));
        $this->assertEquals('Auth is ok', $response->getContent());
    }

    /**
     * test cookie handling
     *
     * @return null
     */
    public function testCookies()
    {
        $urlOpener = new UrlOpener();

        // first request set a cookie
        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie2.php');
        $this->assertEquals('KO', $response->getContent());

        // second test existance of the created cookie
        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie.php');
        $response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie2.php');
        $this->assertEquals('OK', $response->getContent());

        $cookieStorage = $urlOpener->getCookieStorage();
        $this->assertEquals(1, $cookieStorage->count());
    }
}