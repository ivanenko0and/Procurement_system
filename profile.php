<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="http://fonts.cdnfonts.com/css/open-sans" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/lato" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php
    require "modules\\menuModule.php";
    require "modules\\profileModule.php";
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
            <h4>Профіль підприємства:</h4>
            <?php 
            if($_POST["phase"]==1 && $_POST["part"]==0){
                profileRedacting();
                affiliate();
            }else{
                if($_POST["phase"]==1 && $_POST["part"]>0){
                    profile();
                    affiliateRedacting();

                }else{
                    if($_POST["phase"]==2){
                        saving();
                    }else{
                        profile(); 
                        affiliate();
                        addAffiliate();
                    }
                }
            }
            ?>
            </div>
        </div>
    </main>
</body>
</html>