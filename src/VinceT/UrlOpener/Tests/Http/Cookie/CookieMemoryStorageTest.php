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
    public function testAdd()
    {
        $cookieStorage = new CookieMemoryStorage();

        $this->assertEquals($cookieStorage->count(), 0);

        $cookie = new Cookie('c1', 'c1_value');

        $cookieStorage->add($cookie);

        $this->assertEquals($cookieStorage->count(), 1);
    }
}