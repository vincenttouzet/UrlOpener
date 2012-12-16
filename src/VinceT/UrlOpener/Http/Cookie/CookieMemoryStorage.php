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
 * CookieMemoryStorage
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
class CookieMemoryStorage implements CookieStorageInterface
{
    protected $cookies = array();

    /**
     * Add a cookie to the storage
     * (If a cookie already exists in storage it is replaced)
     *
     * @param Cookie $cookie [description]
     *
     * @return null
     */
    public function add(Cookie $cookie)
    {
        $i = $this->indexOf($cookie);
        if ( $i !== -1 ) {
            $this->cookies[$i] = $cookie;
        } else {
            $this->cookies[] = $cookie;
        }
    }

    /**
     * Remove a cookie
     *
     * @param Cookie $cookie [description]
     *
     * @return null
     */
    public function remove(Cookie $cookie)
    {
        $i = $this->indexOf($cookie);
        if ( $i !== -1 ) {
            unset($this->cookies[$i]);
        }
    }

    /**
     * Tells if a cookie exists in storage
     *
     * @param Cookie $cookie [description]
     *
     * @return Boolean
     */
    public function contains(Cookie $cookie)
    {
        return $this->indexOf($cookie) !== -1;
    }

    /**
     * Gets index of a cookie in storage
     * -1 if cookie is not in storage
     *
     * @param Cookie $cookie [description]
     *
     * @return Integer
     */
    public function indexOf(Cookie $cookie)
    {
        foreach ($this->cookies as $i=>$c) {
            if ( $c->equals($cookie) ) {
                return $i;
            }
        }
        return -1;
    }

    /**
     * Retrieve a cookie from the storage
     *
     * @param Cookie $cookie [description]
     *
     * @return Cookie|null
     */
    public function getCookie(Cookie $cookie)
    {
        $i = $this->indexOf($cookie);
        if ( $i !== -1 ) {
            return $this->cookies[$i];
        }
        return null;
    }

    /**
     * Gets cookie list
     *
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * Gets cookies for a given domain
     *
     * @param string $domain [description]
     *
     * @return array
     */
    public function getDomainCookies($domain)
    {
        $cookies = array();
        foreach ($this->cookies as $i=>$c) {
            $isSubDomain = false;
            if ( substr($c->getDomain(), 0, 1) === '.' 
                && strstr($c->getDomain(), $domain) !== -1
            ) {
                $isSubDomain = true;
            }
            if ( $c->getDomain() === $domain
                || $isSubDomain
            ) {
                $cookies[] = $c;
            }
        }
        return $cookies;
    }

    /**
     * Clean an delete all cookies
     *
     * @return null
     */
    public function clean()
    {
        $this->cookies = array();
    }

    /**
     * Remove expired cookies
     *
     * @return null
     */
    public function removeExpired()
    {
        foreach ($this->cookies as $i=>$c) {
            if ( $c->isCleared() ) {
                unset($this->cookies[$i]);
            }
        }
    }
}