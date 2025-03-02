<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <script src="./assets/jquery.js"></script>
    <title>Zakupci</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/header.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php'); ?>
    <?php
        $polica = [];
        if (isset($_GET["id"])) {

            $query = $DB->query("SELECT * FROM `polica` WHERE `ID` = ".$_GET["id"]);
            while ($row = $query->fetch_assoc()) {
                $polica = $row;
            }
        }
        else if (isset($_POST["id"]) && isset($_POST["Broj"]) && isset($_POST["Napomena"])) {
            $sql = "UPDATE `polica` SET `Broj`='".$_POST["Broj"]."', `Napomena`='".$_POST["Napomena"]."' WHERE `ID` = ".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";

                header("Location: ./polica-uredi.php?id=".$_POST['id']);
                exit;
            } else {
                echo "Error updating record: " . $DB->error;
            }
            exit;
        }
        else{
            header('Location: ./polica-lista.php?page=1');
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            <button class="btn btn-primary" onclick="$('#form').submit()">Spremi</button>
            <button class="btn btn-danger" onclick="window.location.assign('./polica-izbrisi.php?id=<?php print($_GET['id']) ?>')">Izbriši</button>
            <button class="btn btn-danger" onclick="window.location.assign('./polica-lista.php?')">Natrag</button>
        </div>
        <form action="./polica-uredi.php" method="POST" id="form">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: <?php print($polica['ID']); ?></li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Broj:</span>
                    <input type="text" name="Broj" value="<?php print($polica['Broj']); ?>" class="form-control">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Napomena:</span>
                    <input type="text" name="Napomena" value="<?php print($polica['Napomena']); ?>" class="form-control">
                </div>
            </li>
        </ul>
        <input type="hidden" name="id" value="<?php print($_GET['id']); ?>">
        </form>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>