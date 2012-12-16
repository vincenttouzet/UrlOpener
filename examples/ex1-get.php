<?php

require_once '../src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

$urlOpener = new UrlOpener();

// Just give the url to load
// It can be :
//      - absolute        (ex: http://www.example.com/examples/pages/get.html)
//      - server relative (ex: /examples/pages/get.html)
//      - path relative   (ex: pages/get.html)
// For the relative url it uses the HTTP_HOST and REQUEST_URI in $_SERVER
$response = $urlOpener->open('pages/get.html');

print $response->getContent();
