<?php

function profile(){
    
    require "dataBaseModule.php";

    $results = $conn->query('SELECT * FROM account WHERE Login="'. $_POST["login"].'"');
    $row = $results->fetch_assoc();

    echo '
    <div class="information_block">

    <div><p> Назва: '. $row["Name"] .'</p>
    <p> Адреса говловного офісу: '. $row["Head_office_address"] .'</p>
    <p> Контакти: '. $row["Contact"] .'</p>
    <p> Опис: '. $row["Description"] .'</p></div>

    <div><form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
        <input type="hidden" name="login" value="'. $_POST["login"].'">
        <input type="hidden" name="phase" value=1>
        <input type="hidden" name="part" value=0>
        <input type="submit" value="Редагувати">
    </form></div>

    </div>
    ';

    $conn->close();

}


function affiliate(){

    require "dataBaseModule.php";

    $results = $conn->query('SELECT * FROM account WHERE Login="'. $_POST["login"].'"');
    $row = $results->fetch_assoc();
    $company_id = $row["Id"];

    $results = $conn->query('SELECT * FROM affiliate WHERE Company_Id="'. $company_id.'"');

    if($results->num_rows > 0){
        echo '<br><h4> Філії: </h4>';
        while ($row = $results->fetch_assoc()) {
            echo '
            <br>
            <div class="information_block">

            <div><p> Адреса: '. $row["Address"] .'</p>
            <p> Контакти: '. $row["Contact"] .'</p>
            <p> Опис: '. $row["Description"] .'</p></div>

            <div><form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                <input type="hidden" name="login" value="'. $_POST["login"].'">
                <input type="hidden" name="phase" value=1>
                <input type="hidden" name="part" value='. $row["Id"] .'>
                <input type="submit" value="Редагувати">
            </form></div>

            </div>
            ';
            
        }
    }

    $conn->close();

}


function profileRedacting(){
    
    require "dataBaseModule.php";

    $results = $conn->query('SELECT * FROM account WHERE Login="'. $_POST["login"].'"');
    $row = $results->fetch_assoc();

    $name = $row["Name"];
    $address = $row["Head_office_address"];
    $contact = $row["Contact"];
    $description = $row["Description"];

    echo '
    
    <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
        <div class="information_block">
            <div><p> Назва: <input type="text" name="name" value="'. $name.'"> </p>
            <p> Адреса головного офісу: <input type="text" name="address" value="'. $address.'"> </p>
            <p> Контакти: <input type="text" name="contact" value="'. $contact.'"> </p>
            <p> Опис: <input type="text" class="description_field" name="description" value="'. $description.'"> </p></div>

            <input type="hidden" name="login" value="'.$_POST["login"].'">
            <input type="hidden" name="phase" value=2>
            <input type="hidden" name="part" value=0>
            <div><input type="submit" value="Зберегти"></div>
        </div>
    </form>
    
    ';

    $conn->close();

}


function affiliateRedacting(){

    require "dataBaseModule.php";

    $results = $conn->query('SELECT * FROM account WHERE Login="'. $_POST["login"].'"');
    $row = $results->fetch_assoc();
    $company_id = $row["Id"];


    $results = $conn->query('SELECT * FROM affiliate WHERE Company_Id="'. $company_id.'"');

    if($results->num_rows > 0){
        echo '<br><h4> Філії: </h4>';
        while ($row = $results->fetch_assoc()) {


            if($_POST["part"]==$row["Id"]){
                echo '
                <br>
                <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                    <div class="information_block">
                        <div><p> Адреса: <input type="text" name="address" value="'. $row["Address"] .'"></p>
                        <p> Контакти: <input type="text" name="contact" value="'. $row["Contact"] .'"></p>
                        <p> Опис: <input type="text" class="description_field" name="description" value="'. $row["Description"] .'"></p></div>
        
                        <input type="hidden" name="login" value="'.$_POST["login"].'">
                        <input type="hidden" name="phase" value=2>
                        <input type="hidden" name="part" value='. $row["Id"] .'>
                        <div><input type="submit" value="Зберегти"></div>
                    </div>
                </form>
                ';
            }else{
                echo '
                <br>
                <div class="information_block">

                <div><p> Адреса: '. $row["Address"] .'</p>
                <p> Контакти: '. $row["Contact"] .'</p>
                <p> Опис: '. $row["Description"] .'</p></div>

                <div><form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                    <input type="hidden" name="login" value="'. $_POST["login"].'">
                    <input type="hidden" name="phase" value=1>
                    <input type="hidden" name="part" value='. $row["Id"] .'>
                    <input type="submit" value="Редагувати">
                </form></div>

                </div>
                ';
            }   
            
        }
    }

    $conn->close();

}


function saving(){

    require "dataBaseModule.php";

    if($_POST["part"]==0){
        $conn->query('UPDATE account SET Name="'. $_POST["name"]. '", Head_office_address="'. $_POST["address"]. '", 
        Contact="'. $_POST["contact"]. '", Description="'. $_POST["description"]. '" WHERE Login="'. $_POST["login"].'";');
    }else{
        if($_POST["part"]>0){
            $results = $conn->query('SELECT * FROM account WHERE Login="'. $_POST["login"].'"');
            $row = $results->fetch_assoc();
            $company_id = $row["Id"];

            $conn->query('UPDATE affiliate SET Address="'. $_POST["address"]. '", Contact="'. $_POST["contact"]. '", Description="'. $_POST["description"]. '" 
            WHERE Id="'. $_POST["part"].'" AND Company_Id="'. $company_id.'";');
        }
    }
        
    echo'
    <form name="authPost" id="authPost" action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
    <input type="hidden" name="login" value="'. $_POST["login"].'">
    <script>
        document.authPost.submit();
    </script>
    ';

    $conn->close();

}

function addAffiliate(){

    if($_POST["phase"]==3){

        require "dataBaseModule.php";

        $results = $conn->query('SELECT Id FROM account WHERE Login="'. $_POST["login"].'"');
        $row = $results->fetch_assoc();
        $company_id = $row["Id"];
        
        $conn->query('INSERT INTO affiliate(Company_Id, Contact, Address, Description) VALUES ("'. $company_id. '", "", "", "");');

        $results = $conn->query('SELECT Id FROM affiliate WHERE Company_Id="'. $company_id.'"');

        $affiliate_id = -1;
        while ($row = $results->fetch_assoc()){
            $affiliate_id = $row["Id"];
        }

        echo'
        <form name="authPost" id="authPost" action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
        <input type="hidden" name="login" value="'. $_POST["login"].'">
        <input type="hidden" name="phase" value=1>
        <input type="hidden" name="part" value='. $affiliate_id .'>
        <script>
            document.authPost.submit();
        </script>
        ';

        $conn->close();

    }else{
        echo '
        <br>
        <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
            <input type="hidden" name="login" value="'. $_POST["login"].'">
            <input type="hidden" name="phase" value=3>
            <input type="submit" value="Додати філію">
        </form>
        ';
    }

}

        
?>