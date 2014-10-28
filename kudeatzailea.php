<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";
require_once "modeloak/saskia.php";

$login = new Sartu();
$reg = new IzenaEman();
$sask = new Saskia();
include("bistak/header.php");
include("bistak/nagusia.php");
$prod = new Produktu();
if(Sartu::barruan()) {
	include("bistak/barruan.php");
	if(Sartu::adminBarruan()) {
		include("bistak/admin.php");
}
} else {
	include("bistak/login_registro.php");
}
include("bistak/kudeatu.php");

include("bistak/footer.php");
?>
