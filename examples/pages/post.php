<?php

if ( isset($_POST['auth']) && $_POST['auth'] == 'ok' ) {
    echo 'Auth is ok';
} else {
    echo 'Failed to auth';
}