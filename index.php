<?php
if (!isset($_COOKIE['token'])) {
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Главная страница</p>

    <a href="signin.php" class="logout"> Выйти</a>
    <?php
    ?>

</body>

</html>