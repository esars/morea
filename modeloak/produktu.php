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
				} else if(isset($_GET['bilaketa'])) {
					$this->parametrizatzailea($_GET['bilaketa']);
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
						$this->produktuaKendu($_POST['id']);
					} else {
						$this->erroreak[] = "Ez zara kudeatzailea.";
					}
					break;
				case "erakutsi":
						$this->produktuBatErakutsi($_GET['id']);
					break;
				case "kudeatzaile_prod":
					if(Sartu::adminBarruan())
					include("bistak/kudeatu.php");
				else $this->produktuakErakutsi();
				break;
				case "kudeatzaile_erab":
					if(Sartu::adminBarruan()) 
					include("bistak/kudeatu_erab.php");
					else $this->produktuakErakutsi();
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

				$this->produktuakErakutsi(null, $param);
		}
		private function parametrizatzailea($parametroa) {
			//echo '<script>alert("apa")</script>';
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
				
				
				$this->produktuakErakutsi($parametroa, null);
		}
		private function produktuaGehitu() {
			//formulariotik datorrela validatu
        if($this->formaBalidatu()){
			//argazkia validatu
			if(isset($_POST["pgehitu"])&&isset($_FILES['imga'])) {
				$arraya=explode('.',$_FILES['imga']['name']);
					$formatua=$arraya[sizeof($arraya)-1];
					if($formatua!='png'&&$formatua!='jpg'&&$formatua!='jpeg'&&$formatua!='tif'&&$formatua!='JPG'&&$formatua!='JPEG'){
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
			}include("bistak/kudeatu.php");
		}
		private function produktuaKendu($id) {
			//formulariotik datorrela validatu
		if(!Sartu::adminBarruan()) {
		echo '<script>alert(document.location.href);window.location="index.php"</script>';}
        else if($this->formaBalidatu()){
			// KONFIRMAZIOA PASA ONDOREN

			if(isset($_POST['pborratu'])) {
				$id_ak=explode(",",$id);
				for($i=1;$i<=sizeof($id_ak)-1;$i++){
				$sql = "DELETE FROM produktu WHERE id='".$id_ak[$i]."';";

				$borratu = $this->db->query($sql);
				$total_imagenes = glob("public/argazkiak/".$id_ak[$i]."-{*.jpg,*.gif,*.png,*.JPG,*.JPEG}",GLOB_BRACE);
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
			if(isset($_POST['eborratu'])) {
				$id_ak=explode(",",$id);
				for($i=1;$i<=sizeof($id_ak)-1;$i++){
				$sql = "DELETE FROM erabiltzaile WHERE id='".$id_ak[$i]."';";
				$borratu = $this->db->query($sql);
				}
				if(isset($borratu)) {
					$this->mezuak[] = "Erabiltzailea arrakastaz ezabatu duzu";
				}
				else{
					$this->erroreak[] = "Errorea erabiltzailea ezabatzean";
				}
			}
		}
		if(isset($_POST['eborratu']))include("bistak/kudeatu_erab.php");
			else if(isset($_POST['pborratu']))include("bistak/kudeatu.php");
		}
		private function produktuaAldatu($id) {
			//formulariotik datorrela validatu
	if(!Sartu::adminBarruan()) {
		echo '<script>alert(document.location.href);window.location="index.php"</script>';}
       else if($this->formaBalidatu()){
			if(isset($id)&&isset($_FILES['imga_berria'])) {
				//echo '<script>alert("'.$_FILES['imga_berria']['name'].'")</script>';
				$arraya=explode('.',$_FILES['imga_berria']['name']);
				$formatua=$arraya[sizeof($arraya)-1];
				if($_FILES['imga_berria']['name']!=null&&$formatua!='png'&&$formatua!='jpg'&&$formatua!='jpeg'&&$formatua!='tif'&&$formatua!='JPG'&&$formatua!='JPEG'){
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
						$kategoria = $_POST['kategoria'];
						$sql = "update produktu set izena='".$izena."',deskripzioa='".$deskr."',prezioa='".$prezioa."',stock='".$stock."',kategoria='".$kategoria."'
									WHERE id='".$id."';";
						$produktuaSartu = $this->db->query($sql);
						if($_FILES['imga_berria']['name']!=null){
							$total_imagenes = glob("public/argazkiak/".$id."-{*.jpg,*.gif,*.png,*.JPG,*.JPEG}",GLOB_BRACE);
							$urrengo_argazkia=$this->kateaSortu();
							$rutaEnServidor='public/argazkiak';
							$rutaTemporal=$_FILES['imga_berria']['tmp_name'];
							$nombreImagen=$_FILES['imga_berria']['name'];
							$total_imagenes_1 = glob("public/argazkiak/".$id."-{1.jpg,1.gif,1.png,1.jpeg,1.JPG,1.JPEG}",GLOB_BRACE);
							if(sizeof($total_imagenes_1)==0){
								$urrengo_argazkia=1;
							}
							$rutaDestino=$rutaEnServidor.'/'.$id.'-'.$urrengo_argazkia.'.'.$formatua;
							move_uploaded_file($rutaTemporal,$rutaDestino);
						}
						if($produktuaSartu) {
							$this->mezuak[] = "Produktua aldatua";
						} else {
							$this->erroreak[] = "Errorea produktua aldatzean";
						}
					}
				}
				else {
					$this->erroreak[] = "Argazkiaren formatua ez da irakurgarria";
					
				}
			} else if(isset($_POST["ealdatu"])){
						$email = $_POST['email'];
						$izena = $_POST['eizena'];
						$telefonoa = $_POST['telefonoa'];
						$helbidea = $_POST['helbidea'];
						$abizena = $_POST['abizena'];
						$id = $_POST['id'];
						//echo '<script>alert("izena :'.$izena.'//abizena :'.$abizena.'//email :'.$email.'//helbidea :'.$helbidea.'//telefonoa :'.$telefonoa.'//id :'.$id.'//")</script>';
						$sql = "update erabiltzaile set izena='".$izena."',email='".$email."',abizena='".$abizena."',helbidea='".$helbidea."',telefonoa='".$telefonoa."'
									WHERE id='".$id."';";
						$ErabiltzaileaAldatu = $this->db->query($sql);
						if($ErabiltzaileaAldatu) {
							$this->mezuak[] = "Erabiltzailea aldatua";
						} else {
							$this->erroreak[] = "Errorea erabiltzailea aldatzean";
						}
				}else {
					$this->erroreak[] = "Ez da ID bat eman";
			}
		}if(isset($_POST["paldatu"]))include("bistak/kudeatu.php");
			else if(isset($_POST["ealdatu"]))include("bistak/kudeatu_erab.php");
	}

		private function produktuakErakutsi($param = null, $kategoria = null) {
			//echo '<script>alert("apa")</script>';
			if(!isset($_GET['ekintzak']) /*&& !$_GET['ekintzak'] == "erosi"*/) {
				if(isset($kategoria)) {
				 $sql = "SELECT * FROM produktu WHERE kategoria='".$kategoria."';";	
				} else if(isset($param)) {
					//~ $sql = "SELECT * FROM produktu WHERE izena LIKE '%".$param."%' OR
					                               //~ deskripzioa LIKE '%".$param."%';";

					$sql = "SELECT * FROM produktu WHERE izena LIKE '%".$param."%';";
				} else {
					$sql = "SELECT * FROM produktu;";
				}
				$produktuak = $this->db->query($sql);

				/*
					* Hasierako orrialdea beteko duen funtzioa
					* Kasu hontan soilik produktu bakoitzaren
					* argazki bakar bat erakutsiko dugu
				*/
				
				if(isset($param)) {
						if(!$produktuak) {
								$this->erroreak[] = "Bilaketak ez du emaitzarik eman.";
						}
				}
				
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
				<div id='botoien_aldea'><h3>".$lerroa['prezioa']." €</h3></div><button class='button-xsmall pure-button pure-input-1 pure-button-primary info' value='".$lerroa['id']."' name='erakutsi'>Informazio gehiago	<i class='fa fa-file-text-o''></i></button>";
					if($lerroa['stock']>0){
					echo "<input type='hidden' name='produktua' value='".$lerroa['id']."'>			
					<button id='".$lerroa['id']."' class='button-success button-xsmall karrito_gehitu pure-button pure-input-1 pure-button-primary' value='gehitu' name='ekintzak'>Saskiratu	<i class='fa fa-shopping-cart fa-l'></i></button>
					</div>";}
					else{
					echo "<button class='button-xsmall pure-button pure-input-1' style='background-color:red'>STOCK GABE</button>
					</div>";}
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
				$total_imagenes = glob("public/argazkiak/".$produktua->id."-{*.jpg,*.gif,*.png,*.JPG,*.JPEG}",GLOB_BRACE);
				echo "<div class='gureinfo'><div id='argazkien_muga'><div id='argazkiak_produktu' class='slider'><ul>";
				foreach($total_imagenes as $v){  
				echo '<li style="margin:auto"><img src="'.$v.'"alt="Sliderreko argazkia" /></li>';  
}  				echo "</ul></div></div>";
echo"<script src='public/js/unslider.js'></script>
	<script>
	$(document).ready(function() {
		$('.slider').unslider({
			speed: 500,               //  The speed to animate each slide (in milliseconds)
			delay: 2500,              //  The delay between slide animations (in milliseconds)
			complete: function() {},  //  A function that gets called after every slide animation
			keys: true,               //  Enable keyboard (left, right) arrow shortcuts
			dots: true,               //  Display dot navigation
			fluid: true              //  Support responsive design. May break non-responsive designs
		});
	});
</script>";
				echo "<div id='testu'>";
				echo "<h1>".$produktua->izena."</h1>";
				echo "<p>Deskripzioa: ".$produktua->deskripzioa."</p><hr>";
				if($produktua->stock>0){
				echo "<input type='hidden' name='produktua' value='".$produktua->id."'>			
				<button style='float:right;' id='".$produktua->id."' class='button-success button-xsmall karrito_gehitu pure-button pure-input-1 pure-button-primary' value='gehitu' name='ekintzak'>Saskiratu	<i class='fa fa-shopping-cart fa-l'></i></button>";}
				else{
				echo "<input type='button' value='Ez dago stock-ean' style='background-color:red'>";	
				}
				echo "<span class='prezioa'>".$produktua->prezioa."<i class='fa fa-eur'></i></span>";
				echo "</div><br><br><div id='behekoa' style='width=100%;clear:both'><hr><button class='button-success button-xsmall pure-button pure-input-1' style='background-color:#3E5C9A;margin-left:10px;float:right'><i class='fa fa-facebook' style='color:white'></i></button>";
				echo "<button class='button-success button-xsmall pure-button pure-input-1' style='background-color:#5EAADE;margin-left:10px;float:right'><i class='fa fa-twitter' style='color:white'></i></button>";
				echo "<button class='button-success button-xsmall pure-button pure-input-1' style='background-color:#D82A21;margin-left:10px;float:right'><i class='fa fa-google-plus' style='color:white'></i></button></div></div>";
			} 
			else {
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
		private function formaBalidatu() {
			if(isset($_SESSION['codigo'])) {
            if ($_POST['codigo'] == $_SESSION['codigo']) {
                return false;
            } else {
                $_SESSION['codigo'] = $_POST['codigo'];
                return true;
            }
        } else {
            $_SESSION['codigo'] = $_POST['codigo'];
           		return true;
        }
		}
		private function argazkiaKendu() {
			//formulariotik datorrela validatu
        if($this->formaBalidatu()){
			if(isset($_POST['ruta_borratzeko_argazkiana'])) {
				unlink($_POST['ruta_borratzeko_argazkiana']);
			}
		}
		include("bistak/kudeatu.php");
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
		public function kateaSortu() {
			
			/*
			 * Irudiei ausazko string-ak gehitzeko
			*/
			
			$length = 5;
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $string = substr( str_shuffle( $chars ), 0, $length );
   return $string;
		}
}
