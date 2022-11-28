<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="http://fonts.cdnfonts.com/css/open-sans" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/lato" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php
    require "modules\\menuModule.php";
    require "modules\\partnersModule.php";
    ?>
    <title>Supply.ua</title>
</head>
<body>
    <header>
        <?php menu(); ?>
    </header>
    <main>
        <div class="container">
            <div class="content_block" class="text_block">
                <h4 align="center">Наші партнери:</h4>

                <h5>Підприємства-поставники:</h5>
                <?php partners("Provider") ?>

                <h5>Транспортні компанії:</h5>
                <?php partners("Transport") ?>

                <h5>Підприємства-замовники:</h5>
                <?php partners("Purchaser") ?>
            </div>
        </div>
    </main>
</body>
</html>