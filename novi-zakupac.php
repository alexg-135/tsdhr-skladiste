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
        if (isset($_POST["ime"]) && isset($_POST["prezime"]) && isset($_POST["telefon"]) && isset($_POST["email"])) {
            print($_POST["ime"]);
            print($_POST["prezime"]);
            print($_POST["telefon"]);
            print($_POST["email"]);

            $sql = "INSERT INTO `zakupac`(`Ime`, `Prezime`, `Telefon`, `Mail`) VALUES ('".$_POST["ime"]."','".$_POST["prezime"]."','".$_POST["telefon"]."','".$_POST["email"]."')";

            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";
                $last_id = $DB->insert_id;
                header("Location: ./uredi-zakupca.php?id=".$last_id);
                exit;
            } else {
                echo "Error inserting record: " . $DB->error;
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            Stvori novog zakupca
        </div>
        <div class="card-body">
            <form action="./novi-zakupac.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Ime:</span>
                    <input name="ime" type="text" class="form-control" placeholder="Ime" aria-label="Ime" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Prezime:</span>
                    <input name="prezime" type="text" class="form-control" placeholder="Prezime" aria-label="Prezime" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Telefon:</span>
                    <input name="telefon" type="tel" class="form-control" placeholder="Telefon" aria-label="Telefon" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">eMail:</span>
                    <input name="email" type="text" class="form-control" placeholder="eMail" aria-label="eMail" aria-describedby="basic-addon1">
                </div>
                <button class="btn btn-primary">Stvori zakupca</button>
                <a class="btn btn-danger" href="./zakupci.php?page=1">Odustavi</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>