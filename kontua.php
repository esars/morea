<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/kontua.php";
require_once "modeloak/zelataria.php";


include("bistak/header.php");
include("bistak/nagusia.php");

$zel = new Zelataria();

if ( isset($_GET['pberreskuratu']) ) $kon = new Kontua();

include("bistak/footer.php");
