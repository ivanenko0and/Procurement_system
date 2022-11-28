<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="http://fonts.cdnfonts.com/css/open-sans" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/lato" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php
    require "modules\\authorizationModule.php";
    ?>
    <title>Supply.ua</title>
</head>
<body>
    <header>
        <div id="logo">supply.ua</div>
        <div id="blank"></div>
        <nav></nav>
    </header>
    <main>
        <div class="container">
            <div class="authorization_block">
                <form action="index.php" method="post">
                    <input type="submit" id="return_button" value="< Назад">
                </form>

                <div>
                <?php 
                $login = $_POST["login"];
                $pass = $_POST["pass"];
                $error = signIn(); 
                ?>
                
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" name="auth_form" method="post">
                    <h4 align=center>Вхід</h4>
                    <input type="text" placeholder="Логін" name="login" value="<?php echo $login;?>" required>
                    <p class="error_text"><?php 
                        if($error == "loginError")
                        echo "Акаунту з таким логіном не існує";?></p>
                    <input type="password" placeholder="Пароль" name="pass" value="<?php echo $pass;?>" required>
                    <p class="error_text"><?php 
                        if($error == "passError")
                        echo "Введіть правильний пароль";?></p>
                    <input type="submit" value="Увійти">
                </form>
                <form action="registration.php">
                    <p><input type="submit" value="Реєстрація"></p>
                </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>