UrlOpener
=========

Library to load page throught HTTP. It support GET, POST, Cookie managment.

```php
<?php

require_once 'path/to/UrlOpener/src/autoload.php';

use VinceT\UrlOpener\UrlOpener;

$urlOpener = new UrlOpener();

$response = $urlOpener->open('http://www.example.com', array('postVar'=>'val', array('User-Agent: Mys user agent string')));

print $response->getContent();
```
