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
        $brojcano_stanje;
        $stanje_polica;

        $query = $DB->query("SELECT COUNT(DISTINCT zakupac.ID) AS 'Broj_zakupac', COUNT(DISTINCT roba.ID) AS 'Broj_roba', COUNT(DISTINCT polica.ID) AS 'Broj_polica', COUNT(DISTINCT vrstarobe.ID) AS 'Broj_vrstarobe' FROM zakupac, roba, polica, vrstarobe;");
        while($row = $query->fetch_assoc()) {
            $brojcano_stanje = $row;
        }

        $query = $DB->query("SELECT COUNT(polica.ID) AS 'Ukupno', COUNT(polica.Roba_ID) AS 'Zauzeto', (COUNT(polica.ID) - COUNT(polica.Roba_ID)) AS 'Slobodno', (COUNT(polica.Roba_ID) / COUNT(polica.ID) * 100) AS 'Zauzeto_postotak', ((COUNT(polica.ID) - COUNT(polica.Roba_ID)) / COUNT(polica.ID) * 100) AS 'Slobodno_postotak' FROM polica;");
        while($row = $query->fetch_assoc()) {
            $stanje_polica = $row;
        }

        
    ?>
    <div class="card m-4">
        <div class="card-header">
            Evidencija stanja - ploča
        </div>
        <div class="card-body">
            <div class="card m-4">
                <div class="card-header">
                    Brojčano stanje - Ukupno
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Broj zakupaca: <?php print($brojcano_stanje['Broj_zakupac']); ?></li>
                    <li class="list-group-item">Broj robe: <?php print($brojcano_stanje['Broj_roba']); ?></li>
                    <li class="list-group-item">Broj polica: <?php print($brojcano_stanje['Broj_polica']); ?></li>
                    <li class="list-group-item">Broj vrsta robe: <?php print($brojcano_stanje['Broj_vrstarobe']); ?></li>
                </ul>
            </div>
            <div class="card m-4">
                <div class="card-header">
                    Stanje zauzetosti polica
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ukupan broj polica: <?php print($stanje_polica['Ukupno']); ?></li>
                    <li class="list-group-item">Broj zauzeti polica: <?php print($stanje_polica['Zauzeto']); ?></li>
                    <li class="list-group-item">Broj slobodnih polica: <?php print($stanje_polica['Slobodno']); ?></li>
                    <li class="list-group-item">Zauzeto: <?php print(round($stanje_polica['Zauzeto_postotak'], 2)); ?>%</li>
                    <li class="list-group-item">Slobodno: <?php print(round($stanje_polica['Slobodno_postotak'], 2)); ?>%</li>
                </ul>
            </div>
            <div class="card m-4">
                <div class="card-header">
                    Stanje zauzetosti polica
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                        $query = $DB->query("SELECT vrstarobe.Naziv, vrstarobe.Napomena, COUNT(roba.ID) AS 'Broj_robe' FROM vrstarobe LEFT JOIN roba ON vrstarobe.ID = roba.VrstaRobe_ID GROUP BY vrstarobe.ID;");
                        while($row = $query->fetch_assoc()) {
                            print('<li class="list-group-item">'.$row['Naziv'].' ('.$row['Napomena'].'): '.$row['Broj_robe'].' roba</li>');
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="card m-4">
        <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
            Generiraj tablice
        </div>
        <div class="card-body">
            <div class="card m-4">
                <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    Evidencija polica
                </div>
                <div class="card-body">
                    Evidencija sadrži popis svih polica i robe na njima uključujući i zakupca koj posjeduje tu robu.
                </div>
                <div class="card-footer" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    <a href="./evidencije/polica.php" class="btn btn-primary" target="_blank">Generiraj evidenciju</a>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    Evidencija robe
                </div>
                <div class="card-body">
                    Evidencija sadrži popis sve robe, na kojoj se polici nalazi ili ne nalazi i kome pripada.
                </div>
                <div class="card-footer" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    <a href="./evidencije/roba.php" class="btn btn-primary" target="_blank">Generiraj evidenciju</a>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    Evidencija robe koja isjteče
                </div>
                <div class="card-body">
                    Evidencija sadrži popis sve robe koja isječe za mjesec dana (30 dana), na kojoj se polici nalazi ili ne nalazi i kome pripada.
                </div>
                <div class="card-footer" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    <a href="./evidencije/roba-istjece.php" class="btn btn-primary" target="_blank">Generiraj evidenciju</a>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    Evidencija Zakupaca
                </div>
                <div class="card-body">
                    Evidencija sadrži popis svih zakupaca u sustavu i njihove podatke.
                </div>
                <div class="card-footer" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
                    <a href="./evidencije/zakupci.php" class="btn btn-primary" target="_blank">Generiraj evidenciju</a>
                </div>
            </div>
        </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>