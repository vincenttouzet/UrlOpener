UrlOpener
=========

Library to load page throught HTTP. 
It supports GET and POST requests and handle Cookie management

```php
<?php

require_once 'path/to/UrlOpener/src/autoload.php';

use VinceT\UrlOpener\UrlOpener;
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;

// use config to set specific options
// default values are:
$config = array(
    'USE_CURL' => false, // set to true to use curl instead of file_get_contents
    'USE_IP' => false, // if you want to make requests from a specific IP, give the ip address to use
    'COOKIE_FILE' => null, // if you want to store cookies into a file, give the file name
);

$urlOpener = new UrlOpener($config);

$postDatas = array(
    'my_var' => 'the value',
);

$headers = new RequestHeaderBag();
$headers->setUserAgent('My user agent string');

$response = $urlOpener->open('http://www.example.com', $postDatas, $headers);

print $response->getContent();
```
