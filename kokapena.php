<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
include("bistak/header.php");
$login = new Sartu();
$reg = new IzenaEman();
if(Sartu::barruan()) {
	include("bistak/barruan.php");
} else {
	include("bistak/login_registro.php");
}
echo "Kokapena";
include("bistak/saskia.php");
include("bistak/nagusia.php");
include("bistak/footer.php");