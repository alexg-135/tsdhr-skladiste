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
                <th scope="col">Broj</th>
                <th scope="col">Napomena</th>
                <th scope="col">ID robe</th>
                <th scope="col">Naziv robe</th>
                <th scope="col">Roba istječe</th>
                <th scope="col">Vrsta robe</th>
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
                $query = $DB->query("SELECT polica.*, roba.ID AS 'Roba_ID', roba.Naziv AS 'Roba_Naziv', roba.Istjece, vrstarobe.Naziv AS 'Vrsta_Naziv', vrstarobe.Napomena AS 'Vrsta_Napomena', zakupac.ID AS 'Zakupac_ID', zakupac.Ime, zakupac.Prezime, zakupac.Telefon, zakupac.Mail FROM polica LEFT JOIN roba ON roba.ID = polica.Roba_ID LEFT JOIN vrstarobe ON roba.VrstaRobe_ID = vrstarobe.ID LEFT JOIN zakupac ON zakupac.ID = roba.Zakupac_ID;");
                while($row = $query->fetch_assoc()) {
                    print('<tr>');
                    print('<th scope="row">'.$row['ID'].'</th>');
                    print('<th scope="row">'.$row['Broj'].'</th>');
                    print('<th scope="row">'.$row['Napomena'].'</th>');
                    print('<th scope="row">'.$row['Roba_ID'].'</th>');
                    print('<th scope="row">'.$row['Roba_Naziv'].'</th>');
                    print('<th scope="row">'.$row['Istjece'].'</th>');
                    print('<th scope="row">'.$row['Vrsta_Naziv'].'</th>');
                    print('<th scope="row">'.$row['Vrsta_Napomena'].'</th>');
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