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
        if (isset($_GET["id"])) {
            $query = $DB->query("SELECT * FROM `zakupac` WHERE `ID` = ".$_GET["id"]);

            while($row = $query->fetch_assoc()) {
                $zakupac = $row;
            }
        }elseif (isset($_POST["id"]) && isset($_POST["ime"]) && isset($_POST["prezime"]) && isset($_POST["telefon"]) && isset($_POST["email"])) {
            
            $sql = "UPDATE `zakupac` SET `Ime`='".$_POST["ime"]."',`Prezime`='".$_POST["prezime"]."',`Telefon`='".$_POST["telefon"]."',`Mail`='".$_POST["email"]."' WHERE `ID`=".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";

                header("Location: ./uredi-zakupca.php?id=".$_POST['id']);
                exit;
            } else {
                echo "Error updating record: " . $DB->error;
            }
            exit;
        }
        else{
            header("Location: ./zakupci.php?page=1");
            exit;
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            #<?php print($zakupac["ID"]); ?> - <?php print($zakupac["Ime"]); ?> <?php print($zakupac["Prezime"]); ?>
        </div>
        <div class="card-body">
            <form action="./uredi-zakupca.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Ime</span>
                    <input name="ime" type="text" class="form-control" placeholder="Ime" aria-label="Ime" aria-describedby="basic-addon1" value="<?php print($zakupac["Ime"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Prezime</span>
                    <input name="prezime" type="text" class="form-control" placeholder="Prezime" aria-label="Prezime" aria-describedby="basic-addon1" value="<?php print($zakupac["Prezime"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Telefon</span>
                    <input name="telefon" type="tel" class="form-control" placeholder="Telefon" aria-label="Telefon" aria-describedby="basic-addon1" value="<?php print($zakupac["Telefon"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">eMail</span>
                    <input name="email" type="text" class="form-control" placeholder="eMail" aria-label="eMail" aria-describedby="basic-addon1" value="<?php print($zakupac["Mail"]); ?>">
                </div>
                <input type="hidden" name="id" value="<?php print($zakupac["ID"]); ?>">
                <button class="btn btn-primary">Spremi</button>
                <a class="btn btn-danger" href="./zakupci.php?page=1">Natrag</a>
                <a class="btn btn-danger" href="./izbrisi-zakupca.php?id=<?php print($zakupac["ID"]); ?>">Izbriši zakupca</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>