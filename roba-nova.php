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
        if (isset($_POST["Naziv"]) && isset($_POST["Istjece"]) && isset($_POST["VrstaRobe_ID"]) && isset($_POST["Zakupac_ID"])) {

            $sql = "INSERT INTO `roba`(`Naziv`, `Istjece`, `VrstaRobe_ID`, `Zakupac_ID`) VALUES ('".$_POST["Naziv"]."','".$_POST["Istjece"]."','".$_POST["VrstaRobe_ID"]."','".$_POST["Zakupac_ID"]."')";

            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";
                $last_id = $DB->insert_id;
                header("Location: ./roba-uredi.php?id=".$last_id);
                exit;
            } else {
                echo "Error inserting record: " . $DB->error;
            }
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            Stvori novu robu
        </div>
        <ul class="list-group list-group-flush">
            <form action="./roba-nova.php" method="POST">
            <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Naziv:</span>
                        <input type="text" name="Naziv" placeholder="Naziv robe" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Istječe:</span>
                        <input type="datetime-local" name="Istjece" placeholder="Istjek robe" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Vrsta:</span>
                        <select class="form-select" name="VrstaRobe_ID" id="VrstaRobe_ID">
                        <?php
                            $vrste = [];
                            $query = $DB->query("SELECT * FROM `vrstarobe`");
                            while ($row = $query->fetch_assoc()) {
                                print('<option value="'.$row['ID'].'">'.$row['Naziv'].', ('.$row['Napomena'].')</option>');
                            }
                        ?>
                        </select>
                        <button class="btn btn-primary" id="urediVrstu" type="button">Uredi vrstu</button>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Zakupac:</span>
                        <select class="form-select" name="Zakupac_ID" id="Zakupac_ID">
                        <?php
                            $vrste = [];
                            $query = $DB->query("SELECT * FROM `zakupac`");
                            while ($row = $query->fetch_assoc()) {
                                print('<option value="'.$row['ID'].'">#'.$row['ID'].', ('.$row['Ime'].' '.$row['Prezime'].')</option>');
                            }
                        ?>
                        </select>
                    </div>
                </li>
                <li class="list-group-item">
                    <button class="btn btn-primary">Stvori robu</button>
                    <a class="btn btn-danger" href="./roba-lista.php?page=1">Odustavi</a>
                </li>
            </form>
        </ul>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>