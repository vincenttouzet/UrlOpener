<?php

require_once dirname(__FILE__).'/../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

$urlOpener = new UrlOpener();

// first request set a cookie
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie.php');

// second test existance of the created cookie
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/cookie2.php');

var_dump($response->getContent());
