<?php

require_once '../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

print '<pre>';

$urlOpener = new UrlOpener();

$response = $urlOpener->open('pages/headers.php');

print $response->getContent().PHP_EOL;

$headers = array(
    'User-Agent: My user agent is good',
);

$response = $urlOpener->open('pages/headers.php', null, $headers);

print $response->getContent().PHP_EOL;

print '</pre>';