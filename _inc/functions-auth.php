<?php

function logged_in()
{

    return isset($_SESSION["username"]);
           

}

function do_logout()
{

    if( !logged_in() ) return true;

    if(session_destroy()) {
        redirect('/login');
    }

}