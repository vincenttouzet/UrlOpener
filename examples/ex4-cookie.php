<?php

require_once '../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

$urlOpener = new UrlOpener();

// first request set a cookie
$response = $urlOpener->open('pages/cookie.php');

// second test existance of the created cookie
$response = $urlOpener->open('pages/cookie2.php');

var_dump($response->getContent());
