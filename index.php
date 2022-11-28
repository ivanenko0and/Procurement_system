<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="http://fonts.cdnfonts.com/css/open-sans" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/lato" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php
    require "modules\\menuModule.php";
    ?>
    <title>Supply.ua</title>
</head>
<body>
    <header>
        <?php menu(); ?>
    </header>
    <main>
        <div class="container">
                <h1>Інформаційна система адміністрування закупівельної <br> логістики підприємств</h1>
                <p id="sub_text">Автоматизація процесів закупівлі товарів, організації доставки та ведення обліку майна</p>
                
                <form action="registration.php">
                    <input type="submit" id="start_button" value="Зареєструватись">
                </form>
        </div>
    </main>
</body>
</html>