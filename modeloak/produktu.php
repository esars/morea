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

			$this->db = mysqli_connect(	$config["host"],
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
						$this->produktuaKendu($_GET['id']);
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "aldatu":
					if(Sartu::adminBarruan()) {
						include("bistak/produktua_aldatu.php");
						$this->produktuaAldatu($_GET['id']);
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
				//$izena = str_replace(' ', '', $_POST['pizena']);
				if(strlen($_POST['pizena']) < 5 || empty($_POST['pizena'])) {
					$this->erroreak[] = "Izena motzegia da edo hutsik utzi duzu";
				} else if(!preg_match('/^[a-z\d]{2,64}$/i', str_replace(' ', '', $_POST['pizena']))) {
					$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
				} else if(strlen($_POST['deskripzioa']) < 20 || empty($_POST['deskripzioa'])) {
					$this->erroreak[] = "Deskripzioa motzegia da edo hutsik utzi duzu.";
				} else if(!ctype_digit($_POST['prezioa']) || empty($_POST['prezioa'])) {
					$this->erroreak[] = "Prezioa ez da zenbaki bat edo hutsa utzi duzu.";
				} else if(!ctype_digit($_POST['stock']) || empty($_POST['prezioa'])) {
					$this->erroreak[] = "Stocka ez da zenbaki bat edo hutsik utzi duzu.";
				} else {
					$izena = $this->db->real_escape_string(strip_tags($_POST['pizena'], ENT_QUOTES));
					$deskr = $this->db->real_escape_string(strip_tags($_POST['deskripzioa'], ENT_QUOTES));
					$prezioa = $_POST['prezioa'];
					$stock = $_POST['stock'];

					$sql = "INSERT INTO produktu (izena,deskripzioa,prezioa,stock)
									VALUES ('".$izena."', '".$deskr."', '".$prezioa."', '".$stock."');";
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
		private function produktuaKendu($id) {
			if(Sartu::adminBarruan()) {

			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuaAldatu($id) {
			if(Sartu::adminBarruan()) {

			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuakErakutsi($param = null) {
			$sql = "SELECT * FROM produktu;";
			$produktuak = $this->db->query($sql);

			/*
			 * Hasierako orrialdea beteko duen funtzioa
			 * Kasu hontan soilik produktu bakoitzaren
			 * argazki bakar bat erakutsiko dugu
			*/

			while($lerroa = $produktuak->fetch_assoc()) {

				// Kontsulta array asoziatibo baten bihurtzen dugu
				// goiko metodoaren bidez

				echo "<div class='produktubat'>";
				echo $lerroa['izena'].'<br>';
				echo "<img src='public/argazkiak/".$lerroa['id']."-1.png' alt='".$lerroa['izena']."'";
				echo "</div>";

			}

		}
		public static function produktuBatErakutsi($id) {

		}
}
