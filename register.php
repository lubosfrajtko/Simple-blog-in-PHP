<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //SANITIZACION

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];


    //VALIDATION

    if(!$username){
        flash()->error('You forgot username');
    }
    if(!$password){
        flash()->error('You forgot password');
    }
    if(strlen($username) < 5){
        flash()->error('Username must have least 5 characters');
    }
    if(strlen($password) < 5){
        flash()->error('Password must have least 5 characters');
    }

    if(flash()->hasMessages()){
        redirect('back');
    }

    //HASH
    $password = md5($password);

    //IF USER EXISTS

    $query = $db->query(" SELECT username FROM users ");
    

    if($query->rowCount()){

        $users = $query->fetchAll( PDO::FETCH_ASSOC );

    }

    foreach($users as $user){

        if(in_array($username, $user)){

            flash()->error('User alredy exists');
            redirect('back');
        }

    }

    //ADD NEW USER

    if($username && $password){

        $insert_user = $db->prepare(" INSERT INTO USERS
                                  (username, password)
                                  VALUES (:username, :password)");
        $insert_user->execute([
            'username' => $username,
            'password' => $password
        ]);

        if($insert_user){

            flash()->success('New account created');
            redirect('/login');
            

        }
    }

}


include_once 'partials/header.php';
?>

    <form class="register-form" action="" method="post">

        <h1>Register</h1>
        <input class="inputs" type="text" name="username" placeholder="Name">
        <input class="inputs" type="password" name="password" placeholder="Password">
        <button type="submit">Register</button>
        <p>or 
            <a class="login" href="<?= BASE_URL.'/login'?>">Come inside</a>
        </p>
            
    </form>



<?php include_once 'partials/footer.php'; ?>    


