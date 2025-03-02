<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <title>Zakupci</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/header.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php'); ?>
    <?php
        $zakupac;
        $roba = [];
        if (isset($_GET["id"])) {
            //SELECT `roba`.`ID`, `roba`.`Naziv`, `roba`.`Istjece`, `vrstarobe`.`Naziv`, `vrstarobe`.`Napomena`, `zakupac`.`ID` AS 'Zakupac_ID', `zakupac`.`Ime`, `zakupac`.`Prezime`, `zakupac`.`Telefon`, `zakupac`.`Mail` FROM `roba`, `vrstarobe`, `zakupac` WHERE `roba`.`Zakupac_ID` = 1 AND `roba`.`VrstaRobe_ID` = `vrstarobe`.`ID` AND `roba`.`Zakupac_ID` = `zakupac`.`ID`;
            $query = $DB->query("SELECT * FROM `zakupac` WHERE `ID` = ".$_GET["id"]);

            while($row = $query->fetch_assoc()) {
                $zakupac = $row;
            }

            $query = $DB->query("SELECT `roba`.`ID`, `roba`.`Naziv`, `roba`.`Istjece`, `vrstarobe`.`Naziv` AS 'vrstarobeNaziv', `vrstarobe`.`Napomena` FROM `roba`, `vrstarobe` WHERE `roba`.`Zakupac_ID` = ".$_GET["id"]." AND `roba`.`VrstaRobe_ID` = `vrstarobe`.`ID`;");

            while ($row = $query->fetch_assoc()) {
                array_push($roba, $row);
            }
        }
        else{
            header('Location: ./zakupci.php?page=1');
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            <button class="btn btn-primary" onclick="window.location.assign('./roba-nova.php')">Nova roba</button>
            <button class="btn btn-danger" onclick="window.location.assign('./zakupci.php')">Natrag</button>
        </div>
    </div>
    <div class="card m-4">
        <div class="card-header">
            #<?php print($zakupac["ID"]); ?> - <?php print($zakupac["Ime"]); ?> <?php print($zakupac["Prezime"]); ?>
        </div>
        <div class="card-body">
            <?php
                for ($i=0; $i < sizeof($roba); $i++) {
                    $upozorenjeDatuma = '';
                    if (new DateTime() > new DateTime($roba[$i]['Istjece'])) {
                        $upozorenjeDatuma = '⚠️';
                    }

                    print("<div class=\"card m-4\">
                        <div class=\"card-header\">
                        #".$roba[$i]['ID']." - ".$roba[$i]['Naziv']."
                        </div>
                        <ul class=\"list-group list-group-flush\">
                            <li class=\"list-group-item\">ID: ".$roba[$i]['ID']."</li>
                            <li class=\"list-group-item\">Naziv: ".$roba[$i]['Naziv']."</li>
                            <li class=\"list-group-item\">Istejče: ".$roba[$i]['Istjece']." ".$upozorenjeDatuma."</li>
                            <li class=\"list-group-item\">Vrsta: ".$roba[$i]['vrstarobeNaziv']."</li>
                            <li class=\"list-group-item\">Napomena Vrste: ".$roba[$i]['Napomena']."</li>
                        </ul>
                        <div class=\"card-footer\">
                            <button class=\"btn btn-primary\" onclick=\"window.location.assign('./roba-uredi.php?id=".$roba[$i]['ID']."')\">Uredi</button>
                        </div>
                    </div>");
                }
            ?>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>