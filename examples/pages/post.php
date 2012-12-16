<?php

if ( isset($_POST['auth']) && $_POST['auth'] == 'OK' ) {
    echo 'Auth is ok';
} else {
    echo 'Failed to auth';
}