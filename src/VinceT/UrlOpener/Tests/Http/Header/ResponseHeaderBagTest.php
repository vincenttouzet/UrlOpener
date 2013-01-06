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

use VinceT\UrlOpener\Http\Header\ResponseHeaderBag;
use VinceT\UrlOpener\Http\Cookie\Cookie;
use VinceT\UrlOpener\Http\Cookie\CookieMemoryStorage;

/**
 * ResponseHeaderBag test class
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class ResponseHeaderBagTest extends \PHPUnit_Framework_TestCase
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

        $headers = new ResponseHeaderBag();
        $headers->setCookies($cookies);
        $headers->setAccessControlAllowOrigin('*');
        $headers->setAcceptRanges('bytes');
        $headers->setAge('12');
        $headers->setAllow('GET, HEAD');
        $headers->setCacheControl('max-age=3600');
        $headers->setConnection('close');
        $headers->setContentEncoding('gzip');
        $headers->setContentLanguage('fr');
        $headers->setContentLocation('/index.html');
        $headers->setContentMD5('Q2hlY2sgSW50ZWdyaXR5IQ==');
        $headers->setContentDisposition('attachment; filename="fname.ext"');
        $headers->setContentLength('512');
        $headers->setContentRange('bytes 21010-47021/47022');
        $headers->setContentType('text/html; charset=utf-8');
        $headers->setDate('Tue, 15 Nov 1994 08:12:31 GMT');
        $headers->setETag('"737060cd8c284d8af7ad3082f209582d"');
        $headers->setExpires('Tue, 15 Nov 1994 08:12:31 GMT');
        $headers->setLastModified('Tue, 15 Nov 1994 08:12:31 GMT');
        $headers->setLink('</feed>; rel="alternate"');
        $headers->setLocation('http://www.example.com');
        $headers->setP3P('P3P:CP="your_compact_policy"');
        $headers->setPragma('no-cache');
        $headers->setProxyAuthenticate('Basic');
        $headers->setRefresh('5; url=http://www.example.com');
        $headers->setRetryAfter('120');
        $headers->setServer('Apache/2.4.1 (Unix)');
        $headers->setStrictTransportSecurity('max-age=16070400; includeSubDomains');
        $headers->setTrailer('Max-Forwards');
        $headers->setTransferEncoding('chunked');
        $headers->setVary('*');
        $headers->setVia('1.0 fred, 1.1 example.com (Apache/1.1)');
        $headers->setWarning('199 Miscellaneous warning');
        $headers->setWWWAuthenticate('Basic');
        $headers->setXFrameOptions('deny');
        $headers->setXXSSProtection('1; mode=block');
        $headers->setXContentTypeOptions('nosniff');
        $headers->setXPoweredBy('PHP/5.4.0');
        $headers->setXUACompatible('Chrome=1');

        $rawHeaders = $headers->buildRawHeaders();

        $headers2 = new ResponseHeaderBag();
        $headers2->setRawHeaders($rawHeaders);

        if ( $cookies = $headers2->getCookies() ) {
            $cookies = $cookies->all();
            $this->assertEquals('c1', $cookies[0]->getName());
            $this->assertEquals('c1_val', $cookies[0]->getValue());
            $this->assertEquals('c2', $cookies[1]->getName());
            $this->assertEquals('c2_val', $cookies[1]->getValue());
        }

        $this->assertEquals('*', $headers2->getAccessControlAllowOrigin());
        $this->assertEquals('bytes', $headers2->getAcceptRanges());
        $this->assertEquals('12', $headers2->getAge());
        $this->assertEquals('GET, HEAD', $headers2->getAllow());
        $this->assertEquals('max-age=3600', $headers2->getCacheControl());
        $this->assertEquals('close', $headers2->getConnection());
        $this->assertEquals('gzip', $headers2->getContentEncoding());
        $this->assertEquals('fr', $headers2->getContentLanguage());
        $this->assertEquals('/index.html', $headers2->getContentLocation());
        $this->assertEquals('Q2hlY2sgSW50ZWdyaXR5IQ==', $headers2->getContentMD5());
        $this->assertEquals('attachment; filename="fname.ext"', $headers2->getContentDisposition());
        $this->assertEquals('512', $headers2->getContentLength());
        $this->assertEquals('bytes 21010-47021/47022', $headers2->getContentRange());
        $this->assertEquals('text/html; charset=utf-8', $headers2->getContentType());
        $this->assertEquals('Tue, 15 Nov 1994 08:12:31 GMT', $headers2->getDate());
        $this->assertEquals('"737060cd8c284d8af7ad3082f209582d"', $headers2->getETag());
        $this->assertEquals('Tue, 15 Nov 1994 08:12:31 GMT', $headers2->getExpires());
        $this->assertEquals('Tue, 15 Nov 1994 08:12:31 GMT', $headers2->getLastModified());
        $this->assertEquals('</feed>; rel="alternate"', $headers2->getLink());
        $this->assertEquals('http://www.example.com', $headers2->getLocation());
        $this->assertEquals('P3P:CP="your_compact_policy"', $headers2->getP3P());
        $this->assertEquals('no-cache', $headers2->getPragma());
        $this->assertEquals('Basic', $headers2->getProxyAuthenticate());
        $this->assertEquals('5; url=http://www.example.com', $headers2->getRefresh());
        $this->assertEquals('120', $headers2->getRetryAfter());
        $this->assertEquals('Apache/2.4.1 (Unix)', $headers2->getServer());
        $this->assertEquals('max-age=16070400; includeSubDomains', $headers2->getStrictTransportSecurity());
        $this->assertEquals('Max-Forwards', $headers2->getTrailer());
        $this->assertEquals('chunked', $headers2->getTransferEncoding());
        $this->assertEquals('*', $headers2->getVary());
        $this->assertEquals('1.0 fred, 1.1 example.com (Apache/1.1)', $headers2->getVia());
        $this->assertEquals('199 Miscellaneous warning', $headers2->getWarning());
        $this->assertEquals('Basic', $headers2->getWWWAuthenticate());
        $this->assertEquals('deny', $headers2->getXFrameOptions());
        $this->assertEquals('1; mode=block', $headers2->getXXSSProtection());
        $this->assertEquals('nosniff', $headers2->getXContentTypeOptions());
        $this->assertEquals('PHP/5.4.0', $headers2->getXPoweredBy());
        $this->assertEquals('Chrome=1', $headers2->getXUACompatible());
    }
}