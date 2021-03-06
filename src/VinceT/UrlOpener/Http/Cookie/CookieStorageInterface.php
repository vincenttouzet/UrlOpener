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
 * CookieStorageInterface
 *
 * @category VinceT
 * @package  UrlOpener
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/UrlOpener
 */
interface CookieStorageInterface
{

    /**
     * Add a cookie to the storage
     * (If a cookie already exists in storage it is replaced)
     *
     * @param Cookie $cookie [description]
     *
     * @return null
     */
    public function store(Cookie $cookie);

    /**
     * Remove a cookie
     *
     * @param Cookie $cookie [description]
     *
     * @return null
     */
    public function remove(Cookie $cookie);

    /**
     * Tells if a cookie exists in storage
     *
     * @param Cookie $cookie [description]
     *
     * @return Boolean
     */
    public function contains(Cookie $cookie);

    /**
     * Gets the number of cookies stored
     *
     * @return Integer
     */
    public function count();

    /**
     * Gets all the cookies
     *
     * @return array
     */
    public function all();

    /**
     * Gets index of a cookie in storage
     * -1 if cookie is not in storage
     *
     * @param Cookie $cookie [description]
     *
     * @return Integer
     */
    public function indexOf(Cookie $cookie);

    /**
     * Gets cookies for a given domain
     *
     * @param string $domain [description]
     *
     * @return array
     */
    public function getDomainCookies($domain);

    /**
     * Clean an delete all cookies
     *
     * @return null
     */
    public function clean();

    /**
     * Remove expired cookies
     *
     * @return null
     */
    public function removeExpired();

    /**
     * Save cookies
     *
     * @return Boolean
     */
    public function save();

    /**
     * Load cookies
     *
     * @return Boolean
     */
    public function load();
}