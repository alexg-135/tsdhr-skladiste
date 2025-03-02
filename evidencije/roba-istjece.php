<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <title>Evidencija robe</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php'); ?>
    <table class="table table-striped" style="vertical-align: baseline;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Naziv</th>
                <th scope="col">Istječe</th>
                <th scope="col">Vrsta</th>
                <th scope="col">Napomena vrste robe</th>
                <th scope="col">ID zakupca</th>
                <th scope="col">Ime zakupca</th>
                <th scope="col">Prezime zakupca</th>
                <th scope="col">Telefon zakupca</th>
                <th scope="col">eMail zakupca</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = $DB->query("SELECT roba.*, vrstarobe.Naziv AS 'Vrsta', vrstarobe.Napomena, zakupac.Ime, zakupac.Prezime, zakupac.Telefon, zakupac.Mail FROM roba LEFT JOIN vrstarobe ON roba.VrstaRobe_ID = vrstarobe.ID LEFT JOIN zakupac ON roba.Zakupac_ID = zakupac.ID WHERE roba.Istjece < DATE_ADD(NOW(), INTERVAL +30 DAY);");
                while($row = $query->fetch_assoc()) {
                    print('<tr>');
                    print('<th scope="row">'.$row['ID'].'</th>');
                    print('<th scope="row">'.$row['Naziv'].'</th>');
                    print('<th scope="row">'.$row['Istjece'].'</th>');
                    print('<th scope="row">'.$row['Vrsta'].'</th>');
                    print('<th scope="row">'.$row['Napomena'].'</th>');
                    print('<th scope="row">'.$row['Zakupac_ID'].'</th>');
                    print('<th scope="row">'.$row['Ime'].'</th>');
                    print('<th scope="row">'.$row['Prezime'].'</th>');
                    print('<th scope="row">'.$row['Telefon'].'</th>');
                    print('<th scope="row">'.$row['Mail'].'</th>');
                    print('</tr>');
                }
            ?>    
        </tbody>
    </table>
</body>
</html>