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
	<link rel="stylesheet" href="public/animate.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster|Magra:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="public/font-awesome-4.2.0/css/font-awesome.min.css">
	<script type="text/javascript" src="public/js/enhance.js"></script>
	<script type="text/javascript" src="public/js/excanvas.js"></script>
	<script src="public/js/jquery.js"></script>
	<script type="text/javascript" src="public/js/visualize.jQuery.js"></script>
	<script type="text/javascript" src="public/js/example-editable.js"></script>

	
	<script src="public/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/js/jquery.tooltipster.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="Chart.js"></script>
	<link rel="shortcut icon" type="image/png" href="public/mariolorea.png">
	<link rel="stylesheet" type="text/css" href="public/style.css">
	<link rel="stylesheet" type="text/css" href="public/tooltipster.css">
	<style id='estiloak'>
	#bigarrena{
	display:inline-block;
	background-color:transparent;
	border-bottom:solid thin #F4F4E8;
	margin-bottom:-1px
}</style>
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
			if(isset($_SESSION['izena'])){

							?>			<a class='tooltip' title='<ul class="kategoriak">
																	<li><a href="erabiltzaile.php?aldatu=pasahitza"><i class="fa fa-key"></i>Pasahitza aldatu</li>
																	<li><a href="erabiltzaile.php?aldatu=datuak"><i class="fa fa-male"></i>Kontua aldatu</li>

																	<li></li>

																  </ul>' href="profila.php" data-featherlight="#mylightbox"><li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>

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

							?><a class="tooltip ikono" id='my-tooltip' title='
									<ul class="kategoriak">
									<li><a href="index.php?ekintza=kudeatzaile_prod"><i class="fa fa-cubes"></i>  Produktuak</a></li>
									<li><a href="index.php?ekintza=kudeatzaile_erab"><i class="fa fa-users"></i>  Erabiltzaileak</a></li>
									<li><a href="index.php?erabid=2"><i class="fa fa-shopping-cart"></i>  Salmentak</a></li>
									<li><a href="erabiltzaile.php?ekintza=kudeatzaile_stat"><i class="fa fa-bar-chart"></i>  Estatistikak</a></li>
									</ul>' href="index.php?ekintza=kudeatzaile_prod"><li><img id='adminarg' src="public/img/admin.png" alt="Karritoan duzuna ikusi"></li></a>

<?php
			}
			?>
		</ul>
	</nav>
	<div id="ezkutatua2"></div>
	</header>
