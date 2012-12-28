<?php

if ( $_COOKIE['auth'] == 'ok' ) {
    if ( $_COOKIE['name'] === 'admin' ) {
        echo 'Hello admin';
    } else {
        echo 'OK';
    }
} else {
    echo 'KO';
}
