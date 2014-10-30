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
					$this->handle($_GET['ekintza']);
				} else if(isset($_GET['kat'])) {
					$this->kategorizator($_GET['kat']);
				} else if(isset($_POST['ekintza'])) {
					$this->handle($_POST['ekintza']);
				} else {
					$this->handle();
				}
		}

		private function handle($ekintza = null, $ad = true) {

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
						//include("bistak/produktua_gehitu.php");
						$this->produktuaGehitu();
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "kendu":
					if($ad) {
						include("bistak/produktua_kendu.php");
						$this->produktuaKendu($_POST['id']);
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "erakutsi":
						$this->produktuBatErakutsi($_GET['id']);
					break;
				case "kudeatzaile":
						include("bistak/kudeatu.php");
					break;
				case "aldatu":
					if($ad) {
						$this->produktuaAldatu($_POST['id']);
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case null:
					$this->produktuakErakutsi();
					break;

			}
		}
		private function kategorizator($param) {
				/*
				 * produktu.phpren handle propioa.
				 * Kategoria bat edo bestea erakusten du. 
				*/ 
				global $config;

				$this->db = mysqli_connect(	$config["host"],
									   	$config["user"],
									   	$config["pass"],
										$config["izen"])
										or die("Error " . mysqli_error($this->db));
				
				$this->produktuakErakutsi(null, $kategoria);
		}
		private function produktuaGehitu() {
			if(isset($_POST["pgehitu"])&&isset($_FILES['imga'])) {
				$arraya=explode('.',$_FILES['imga']['name']);
					$formatua=$arraya[sizeof($arraya)-1];
					if($formatua!='png'&&$formatua!='jpg'&&$formatua!='jpeg'&&$formatua!='tif'){
						$validatua=false;
					}
					else{
						$validatua=true;
					}
				if($this->produktuaBalidatu()&&$validatua) {

					//	HTMLa eta JavaScripta sartu bada, testu normalean bihurtu	//
					$izena = $this->db->real_escape_string(strip_tags($_POST['pizena'], ENT_QUOTES));
					$deskr = $this->db->real_escape_string(strip_tags($_POST['deskripzioa'], ENT_QUOTES));
					$prezioa = $_POST['prezioa'];
					$stock = $_POST['stock'];
					$kategoria = $_POST['kategoria'];

					$sql = "INSERT INTO produktu (izena,deskripzioa,prezioa,stock,kategoria)
									VALUES ('".$izena."', '".$deskr."', '".$prezioa."', '".$stock."', '".$kategoria."');";
					$produktuaSartu = $this->db->query($sql);
					$azkenProduktua = $this->db->query("SELECT * FROM produktu WHERE izena='".$izena."';")->fetch_object();
					//argazkia sartu
					$rutaEnServidor='public/argazkiak';
					$rutaTemporal=$_FILES['imga']['tmp_name'];
					$nombreImagen=$_FILES['imga']['name'];
					$rutaDestino=$rutaEnServidor.'/'.$azkenProduktua->id.'-1.'.$formatua;
					move_uploaded_file($rutaTemporal,$rutaDestino);
					if($produktuaSartu) {
						$this->mezuak[] = "Produktua gehitua, gehituizkiozu argazkiak ".$azkenProduktua->id."-*.png formatuan";
						//$this->mezuak[] = $mezua;
						Mugitu::nora("produktua.php");
					} else {
						$this->erroreak[] = "Errorea produktua gehitzean";
					}
				}
				else if($this->produktuaBalidatu()){
					$this->erroreak[] = "Argazki formatu okerra";
				}
				else if($validatua){
					$this->erroreak[] = "Arazoak izen deskripzio prezio edo stockarekin";
				}
			}
			else{
				$this->erroreak[] = "Argazkia sartu beharrekoa da";
			}

		}
		private function produktuaKendu($id) {

			// KONFIRMAZIOA PASA ONDOREN

			if(isset($_POST['pborratu'])) {
				$id_ak=explode(",",$id);
				for($i=1;$i<=sizeof($id_ak)-1;$i++){
				$sql = "DELETE FROM produktu WHERE id='".$id_ak[$i]."';";

				$borratu = $this->db->query($sql);
				$total_imagenes = glob("public/argazkiak/".$id_ak[$i]."-{*.jpg,*.gif,*.png}",GLOB_BRACE);
				foreach($total_imagenes as $v){  
				unlink($v);}
				}
				if(isset($borratu)) {
					$this->mezuak[] = "Produktua arrakastaz ezabatu duzu";
				}
				else{
					$this->erroreak[] = "Errorea produktua ezabatzean";
				}
			}
		}
		private function produktuaAldatu($id) {
			if(isset($id)) {
				//echo '<script>alert("'.$_FILES['imga_berria']['name'].'")</script>';
				$arraya=explode('.',$_FILES['imga_berria']['name']);
				$formatua=$arraya[sizeof($arraya)-1];
				if($_FILES['imga_berria']['name']!=null&&$formatua!='png'&&$formatua!='jpg'&&$formatua!='jpeg'&&$formatua!='tif'){
						$validatua=false;
					}
					else{
						$validatua=true;
					}
				if(isset($_POST["paldatu"])&&$validatua) {

					if($this->produktuaBalidatu()) {

						//	HTMLa eta JavaScripta sartu bada, testu normalean bihurtu	//

						$izena = $_POST['pizena'];
						$deskr = $_POST['deskripzioa'];
						$prezioa = $_POST['prezioa'];
						$stock = $_POST['stock'];
						$sql = "update produktu set izena='".$izena."',deskripzioa='".$deskr."',prezioa='".$prezioa."',stock='".$stock."'
									WHERE id='".$id."';";
						$produktuaSartu = $this->db->query($sql);
						if($_FILES['imga_berria']['name']!=null){
							$total_imagenes = glob("public/argazkiak/".$id."-{*.jpg,*.gif,*.png}",GLOB_BRACE);
							$urrengo_argazkia=sizeof($total_imagenes)+1;
							$rutaEnServidor='public/argazkiak';
							$rutaTemporal=$_FILES['imga_berria']['tmp_name'];
							$nombreImagen=$_FILES['imga_berria']['name'];
							$rutaDestino=$rutaEnServidor.'/'.$id.'-'.$urrengo_argazkia.'.'.$formatua;
							move_uploaded_file($rutaTemporal,$rutaDestino);
						}
						if($produktuaSartu) {
							$this->mezuak[] = "Produktua aldatua";
						} else {
							$this->erroreak[] = "Errorea produktua aldatzean";
						}
					}
				} else {
					$this->erroreak[] = "Argazkiaren formatua ez da irakurgarria";
					
				}
			} else {
					$this->erroreak[] = "Ez da ID bat eman";
			}
		}
		private function produktuakErakutsi($param = null, $kategoria = null) {
			if(!isset($_GET['ekintzak']) /*&& !$_GET['ekintzak'] == "erosi"*/) {
				if(isset($kategoria)) {
				 $sql = "SELECT * FROM produktu WHERE kategoria='".$kategoria."';";	
				} else {
					$sql = "SELECT * FROM produktu;";
				}
				$produktuak = $this->db->query($sql);

				/*
					* Hasierako orrialdea beteko duen funtzioa
					* Kasu hontan soilik produktu bakoitzaren
					* argazki bakar bat erakutsiko dugu
				*/
				echo "<style scoped>.button-xsmall{font-size: 60%;}.button-success{background: rgb(28, 184, 65);}</style>";
				while($lerroa = $produktuak->fetch_assoc()) {

					// Kontsulta array asoziatibo baten bihurtzen dugu
					// goiko metodoaren bidez
					$argazkia = glob("public/argazkiak/".$lerroa['id']."-{1.jpg,1.gif,1.png,1.jpeg,1.tif}",GLOB_BRACE);
					if(!isset($argazkia[0])){
						$argazkia[0]='hutsa';
					}
					echo "<div class='produktubat'>
					<img src='".$argazkia[0]."' alt='".$lerroa['izena']."'>
					<div id='zehaztasun_aldea'><h3>".$lerroa['izena']."</h3><p>";
					$deskripzioa = substr($lerroa['deskripzioa'],0,35);
					echo /*$deskripzioa.*/"</p></div>
				<div id='botoien_aldea'><h3>".$lerroa['prezioa']." €</h3></div><button data-featherlight='#info' class='button-xsmall pure-button pure-input-1 pure-button-primary info' value='".$lerroa['id']."' name='erakutsi'>Informazio gehiago	<i class='fa fa-file-text-o''></i></button>
					<input type='hidden' name='produktua' value='".$lerroa['id']."'>			
					<button id='".$lerroa['id']."' class='button-success button-xsmall karrito_gehitu pure-button pure-input-1 pure-button-primary' value='gehitu' name='ekintzak'>Saskiratu	<i class='fa fa-shopping-cart fa-l'></i></button>
					</div>";
				}
			}
		}
		private function produktuBatErakutsi($id) {

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
				$total_imagenes = glob("../public/argazkiak/".$produktua->id."-{*.jpg,*.gif,*.png}",GLOB_BRACE);
				echo "<div id='info'>";
				echo "<h1>".$produktua->izena."</h1>";
				echo "<p>Deskripzioa: ".$produktua->deskripzioa."</p>";
				echo "<p>Stock: ".$produktua->stock."</p>";
				echo "<p>Prezioa: ".$produktua->prezioa." euro</p>";
				if(Sartu::adminBarruan()) {
					echo "<a href='kudeatzailea.php'>Produktua aldatu</a>";
				}
				foreach($total_imagenes as $v){  
				$ruta_zatiak = explode("/", $v);
				echo '<img src="'.$ruta_zatiak[1].'/'.$ruta_zatiak[2].'/'.$ruta_zatiak[3].'" border="0" style="width:100px;float:left;margin:10px;" />';  
}  				echo "</div>";
			} else {
				$this->erroreak[] = "Landare hau ez da existitzen";
				Mugitu::nora('index.php');
			}
		}
		private function produktuaBalidatu() {
			if(strlen($_POST['pizena']) < 3 || empty($_POST['pizena'])) {
				$this->erroreak[] = "Izena motzegia da edo hutsik utzi duzu";
				return false;
			} else if(!preg_match('/^[a-z\d]{2,64}$/i', str_replace(' ', '', $_POST['pizena']))) {
				$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
				return false;
			} else if(strlen($_POST['deskripzioa']) < 20 || empty($_POST['deskripzioa'])) {
				$this->erroreak[] = "Deskripzioa motzegia da edo hutsik utzi duzu.";
				return false;
			} else if(empty($_POST['prezioa'])) {
				$this->erroreak[] = "Prezioa ez da zenbaki bat edo hutsa utzi duzu.";
				return false;
			} else if(empty($_POST['stock'])) {
				$this->erroreak[] = "Stocka ez da zenbaki bat edo hutsik utzi duzu.";
				return false;
			} else {
				return true;
			}
		}
		public function zeozeLortu($kanpo) {
				// ID eta kanpo izen bat emanda balioa itzultzen du
				$id = $_GET['id'];
				$sql = "SELECT * FROM produktu WHERE id='".$id."';";
				
				$kontsulta = $this->db->query($sql)->fetch_object();
				
				switch($kanpo) {
						case "izena":
							return $kontsulta->izena;
							break;
						case "prezioa":
							return $kontsulta->deskripzioa;
							break;
						case "stock":
							return $kontsulta->stock;
							break;
				}
		}
}
