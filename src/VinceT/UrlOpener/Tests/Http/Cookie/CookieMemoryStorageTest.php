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

namespace VinceT\UrlOpener\Tests\Http\Cookie;

use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;
use VinceT\UrlOpener\Http\Cookie\Cookie;

/**
 * This file is part of VinceTUrlOpener
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class CookieMemoryStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test add functionnality
     *
     * @return null
     */
    public function testUse()
    {
        $cookieStorage = new CookieMemoryStorage();

        $this->assertEquals($cookieStorage->count(), 0);

        $cookie = new Cookie('c1', 'c1_value');
        $cookieStorage->store($cookie);
        $this->assertEquals($cookieStorage->count(), 1);
        // store same cookie
        $cookieStorage->store($cookie);
        $this->assertEquals($cookieStorage->count(), 1);
        // add another cookie
        $cookie2 = new Cookie('c2', 'c2_value');
        $cookieStorage->store($cookie2);
        $this->assertEquals($cookieStorage->count(), 2);
        // contains
        $this->assertTrue($cookieStorage->contains($cookie));
        // remove cookie
        $cookieStorage->remove($cookie);
        $this->assertEquals($cookieStorage->count(), 1);
        // contains
        $this->assertFalse($cookieStorage->contains($cookie));
        // clean
        $cookieStorage->clean();
        $this->assertEquals($cookieStorage->count(), 0);
        $cookieStorage->save();
        $cookieStorage->load();
    }

    /**
     * Test get domain cookies functionnality
     *
     * @return null
     */
    public function testGetDomainCookies()
    {
        $cookieStorage = new CookieMemoryStorage();

        $c1 = new Cookie('c1', 'c1_val', 0, '/', '.example.com');
        $c2 = new Cookie('c2', 'c2_val', 0, '/', '.www.example.com');
        $c3 = new Cookie('c3', 'c3_val', 0, '/', 'example.com');
        $c4 = new Cookie('c4', 'c4_val', 0, '/', 'www.example.com');

        $cookieStorage->store($c1);
        $cookieStorage->store($c2);
        $cookieStorage->store($c3);
        $cookieStorage->store($c4);

        $cookies = $cookieStorage->getDomainCookies('example.com');
        $this->assertEquals(count($cookies), 2);

        $cookies = $cookieStorage->getDomainCookies('www.example.com');
        $this->assertEquals(count($cookies), 3);
    }

    /**
     * test remove expired functionnality
     *
     * @return null
     */
    public function testRemoveExpired()
    {
        $cookieStorage = new CookieMemoryStorage();

        $c1 = new Cookie('c1', 'c1_val', '+1 days', '/', '.example.com');
        $c2 = new Cookie('c2', 'c2_val', 42, '/', '.www.example.com');
        $c3 = new Cookie('c3', 'c3_val', 0, '/', 'example.com');

        $cookieStorage->store($c1);
        $cookieStorage->store($c2);
        $cookieStorage->store($c3);

        $this->assertEquals($cookieStorage->count(), 3);
        $cookieStorage->removeExpired();
        $this->assertEquals($cookieStorage->count(), 2);
    }
}