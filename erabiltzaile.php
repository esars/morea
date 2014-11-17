<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";
require_once "modeloak/saskia.php";
require_once "modeloak/kontua_refactor.php";
require_once "modeloak/zelataria.php";
require_once "modeloak/browser_class.php";
$br= new browser();
$login = new Sartu();
$reg = new IzenaEman();

if(Sartu::adminBarruan()) include("bistak/header1.php");
else include("bistak/header.php");

include("bistak/nagusia.php");

$sask = new Saskia();
$kontua = new Kontua();
$zel = new Zelataria();

if(Sartu::barruan()) {
	include("bistak/barruan.php");
	if(Sartu::adminBarruan()) {
		include("bistak/admin.php");
	}
} else {
	include("bistak/login_registro.php");
}

include("bistak/footer.php");
