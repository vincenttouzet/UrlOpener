UrlOpener
=========

Library to load page throught HTTP. 
It supports GET and POST requests and handle Cookie management

```php
<?php

require_once 'path/to/UrlOpener/src/autoload.php';

use VinceT\UrlOpener\UrlOpener;
use VinceT\UrlOpener\Http\Header\RequestHeaderBag;

$urlOpener = new UrlOpener();

$postDatas = array(
    'my_var' => 'the value',
);

$headers = new RequestHeaderBag();
$headers->setUserAgent('My user agent string');

$response = $urlOpener->open('http://www.example.com', $postDatas, $headers);

print $response->getContent();
```
