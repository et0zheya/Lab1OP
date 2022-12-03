<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <form action="login.php" method="GET">
    <h1>Регистрация</h1>
    <p> Ваш логин <input type="text" name="login"></p>
    <p> Ваш пароль <input type="text" name="password"></p>
    <p><button type="submit">Зарегистрироваться</button></p>
    <?php
    if (isset($_GET['msg'])) {
      echo $_GET['msg'];
    }
    ?>
    <a href="signin.php" class="login"> Войти </a>
  </form>

</body>

</html>