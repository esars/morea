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
					$this->handle($_GET["ekintza"], Sartu::adminBarruan());
				} else {
					$this->handle();
				}
		}

		private function handle($ekintza = null, $ad = false) {

			/* PRODUKTUEN KONTROLATZAILEA
			 *
			 * GETaren arabera funtzio bat edo bestea egingo du.
			 * Hemen ere datubasera konexioa egiten dugu. Funtzionalitate
			 * orokor gehiago gehitu daitezke. Parametro bezela admina barruan
			 * dagoen hartzen du baita.
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
					if($ad) {
						include("bistak/produktua_gehitu.php");
						$this->produktuaGehitu();
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "kendu":
					if($ad) {
						include("bistak/produktua_kendu.php");
						$this->produktuaKendu($_GET['id']);
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "aldatu":
					if($ad) {
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

				if($this->produktuaBalidatu()) {

					//	HTMLa eta JavaScripta sartu bada, testu normalean bihurtu	//

					$izena = $this->db->real_escape_string(strip_tags($_POST['pizena'], ENT_QUOTES));
					$deskr = $this->db->real_escape_string(strip_tags($_POST['deskripzioa'], ENT_QUOTES));
					$prezioa = $_POST['prezioa'];
					$stock = $_POST['stock'];

					$sql = "INSERT INTO produktu (izena,deskripzioa,prezioa,stock)
									VALUES ('".$izena."', '".$deskr."', '".$prezioa."', '".$stock."');";
					$produktuaSartu = $this->db->query($sql);

					if($produktuaSartu) {

						$azkenProduktua = $this->db->query("SELECT * FROM produktu WHERE izena='".$izena."';")->fetch_object();

						$this->mezuak[] = "Produktua gehitua, gehituizkiozu argazkiak ".$azkenProduktua->id."-*.png formatuan";

						Mugitu::nora("produktua.php");
					} else {
						$this->erroreak[] = "Errorea produktua gehitzean";
					}
				}
			}

		}
		private function produktuaKendu($id) {

			// KONFIRMAZIOA PASA ONDOREN

			if(isset($_POST['pborratu'])) {
				$sql = "DELETE * FROM produktu WHERE id='".$id."';";

				$borratu = $this->db->query($sql);

				if($borratu) {
					$this->mezuak[] = "Produktua arrakastaz ezabatu duzu";
				} else {
					$this->erroreak[] = "Errorea produktua ezabatzean";
				}
			}
		}
		private function produktuaAldatu($id) {

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

				echo "<div class='produktubat'>
		<style scoped>.button-xsmall{font-size: 60%;}.button-success{background: rgb(28, 184, 65);}</style>
				<img src='public/argazkiak/".$lerroa['id']."-1.png' alt='".$lerroa['izena']."'>
				<div id='zehaztasun_aldea'><h3>".$lerroa['izena']."</h3><p>";
				$deskripzioa = substr($lerroa['deskripzioa'],0,35);
				echo $deskripzioa."</p></div>
			<div id='botoien_aldea'><h3>".$lerroa['prezioa']."</h3></div><button class='button-xsmall pure-button pure-input-1 pure-button-primary' value='Informazio gehiago'>Informazio gehiago</button>
				<input type='hidden' name='produktua' value='".$lerroa['id']."'>			
				<button id='".$lerroa['id']."' class='button-success button-xsmall karrito_gehitu pure-button pure-input-1 pure-button-primary' value='gehitu' name='ekintzak'>Saskiratu	<i class='fa fa-shopping-cart fa-l'></i></button>
				</div>";
			}

		}
		public static function produktuBatErakutsi($id) {

			/*
			 * Produktu guztiak erakusteko funtzioaren pixkat desberdina da
			 * IDaren arabera abiaraziko dugu, beti emaitza bakarra lortuko
			 * dugu eta beraz kontsultaren emaitza objektu bihurtu dezakegu
			 * erosoago maneiatzeko haren propietateak
			*/

			$sql = "SELECT * FROM produktu WHERE id='".$id."';";
			$query = $this->db->query($sql);

			if($query) {
				$produktua = $query->fetch_object();

				echo "<h1>".$produktua->izena."</h1>";
			} else {
				$this->erroreak[] = "Landare hau ez da existitzen";
				Mugitu::nora('index.php');
			}
		}
		private function produktuaBalidatu() {
			if(strlen($_POST['pizena']) < 5 || empty($_POST['pizena'])) {
				$this->erroreak[] = "Izena motzegia da edo hutsik utzi duzu";
				return false;
			} else if(!preg_match('/^[a-z\d]{2,64}$/i', str_replace(' ', '', $_POST['pizena']))) {
				$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
				return false;
			} else if(strlen($_POST['deskripzioa']) < 20 || empty($_POST['deskripzioa'])) {
				$this->erroreak[] = "Deskripzioa motzegia da edo hutsik utzi duzu.";
				return false;
			} else if(!ctype_digit($_POST['prezioa']) || empty($_POST['prezioa'])) {
				$this->erroreak[] = "Prezioa ez da zenbaki bat edo hutsa utzi duzu.";
				return false;
			} else if(!ctype_digit($_POST['stock']) || empty($_POST['prezioa'])) {
				$this->erroreak[] = "Stocka ez da zenbaki bat edo hutsik utzi duzu.";
				return false;
			} else {
				return true;
			}
		}
}
