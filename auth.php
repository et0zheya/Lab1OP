<?php
$login = $_GET['login']; 
$password = $_GET['password'];
$file = file_get_contents('db.json');
$taskList = json_decode($file);

foreach ($taskList as $value){
    if(($login == $value->login && password_verify($password, $value->password))){
        if (!isset($_COOKIE['token'])){   
            foreach ($taskList as $value){
                if(($login == $value->login)){
                    $token = bin2hex(random_bytes(10));
                    setcookie("token", $token, time() + 30);
                    $value->token = $token;
                    file_put_contents('db.json',json_encode($taskList));
                }
            }       
        }
        header('Location: /index.php');
        exit( );
    }
}  

header('Location: /signin.php?msg=Неверный логин или пароль');
exit( );
