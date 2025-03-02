<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <title>Zakupci</title>
    <style>
        .btn-td{
            display: flex;
            flex-wrap: wrap;
            align-content: center;
            justify-content: space-around;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/header.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/server/config.php'); ?>
    <div class="card m-4">
        <div class="card-header">
            Funkcije za upravljanje zakupcima
        </div>
        <div class="card-body">
            <button class="btn btn-primary" onclick="window.location.assign('./novi-zakupac.php')">Novi Zakupac</button>
        </div>
    </div>
    <div class="card m-4">
        <div class="card-header" style="display: flex;flex-wrap: nowrap;flex-direction: row;align-content: center;justify-content: space-between;align-items: center;">
            <span>Lista korisnika</span>    
            <span>
                <form class="d-flex" method="GET" action="./zakupci.php">
                    <input class="form-control me-2" type="search" name="q" placeholder="Pretraži . . ." aria-label="Pretraga" value="<?php print(isset($_GET['q']) ? $_GET['q'] : '') ?>">
                    <input type="hidden" name="page" value="1">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </span>    
            <spam class="input-group" style="width: max-content;">
                <a href="./zakupci.php?page=<?php print($_GET['page'] - 1) ?><?php print(isset($_GET['q']) ? "&q=".$_GET['q'] : '') ?>" class="btn btn-primary"><</a>
                <span class="input-group-text"><?php print($_GET['page']) ?></span>
                <a href="./zakupci.php?page=<?php print($_GET['page'] + 1) ?><?php print(isset($_GET['q']) ? "&q=".$_GET['q'] : '') ?>" class="btn btn-primary">></a>
            </spam>
        </div>
        <table class="table table-striped" style="margin-top: 8px;margin-bootom: 16px;vertical-align: baseline;">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Telefon</th>
                <th scope="col">eMail</th>
                <th scope="col">Funkcije</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_GET["q"])) {
                        if ($_GET["page"] <= 0) {
                            header("Location: ./zakupci.php?page=1&q=".$_GET["q"]);
                        }
                        $query = $DB->query("SELECT * FROM zakupac WHERE ime LIKE '%".$_GET["q"]."%' OR prezime LIKE '%".$_GET["q"]."%' OR mail LIKE '%".$_GET["q"]."%' OR telefon LIKE '%".$_GET["q"]."%' LIMIT 20 OFFSET ".($_GET["page"]-1)*20);
                        while($row = $query->fetch_assoc()) {
                            print("<tr>");
                            print("<th scope=\"row\">#".$row["ID"]."</th>");
                            print("<th scope=\"row\">".$row["Ime"]."</th>");
                            print("<th scope=\"row\">".$row["Prezime"]."</th>");
                            print("<th scope=\"row\"><a href=\"tel:".$row["Telefon"]."\">".$row["Telefon"]."</a></th>");
                            print("<th scope=\"row\"><a href=\"mailto:".$row["Mail"]."\">".$row["Mail"]."</a></th>");
                            print("<td class=\"btn-td\"><button class=\"btn btn-primary\" onclick=\"window.location.assign('./uredi-zakupca.php?id=".$row["ID"]."')\">Uredi</button><button class=\"btn btn-primary\" onclick=\"window.location.assign('./roba-zakupca.php?id=".$row["ID"]."')\">Roba</button><button class=\"btn btn-danger\" onclick=\"window.location.assign('./izbrisi-zakupca.php?id=".$row["ID"]."')\">Izbrisi</button></td>");
                            print("</tr>");
                        }
                    }
                    else if (isset($_GET["page"])) {
                        if ($_GET["page"] <= 0) {
                            header("Location: ./zakupci.php?page=1");
                        }
                        $query = $DB->query("SELECT * FROM zakupac LIMIT 20 OFFSET ".($_GET["page"]-1)*20);
                        while($row = $query->fetch_assoc()) {
                            print("<tr>");
                            print("<th scope=\"row\">#".$row["ID"]."</th>");
                            print("<th scope=\"row\">".$row["Ime"]."</th>");
                            print("<th scope=\"row\">".$row["Prezime"]."</th>");
                            print("<th scope=\"row\"><a href=\"tel:".$row["Telefon"]."\">".$row["Telefon"]."</a></th>");
                            print("<th scope=\"row\"><a href=\"mailto:".$row["Mail"]."\">".$row["Mail"]."</a></th>");
                            print("<td class=\"btn-td\"><button class=\"btn btn-primary\" onclick=\"window.location.assign('./uredi-zakupca.php?id=".$row["ID"]."')\">Uredi</button><button class=\"btn btn-primary\" onclick=\"window.location.assign('./roba-zakupca.php?id=".$row["ID"]."')\">Roba</button><button class=\"btn btn-danger\" onclick=\"window.location.assign('./izbrisi-zakupca.php?id=".$row["ID"]."')\">Izbrisi</button></td></tr>");
                        }
                    }else{
                        header("Location: ./zakupci.php?page=1");
                        exit();
                    }


                ?>
            </tbody>
        </table>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>
</body>
</html>