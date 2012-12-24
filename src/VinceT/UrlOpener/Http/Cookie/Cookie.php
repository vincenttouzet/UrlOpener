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

namespace VinceT\UrlOpener\Http\Cookie;

/**
 * Represents a cookie
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Johannes M. Schmitt <schmittjoh@gmail.com>
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 * @api
 */
class Cookie
{
    protected $name;
    protected $value;
    protected $domain;
    protected $expire;
    protected $path;
    protected $secure;
    protected $httpOnly;

    /**
     * Constructor.
     *
     * @param string                   $name     The name of the cookie
     * @param string                   $value    The value of the cookie
     * @param integer|string|\DateTime $expire   The time the cookie expires
     * @param string                   $path     The path on the server in which the cookie will be available on
     * @param string                   $domain   The domain that the cookie is available to
     * @param Boolean                  $secure   Whether the cookie should only be transmitted over a secure HTTPS connection from the client
     * @param Boolean                  $httpOnly Whether the cookie will be made accessible only through the HTTP protocol
     *
     * @api
     */
    public function __construct($name, $value = null, $expire = 0, $path = '/', $domain = null, $secure = false, $httpOnly = true)
    {
        $this->setName($name);
        $this->setExpireTime($expire);
        $this->setValue($value);
        $this->setDomain($domain);
        $this->setPath($path);
        $this->setSecure($secure);
        $this->setHttpOnly($httpOnly);
    }

    /**
     * Create a cookie from a header line.
     * If the header line does not contains "Set-Cookie:" null is returned
     *
     * @param string $header line of headers response
     *
     * @return Cookie|null
     */
    public static function fromHeader($header)
    {
        $cookie = null;
        if ( preg_match('/^Set-Cookie: (.*)/', $header, $matches) ) {
            $raw = $matches[1];
            $raw_array = explode(';', $raw);
            $name_val = array_shift($raw_array);
            preg_match('/([^=]+)=(.*)/', $name_val, $matches);
            $name = $matches[1];
            $value = $matches[2];
            $expire = 0;
            $path = '/';
            $domain = null;
            $secure = false;
            $httponly = true;
            foreach ($raw_array as $val) {
                preg_match('/([^=]+)=?(.*)?/', $val, $matches);
                $m1 = trim($matches[1]);
                $m2 = trim($matches[2]);
                switch ($m1) {
                case 'expires':
                    $expire = new \DateTime($m2);
                    break;
                case 'path':
                    $path = $m2;
                    break;
                case 'domain':
                    $domain = $m2;
                    break;
                case 'httponly':
                    $httponly = true;
                    break;
                case 'secure':
                    $secure = true;
                    break;
                }
            }
            $cookie = new Cookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        }
        return $cookie;
    }

    /**
     * Returns the cookie as a string.
     *
     * @return string The cookie
     */
    public function __toString()
    {
        $str = urlencode($this->getName()).'=';

        if ('' === (string) $this->getValue()) {
            $str .= 'deleted; expires='.gmdate('D, d-M-Y H:i:s T', time() - 31536001);
        } else {
            $str .= urlencode($this->getValue());

            if ($this->getExpireTime() !== 0) {
                $str .= '; expires='.gmdate('D, d-M-Y H:i:s T', $this->getExpireTime());
            }
        }

        if ('/' !== $this->path) {
            $str .= '; path='.$this->path;
        }

        if (null !== $this->getDomain()) {
            $str .= '; domain='.$this->getDomain();
        }

        if (true === $this->isSecure()) {
            $str .= '; secure';
        }

        if (true === $this->isHttpOnly()) {
            $str .= '; httponly';
        }

        return $str;
    }

    /**
     * Gets the name of the cookie.
     *
     * @return string
     *
     * @api
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setName
     *
     * @param string $name Name of the cookie
     *
     * @return Cookie
     */
    public function setName($name)
    {
        // from PHP source code
        if (preg_match('/[=,; \t\r\n\013\014]/', $name)) {
            throw new \InvalidArgumentException(sprintf('The cookie name "%s" contains invalid characters.', $name));
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('The cookie name cannot be empty.');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the value of the cookie.
     *
     * @return string
     *
     * @api
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * setValue
     * 
     * @param string $value Value of the cookie
     * 
     * @return Cookie
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    

    /**
     * Gets the domain that the cookie is available to.
     *
     * @return string
     *
     * @api
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * setDomain
     * 
     * @param string $domain Domain of the cookie
     * 
     * @return Cookie
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
    

    /**
     * Gets the time the cookie expires.
     *
     * @return integer
     *
     * @api
     */
    public function getExpireTime()
    {
        return $this->expire;
    }

    /**
     * setExpireTime
     * 
     * @param integer $expire Number of seconds until cookie expires
     * 
     * @return Cookie
     */
    public function setExpireTime($expire)
    {
        // convert expiration time to a Unix timestamp
        if ($expire instanceof \DateTime) {
            $expire = $expire->format('U');
        } elseif (!is_numeric($expire)) {
            $expire = strtotime($expire);

            if (false === $expire || -1 === $expire) {
                throw new \InvalidArgumentException('The cookie expiration time is not valid.');
            }
        }
        $this->expire = $expire;
        return $this;
    }
    

    /**
     * Gets the path on the server in which the cookie will be available on.
     *
     * @return string
     *
     * @api
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * setPath
     * 
     * @param string $path Path for this cookie
     * 
     * @return null
     */
    public function setPath($path)
    {
        $this->path = empty($path) ? '/' : $path;
        return $this;
    }
    

    /**
     * Checks whether the cookie should only be transmitted over a secure HTTPS connection from the client.
     *
     * @return Boolean
     *
     * @api
     */
    public function isSecure()
    {
        return $this->secure;
    }
    
    /**
     * setSecure
     * 
     * @param Boolean $secure [description]
     * 
     * @return null
     */
    public function setSecure($secure)
    {
        $this->secure = (Boolean)$secure;
        return $this;
    }
    
    /**
     * Checks whether the cookie will be made accessible only through the HTTP protocol.
     *
     * @return Boolean
     *
     * @api
     */
    public function isHttpOnly()
    {
        return $this->httpOnly;
    }
    
    /**
     * setHttpOnly
     * 
     * @param Boolean $httpOnly [description]
     * 
     * @return Cookie
     */
    public function setHttpOnly($httpOnly)
    {
        $this->httpOnly = (Boolean)$httpOnly;
        return $this;
    }
    

    /**
     * Whether this cookie is about to be cleared
     *
     * @return Boolean
     *
     * @api
     */
    public function isCleared()
    {
        return ($this->expire !== 0 && $this->expire < time());
    }

    /**
     * Compare the cookie to another
     *
     * @param Cookie $cookie Cookie to compare
     *
     * @return Boolean
     */
    public function equals(Cookie $cookie)
    {
        $ret = true;
        $ret = $ret && ($cookie->getName() === $this->getName());
        $ret = $ret && ($cookie->getDomain() === $this->getDomain());
        $ret = $ret && ($cookie->isSecure() === $this->isSecure());
        $ret = $ret && ($cookie->isHttpOnly() === $this->isHttpOnly());
        return $ret;
    }
}
