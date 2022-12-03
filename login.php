<?php
$login = $_GET['login']; 
$password = $_GET['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$file = file_get_contents('db.json');
$taskList = json_decode($file);

if (empty($taskList)) {
    header('Location: /index.php');
}
else{
    foreach ($taskList as $value){
        if(($login == $value->login)){
            header('Location: /signup.php?msg=Такой логин уже есть');
            exit();
        }
    }   
}
$token = bin2hex(random_bytes(10));
$file = file_get_contents('db.json');
$taskList = json_decode($file,TRUE);            
unset($file);                               
$taskList[] = array('login'=>$login, 'password'=>$hash, 'token'=>$token);       
file_put_contents('db.json',json_encode($taskList));  
unset($taskList);  
setcookie("token", $token, time() + 30);
header('Location: /index.php');
exit();

?>