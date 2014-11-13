<!DOCTYPE html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Morea Lorategia</title>

	<link href="public/css/basic.css" type="text/css" rel="stylesheet" />
	<link href="public/css/visualize.css" type="text/css" rel="stylesheet" />
	<link href="public/css/visualize-light.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="public/pure.css">
	<link rel="stylesheet" type="text/css" href="public/featherlight.min.css">
	
	<link href='http://fonts.googleapis.com/css?family=Lobster|Magra:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="public/font-awesome-4.2.0/css/font-awesome.min.css">
	<script type="text/javascript" src="public/js/enhance.js"></script>
	<script type="text/javascript" src="public/js/excanvas.js"></script>
	<script src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/visualize.jQuery.js"></script>
	<script type="text/javascript" src="public/js/example-editable.js"></script>

	
	<script src="public/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/js/jquery.tooltipster.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="shortcut icon" type="image/png" href="public/mariolorea.png">
	<link rel="stylesheet" type="text/css" href="public/style.css">
	<link rel="stylesheet" type="text/css" href="public/tooltipster.css">
</head>
<body>
	<div id="edukia">
	<header>
		<img src="public/img/logoa_beixGabe.png" alt="Logoa" id="logoa" class="pure-img">
	<nav>
		<ul>
			<a id='my-tooltip' href="index.php"><li>Produktuak</li></a><a class='tooltip' title='Jakin ezazu gehiago guri buruz' href="gu.php"><li>Gu</li></a>
			<a href="kokapena.php"><li>Kokapena</li></a>
			<a><li><img id='bilatu' src="public/img/bilatu.png" alt="Bilatu"></li></a>
			<a class='ikono' href="#" data-featherlight="#saskia"><li><img id='saski' src="public/img/shopping.png" alt="Karritoan duzuna ikusi"></li></a><?php
			if(isset($_SESSION['izena'])){
							?>			<a class='tooltip' title='Zure profila' href="profila.php" data-featherlight="#mylightbox">
							<li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
<?php
			}
			else{
							?><a class='tooltip' title='Login / Izena eman' href="#" data-featherlight="#mylightbox">
							<li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
<?php
			}
			?>
			<?php
			if(Sartu::adminBarruan()) {
							?><a class="tooltip ikono" id='my-tooltip' href="index.php?ekintza=kudeatzaile_prod"><li><img id='adminarg' src="public/img/admin.png" alt="Karritoan duzuna ikusi"></li></a>
<?php
			}
			?></ul>
	</nav>
	<div id="ezkutatua2"></div>
	</header>
