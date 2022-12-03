<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <form action="auth.php" method="GET">
    <h1>Вход</h1>
    <p> Ваш логин <input type="text" name="login"></p>
    <p> Ваш пароль <input type="password" name="password"></p>
    <p><button type="submit">Войти</button></p>
    <?php
    if (isset($_GET['msg'])) {
      echo $_GET['msg'];
    }
    ?>
    <a href="signup.php" class="registration"> Регистрация </a>
  </form>
</body>

</html>