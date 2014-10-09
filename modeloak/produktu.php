<?php
class Produktu {

		private $db = null;

		public $erroreak = [];
		public $mezuak = [];

		/*
		 * Hemen CRUD funtzionalitate basikoa egongo da programatuta.
		 *        ^
		 * Create Read Update Delete
		 *
		 * Datubasera queryak egiten dituen edozein funtziok pribatua
		 * izan behar du, eta kontrolatzailearen bidez abiaraziko degu.
		*/

		public function __construct() {

				/*
				 * Produktu->handle() Kontrolatzailea abiarazi.
				 * Web orrialdearen konplexutasuna haundituko balitz
				 * kontrolatzaile bat baino gehiago inplementatu daiteke.
				*/

				if(isset($_GET['ekintza'])) {
					$this->handle($_GET["ekintza"]);
				} else {
					$this->handle();
				}
		}

		private function handle($ekintza = null) {

			/* PRODUKTUEN KONTROLATZAILEA
			 *
			 * GETaren arabera funtzio bat edo bestea egingo du.
			 * Hemen ere datubasera konexioa egiten dugu. Funtzionalitate
			 * orokor gehiago gehitu daitezke.
			 *
			*/

			global $config;

			$this->db = mysqli_connect($config["host"],
															 $config["user"],
															 $config["pass"],
															 $config["izen"])
									or die("Error " . mysqli_error($this->db));

			switch($ekintza) {
				case "gehitu":
					if(Sartu::adminBarruan()) {
						include("bistak/produktua_gehitu.php");
						$this->produktuaGehitu();
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "kendu":
					if(Sartu::adminBarruan()) {
						include("bistak/produktua_kendu.php");
						$this->produktuaKendu();
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "aldatu":
					if(Sartu::adminBarruan()) {
						include("bistak/produktua_aldatu.php");
						$this->produktuaAldatu();
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case null:
					$this->produktuakErakutsi();
					break;

			}
		}
		private function produktuaGehitu() {

			if(isset($_POST["pgehitu"])) {

				// MIMIMOAK KONPROBATU

				if(strlen($_POST['pizena']) < 5 || empty($_POST['pizena'])) {
					$this->erroreak[] = "Izena motzegia da edo hutsik utzi duzu";
				} else if(!preg_match('/^[a-z\d]{2,64}$/i', $_POST['pizena'])) {
					$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
				} else if(strlen($_POST['deskripzioa']) < 20 || empty($_POST['deskripzioa'])) {
					$this->erroreak[] = "Deskripzioa motzegia da edo hutsik utzi duzu.";
				} else if(gettype($_POST['prezioa']) != "double" || gettype($_POST['prezioa']) != "integer" || empty($_POST['prezioa'])) {
					$this->erroreak[] = "Prezioa ez da zenbaki bat edo hutsa utzi duzu.";
				} else if(gettype($_POST['stock']) != "double" || empty($_POST['prezioa'])) {
					$this->erroreak[] = "Stocka ez da zenbaki bat edo hutsik utzi duzu.";
				} else {
					$izena = $this->db->real_escape_string(strip_tags($_POST['pizena'], ENT_QUOTES));
					$deskr = $this->db->real_escape_string(strip_tags($_POST['deskripzioa'], ENT_QUOTES));
					$prezioa = $_POST['prezioa'];
					$stock = $_POST['stock'];

					$sql = "INSERT INTO produktu (izena,deskripzioa,prezioa,stock)
									VALUES ('".$izena."', '".$deskripzioa."', '".$prezioa."', '".$stock."');";
					$produktuaSartu = $this->db->query($sql);

					if($produktuaSartu) {
						$this->mezuak[] = "Produktua arrakastaz gehitua";

						Mugitu::nora("produktua.php");
					} else {
						$this->erroreak[] = "Errorea produktua gehitzean";
					}
				}
			}

		}
		private function produktuaKendu() {

		}
		private function produktuaAldatu() {
			if(Sartu::adminBarruan()) {

			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuakErakutsi($param = null) {

		}
}
