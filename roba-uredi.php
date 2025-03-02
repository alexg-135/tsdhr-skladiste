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
        $roba = [];
        if (isset($_GET["id"])) {
            $query = $DB->query("SELECT `roba`.`ID`, `roba`.`Naziv`, `roba`.`Istjece`, `vrstarobe`.`ID` AS 'vrstarobeID', `vrstarobe`.`Naziv` AS 'vrstarobeNaziv', `vrstarobe`.`Napomena`, `zakupac`.`ID` AS 'ZakupacID' FROM `roba`, `vrstarobe`, `zakupac` WHERE `roba`.`ID` = ".$_GET["id"]." AND `roba`.`VrstaRobe_ID` = `vrstarobe`.`ID` AND `roba`.`Zakupac_ID` = `zakupac`.`ID`;");
            while ($row = $query->fetch_assoc()) {
                $roba = $row;
            }
        }
        else if(isset($_POST['id']) && isset($_POST['Naziv']) && isset($_POST['Istjece']) && isset($_POST['VrstaRobe_ID']) && isset($_POST['Zakupac_ID'])){
            $sql = "UPDATE `roba` SET `Naziv`='".$_POST['Naziv']."',`Istjece`='".$_POST['Istjece']."',`VrstaRobe_ID`='".$_POST['VrstaRobe_ID']."', `Zakupac_ID`='".$_POST['Zakupac_ID']."' WHERE `ID` = ".$_POST["id"];
            if ($DB->query($sql) === TRUE) {
                echo "Record updated successfully";

                header("Location: ./roba-uredi.php?id=".$_POST['id']);
                exit;
            } else {
                echo "Error updating record: " . $DB->error;
            }
            exit;
        }
        else{
            header('Location: ./zakupci.php?page=1');
        }
    ?>
    <div class="card m-4">
        <div class="card-header">
            <button class="btn btn-primary" onclick="$('#form').submit()">Spremi</button>
            <button class="btn btn-danger" onclick="window.location.assign('./roba-izbrisi.php?id=<?php print($roba['ID']); ?>')">Izbriši</button>
        </div>
        <ul class="list-group list-group-flush">
            <form action="./roba-uredi.php" method="POST" id="form">
            <li class="list-group-item">ID: <?php print($roba['ID']); ?></li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Naziv:</span>
                    <input type="text" name="Naziv" value="<?php print($roba['Naziv']); ?>" class="form-control">
                </div>
            </li>
            <li class="list-group-item">
                <div class="input-group">
                    <span class="input-group-text">Istječe:</span>
                    <input type="datetime-local" name="Istjece" value="<?php print($roba['Istjece']); ?>" class="form-control">
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
                            $select = "";
                            if($row['ID'] == $roba['vrstarobeID']){
                                $select = ' selected';
                            }
                            print('<option value="'.$row['ID'].'"'.$select.'>'.$row['Naziv'].', ('.$row['Napomena'].')</option>');
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
                            $select = "";
                            if($row['ID'] == $roba['ZakupacID']){
                                $select = ' selected';
                            }
                            print('<option value="'.$row['ID'].'"'.$select.'>#'.$row['ID'].', ('.$row['Ime'].' '.$row['Prezime'].')</option>');
                        }
                    ?>
                    </select>
                </div>
            </li>
            <input type="hidden" name="id" value="<?php print($roba['ID']); ?>">
            </form>
        </ul>
    </div>
    <div class="card m-4">
        <div class="card-header">
            Police
        </div>
        <div class="card-body">
            <?php
                $query = $DB->query("SELECT * FROM `polica` WHERE `Roba_ID` = ".$_GET["id"]);
                while ($row = $query->fetch_assoc()) {
                    print('<div class="card m-4">
                            <div class="card-header">
                                Polica - Br. '.$row['Broj'].', #'.$row['ID'].'
                            </div>
                            <div class="card-body">
                                <button class="btn btn-danger" onclick="makni('.$row['ID'].')">Makni sa police</button>
                            </div>
                            </div>');
                }
            ?>
            <div class="card m-4">
                <div class="card-header">
                    Polica - Dodaj
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <select class="form-select" id="dodajnapolicu">
                            <?php
                                $query = $DB->query("SELECT * FROM `polica` WHERE `Roba_ID` IS NULL");
                                while ($row = $query->fetch_assoc()) {
                                    if($row['ID'] == $roba['vrstarobeID']){
                                        $select = ' selected';
                                    }
                                    print('<option value="'.$row['ID'].'">Br. '.$row['Broj'].'  (#'.$row['ID'].')</option>');
                                }
                            ?>
                        </select>
                        <button class="btn btn-primary" onclick="dodaj()">Dodaj na policu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
    <script>
        $('#VrstaRobe_ID').on('change', promjeniBtn4VrstuRobe())
        function promjeniBtn4VrstuRobe() {$('#urediVrstu')[0].onclick = () => {window.location.assign('./uredi-vrstu.php?id='+$('#VrstaRobe_ID')[0].selectedOptions[0].value+'&return=.%2Froba-uredi.php%3Fid%3D<?php print($_GET["id"]);?>')}}
        promjeniBtn4VrstuRobe()

        function makni(Polica_ID) {
            $.ajax({
                url:"./server/api/makni-s-police.php",
                method:'POST',
                data:{
                    "Polica_ID":String(Polica_ID)
                },
                success: (data) => {
                    window.location.reload()
                }
            })
        }

        function dodaj() {
            Roba_ID='<?php print($_GET['id']); ?>'
            Polica_ID = String($('#dodajnapolicu')[0].selectedOptions[0].value)
            console.log(Roba_ID, Polica_ID);
            $.ajax({
                url:"./server/api/dodaj-na-policu.php",
                method:'POST',
                data:{
                    "Roba_ID":Roba_ID,
                    "Polica_ID":Polica_ID
                },
                success: (data) => {
                    window.location.reload()
                }
            })
        }
    </script>
</body>
</html>