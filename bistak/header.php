<!DOCTYPE html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Morea Lorategia</title>
	<link rel="stylesheet" type="text/css" href="public/style.css">
	<link rel="stylesheet" type="text/css" href="public/pure.css">
	<link rel="stylesheet" type="text/css" href="public/featherlight.min.css">
	<link rel="stylesheet" type="text/css" href="public/tooltipster.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster|Cabin:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="public/font-awesome-4.2.0/css/font-awesome.min.css">
	<script src="public/js/jquery.js"></script>
	<script src="public/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/js/jquery.tooltipster.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="shortcut icon" type="image/png" href="public/mariolorea.png">
</head>
<body>
	<header>
		<img src="public/img/logoa.png" alt="Logoa" id="logoa" class="pure-img">
	<nav>
		<ul>
			<a id='my-tooltip' class='tooltip' title='
																													<ul id="kategoriak">
																													<li><a href="index.php?kat=Zentroak"><i class="fa fa-support"></i>  Zentroak</a></li>
																													<li><a href="index.php?kat=Erramuak"><i class="fa fa-gift"></i>  Erramuak</a></li>
																													<li><a href="index.php?kat=Funeralak"><i class="fa fa-thumbs-down"></i>  Funeralak</a></li>
																													<li><a href="index.php?kat=Ezkontzak"><i class="fa fa-heart"></i>  Ezkontzak</a></li>
																													<li><a href="index.php?kat=Matujak"><i class="fa fa-leaf"></i>  Matujak</a></li>
																													<li><a href="index.php?kat=Zuhaitzak"><i class="fa fa-tree"></i>  Zuhaitzak</a></li>
																												</ul>' href="index.php"><li>Produktuak</li></a>
			<a class='tooltip' title='Jakin ezazu gehiago guri buruz' href="gu.php"><li>Gu</li></a>
			<a class='tooltip' title='Aurkitu gaitzazu' href="kokapena.php"><li>Kokapena</li></a>
			<?php
			if(isset($_SESSION['izena'])){
							?>			<a class='tooltip' title='Zure profila' href="profila.php" data-featherlight="#mylightbox"><li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
<?php
			}
			else{
							?><a class='tooltip' title='Login / Izena eman' href="#" data-featherlight="#mylightbox"><li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
<?php
			}
			?>
			<a class='tooltip' title='<span>Bilatu: </span><form id="bilatuform" action="" method="get"><input id="bilatu-input" type="text" name="bilaketa"><button type="submit"><i class="fa fa-search"></i></button></form>'><li><img id='bilatu' src="public/img/bilatu.png" alt="Bilatu"></li></a>
			<a class='tooltip' title='Saskia bistaratu' href="#" data-featherlight="#saskia"><li><img id='saski' src="public/img/shopping.png" alt="Karritoan duzuna ikusi"></li></a>
			<?php
			if(Sartu::adminBarruan()) {
							?><a class="tooltip" title='Datubasea kudeatu' href="kudeatzailea.php?ekintza='kudeatzaile'"><li><img id='adminarg' src="public/img/admin.png" alt="Karritoan duzuna ikusi"></li></a><?php
			}
			?>
		</ul>
	</nav>
	<div id="ezkutatua2"></div>
	</header>
