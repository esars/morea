<?php
session_start();
/*
 * DATUBASEAREN KREDENTZIALAK
*/

$config = [
    "host" => "localhost",
    "user" => "morea",
    "pass" => "12345",
    "izen" => "landare",
];

$kategoriak = [
   "Zentroak",
   "Erramuak",
   "Funeralak",
   "Ezkontzak",
   "Matujak",
   "Zuhaitzak",
];

global $kategoriak;
/*
 * Erroreak izkutatu edo erakutsi
 */
 
$erroreak_ikusi = true; 

if($erroreak_ikusi) {
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
}
?>
