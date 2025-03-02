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
        $polica;
        $error = 0;
        if (isset($_GET["id"])) {
            $query = $DB->query("SELECT * FROM `polica` WHERE `ID` = ".$_GET["id"]);

            while($row = $query->fetch_assoc()) {
                $polica = $row;
            }
        }
        elseif (isset($_POST["id"]) && isset($_POST["delete"])) {
            if ($_POST['delete'] != 'true') {
                header("Location: ./uredi-vrstu.php?id=".$_POST["id"]);
                exit;
            }

            $sql = "DELETE FROM `polica` WHERE `ID` = ".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record deleted successfully";

                header("Location: ./polica-lista.php?page=1");
                exit;
            } else {
                $error = 1;

                $query = $DB->query("SELECT * FROM `polica` WHERE `ID` = ".$_POST["id"]);

                while($row = $query->fetch_assoc()) {
                    $polica = $row;
                }
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header bg-danger">
            #<?php print($polica["ID"]); ?> - Br. <?php print($polica["Broj"]); ?>
        </div>
        <div class="card-body">
            <?php 
                if ($error == 1) {
                    print("<div class=\"alert alert-danger\" role=\"alert\"><h3>polica se ne može izbrisati!</h3><hr><p>Provjerite je li postoji roba na toj polici</p></div>");
                }
            ?>

            <form action="./polica-izbrisi.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Broj</span>
                    <input disabled name="naziv" type="text" class="form-control" placeholder="Naziv" aria-label="Naziv" aria-describedby="basic-addon1" value="<?php print($polica["Broj"]); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Napomena</span>
                    <input disabled name="napomena" type="text" class="form-control" placeholder="Napomena" aria-label="Napomena" aria-describedby="basic-addon1" value="<?php print($polica["Napomena"]); ?>">
                </div>

                <input type="hidden" name="id" value="<?php print($polica["ID"]); ?>">
                <input type="hidden" name="delete" value="true">
                <button class="btn btn-primary">Izbriši zauvijek</button>
                <a class="btn btn-danger" href="./polica-uredi.php?id=<?php print($polica["ID"]); ?>">Odustani</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>