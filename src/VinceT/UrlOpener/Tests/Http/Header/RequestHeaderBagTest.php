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

use VinceT\UrlOpener\Http\Header\RequestHeaderBag;
use VinceT\UrlOpener\Http\Cookie\Cookie;
use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;

/**
 * RequestHeaderBag test class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class RequestHeaderBagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test use 
     *
     * @return null
     */
    public function testUse()
    {
        $cookies = new CookieMemoryStorage();
        $cookies->store(new Cookie('c1', 'c1_val'));
        $cookies->store(new Cookie('c2', 'c2_val'));

        $headers = new RequestHeaderBag();
        $headers->setCookies($cookies);
        $headers->setAccept('text/plain');
        $headers->setAcceptCharset('utf-8');
        $headers->setAcceptEncoding('gzip, deflate');
        $headers->setAcceptLanguage('fr-FR');
        $headers->setAcceptDatetime('Thu, 31 May 2007 20:35:00 GMT');
        $headers->setAuthorization('Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $headers->setCacheControl('no-cache');
        $headers->setConnection('keep-alive');
        $headers->setContentLength('512');
        $headers->setContentMD5(md5('foo bar'));
        $headers->setContentType('application/x-www-form-urlencoded');
        $headers->setDate('Thu, 31 May 2007 20:35:00 GMT');
        $headers->setExpect('100-continue');
        $headers->setFrom('vincent.touzet@gmail.com');
        $headers->setHost('www.urlopener.localhost');
        $headers->setIfMatch('"737060cd8c284d8af7ad3082f209582d"');
        $headers->setIfModifiedSince('Thu, 31 May 2007 20:35:00 GMT');
        $headers->setIfNoneMatch('"737060cd8c284d8af7ad3082f209582d"');
        $headers->setIfRange('"737060cd8c284d8af7ad3082f209582d"');
        $headers->setIfUnmodifiedSince('Thu, 31 May 2007 20:35:00 GMT');
        $headers->setMaxForwards('10');
        $headers->setPragma('no-cache');
        $headers->setProxyAuthorization('Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $headers->setRange('bytes=500-999');
        $headers->setReferer('http://www.example.com');
        $headers->setTE('trailers, deflate');
        $headers->setUpgrade('HTTP/2.0, SHTTP/1.3, IRC/6.9, RTA/x11');
        $headers->setUserAgent('Mozilla/5.0 (X11; Linux x86_64; rv:12.0) Gecko/20100101 Firefox/12.0');
        $headers->setVia('1.0 fred, 1.1 example.com (Apache/1.1)');
        $headers->setWarning('199 Miscellaneous warning');

        $headers->setXRequestedWith('XMLHttpRequest');
        $headers->setDNT('1');
        $headers->setXForwardedFor('client1, proxy1, proxy2');
        $headers->setXForwardedProto('https');
        $headers->setFrontEndHttps('on');
        $headers->setXATTDeviceID('MakeModel/Firmware');
        $headers->setXWapProfile('http://wap.samsungmobile.com/uaprof/SGH-I777.xml');
        $headers->setProxyConnection('keep-alive');

        $rawHeaders = $headers->buildRawHeaders();

        $headers2 = new RequestHeaderBag();
        $headers2->setRawHeaders($rawHeaders);

        if ( $cookies = $headers2->getCookies() ) {
            $cookies = $cookies->all();
            $this->assertEquals('c1', $cookies[0]->getName());
            $this->assertEquals('c1_val', $cookies[0]->getValue());
            $this->assertEquals('c2', $cookies[1]->getName());
            $this->assertEquals('c2_val', $cookies[1]->getValue());
        }
        
        $this->assertEquals('text/plain', $headers2->getAccept());
        $this->assertEquals('utf-8', $headers2->getAcceptCharset());
        $this->assertEquals('gzip, deflate', $headers2->getAcceptEncoding());
        $this->assertEquals('fr-FR', $headers2->getAcceptLanguage());
        $this->assertEquals('Thu, 31 May 2007 20:35:00 GMT', $headers2->getAcceptDatetime());
        $this->assertEquals('Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==', $headers2->getAuthorization());
        $this->assertEquals('no-cache', $headers2->getCacheControl());
        $this->assertEquals('keep-alive', $headers2->getConnection());
        $this->assertEquals('512', $headers2->getContentLength());
        $this->assertEquals(md5('foo bar'), $headers2->getContentMD5());
        $this->assertEquals('application/x-www-form-urlencoded', $headers2->getContentType());
        $this->assertEquals('Thu, 31 May 2007 20:35:00 GMT', $headers2->getDate());
        $this->assertEquals('100-continue', $headers2->getExpect());
        $this->assertEquals('vincent.touzet@gmail.com', $headers2->getFrom());
        $this->assertEquals('www.urlopener.localhost', $headers2->getHost());
        $this->assertEquals('"737060cd8c284d8af7ad3082f209582d"', $headers2->getIfMatch());
        $this->assertEquals('Thu, 31 May 2007 20:35:00 GMT', $headers2->getIfModifiedSince());
        $this->assertEquals('"737060cd8c284d8af7ad3082f209582d"', $headers2->getIfNoneMatch());
        $this->assertEquals('"737060cd8c284d8af7ad3082f209582d"', $headers2->getIfRange());
        $this->assertEquals('Thu, 31 May 2007 20:35:00 GMT', $headers2->getIfUnmodifiedSince());
        $this->assertEquals('10', $headers2->getMaxForwards());
        $this->assertEquals('no-cache', $headers2->getPragma());
        $this->assertEquals('Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==', $headers2->getProxyAuthorization());
        $this->assertEquals('bytes=500-999', $headers2->getRange());
        $this->assertEquals('http://www.example.com', $headers2->getReferer());
        $this->assertEquals('trailers, deflate', $headers2->getTE());
        $this->assertEquals('HTTP/2.0, SHTTP/1.3, IRC/6.9, RTA/x11', $headers2->getUpgrade());
        $this->assertEquals('Mozilla/5.0 (X11; Linux x86_64; rv:12.0) Gecko/20100101 Firefox/12.0', $headers2->getUserAgent());
        $this->assertEquals('1.0 fred, 1.1 example.com (Apache/1.1)', $headers2->getVia());
        $this->assertEquals('199 Miscellaneous warning', $headers2->getWarning());

        $this->assertEquals('XMLHttpRequest', $headers2->getXRequestedWith());
        $this->assertEquals('1', $headers2->getDNT());
        $this->assertEquals('client1, proxy1, proxy2', $headers2->getXForwardedFor());
        $this->assertEquals('https', $headers2->getXForwardedProto());
        $this->assertEquals('on', $headers2->getFrontEndHttps());
        $this->assertEquals('MakeModel/Firmware', $headers2->getXATTDeviceID());
        $this->assertEquals('http://wap.samsungmobile.com/uaprof/SGH-I777.xml', $headers2->getXWapProfile());
        $this->assertEquals('keep-alive', $headers2->getProxyConnection());
    }
}