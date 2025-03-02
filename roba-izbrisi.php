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
        $vrsta;
        $error = 0;
        if (isset($_GET["id"])) {
            $query = $DB->query("SELECT `roba`.*, `vrstarobe`.`Naziv` AS 'Vrsta', `vrstarobe`.`Napomena` AS 'Vrsta_Napomena', `zakupac`.`ID` AS 'Zakupac_ID', `zakupac`.`Ime` AS 'Zakupac_Ime', `zakupac`.`Prezime` AS 'Zakupac_Prezime' FROM `roba`, `vrstarobe`, `zakupac` WHERE `roba`.`VrstaRobe_ID` = `vrstarobe`.`ID` AND `roba`.`Zakupac_ID` = `zakupac`.`ID` AND `roba`.`ID` = ".$_GET["id"]);

            while($row = $query->fetch_assoc()) {
                $vrsta = $row;
            }
        }
        elseif (isset($_POST["id"]) && isset($_POST["delete"])) {
            if ($_POST['delete'] != 'true') {
                header("Location: ./uredi-vrstu.php?id=".$_POST["id"]);
                exit;
            }

            $sql = "UPDATE `polica` SET `Roba_ID` = NULL WHERE `Roba_ID` = ".$_POST["id"]."; DELETE FROM `roba` WHERE `ID` = ".$_POST["id"];
            if ($DB->multi_query($sql) === TRUE) {
                echo "Record deleted successfully";

                header("Location: ./roba-lista.php?page=1");
                exit;
            } else {
                $error = 1;
                print($DB -> error);
                print($DB -> sql);
                $query = $DB->query("SELECT `roba`.*, `vrstarobe`.`Naziv` AS 'Vrsta', `vrstarobe`.`Napomena` AS 'Vrsta_Napomena', `zakupac`.`ID` AS 'Zakupac_ID', `zakupac`.`Ime` AS 'Zakupac_Ime', `zakupac`.`Prezime` AS 'Zakupac_Prezime' FROM `roba`, `vrstarobe`, `zakupac` WHERE `roba`.`VrstaRobe_ID` = `vrstarobe`.`ID` AND `roba`.`Zakupac_ID` = `zakupac`.`ID` AND `roba`.`ID` = ".$_POST["id"]);

                while($row = $query->fetch_assoc()) {
                    $vrsta = $row;
                }
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header bg-danger">
            #<?php print($vrsta["ID"]); ?> - <?php print($vrsta["Naziv"]); ?>
        </div>
        <div class="card-body">
            <?php 
                if ($error == 1) {
                    print("<div class=\"alert alert-danger\" role=\"alert\"><h3>Roba se ne može izbrisati!</h3><hr><p>Nepoznata greška...</p></div>");
                }
            ?>

            <form action="./roba-izbrisi.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Naziv</span>
                    <input disabled name="naziv" type="text" class="form-control" placeholder="Naziv" aria-label="Naziv" aria-describedby="basic-addon1" value="<?php print($vrsta["Naziv"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Istječe</span>
                    <input disabled name="napomena" type="text" class="form-control" placeholder="Napomena" aria-label="Napomena" aria-describedby="basic-addon1" value="<?php print($vrsta["Istjece"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Vrsta</span>
                    <input disabled name="napomena" type="text" class="form-control" placeholder="Napomena" aria-label="Napomena" aria-describedby="basic-addon1" value="<?php print($vrsta["Vrsta"]); ?>, (<?php print($vrsta["Vrsta_Napomena"]); ?>)">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Zakupac</span>
                    <input disabled name="napomena" type="text" class="form-control" placeholder="Napomena" aria-label="Napomena" aria-describedby="basic-addon1" value="<?php print($vrsta["Zakupac_ID"]); ?> - <?php print($vrsta["Zakupac_Ime"]); ?> <?php print($vrsta["Zakupac_Prezime"]); ?>">
                </div>

                <input type="hidden" name="id" value="<?php print($vrsta["ID"]); ?>">
                <input type="hidden" name="delete" value="true">
                <button class="btn btn-primary">Izbriši zauvijek</button>
                <a class="btn btn-danger" href="./roba-uredi.php?id=<?php print($vrsta["ID"]); ?>">Odustani</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>