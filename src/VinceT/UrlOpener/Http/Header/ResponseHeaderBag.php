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
 * ResponseHeaderBag
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class ResponseHeaderBag extends HeaderBag
{
    /**
     * Gets Acces-Control-Allow-Origin header
     * 
     * @return string|null
     */
    public function getAccesControlAllowOrigin()
    {
        return $this->get('Acces-Control-Allow-Origin');
    }
    
    /**
     * Sets Acces-Control-Allow-Origin header
     * 
     * @param string $accesControlAllowOrigin Acces-Control-Allow-Origin header
     * 
     * @return ResponseHeaderBag
     */
    public function setAccesControlAllowOrigin($accesControlAllowOrigin)
    {
        $this->set('Acces-Control-Allow-Origin', $accesControlAllowOrigin);
        return $this;
    }

    /**
     * Gets Accept-Ranges header
     * 
     * @return string|null
     */
    public function getAcceptRanges()
    {
        return $this->get('Accept-Ranges');
    }
    
    /**
     * Sets Accept-Ranges header
     * 
     * @param string $acceptRanges Accept-Ranges header
     * 
     * @return ResponseHeaderBag
     */
    public function setAcceptRanges($acceptRanges)
    {
        $this->set('Accept-Ranges', $acceptRanges);
        return $this;
    }
    
    /**
     * Gets Age header
     * 
     * @return string|null
     */
    public function getAge()
    {
        return $this->get('Age');
    }
    
    /**
     * Sets Age header
     * 
     * @param string $age Age header
     * 
     * @return ResponseHeaderBag
     */
    public function setAge($age)
    {
        $this->set('Age', $age);
        return $this;
    }
    
    /**
     * Gets Allow header
     * 
     * @return string|null
     */
    public function getAllow()
    {
        return $this->get('Allow');
    }
    
    /**
     * Sets Allow header
     * 
     * @param string $allow Allow header
     * 
     * @return ResponseHeaderBag
     */
    public function setAllow($allow)
    {
        $this->set('Allow', $allow);
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
     * @return ResponseHeaderBag
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
     * @return ResponseHeaderBag
     */
    public function setConnection($connection)
    {
        $this->set('Connection', $connection);
        return $this;
    }
    
    /**
     * Gets Content-Encoding header
     * 
     * @return string|null
     */
    public function getContentEncoding()
    {
        return $this->get('Content-Encoding');
    }
    
    /**
     * Sets Content-Encoding header
     * 
     * @param string $contentEncoding Content-Encoding header
     * 
     * @return ResponseHeaderBag
     */
    public function setContentEncoding($contentEncoding)
    {
        $this->set('Content-Encoding', $contentEncoding);
        return $this;
    }
    
    /**
     * Gets Content-Language header
     * 
     * @return string|null
     */
    public function getContentLanguage()
    {
        return $this->get('Content-Language');
    }
    
    /**
     * Sets Content-Language header
     * 
     * @param string $contentLanguage Content-Language header
     * 
     * @return ResponseHeaderBag
     */
    public function setContentLanguage($contentLanguage)
    {
        $this->set('Content-Language', $contentLanguage);
        return $this;
    }

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
     * @return ResponseHeaderBag
     */
    public function setContentLength($contentLength)
    {
        $this->set('Content-Length', $contentLength);
        return $this;
    }

    /**
     * Gets Content-Location header
     * 
     * @return string|null
     */
    public function getContentLocation()
    {
        return $this->get('Content-Location');
    }
    
    /**
     * Sets Content-Location header
     * 
     * @param string $contentLocation Content-Location header
     * 
     * @return ResponseHeaderBag
     */
    public function setContentLocation($contentLocation)
    {
        $this->set('Content-Location', $contentLocation);
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
     * @return ResponseHeaderBag
     */
    public function setContentMD5($contentMD5)
    {
        $this->set('Content-MD5', $contentMD5);
        return $this;
    }
    
    /**
     * Gets Content-Disposition header
     * 
     * @return string|null
     */
    public function getContentDisposition()
    {
        return $this->get('Content-Disposition');
    }
    
    /**
     * Sets Content-Disposition header
     * 
     * @param string $contentDisposition Content-Disposition header
     * 
     * @return ResponseHeaderBag
     */
    public function setContentDisposition($contentDisposition)
    {
        $this->set('Content-Disposition', $contentDisposition);
        return $this;
    }
    
    /**
     * Gets Content-Range header
     * 
     * @return string|null
     */
    public function getContentRange()
    {
        return $this->get('Content-Range');
    }
    
    /**
     * Sets Content-Range header
     * 
     * @param string $contentRange Content-Range header
     * 
     * @return ResponseHeaderBag
     */
    public function setContentRange($contentRange)
    {
        $this->set('Content-Range', $contentRange);
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
     * @return ResponseHeaderBag
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
     * @return ResponseHeaderBag
     */
    public function setDate($date)
    {
        $this->set('Date', $date);
        return $this;
    }

    /**
     * Gets ETAG header
     * 
     * @return string|null
     */
    public function getETAG()
    {
        return $this->get('ETAG');
    }
    
    /**
     * Sets ETAG header
     * 
     * @param string $eTAG ETAG header
     * 
     * @return ResponseHeaderBag
     */
    public function setETAG($eTAG)
    {
        $this->set('ETAG', $eTAG);
        return $this;
    }
    
    /**
     * Gets Expires header
     * 
     * @return string|null
     */
    public function getExpires()
    {
        return $this->get('Expires');
    }
    
    /**
     * Sets Expires header
     * 
     * @param string $expires Expires header
     * 
     * @return ResponseHeaderBag
     */
    public function setExpires($expires)
    {
        $this->set('Expires', $expires);
        return $this;
    }
    
    /**
     * Gets Last-Modified header
     * 
     * @return string|null
     */
    public function getLastModified()
    {
        return $this->get('Last-Modified');
    }
    
    /**
     * Sets Last-Modified header
     * 
     * @param string $lastModified Last-Modified header
     * 
     * @return ResponseHeaderBag
     */
    public function setLastModified($lastModified)
    {
        $this->set('Last-Modified', $lastModified);
        return $this;
    }
    
    /**
     * Gets Link header
     * 
     * @return string|null
     */
    public function getLink()
    {
        return $this->get('Link');
    }
    
    /**
     * Sets Link header
     * 
     * @param string $link Link header
     * 
     * @return ResponseHeaderBag
     */
    public function setLink($link)
    {
        $this->set('Link', $link);
        return $this;
    }
    
    /**
     * Gets Location header
     * 
     * @return string|null
     */
    public function getLocation()
    {
        return $this->get('Location');
    }
    
    /**
     * Sets Location header
     * 
     * @param string $location Location header
     * 
     * @return ResponseHeaderBag
     */
    public function setLocation($location)
    {
        $this->set('Location', $location);
        return $this;
    }
    
    /**
     * Gets P3P header
     * 
     * @return string|null
     */
    public function getP3P()
    {
        return $this->get('P3P');
    }
    
    /**
     * Sets P3P header
     * 
     * @param string $p3P P3P header
     * 
     * @return ResponseHeaderBag
     */
    public function setP3P($p3P)
    {
        $this->set('P3P', $p3P);
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
     * @return ResponseHeaderBag
     */
    public function setPragma($pragma)
    {
        $this->set('Pragma', $pragma);
        return $this;
    }
    
    /**
     * Gets Proxy-Authenticate header
     * 
     * @return string|null
     */
    public function getProxyAuthenticate()
    {
        return $this->get('Proxy-Authenticate');
    }
    
    /**
     * Sets Proxy-Authenticate header
     * 
     * @param string $proxyAuthenticate Proxy-Authenticate header
     * 
     * @return ResponseHeaderBag
     */
    public function setProxyAuthenticate($proxyAuthenticate)
    {
        $this->set('Proxy-Authenticate', $proxyAuthenticate);
        return $this;
    }
    
    /**
     * Gets Refresh header
     * 
     * @return string|null
     */
    public function getRefresh()
    {
        return $this->get('Refresh');
    }
    
    /**
     * Sets Refresh header
     * 
     * @param string $refresh Refresh header
     * 
     * @return ResponseHeaderBag
     */
    public function setRefresh($refresh)
    {
        $this->set('Refresh', $refresh);
        return $this;
    }

    /**
     * Gets Retry-After header
     * 
     * @return string|null
     */
    public function getRetryAfter()
    {
        return $this->get('Retry-After');
    }
    
    /**
     * Sets Retry-After header
     * 
     * @param string $retryAfter Retry-After header
     * 
     * @return ResponseHeaderBag
     */
    public function setRetryAfter($retryAfter)
    {
        $this->set('Retry-After', $retryAfter);
        return $this;
    }

    /**
     * Gets Server header
     * 
     * @return string|null
     */
    public function getServer()
    {
        return $this->get('Server');
    }
    
    /**
     * Sets Server header
     * 
     * @param string $server Server header
     * 
     * @return ResponseHeaderBag
     */
    public function setServer($server)
    {
        $this->set('Server', $server);
        return $this;
    }
    
    /**
     * Gets Set-Cookie header
     * 
     * @return string|null
     */
    public function getSetCookie()
    {
        return $this->get('Set-Cookie');
    }
    
    /**
     * Sets Set-Cookie header
     * 
     * @param string $setCookie Set-Cookie header
     * 
     * @return ResponseHeaderBag
     */
    public function setSetCookie($setCookie)
    {
        $this->set('Set-Cookie', $setCookie);
        return $this;
    }
    
    /**
     * Gets Strict-Transport-Security header
     * 
     * @return string|null
     */
    public function getStrictTransportSecurity()
    {
        return $this->get('Strict-Transport-Security');
    }
    
    /**
     * Sets Strict-Transport-Security header
     * 
     * @param string $strictTransportSecurity Strict-Transport-Security header
     * 
     * @return ResponseHeaderBag
     */
    public function setStrictTransportSecurity($strictTransportSecurity)
    {
        $this->set('Strict-Transport-Security', $strictTransportSecurity);
        return $this;
    }

    /**
     * Gets Trailer header
     * 
     * @return string|null
     */
    public function getTrailer()
    {
        return $this->get('Trailer');
    }
    
    /**
     * Sets Trailer header
     * 
     * @param string $trailer Trailer header
     * 
     * @return ResponseHeaderBag
     */
    public function setTrailer($trailer)
    {
        $this->set('Trailer', $trailer);
        return $this;
    }
    
    /**
     * Gets Transfert-Encoding header
     * 
     * @return string|null
     */
    public function getTransfertEncoding()
    {
        return $this->get('Transfert-Encoding');
    }
    
    /**
     * Sets Transfert-Encoding header
     * 
     * @param string $transfertEncoding Transfert-Encoding header
     * 
     * @return ResponseHeaderBag
     */
    public function setTransfertEncoding($transfertEncoding)
    {
        $this->set('Transfert-Encoding', $transfertEncoding);
        return $this;
    }

    /**
     * Gets Vary header
     * 
     * @return string|null
     */
    public function getVary()
    {
        return $this->get('Vary');
    }
    
    /**
     * Sets Vary header
     * 
     * @param string $vary Vary header
     * 
     * @return ResponseHeaderBag
     */
    public function setVary($vary)
    {
        $this->set('Vary', $vary);
        return $this;
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
     * @return ResponseHeaderBag
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
     * @return ResponseHeaderBag
     */
    public function setWarning($warning)
    {
        $this->set('Warning', $warning);
        return $this;
    }

    /**
     * Gets WWW-Authenticate header
     * 
     * @return string|null
     */
    public function getWWWAuthenticate()
    {
        return $this->get('WWW-Authenticate');
    }
    
    /**
     * Sets WWW-Authenticate header
     * 
     * @param string $wWWAuthenticate WWW-Authenticate header
     * 
     * @return ResponseHeaderBag
     */
    public function setWWWAuthenticate($wWWAuthenticate)
    {
        $this->set('WWW-Authenticate', $wWWAuthenticate);
        return $this;
    }
    
    /**
     * Gets X-Frame-Options header
     * 
     * @return string|null
     */
    public function getXFrameOptions()
    {
        return $this->get('X-Frame-Options');
    }
    
    /**
     * Sets X-Frame-Options header
     * 
     * @param string $xFrameOptions X-Frame-Options header
     * 
     * @return ResponseHeaderBag
     */
    public function setXFrameOptions($xFrameOptions)
    {
        $this->set('X-Frame-Options', $xFrameOptions);
        return $this;
    }

    /**
     * Gets X-XSS-Protection header
     * 
     * @return string|null
     */
    public function getXXSSProtection()
    {
        return $this->get('X-XSS-Protection');
    }
    
    /**
     * Sets X-XSS-Protection header
     * 
     * @param string $xXSSProtection X-XSS-Protection header
     * 
     * @return ResponseHeaderBag
     */
    public function setXXSSProtection($xXSSProtection)
    {
        $this->set('X-XSS-Protection', $xXSSProtection);
        return $this;
    }
    
    /**
     * Gets X-Content-Type-Options header
     * 
     * @return string|null
     */
    public function getXContentTypeOptions()
    {
        return $this->get('X-Content-Type-Options');
    }
    
    /**
     * Sets X-Content-Type-Options header
     * 
     * @param string $xContentTypeOptions X-Content-Type-Options header
     * 
     * @return ResponseHeaderBag
     */
    public function setXContentTypeOptions($xContentTypeOptions)
    {
        $this->set('X-Content-Type-Options', $xContentTypeOptions);
        return $this;
    }
    
    /**
     * Gets X-Powered-By header
     * 
     * @return string|null
     */
    public function getXPoweredBy()
    {
        return $this->get('X-Powered-By');
    }
    
    /**
     * Sets X-Powered-By header
     * 
     * @param string $xPoweredBy X-Powered-By header
     * 
     * @return ResponseHeaderBag
     */
    public function setXPoweredBy($xPoweredBy)
    {
        $this->set('X-Powered-By', $xPoweredBy);
        return $this;
    }
    
    /**
     * Gets X-UA-Compatible header
     * 
     * @return string|null
     */
    public function getXUACompatible()
    {
        return $this->get('X-UA-Compatible');
    }
    
    /**
     * Sets X-UA-Compatible header
     * 
     * @param string $xUACompatible X-UA-Compatible header
     * 
     * @return ResponseHeaderBag
     */
    public function setXUACompatible($xUACompatible)
    {
        $this->set('X-UA-Compatible', $xUACompatible);
        return $this;
    }
    
    
}