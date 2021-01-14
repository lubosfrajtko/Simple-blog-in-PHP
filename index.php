<?php require_once '_inc/config.php';


$routes = [

    '/' =>[
        'GET' => 'home.php',
        'POST' => '_admin/add-comment.php',
    ],

    '/dashboard' =>[
        'GET' => 'dashboard.php',
    ],

    '/register' =>[
        'GET' => 'register.php',
        'POST' => 'register.php',
    ],

    '/login' =>[
        'GET' => 'login.php',
        'POST' => 'login.php',
    ],

    '/post' =>[
        'GET' => 'post.php',
        'POST' => '_admin/add-item.php',
        'POST' => 'comment.php',
    ],
    
    '/tag' =>[
        'GET' => 'tag.php', 
    ],

    '/edit' =>[
        'GET' =>'edit.php',
        'POST' => '_admin/edit-item.php',
        'POST' => '_admin/new-tag.php',
    ],

    '/delete' =>[
        'GET' =>'delete.php',
        'POST' => '_admin/delete-item.php',
    ],

];

$page  = segment(1);
$request = $_SERVER['REQUEST_METHOD'];

$public =[

    'login', 'register'

];

if(!logged_in() && !in_array($page, $public))
{

    redirect('/login');

}


if ( ! isset( $routes["/$page"][$request]))
{
    show_404();
}

require_once $routes["/$page"][$request];