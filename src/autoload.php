<?php

/**
 * autoloader
 *
 * @param string $className Class name
 */
function url_opener_loader($className)
{
    $package = 'VinceT\\UrlOpener';
    $className = ltrim($className, '\\');
    if (0 === strpos($className, $package)) {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (is_file($fileName)) {
            require_once $fileName;
            return true;
        }
    }
    return false;
}

spl_autoload_register('url_opener_loader');
