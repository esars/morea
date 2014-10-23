<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/saskia.php";
include("bistak/header.php");
include("bistak/nagusia.php");
$login = new Sartu();
$reg = new IzenaEman();
$sask = new Saskia();
if(Sartu::barruan()) {
	include("bistak/barruan.php");
} else {
	include("bistak/login_registro.php");
}
echo "Kokapena";
include("bistak/footer.php");
