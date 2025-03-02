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
        if (isset($_POST["Broj"]) && isset($_POST["Napomena"])) {

            $sql = "INSERT INTO `polica`(`Broj`, `Napomena`) VALUES ('".$_POST["Broj"]."','".$_POST["Napomena"]."')";

            if ($DB->query($sql) === TRUE) {
                echo "Record inserted successfully";
                $last_id = $DB->insert_id;
                header("Location: ./polica-uredi.php?id=".$last_id."&return=.%2Fvrsta-lista.php");
                exit;
            } else {
                echo "Error inserting record: " . $DB->error;
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            Stvori novu policu
        </div>
        <div class="card-body">
            <form action="./polica-nova.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Broj:</span>
                    <input name="Broj" type="text" class="form-control" placeholder="Broj" aria-label="Broj" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Napomena:</span>
                    <input name="Napomena" type="text" class="form-control" placeholder="Napomena" aria-label="Napomena" aria-describedby="basic-addon1">
                </div>
                <button class="btn btn-primary">Stvori vrstu</button>
                <a class="btn btn-danger" href="./polica-lista.php?page=1">Odustavi</a>
            </form>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>