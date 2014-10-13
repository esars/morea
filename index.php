<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";
require_once "modeloak/saskia.php";
include("bistak/header.php");
include("bistak/nagusia.php");
$login = new Sartu();
$reg = new IzenaEman();
$sask = new Saskia();
if(Sartu::barruan()) {
	include("bistak/barruan.php");
	echo 'Egunon '.Session::get('izena');
} else {
	include("bistak/login_registro.php");
}
$prod = new Produktu();
include("bistak/footer.php");
?>
