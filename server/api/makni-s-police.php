<?php
    include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php');

    if(isset($_POST['Polica_ID'])){
        $sql = "UPDATE `polica` SET `Roba_ID` = NULL WHERE `ID` = ".$_POST['Polica_ID'];
        
        if ($DB->query($sql) === TRUE) {
            echo "true";
            exit;
        } else {
            echo "false";
        }
    }else{
        echo "false";
    }
?>