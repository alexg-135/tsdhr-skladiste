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
        $vrsta = [];
        if (isset($_GET["id"]) && isset($_GET['return'])) {

            $query = $DB->query("SELECT * FROM `vrstarobe` WHERE `ID` = ".$_GET["id"]);
            while ($row = $query->fetch_assoc()) {
                $vrsta = $row;
            }
        }
        else if (isset($_POST["id"]) && isset($_POST["return"]) && isset($_POST["Naziv"]) && isset($_POST["Napomena"])) {
            $sql = "UPDATE `vrstarobe` SET `Naziv`='".$_POST["Naziv"]."',`Napomena`='".$_POST["Napomena"]."' WHERE `ID` = ".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";

                header("Location: ./uredi-vrstu.php?id=".$_POST['id']."&return=".urlencode($_POST['return']));
                exit;
            } else {
                echo "Error updating record: " . $DB->error;
            }
            exit;
        }
        else{
            header('Location: ./vrsta-lista.php?page=1');
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            <button class="btn btn-primary" onclick="$('#form').submit()">Spremi</button>
            <button class="btn btn-danger" onclick="window.location.assign('./vrsta-izbrisi.php?id=<?php print($_GET['id']) ?>')">Izbriši</button>
            <button class="btn btn-danger" onclick="window.location.assign('<?php print($_GET['return']);?>')">Odustani</button>
        </div>
        <form action="./uredi-vrstu.php" method="POST" id="form">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: <?php print($vrsta['ID']); ?></li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Naziv:</span>
                    <input type="text" name="Naziv" value="<?php print($vrsta['Naziv']); ?>" class="form-control">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Napomena:</span>
                    <input type="text" name="Napomena" value="<?php print($vrsta['Napomena']); ?>" class="form-control">
                </div>
            </li>
        </ul>
        <input type="hidden" name="id" value="<?php print($_GET['id']); ?>">
        <input type="hidden" name="return" value="<?php print($_GET['return']); ?>">
        </form>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>