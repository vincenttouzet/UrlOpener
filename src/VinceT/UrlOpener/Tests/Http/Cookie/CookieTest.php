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
class CookieTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test fromHeader method
     *
     * @return null
     */
    public function testFromHeader()
    {
        $cookie = Cookie::fromHeader('Set-Cookie: c1=c1_val; expires='.gmdate('D, d-M-Y H:i:s T', 42).'; path=/my_path; domain=.example.com; secure; httponly');
        $this->assertEquals($cookie->getName(), 'c1');
        $this->assertEquals($cookie->getValue(), 'c1_val');
        $this->assertEquals($cookie->getExpireTime(), 42);
        $this->assertEquals($cookie->getPath(), '/my_path');
        $this->assertEquals($cookie->getDomain(), '.example.com');
        $this->assertTrue($cookie->isSecure());
        $this->assertTrue($cookie->isHttpOnly());
    }

    /**
     * Test add functionnality
     *
     * @return null
     */
    public function testGetSet()
    {
        $cookie = new Cookie('c1', 'c1_value');

        // test getters
        $this->assertEquals($cookie->getName(), 'c1');
        $this->assertEquals($cookie->getValue(), 'c1_value');
        $this->assertEquals($cookie->getExpireTime(), 0);
        $this->assertEquals($cookie->getPath(), '/');
        $this->assertEquals($cookie->getDomain(), null);
        $this->assertEquals($cookie->isSecure(), false);
        $this->assertEquals($cookie->isHttpOnly(), true);

        // test setters
        $cookie->setName('c2');
        $cookie->setValue('c2_value');
        $t = time();
        $cookie->setExpireTime($t);
        $cookie->setPath('/path');
        $cookie->setDomain('.example.com');
        $cookie->setSecure(true);
        $cookie->setHttpOnly(false);

        $this->assertEquals($cookie->getName(), 'c2');
        $this->assertEquals($cookie->getValue(), 'c2_value');
        $this->assertEquals($cookie->getExpireTime(), $t);
        $this->assertEquals($cookie->getPath(), '/path');
        $this->assertEquals($cookie->getDomain(), '.example.com');
        $this->assertEquals($cookie->isSecure(), true);
        $this->assertEquals($cookie->isHttpOnly(), false);

        $dt = new \DateTime('now');
        $cookie->setExpireTime($dt);
        $this->assertEquals($cookie->getExpireTime(), $dt->format('U'));
        $cookie->setExpireTime('now');
        $this->assertEquals($cookie->getExpireTime(), $dt->format('U'));
    }

    /**
     * Test if the cookie is cleared
     *
     * @return null
     */
    public function testIsCleared()
    {
        $cookie = new Cookie('c1');
        $this->assertFalse($cookie->isCleared());
        $cookie->setExpireTime('-1 day');
        $this->assertTrue($cookie->isCleared());
    }

    /**
     * Test to string method
     *
     * @return null
     */
    public function testToString()
    {
        $cookie = new Cookie('c1', 'c1_val');
        $this->assertEquals($cookie->__toString(), 'c1=c1_val; httponly');
        $cookie = new Cookie('c1');
        $this->assertEquals($cookie->__toString(), 'c1=deleted; expires='.gmdate('D, d-M-Y H:i:s T', time() - 31536001).'; httponly');
        $cookie = new Cookie('c1', 'c1_val', '+1 day');
        $this->assertEquals($cookie->__toString(), 'c1=c1_val; expires='.gmdate('D, d-M-Y H:i:s T', $cookie->getExpireTime()).'; httponly');
        $cookie = new Cookie('c1', 'c1_val', '+1 day', '/my_path');
        $this->assertEquals($cookie->__toString(), 'c1=c1_val; expires='.gmdate('D, d-M-Y H:i:s T', $cookie->getExpireTime()).'; path=/my_path; httponly');
        $cookie = new Cookie('c1', 'c1_val', '+1 day', '/my_path', '.example.com');
        $this->assertEquals($cookie->__toString(), 'c1=c1_val; expires='.gmdate('D, d-M-Y H:i:s T', $cookie->getExpireTime()).'; path=/my_path; domain=.example.com; httponly');
        $cookie = new Cookie('c1', 'c1_val', '+1 day', '/my_path', '.example.com', true, false);
        $this->assertEquals($cookie->__toString(), 'c1=c1_val; expires='.gmdate('D, d-M-Y H:i:s T', $cookie->getExpireTime()).'; path=/my_path; domain=.example.com; secure');
    }

    /**
     * Test equals method
     *
     * @return null
     */
    public function testEquals()
    {
        $c1 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $c2 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $this->assertTrue($c1->equals($c2));
        $this->assertTrue($c2->equals($c1));
        $c1 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $c2 = new Cookie('c2', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));
        $c1 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $c2 = new Cookie('c1', 'c1_val', '+1 day', '/path', 'www.example.com', true, false);
        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));
        $c1 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $c2 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', false, false);
        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));
        $c1 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, false);
        $c2 = new Cookie('c1', 'c1_val', '+1 day', '/path', '.example.com', true, true);
        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));
    }

    /**
     * Test exception thrown during initialization
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionNameEmpty()
    {
        $cookie = new Cookie('');
    }

    /**
     * Test exception thrown during initialization
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionNameInvalid()
    {
        $cookie = new Cookie('invalid name');
    }

    /**
     * Test exception thrown during initialization
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionExpireInvalid()
    {
        $cookie = new Cookie('test', 'value', 'invalid expire time');
    }
}