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

use VinceT\UrlOpener\Http\Cookie\CookieFileStorage;
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
class CookieFileStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests save / load functionnality
     *
     * @return null
     */
    public function testSaveLoad()
    {
        $fileName = '/tmp/urlopener.cookies';
        $cookieStorage = new CookieFileStorage();

        $cookie = new Cookie('c1', 'c1_value');
        $cookieStorage->store($cookie);
        $cookie2 = new Cookie('c2', 'c2_value');
        $cookieStorage->store($cookie2);

        $this->assertEquals(2, $cookieStorage->count());

        $cookieStorage->setFileName($fileName);
        $cookieStorage->save();

        $cookieStorage2 = new CookieFileStorage();
        $cookieStorage2->setFileName($fileName);
        $cookieStorage2->load();

        $this->assertEquals(2, $cookieStorage2->count());
    }

    /**
     * Test exception thrown during save
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionSaveFileNotSet()
    {
        $cookieStorage = new CookieFileStorage();
        $cookieStorage->save();
    }

    /**
     * Test exception thrown during save
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionLoadFileNotSet()
    {
        $cookieStorage = new CookieFileStorage();
        $cookieStorage->load();
    }

    /**
     * Test exception thrown during save
     * 
     * @expectedException InvalidArgumentException
     * @return null
     */
    public function testExceptionLoadFileNotFound()
    {
        $cookieStorage = new CookieFileStorage();
        $cookieStorage->setFileName('/file/that/does/not/exist');
        $cookieStorage->load();
    }
}