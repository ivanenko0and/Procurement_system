<?php

function partners($company_type){
    require "dataBaseModule.php";

    $results = $conn->query('SELECT * FROM account WHERE Type="'. $company_type.'"');
    while ($row = $results->fetch_assoc()) {
        echo '
            <div class="information_block">
            <div><p> Назва: '. $row["Name"] .'</p>
            <p> Адреса головного офісу: '. $row["Head_office_address"] .'</p>
            <p> Контакти: '. $row["Contact"] .'</p>
            <p> Опис: '. $row["Description"] .'</p></div>
            </div>
            ';
    }

    $conn->close();
}

?>