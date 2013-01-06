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

namespace VinceT\UrlOpener\Tests\Http\Header;

use VinceT\UrlOpener\Http\Header\HeaderBag;

/**
 * HeaderBag test class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class HeaderBagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test use 
     *
     * @return null
     */
    public function testUse()
    {
        $headers = new HeaderBag();


        $headers->set('User-Agent', 'My user agent is good !');

        $this->assertEquals('My user agent is good !', $headers->get('User-Agent'));
        $this->assertTrue($headers->has('User-Agent'));
        $headers->remove('User-Agent');

        $this->assertEquals($headers->__toString(), $headers->toString());
        
        $this->assertEquals(null, $headers->get('User-Agent'));
        $this->assertFalse($headers->has('User-Agent'));
    }
}