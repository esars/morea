<?php

require_once "config/config.php";

require_once "libs/misc.php";

require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";

include("bistak/header.php");

$login = new Sartu();
$reg = new IzenaEman();
$prod = new Produktu();

if(Sartu::barruan()) {
	include("bistak/barruan.php");
	echo 'Egunon '.Session::get('izena');
} else {
	include("bistak/login_registro.php");
}
include("bistak/saskia.php");
include("bistak/nagusia.php");
include("bistak/footer.php");
?>