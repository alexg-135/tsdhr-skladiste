<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/skladiste/bootstrap/css/bootstrap.css">
    <title>Skladište</title>
	<style>
		div.card{
			width: 400px;
			height: -webkit-fill-available;
		}
		div.card-list{
			display: grid;
			justify-items: center;
    		align-items: center;
		}
		@media (min-width: 500px) {
			div.card-list { grid-template-columns: repeat(1, auto); }
		}
		@media (min-width: 900px) {
			div.card-list { grid-template-columns: repeat(2, auto); }
		}
		@media (min-width: 1260px) {
			div.card-list { grid-template-columns: repeat(3, auto); }
		}
	</style>
</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/header.php'); ?>

	<div class="card-list p-3">
		<div class="card m-2">
			<div class="card-header">
				Zakupac
			</div>
			<div class="card-body">
				<h5 class="card-title">Lista zakupaca</h5>
				<p class="card-text">Lista svih zakopaca koji su prijavljeni u sustav</p>
				<a href="./zakupci.php" class="btn btn-primary">Lista zakupaca</a>
				<a href="./novi-zakupac.php" class="btn btn-primary">Novi zakupac</a>
			</div>
		</div>
		<div class="card m-2">
			<div class="card-header">
				Roba
			</div>
			<div class="card-body">
				<h5 class="card-title">Lista robe</h5>
				<p class="card-text">Lista robe koja je upisana u sustav</p>
				<a href="./roba-lista.php" class="btn btn-primary">Lista robe</a>
				<a href="./roba-nova.php" class="btn btn-primary">Nova roba</a>
			</div>
		</div>
		<div class="card m-2">
			<div class="card-header">
				Police
			</div>
			<div class="card-body">
				<h5 class="card-title">Lista polica</h5>
				<p class="card-text">Lista svih polica koja u skladištu</p>
				<a href="./polica-lista.php" class="btn btn-primary">Lista polica</a>
				<a href="./polica-novo.php" class="btn btn-primary">Nova polica</a>
			</div>
		</div>
		<div class="card m-2">
			<div class="card-header">
				Vrsta robe
			</div>
			<div class="card-body">
				<h5 class="card-title">Lista vrsti roba</h5>
				<p class="card-text">Lista svih vrsta koja roba može imati</p>
				<a href="./vrsta-lista.php" class="btn btn-primary">Lista vrsta</a>
				<a href="./nova-vrsta.php" class="btn btn-primary">Nova vrsta</a>
			</div>
		</div>
		<div class="card m-2">
			<div class="card-header">
				Evidencija
			</div>
			<div class="card-body">
				<h5 class="card-title">Evidencija skladišta</h5>
				<p class="card-text">Evidencija o stanju skladišta</p>
				<a href="./evidencija.php" class="btn btn-primary">Pogledaj evidencije</a>
			</div>
		</div>
	</div>

	<?php include($_SERVER['DOCUMENT_ROOT'].'/skladiste/include/footer.php'); ?>    
</body>
</html>