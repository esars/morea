<?php

//--ERROREAK AZALTZEKO--//

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require_once "config/config.php";

require_once "modeloak/sartu.php";

require_once "modeloak/izenaeman.php";

include("bistak/header.php");
include("bistak/login_registro.php");

if(!Sartu::barruan()) {
	//include("bistak/login_registro.php");
}

include("bistak/nagusia.php");

include("bistak/footer.php");
