<!DOCTYPE html>
<html lang="eu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Morea Lorategia</title>
	<link rel="stylesheet" href="public/font-awesome-4.2.0/css/font-awesome.min.css">	
	<link rel="stylesheet" type="text/css" href="public/pure.css">
	<link rel="stylesheet" type="text/css" href="public/style.css">
	<link rel="stylesheet" type="text/css" href="public/featherlight.min.css">
	<link rel="stylesheet" type="text/css" href="public/tooltipster.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster|Magra:400,500' rel='stylesheet' type='text/css'>
	<script src="public/js/jquery.js"></script>
	<script src="public/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/js/jquery.tooltipster.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="shortcut icon" type="image/png" href="public/mariolorea.png">
</head>
<body>
	<div id="edukia">
	<header>
		<img src="public/img/logoa_beixGabe.png" alt="Logoa" id="logoa" class="pure-img">
	<nav>
		<ul>
			<a id='my-tooltip' class='tooltip' title='</a>
				<ul class="kategoriak">
				<li><a href="index.php?kat=Zentroak"><i class="fa fa-support"></i>  Zentroak</a></li>
				<li><a href="index.php?kat=Erramuak"><i class="fa fa-gift"></i>  Erramuak</a></li>
				<li><a href="index.php?kat=Funeralak"><i class="fa fa-thumbs-down"></i>  Funeralak</a></li>
				<li><a href="index.php?kat=Ezkontzak"><i class="fa fa-heart"></i>  Ezkontzak</a></li>
				<li><a href="index.php?kat=Matujak"><i class="fa fa-leaf"></i>  Matujak</a></li>
				<li><a href="index.php?kat=Zuhaitzak"><i class="fa fa-tree"></i>  Zuhaitzak</a></li>
			</ul>' href="index.php"><li>Produktuak</li></a>

			<a class='tooltip' title='Jakin ezazu gehiago guri buruz' href="gu.php"><li>Gu</li></a>
			<a class='tooltip' title='Aurkitu gaitzazu' href="kokapena.php"><li>Kokapena</li></a>
			<a class='tooltip ikono' title='<span>Bilatu: </span><form id="bilatuform" action="index.php" method="get"><input id="bilatu-input" type="text" name="bilaketa">
<button type="submit"><i class="fa fa-search"></i></button></form>'><li><img id='bilatu' src="public/img/bilatu.png" alt="Bilatu"></li></a>
			<a class='tooltip ikono' title='Saskia bistaratu' href="#" data-featherlight="#saskia"><li><img id='saski' src="public/img/shopping.png" alt="Karritoan duzuna ikusi"></li></a>
<?php
	if(isset($_SESSION['izena'])) {
?>			<a class='tooltip' title='<ul class="kategoriak">
										<li><a href="erabiltzaile.php?aldatu=pasahitza"><i class="fa fa-key"></i>Pasahitza aldatu</a></li>
										<li><a href="erabiltzaile.php?aldatu=datuak"><i class="fa fa-male"></i>Kontua aldatu</a></li>
										<li><a href="index.php" onclick="ateraFunc()"><i class="fa fa-sign-out"></i>Kontutik atera</a></li>

									  </ul>'><li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>

<?php } else { ?>
	<a class='tooltip ikono' title='Login / Izena eman' href="#" data-featherlight="#mylightbox">
	<li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
<?php } ?><?php if(Sartu::adminBarruan()) { ?>
	<a href="index.php?ekintza=kudeatzaile_prod" class="tooltip ikono" title='<ul class="kategoriak"><li><a href="index.php?ekintza=kudeatzaile_prod"><i class="fa fa-cubes"></i>  Produktuak</a></li>
									<li><a href="index.php?ekintza=kudeatzaile_erab"><i class="fa fa-users"></i>  Erabiltzaileak</a></li>
									<li><a href="index.php?erabid=4"><i class="fa fa-shopping-cart"></i>  Salmentak</a></li>
									<li><a href="erabiltzaile.php?ekintza=kudeatzaile_stat"><i class="fa fa-bar-chart"></i>  Estatistikak</a></li>
									</ul>' href="index.php?ekintza=kudeatzaile_prod"><li><img id='adminarg' src="public/img/admin.png" style="height:25px;" alt="Karritoan duzuna ikusi"></li></a>

<?php } ?>
		</ul>
	<form class="pure-form ikusezin" id="ateraform" action="" method="post"><input class="pure-button pure-input-1-6 pure-button-primary formbotoi" type="hidden" name="logout" id="logout" value="Saioa itxi"></form>
	</nav>
	<div id="ezkutatua2"></div>
	</header>
