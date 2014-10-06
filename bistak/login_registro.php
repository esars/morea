<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Morea Lorategia</title>
	<link rel="stylesheet" type="text/css" href="../public/style.css">
	<link rel="stylesheet" type="text/css" href="../public/pure.css">
	<script src="../public/jquery.js"></script>
</head>
<body>
	<header>
		<img src="public/img/logoa.png" alt="Logoa" id="logoa">
	<nav>
		<ul>
			<li>Produktuak</li>
			<li>Gu</li>
			<li>Kokapena</li>
		</ul>
	</nav>
	</header>
<form class='pure-form' action="" method='post'>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="text" maxlength='40' required value='Emaila' name='email'>
	<input class='pure-input-1-6' type="text" maxlength='70' required value='Pasahitza' name='pasahitza'>
	</fieldset>
	<input class='pure-button pure-input-1-6 pure-button-primary' type="submit" value='Sartu'>
</form>
<form class='pure-form' action="" method='post'>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="text" required maxlength='30' value='Izena' name='izena'>
	<input class='pure-input-1-6' type="text" required maxlength='30' value='Abizena' name='abizena'>
	<input class='pure-input-1-6' type="email" required maxlength='40' value='Emaila' name='email'>
	</fieldset>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="number" required max='12' value='Telefonoa' name='telefono'>
	<input class='pure-input-1-6' type="text" required maxlength='70' value='Helbidea' name='helbidea'>
	</fieldset>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="text" maxlength='70' required value='Pasahitza' name='pasahitza'>
	<input class='pure-input-1-6' type="text" maxlength='70' required value='Errepikatu Pasahitza' name='pasahitza1'>
	</fieldset>
	<input type="button" class='pure-button pure-input-1-6 pure-button-primary' value='Erregistratu'>
</form>
<script type="text/javascript">
	$("input[value='Erregistratu']").click(verificar);
	function verificar () {
		if($("input[name='pasahitza']").val()!=$("input[name='pasahitza1']").val())
		
	}
</script>
<footer>
	<h6>enekosar@ikasle.aeg.es/xaxtian.amenabar@ikasle.aeg.es</h6>
	<h6>All rights reserved</h6>
</footer>
</body>
</html>