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

    /**
     * test config functionnality
     *
     * @return [type]
     */
    public function testConfig()
    {
        $config = array(
            'USE_CURL' => true,
            'USE_IP' => '192.168.1.15',
        );
        $urlopener = new UrlOpener($config);
        $response = $urlopener->open('http://www.urlopener.localhost/examples/pages/ip.php');
        $this->assertEquals('192.168.1.15', $response->getContent());
        $config = array(
            'USE_CURL' => false,
            'USE_IP' => '127.0.0.1',
        );
        $urlopener = new UrlOpener($config);
        $response = $urlopener->open('http://www.urlopener.localhost/examples/pages/ip.php');
        $this->assertEquals('127.0.0.1', $response->getContent());


        $config = array(
            'COOKIE_FILE' => '/tmp/urlopener.cookies',
        );
        $urlopener = new UrlOpener($config);
        $this->assertTrue($urlopener->getCookieStorage() instanceof \VinceT\UrlOpener\Http\Cookie\CookieFileStorage);
        $urlopener = new UrlOpener();
        $this->assertTrue($urlopener->getCookieStorage() instanceof \VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage);
    }

}