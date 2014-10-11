<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";

include("bistak/header.php");

$login = new Sartu();
$reg = new IzenaEman();

if(Sartu::barruan()) {
	include("bistak/barruan.php");
} else {
	include("bistak/login_registro.php");
}
include("bistak/saskia.php");
include("bistak/nagusia.php");

$prod = new Produktu();

include("bistak/footer.php");
?>
