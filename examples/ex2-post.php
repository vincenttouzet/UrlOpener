<?php

require_once dirname(__FILE__).'/../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

print '<pre>';

$urlOpener = new UrlOpener();

// first request set a cookie
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'fail'));

print $response->getContent().PHP_EOL;
$response = $urlOpener->open('http://www.urlopener.localhost/examples/pages/post.php', array('auth'=>'ok'));

print $response->getContent().PHP_EOL;

print '</pre>';