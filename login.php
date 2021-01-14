<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //SANITIZACION

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];


    //VALIDIDATION

    if(!$username){
        flash()->error('You forgot username');
    }
    if(!$password){
        flash()->error('You forgot password');
    }
    if(flash()->hasMessages()){
        redirect('back');
    }

    //HASH
    
    $password = md5($password);

    //CHECK user exist

    $query = $db->prepare(" SELECT * FROM users WHERE username = :username
                            AND password = :password ");
    
    $query->execute([
        'username' => $username,
        'password' => $password
    ]);
    
    if($query->rowCount()=== 1 ){

        $_SESSION['username'] = $username;
        redirect('/');


    }
    if($query->rowCount() === 0){

        flash()->error('Inncorect username or password');
        redirect('back');

    }

}

include_once 'partials/header.php';
?>

    <form class="register-form" action="" method="post">

        <h1>Login</h1>
        <input class="inputs" type="text" name="username" placeholder="Name">
        <input class="inputs" type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
        <p>Dont have account yet?  
            <a class="login" href="<?= BASE_URL.'/register'?>">register</a>
        </p>
            
    </form>



<?php include_once 'partials/footer.php'; ?>