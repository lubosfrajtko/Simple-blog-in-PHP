<?php

require_once '_inc/config.php';

    
    if( !logged_in() ) return true;

    if(session_destroy()) {
        redirect('/login');
    }

?>
