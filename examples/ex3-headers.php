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
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;

$urlOpener = new UrlOpener();

$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/headers.php');

print $response->getContent().PHP_EOL; // print User-Agent is:

$headers = new RequestHeaderBag();
$headers->setUserAgent('My user agent is good');

$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/headers.php', null, $headers);

print $response->getContent().PHP_EOL; // print User-Agent is: My user agent is good