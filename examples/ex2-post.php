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

// first request set a cookie
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'fail'));

print $response->getContent().PHP_EOL;
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'ok'));

print $response->getContent().PHP_EOL;
