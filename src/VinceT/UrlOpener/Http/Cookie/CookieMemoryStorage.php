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
    public function store(Cookie $cookie)
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
     * Gets the number of cookies stored
     *
     * @return Integer
     */
    public function count()
    {
        return count($this->cookies);
    }

    /**
     * Gets all the cookies
     *
     * @return array
     */
    public function all()
    {
        return $this->cookies;
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
     * Gets cookies for a given domain
     *
     * @param string $domain [description]
     *
     * @return array
     */
    public function getDomainCookies($domain)
    {
        $cookies = new CookieMemoryStorage();
        foreach ($this->cookies as $i=>$c) {
            $pattern = str_replace('.', '\\.', $c->getDomain());
            if ( $pattern[0] === '\\' ) {
                $pattern = '(.*\.)?'.substr($pattern, 2);
            }
            $pattern = sprintf('/^%s$/', $pattern);
            if ( preg_match($pattern, $domain) ) {
                $cookies->store($c);
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

    /**
     * Save cookies
     *
     * @return Boolean
     */
    public function save()
    {
        return true;
    }

    /**
     * Load cookies
     *
     * @return Boolean
     */
    public function load()
    {
        return true;
    }

}