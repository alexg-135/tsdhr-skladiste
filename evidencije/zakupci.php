<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <title>Evidencija zakupaca</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php'); ?>
    <table class="table table-striped" style="vertical-align: baseline;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Telefon</th>
                <th scope="col">eMail</th>
                <th scope="col">Broj roba</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = $DB->query("SELECT zakupac.*, COUNT(roba.ID) AS 'Broj_roba' FROM `zakupac` LEFT JOIN roba ON zakupac.ID = roba.Zakupac_ID GROUP BY zakupac.ID;");
                while($row = $query->fetch_assoc()) {
                    print('<tr>');
                    print('<th scope="row">'.$row['ID'].'</th>');
                    print('<th scope="row">'.$row['Ime'].'</th>');
                    print('<th scope="row">'.$row['Prezime'].'</th>');
                    print('<th scope="row">'.$row['Telefon'].'</th>');
                    print('<th scope="row">'.$row['Mail'].'</th>');
                    print('<th scope="row">'.$row['Broj_roba'].'</th>');
                    print('</tr>');
                }
            ?>    
        </tbody>
    </table>
</body>
</html>