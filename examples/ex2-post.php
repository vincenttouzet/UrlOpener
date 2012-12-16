<?php

require_once '../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

print '<pre>';

$urlOpener = new UrlOpener();

// first request set a cookie
$response = $urlOpener->open('pages/post.php', array('auth'=>'fail'));

print $response->getContent().PHP_EOL;
$response = $urlOpener->open('pages/post.php', array('auth'=>'OK'));

print $response->getContent().PHP_EOL;

print '</pre>';