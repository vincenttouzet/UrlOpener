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

require_once dirname(__FILE__).'/../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

$urlOpener = new UrlOpener();

// tests if cookie exist
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie2.php');

print $response->getContent().PHP_EOL; // print KO

// call page that set cookie
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie.php');

// tests if cookie exist
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie2.php');

print $response->getContent().PHP_EOL; // print OK
