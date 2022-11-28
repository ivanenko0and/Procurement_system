<?php

function commodityList(){
    
    require "dataBaseModule.php";

    $results = $conn->query('SELECT Id FROM account WHERE Login="'. $_POST["login"].'"');
    $row = $results->fetch_assoc();
    $company_id = $row["Id"];

    $results = $conn->query('SELECT * FROM affiliate WHERE Company_Id="'. $company_id.'"');

    if($results->num_rows > 0){
        while ($row = $results->fetch_assoc()) {
            echo '
            <div class="information_block">
            <div>
            <h4> Філія </h4>
            <p> Адреса: '. $row["Address"] .'</p>
            <p> Опис: '. $row["Description"] .'</p></div>
            </div>
            ';

            $affiliate_id = $row["Id"];

            $results2 = $conn->query('SELECT * FROM commodity WHERE Owner_Id="'. $row["Id"].'"');
            
            echo '<h5> Майно філії: </h5>';

            if($results2->num_rows > 0){
                while ($row2 = $results2->fetch_assoc()) {

                    if($_POST["phase"]==2){

                        if($_POST["part"]==$row2["Id"]){
                            $conn->query('UPDATE commodity SET Name="'. $_POST["name"]. '", Number="'. $_POST["number"]. '", Cost="'. $_POST["cost"]. '", Description="'. $_POST["description"]. '" 
                            WHERE Id="'. $_POST["part"].'";');

                            echo'
                            <form name="authPost" id="authPost" action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                            <input type="hidden" name="login" value="'. $_POST["login"].'">
                            <script>
                                document.authPost.submit();
                            </script>
                            ';
                        }

                    }else{

                        if($_POST["part"]==$row2["Id"]){
                            echo '
                            <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                                <div class="information_block">
                                    <div><p> Назва: <input type="text" name="name" value="'. $row2["Name"] .'"></p>
                                    <p> Кількість: <input type="text" name="number" value="'. $row2["Number"] .'"></p>
                                    <p> Ціна: <input type="text" name="cost" value="'. $row2["Cost"] .'"></p>
                                    <p> Опис: <input type="text" class="description_field" name="description" value="'. $row2["Description"] .'"></p></div>
                    
                                    <div><input type="hidden" name="login" value="'.$_POST["login"].'">
                                    <input type="hidden" name="phase" value=2>
                                    <input type="hidden" name="part" value='. $row2["Id"] .'>
                                    <input type="submit" value="Зберегти"></div>
                                </div>
                            </form>
                            ';

                        }else{
                            echo '
                            <div class="information_block">
                            <div><p> Назва: '. $row2["Name"] .'</p>
                            <p> Кількість: '. $row2["Number"] .'</p>
                            <p> Ціна: '. $row2["Cost"] .'</p>
                            <p> Опис: '. $row2["Description"] .'</p></div>
        
                            <div><form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
                                <input type="hidden" name="login" value="'. $_POST["login"].'">
                                <input type="hidden" name="phase" value=1>
                                <input type="hidden" name="part" value='. $row2["Id"] .'>
                                <input type="submit" value="Редагувати">
                            </form></div>
                            </div>
        
                            <br>
                            ';
                        }

                    }

                    
                }
            }

            addCommodity($affiliate_id);
            
        }
    }

    $conn->close();
    
}


function addCommodity($affiliate_id){

    if($_POST["phase"]==3 && $_POST["part"]==$affiliate_id){

        require "dataBaseModule.php";
        
        $conn->query('INSERT INTO commodity(Owner_Id, Name, Number, Cost, Description) VALUES ("'. $affiliate_id. '", "", 0, 0, "");');

        $results = $conn->query('SELECT * FROM commodity WHERE Owner_Id="'. $affiliate_id.'"');

        $commodity_id = -1;
        while ($row = $results->fetch_assoc()){
            $commodity_id = $row["Id"];
        }
        
        echo'
        <form name="authPost" id="authPost" action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
        <input type="hidden" name="login" value="'. $_POST["login"].'">
        <input type="hidden" name="phase" value=1>
        <input type="hidden" name="part" value='. $commodity_id .'>
        <script>
            document.authPost.submit();
        </script>
        ';

    }else{
        echo '
        <form action="'. htmlentities($_SERVER["PHP_SELF"]).'" method="post">
            <input type="hidden" name="login" value="'. $_POST["login"].'">
            <input type="hidden" name="phase" value=3>
            <input type="hidden" name="part" value="'. $affiliate_id.'">
            <input type="submit" value="Додати майно">
        </form>
        <br>
        <br>
        ';
    }

}

?>