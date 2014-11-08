<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/saskia.php";
require_once "modeloak/zelataria.php";

include("bistak/header.php");
include("bistak/nagusia.php");

$login = new Sartu();
$reg = new IzenaEman();
$sask = new Saskia();
$zel = new Zelataria();

if(Sartu::barruan()) {
	include("bistak/barruan.php");
} else {
	include("bistak/login_registro.php");
}
include("bistak/guriburuz.php");
include("bistak/footer.php");


