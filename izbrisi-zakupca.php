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
        $error = 0;
        if (isset($_GET["id"])) {
            $query = $DB->query("SELECT * FROM `zakupac` WHERE `ID` = ".$_GET["id"]);

            while($row = $query->fetch_assoc()) {
                $zakupac = $row;
            }
        }
        elseif (isset($_POST["id"]) && isset($_POST["delete"])) {
            if ($_POST['delete'] != 'true') {
                header("Location: ./uredi-zakupca.php?id=".$_POST["id"]);
                exit;
            }

            $sql = "DELETE FROM `zakupac` WHERE `ID` = ".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record deleted successfully";

                header("Location: ./zakupci.php?page=1");
                exit;
            } else {
                $error = 1;

                $query = $DB->query("SELECT * FROM `zakupac` WHERE `ID` = ".$_POST["id"]);

                while($row = $query->fetch_assoc()) {
                    $zakupac = $row;
                }
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header bg-danger">
            #<?php print($zakupac["ID"]); ?> - <?php print($zakupac["Ime"]); ?> <?php print($zakupac["Prezime"]); ?>
        </div>
        <div class="card-body">
            <?php 
                if ($error == 1) {
                    print("<div class=\"alert alert-danger\" role=\"alert\"><h3>Zakupac se ne može izbrisati!</h3><hr><p>Provjerite je li zakupac ima robu upisanu na svoje ime...</p></div>");
                }
            ?>

            <form action="./izbrisi-zakupca.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Ime</span>
                    <input disabled name="ime" type="text" class="form-control" placeholder="Ime" aria-label="Ime" aria-describedby="basic-addon1" value="<?php print($zakupac["Ime"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Prezime</span>
                    <input disabled name="prezime" type="text" class="form-control" placeholder="Prezime" aria-label="Prezime" aria-describedby="basic-addon1" value="<?php print($zakupac["Prezime"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Telefon</span>
                    <input disabled name="telefon" type="tel" class="form-control" placeholder="Telefon" aria-label="Telefon" aria-describedby="basic-addon1" value="<?php print($zakupac["Telefon"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">eMail</span>
                    <input disabled name="email" type="text" class="form-control" placeholder="eMail" aria-label="eMail" aria-describedby="basic-addon1" value="<?php print($zakupac["Mail"]); ?>">
                </div>

                <input type="hidden" name="id" value="<?php print($zakupac["ID"]); ?>">
                <input type="hidden" name="delete" value="true">
                <button class="btn btn-primary">Izbriši zauvijek</button>
                <a class="btn btn-danger" href="./uredi-zakupca.php?id=<?php print($zakupac["ID"]); ?>">Odustani</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>