<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
	<header>
		<img src="public/img/logoa.png" alt="Logoa" id="logoa" class="pure-img">
	<nav>
		<ul>
			<a id='my-tooltip' class='tooltip' title='Produktuak' href="index.php"><li>Produktuak</li></a>
			<a class='tooltip' title='Gu' href="gu.php"><li>Gu</li></a>
			<a class='tooltip' title='Kokapena' href="kokapena.php"><li>Kokapena</li></a>
			<a class='tooltip' title='Login/erregistroa' href="#" data-featherlight="#mylightbox"><li><img id='erab' src="public/img/erab.png" alt="Sartu edo erregistratu"></li></a>
			<a class='tooltip' title='Saskia' href="#" data-featherlight="#saskia"><li><img id='saski' src="public/img/shopping.png" alt="Karritoan duzuna ikusi"></li></a>
			<?php
			if(Sartu::adminBarruan()) {
							?><a class='tooltip' title='Admin' href="#" data-featherlight="#admin"><li><img id='admin' src="public/img/admin.png" alt="Karritoan duzuna ikusi"></li></a><?php
			}
			?>
		</ul>
		<div id="ezkutatua"><div id="saskia">saskia hutsik</div></div>
	</nav>
	</header>
