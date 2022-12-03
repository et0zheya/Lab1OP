**Лабораторная работа №1**

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.001.png)
# **Основное задание**
Спроектировать и разработать систему авторизации пользователей на протоколе HTTP.

Система должна обладать следующим функционалом:

- Функциональность входа и выхода
- Пароли должны хранится в хешированном виде


## **1. Описание пользовательских сценариев работы**

`     `Возможности:

- Регистрация 
- Вход/выход

После авторизации пользователю открываются следующие возможности:

1. Выход из аккаунта

Если пользователь был ранее авторизован на сайте, у него есть cookie с токеном, и токен совпадает с токеном в БД, то при обновлении страницы, закрытия вкладки или закрытия  браузера, он останется на главной странице.

После того как срок годности cookie закончится, при обновлении главной страницы, будет произведен автоматический выход из аккаунта. После этого пользователь будет перенаправлен на страницу входа.



















2. ## **Описание API сервера и хореографии**
![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.002.png)Пример запросов, когда пользователь в первый раз заходит на страницу index.php,

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.003.jpeg)а после этого регистрируется:

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.004.jpeg)Пример запросов, когда пользователь заходит на страницу авторизации, вводит                              неверное имя пользователя, а после вводит верные данные для входа и заходит в аккаунт:

3. ## **Описание структуры базы данных**
Для хранение данных пользователя используется JSON файла. Каждый объект содержит в себе login пользователя, хэш пароля и токен.

Пример данных пользователя в БД:

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.005.png)


4. ## **Описание алгоритмов**
![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.006.png)![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.002.png)Алгоритм страницы регистрации:

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.002.png)Алгоритм страницы авторизации:

![](Aspose.Words.26e3e94c-23ed-4d42-b8ae-97f1da3da993.007.png)




# **Значимые фрагменты кода**
Фрагмент кода проверки данных, полученных из формы регистрации, и запись их в базу данных:


if (empty($taskList)) {

`    `header('Location: /index.php');

}

else{

`    `foreach ($taskList as $value){

`        `if(($login == $value->login)){

`            `header('Location: /signup.php?msg=Такой логин уже есть');

`            `exit();

`        `}

`    `}   

}

$token = bin2hex(random\_bytes(10));

$file = file\_get\_contents('db.json');

$taskList = json\_decode($file,TRUE);            

unset($file);                               

$taskList[] = array('login'=>$login, 'password'=>$hash, 'token'=>$token);       

file\_put\_contents('db.json',json\_encode($taskList));  

unset($taskList);  

setcookie("token", $token, time() + 30);

header('Location: /index.php');

exit();

?>






Фрагмент кода проверки введенных данных, обновления токена при авторизации:

foreach ($taskList as $value){

`    `if(($login == $value->login && password\_verify($password, $value->password))){

`        `if (!isset($\_COOKIE['token'])){   

`            `foreach ($taskList as $value){

`                `if(($login == $value->login)){

`                    `$token = bin2hex(random\_bytes(10));

`                    `setcookie("token", $token, time() + 30);

`                    `$value->token = $token;

`                    `file\_put\_contents('db.json',json\_encode($taskList));

`                `}

`            `}       

`        `}

`        `header('Location: /index.php');

`        `exit( );

`    `}

}  





