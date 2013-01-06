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

namespace VinceT\UrlOpener\Http\Header;

/**
 * RequestHeaderBag
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class RequestHeaderBag extends HeaderBag
{

    /**
     * Builds raw headers
     *
     * @return array
     */
    public function buildRawHeaders()
    {
        $ret = parent::buildRawHeaders();
        if ( $cookieStorage = $this->getCookies() ) {
            $cookies = array();
            foreach ($cookieStorage->all() as $cookie) {
                $cookies[]= $cookie->getName().'='.$cookie->getValue();
            }
            $ret[]= 'Cookie: '.implode(', ', $cookies);
        }
        return $ret;
    }

    /**
     * Gets the Accept header
     * 
     * @return string|null
     */
    public function getAccept()
    {
        return $this->get('Accept');
    }
    
    /**
     * Sets Accept header
     * 
     * @param string $accept Accept value header
     * 
     * @return RequestHeaderBag
     */
    public function setAccept($accept)
    {
        $this->set('Accept', $accept);
        return $this;
    }
    
    /**
     * Gets Accept-Charset header
     * 
     * @return string|null
     */
    public function getAcceptCharset()
    {
        return $this->get('Accept-Charset');
    }
    
    /**
     * Sets Accept-Charset header
     * 
     * @param string $acceptCharset Accept-Charset header
     * 
     * @return RequestHeaderBag
     */
    public function setAcceptCharset($acceptCharset)
    {
        $this->set('Accept-Charset', $acceptCharset);
        return $this;
    }

    /**
     * Gets Accept-Encoding header
     * 
     * @return string|null
     */
    public function getAcceptEncoding()
    {
        return $this->get('Accept-Encoding');
    }
    
    /**
     * Sets Accept-Encoding header
     * 
     * @param string $acceptEncoding Accept-Encoding header
     * 
     * @return null
     */
    public function setAcceptEncoding($acceptEncoding)
    {
        $this->set('Accept-Encoding', $acceptEncoding);
        return $this;
    }
    
    /**
     * Gets Accept-Language header
     * 
     * @return string|null
     */
    public function getAcceptLanguage()
    {
        return $this->get('Accept-Language');
    }
    
    /**
     * Sets Accept-Language header
     * 
     * @param string $acceptLanguage Accept-Language header
     * 
     * @return null
     */
    public function setAcceptLanguage($acceptLanguage)
    {
        $this->set('Accept-Language', $acceptLanguage);
        return $this;
    }

    /**
     * Gets Accept-Datetime header
     * 
     * @return string|null
     */
    public function getAcceptDatetime()
    {
        return $this->get('Accept-Datetime');
    }
    
    /**
     * Sets Accept-Datetime header
     * 
     * @param string $acceptDatetime Accept-Datetime header
     * 
     * @return null
     */
    public function setAcceptDatetime($acceptDatetime)
    {
        $this->set('Accept-Datetime', $acceptDatetime);
        return $this;
    }
    
    /**
     * Gets Authorization header
     * 
     * @return string|null
     */
    public function getAuthorization()
    {
        return $this->get('Authorization');
    }
    
    /**
     * Sets Authorization header
     * 
     * @param string $authorization Authorization header
     * 
     * @return null
     */
    public function setAuthorization($authorization)
    {
        $this->set('Authorization', $authorization);
        return $this;
    }

    /**
     * Gets Cache-Control header
     * 
     * @return string|null
     */
    public function getCacheControl()
    {
        return $this->get('Cache-Control');
    }
    
    /**
     * Sets Cache-Control header
     * 
     * @param string $cacheControl Cache-Control header
     * 
     * @return null
     */
    public function setCacheControl($cacheControl)
    {
        $this->set('Cache-Control', $cacheControl);
        return $this;
    }

    /**
     * Gets Connection header
     * 
     * @return string|null
     */
    public function getConnection()
    {
        return $this->get('Connection');
    }
    
    /**
     * Sets Connection header
     * 
     * @param string $connection Connection header
     * 
     * @return null
     */
    public function setConnection($connection)
    {
        $this->set('Connection', $connection);
        return $this;
    }
    
    /**
     * Gets Cookie header
     * 
     * @return string|null
     */
    /*public function getCookie()
    {
        return $this->get('Cookie');
    }*/
    
    /**
     * Sets Cookie header
     * 
     * @param string $cookie Cookie header
     * 
     * @return RequestHeaderBag
     */
    /*public function setCookie($cookie)
    {
        $this->set('Cookie', $cookie);
        return $this;
    }*/

    /**
     * Gets Content-Length header
     * 
     * @return string|null
     */
    public function getContentLength()
    {
        return $this->get('Content-Length');
    }
    
    /**
     * Sets Content-Length header
     * 
     * @param string $contentLength Content-Length header
     * 
     * @return RequestHeaderBag
     */
    public function setContentLength($contentLength)
    {
        $this->set('Content-Length', $contentLength);
        return $this;
    }
    
    /**
     * Gets Content-MD5 header
     * 
     * @return string|null
     */
    public function getContentMD5()
    {
        return $this->get('Content-MD5');
    }
    
    /**
     * Sets Content-MD5 header
     * 
     * @param string $contentMD5 Content-MD5 header
     * 
     * @return RequestHeaderBag
     */
    public function setContentMD5($contentMD5)
    {
        $this->set('Content-MD5', $contentMD5);
        return $this;
    }

    /**
     * Gets Content-Type header
     * 
     * @return string|null
     */
    public function getContentType()
    {
        return $this->get('Content-Type');
    }
    
    /**
     * Sets Content-Type header
     * 
     * @param string $contentType Content-Type header
     * 
     * @return RequestHeaderBag
     */
    public function setContentType($contentType)
    {
        $this->set('Content-Type', $contentType);
        return $this;
    }
    
    /**
     * Gets Date header
     * 
     * @return string|null
     */
    public function getDate()
    {
        return $this->get('Date');
    }
    
    /**
     * Sets Date header
     * 
     * @param string $date Date header
     * 
     * @return RequestHeaderBag
     */
    public function setDate($date)
    {
        $this->set('Date', $date);
        return $this;
    }

    /**
     * Gets Expect header
     * 
     * @return string|null
     */
    public function getExpect()
    {
        return $this->get('Expect');
    }
    
    /**
     * Sets Expect header
     * 
     * @param string $expect Expect header
     * 
     * @return RequestHeaderBag
     */
    public function setExpect($expect)
    {
        $this->set('Expect', $expect);
        return $this;
    }
    
    /**
     * Gets From header
     * 
     * @return string|null
     */
    public function getFrom()
    {
        return $this->get('From');
    }
    
    /**
     * Sets From header
     * 
     * @param string $from From header
     * 
     * @return RequestHeaderBag
     */
    public function setFrom($from)
    {
        $this->set('From', $from);
        return $this;
    }

    /**
     * Gets Host header
     * 
     * @return string|null
     */
    public function getHost()
    {
        return $this->get('Host');
    }
    
    /**
     * Sets Host header
     * 
     * @param string $host Host header
     * 
     * @return RequestHeaderBag
     */
    public function setHost($host)
    {
        $this->set('Host', $host);
        return $this;
    }

    /**
     * Gets If-Match header
     * 
     * @return string|null
     */
    public function getIfMatch()
    {
        return $this->get('If-Match');
    }
    
    /**
     * Sets If-Match header
     * 
     * @param string $ifMatch If-Match header
     * 
     * @return RequestHeaderBag
     */
    public function setIfMatch($ifMatch)
    {
        $this->set('If-Match', $ifMatch);
        return $this;
    }
    
    /**
     * Gets If-Modified-Since header
     * 
     * @return string|null
     */
    public function getIfModifiedSince()
    {
        return $this->get('If-Modified-Since');
    }
    
    /**
     * Sets If-Modified-Since header
     * 
     * @param string $ifModifiedSince If-Modified-Since header
     * 
     * @return RequestHeaderBag
     */
    public function setIfModifiedSince($ifModifiedSince)
    {
        $this->set('If-Modified-Since', $ifModifiedSince);
        return $this;
    }

    /**
     * Gets If-None-Match header
     * 
     * @return string|null
     */
    public function getIfNoneMatch()
    {
        return $this->get('If-None-Match');
    }
    
    /**
     * Sets If-None-Match header
     * 
     * @param string $ifNoneMatch If-None-Match header
     * 
     * @return RequestHeaderBag
     */
    public function setIfNoneMatch($ifNoneMatch)
    {
        $this->set('If-None-Match', $ifNoneMatch);
        return $this;
    }
    
    /**
     * Gets If-Range header
     * 
     * @return string|null
     */
    public function getIfRange()
    {
        return $this->get('If-Range');
    }
    
    /**
     * Sets If-Range header
     * 
     * @param string $ifRange If-Range header
     * 
     * @return RequestHeaderBag
     */
    public function setIfRange($ifRange)
    {
        $this->set('If-Range', $ifRange);
        return $this;
    }

    /**
     * Gets If-Unmodified-Since header
     * 
     * @return string|null
     */
    public function getIfUnmodifiedSince()
    {
        return $this->get('If-Unmodified-Since');
    }
    
    /**
     * Sets If-Unmodified-Since header
     * 
     * @param string $ifUnmodifiedSince If-Unmodified-Since header
     * 
     * @return RequestHeaderBag
     */
    public function setIfUnmodifiedSince($ifUnmodifiedSince)
    {
        $this->set('If-Unmodified-Since', $ifUnmodifiedSince);
        return $this;
    }
    
    /**
     * Gets Max-Forwards header
     * 
     * @return string|null
     */
    public function getMaxForwards()
    {
        return $this->get('Max-Forwards');
    }
    
    /**
     * Sets Max-Forwards header
     * 
     * @param string $maxForwards Max-Forwards header
     * 
     * @return RequestHeaderBag
     */
    public function setMaxForwards($maxForwards)
    {
        $this->set('Max-Forwards', $maxForwards);
        return $this;
    }
    
    /**
     * Gets Pragma header
     * 
     * @return string|null
     */
    public function getPragma()
    {
        return $this->get('Pragma');
    }
    
    /**
     * Sets Pragma header
     * 
     * @param string $pragma Pragma header
     * 
     * @return RequestHeaderBag
     */
    public function setPragma($pragma)
    {
        $this->set('Pragma', $pragma);
        return $this;
    }

    /**
     * Gets Proxy-Authorization header
     * 
     * @return string|null
     */
    public function getProxyAuthorization()
    {
        return $this->get('Proxy-Authorization');
    }
    
    /**
     * Sets Proxy-Authorization header
     * 
     * @param string $proxyAuthorization Proxy-Authorization header
     * 
     * @return RequestHeaderBag
     */
    public function setProxyAuthorization($proxyAuthorization)
    {
        $this->set('Proxy-Authorization', $proxyAuthorization);
        return $this;
    }
    
    /**
     * Gets Range header
     * 
     * @return string|null
     */
    public function getRange()
    {
        return $this->get('Range');
    }
    
    /**
     * Sets Range header
     * 
     * @param string $range Range header
     * 
     * @return RequestHeaderBag
     */
    public function setRange($range)
    {
        $this->set('Range', $range);
        return $this;
    }

    /**
     * Gets Referer header
     * 
     * @return string|null
     */
    public function getReferer()
    {
        return $this->get('Referer');
    }
    
    /**
     * Sets Referer header
     * 
     * @param string $Referer Referer header
     * 
     * @return RequestHeaderBag
     */
    public function setReferer($Referer)
    {
        $this->set('Referer', $Referer);
        return $this;
    }
    
    /**
     * Gets TE header
     * 
     * @return string|null
     */
    public function getTE()
    {
        return $this->get('TE');
    }
    
    /**
     * Sets TE header
     * 
     * @param string $tE TE header
     * 
     * @return RequestHeaderBag
     */
    public function setTE($tE)
    {
        $this->set('TE', $tE);
        return $this;
    }
    
    /**
     * Gets Upgrade header
     * 
     * @return string|null
     */
    public function getUpgrade()
    {
        return $this->get('Upgrade');
    }
    
    /**
     * Sets Upgrade header
     * 
     * @param string $upgrade Upgrade header
     * 
     * @return RequestHeaderBag
     */
    public function setUpgrade($upgrade)
    {
        $this->set('Upgrade', $upgrade);
        return $this;
    }

    /**
     * Gets the user agent header
     *
     * @return string|null
     */
    public function getUserAgent()
    {
        return $this->get('User-Agent');
    }

    /**
     * Sets the User-Agent header
     *
     * @param string $ua User-Agent value header
     *
     * @return RequestHeaderBag
     */
    public function setUserAgent($ua)
    {
        $this->set('User-Agent', $ua);
    }

    /**
     * Gets Via header
     * 
     * @return string|null
     */
    public function getVia()
    {
        return $this->get('Via');
    }
    
    /**
     * Sets Via header
     * 
     * @param string $via Via header
     * 
     * @return RequestHeaderBag
     */
    public function setVia($via)
    {
        $this->set('Via', $via);
        return $this;
    }

    /**
     * Gets Warning header
     * 
     * @return string|null
     */
    public function getWarning()
    {
        return $this->get('Warning');
    }
    
    /**
     * Sets Warning header
     * 
     * @param string $warning Warning header
     * 
     * @return RequestHeaderBag
     */
    public function setWarning($warning)
    {
        $this->set('Warning', $warning);
        return $this;
    }
    
    /**
     * Gets X-REquested-With header
     * 
     * @return string|null
     */
    public function getXREquestedWith()
    {
        return $this->get('X-REquested-With');
    }
    
    /**
     * Sets X-REquested-With header
     * 
     * @param string $xREquestedWith X-REquested-With header
     * 
     * @return RequestHeaderBag
     */
    public function setXREquestedWith($xREquestedWith)
    {
        $this->set('X-REquested-With', $xREquestedWith);
        return $this;
    }

    /**
     * Gets DNT header
     * 
     * @return string|null
     */
    public function getDNT()
    {
        return $this->get('DNT');
    }
    
    /**
     * Sets DNT header
     * 
     * @param string $dNT DNT header
     * 
     * @return RequestHeaderBag
     */
    public function setDNT($dNT)
    {
        $this->set('DNT', $dNT);
        return $this;
    }
    
    /**
     * Gets X-Forwarded-For header
     * 
     * @return string|null
     */
    public function getXForwardedFor()
    {
        return $this->get('X-Forwarded-For');
    }
    
    /**
     * Sets X-Forwarded-For header
     * 
     * @param string $xForwardedFor X-Forwarded-For header
     * 
     * @return RequestHeaderBag
     */
    public function setXForwardedFor($xForwardedFor)
    {
        $this->set('X-Forwarded-For', $xForwardedFor);
        return $this;
    }
    
    /**
     * Gets X-Forwarded-Proto header
     * 
     * @return string|null
     */
    public function getXForwardedProto()
    {
        return $this->get('X-Forwarded-Proto');
    }
    
    /**
     * Sets X-Forwarded-Proto header
     * 
     * @param string $xForwardedProto X-Forwarded-Proto header
     * 
     * @return RequestHeaderBag
     */
    public function setXForwardedProto($xForwardedProto)
    {
        $this->set('X-Forwarded-Proto', $xForwardedProto);
        return $this;
    }
    
    /**
     * Gets Front-End-Https header
     * 
     * @return string|null
     */
    public function getFrontEndHttps()
    {
        return $this->get('Front-End-Https');
    }
    
    /**
     * Sets Front-End-Https header
     * 
     * @param string $frontEndHttps Front-End-Https header
     * 
     * @return RequestHeaderBag
     */
    public function setFrontEndHttps($frontEndHttps)
    {
        $this->set('Front-End-Https', $frontEndHttps);
        return $this;
    }
    
    /**
     * Gets X-ATT-DeviceId header
     * 
     * @return string|null
     */
    public function getXATTDeviceId()
    {
        return $this->get('X-ATT-DeviceId');
    }
    
    /**
     * Sets X-ATT-DeviceId header
     * 
     * @param string $xATTDeviceId X-ATT-DeviceId header
     * 
     * @return RequestHeaderBag
     */
    public function setXATTDeviceId($xATTDeviceId)
    {
        $this->set('X-ATT-DeviceId', $xATTDeviceId);
        return $this;
    }

    /**
     * Gets X-Wap-Profile header
     * 
     * @return string|null
     */
    public function getXWapProfile()
    {
        return $this->get('X-Wap-Profile');
    }
    
    /**
     * Sets X-Wap-Profile header
     * 
     * @param string $xWapProfile X-Wap-Profile header
     * 
     * @return RequestHeaderBag
     */
    public function setXWapProfile($xWapProfile)
    {
        $this->set('X-Wap-Profile', $xWapProfile);
        return $this;
    }
    
    /**
     * Gets Proxy-Connection header
     * 
     * @return string|null
     */
    public function getProxyConnection()
    {
        return $this->get('Proxy-Connection');
    }
    
    /**
     * Sets Proxy-Connection header
     * 
     * @param string $proxyConnection Proxy-Connection header
     * 
     * @return RequestHeaderBag
     */
    public function setProxyConnection($proxyConnection)
    {
        $this->set('Proxy-Connection', $proxyConnection);
        return $this;
    }
    
    
}