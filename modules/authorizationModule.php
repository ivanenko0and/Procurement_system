<?php

function signIn(){
    
    require "dataBaseModule.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $login = $_POST["login"];
        $pass = $_POST["pass"];

        $results = $conn->query('SELECT * FROM account WHERE Login="'. $login. '" AND Password="'. $pass. '"');

        if($results->num_rows > 0){
            while ($row = $results->fetch_assoc()) {
                echo'
                <form name="authPost" id="authPost" action="profile.php" method="post">
                <input type="hidden" name="login" value="'.$login .'">
                <script>
                    document.authPost.submit();
                </script>
               ';
            }
        }else{
            $results = $conn->query('SELECT * FROM account WHERE Login="'. $login. '"');
            if($results->num_rows > 0){
               return "loginError";
            }else{
               return "passError";
            }
        }

    }
    $conn->close();
    
}

?>