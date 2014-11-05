<?php
class Saskia{
	private $db=null;

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
				
				if(isset($_GET['ekintzak'])) {
					$this->handle($_GET['ekintzak']);
				} else if(isset($_POST['ekintzak'])){
					$this->handle($_POST['ekintzak']);
				} else {
					$this->handle();
				}
		}
		
		private function handle($karrito = null) {
			
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
			
			switch($karrito) {
				case "gehitu":
					$this->saskiraGehitu();
					$this->saskiaErakutsi();
					break;
				case "kendu":
					$this->saskitikKendu();
					$this->saskiaErakutsi();
					break;
				case "erosi":
					if(isset($_POST['ekintzak'])&&$_POST['ekintzak']=='kendu'){
						$this->saskitikKendu();}
					$this->erosi();
				case null:
					$this->saskiaErakutsi();
					break;if((int)phpversion()[2] < 5) {
	require_once "config/passlib.php";
}

			}
		}
		private function saskiraGehitu() {
			//kontadorea ez bada existitzen 0 balioarekin sortzen dugu
				if(!isset($_SESSION['karritoa'])){
					$_SESSION['contador']=0;
				}
				if(isset($_GET["produktua"])) {
			//karritoaren array-ean kontadorea momentu horretan
			// dagoen posizioan sartuko dugu produktuaren id-a
					$_SESSION['karritoa'][$_SESSION['contador']]=$_GET['produktua'];
			//Urrengo produktua array-ean urrengo posizioan gehitzeko contadorea +1 egiten dugu
					$_SESSION['contador']++;
				}
		}
		private function saskitikKendu() {
				if(isset($_POST["id_prod"]) && isset($_SESSION['karritoa'])) {

			//Ezabatzekoak postak ezabatzeko produktuen id zerrenda ekartzen du ',' banatuak
			//beraz, explode funtzioarekin array bihurtzen dugu "$ezabatzeko_array" izenarekin 
			//ondoren for batekin banan banan ezabatzeko
					$ezabatzeko_array=explode(',',$_POST["id_prod"]);
					
			//$max bariableak  arrayaren luzeera esaten digu "sizeOf()" funtzioaren bitartez
					//$max=sizeOf($ezabatzeko_array);
					
					for($i=0;$i<$ezabatzeko_array[0];$i++){
						$kendu=$ezabatzeko_array[1];
						$pos=array_search($kendu,$_SESSION['karritoa']);
						unset($_SESSION['karritoa'][$pos]);
					}
					if(sizeOf($_SESSION['karritoa'])<1){
						Session::saskia_ustu();
					}
				}
				else {

					if(isset($_POST['erosibotoi'])) {
						Session::saskia_ustu();
						Mugitu::nora('index.php');
					}
				}
		}
		private function saskiaErakutsi($lb = true) {
			/*
			 * $lb parametroak lightboxaren barruan dagoen ala ez
			 * esango digu. Beste leku batetik deitu nahi dugunean
			 * saskiaErakutsi(false) erabiliko dugu izkutuan ez
			 * egoteko
			*/
			if($lb) {
				echo '<div id="ezkutatua"><div id="saskia">';
			}
			echo '<h1 style="margin:auto;text-align:center">Erosketen Gurditxoa</h1>';
			echo '<table class="pure-table" style="margin:auto;';
			if(!$lb) {
				//Lighbox barruan ez dagoenean zabalera gehiago eman
					echo 'width: 75%;';
			}
			echo '">';
			echo '<thead><tr><th>Izena</th><th>Kopurua</th><th>Prezioa</th>';
			echo '<th class="zakarra"><form action="" method="post">';
			echo '<input id="ezabatzeko" class="tooltip" title="Guztiak ezabatu" type="image" name="ekintzak" src="public/img/zakarra_2.png" value="kendu">';
			
						/*
			 * Hau jarri behar da, karritoaren lokuragatik
			*/
			echo '<input type="hidden" name="erosibotoi" value="erosibotoi">';
			echo '</form></th></tr></thead><tbody>';

			if(isset($_SESSION['karritoa'])){
				$karritoaren_array=array_count_values($_SESSION['karritoa']);
				$totala=0;

			/*
			 * Karritoaren array-ean produktu ezberdinak 
			 * ateratzen ditugu eta bakoitzaren kopurua
			*/
			
				foreach($karritoaren_array as $x=>$x_value){
				$sql = "SELECT * FROM produktu where id=".$x."";
				$produktuak = $this->db->query($sql);
					while($row = $produktuak->fetch_assoc()) {
						echo '<tr><td>'.$row['izena'].'</td><td>'.$x_value.'</td>';
						echo '<td>'.$row['prezioa']*$x_value.' euro</td>';
						echo '<td><form action="" method="post"><input type="hidden" value="'.$x_value.','.$x.'" name="id_prod"><input id="ezabatzeko" type="image" name="ekintzak" src="public/img/zakarra_2.png" value="kendu"></form></td></tr>';
						$totala+=$row['prezioa']*$x_value;
		
					}
				}
				echo '</tbody><thead><tr><th>Guztira:'.$totala.' euro</th>';
				echo '<th colspan="3" class="erosi">';
				if(!$lb) {
				//Lighbox barruan ez dagoenean erosi botoi ezberdina
					echo '<form action="" method="post"><input type="hidden" name="erosibotoi" value="erosibotoi"><input type="hidden" name="codigo" value="'.md5(uniqid(rand(), true)).'"><input type="hidden" name="erosi" value="bai"><button class="erosibotoi" type="submit" name="ekintzak" value="erosi">Erosketa egin</button></form></th>';
			}
			else{
				echo '<form action="" method="get"><button class="erosibotoi" type="submit" name="ekintzak" value="erosi">Erosketa egin</button></form></th>';}
				echo '</tr></thead>';
				echo '</table>';
			}
			else{
				echo '<tr><td colspan="4">Saskia hutsik</td></tr></tbody></table>';
			}
			if($lb) {
					echo '</div></div>';
			}
		}
		private function erosi() {
			if(Sartu::barruan()&&isset($_SESSION['karritoa'])) {
				if($this->formaBalidatu()){
					if(!isset($_POST['erosi'])&&isset($_SESSION['karritoa'])){
					$this->saskiaErakutsi(false);
					$erostear = $_SESSION['karritoa'];}
					//print_r ($erostear);
					//echo Session::get('id');
					else if(isset($_POST['erosi'])&&isset($_SESSION['karritoa'])) {
						$erostear = $_SESSION['karritoa'];
						$karritoaren_array=array_count_values($_SESSION['karritoa']);
						$kodea=$this->kodigoaSortu();
					foreach($karritoaren_array as $ida=>$kantitatea){
					$this->erosketaInsertatu($ida,$kodea,$kantitatea);
					}
					if(!isset($_SESSION['mezua_stock'])){
					$this->saskitikKendu();
					unset($_GET['ekintzak']);
					$this->mezuak[] = "Erosketa arrakastaz egina";}
					else {$this->erroreak[] = "Ez da stocka geratzen '".$_SESSION['mezua_stock']."' erosteko";
						unset($_GET['ekintzak']);
				}
				}
			}
		}
		else if(!Sartu::barruan()){
			unset($_GET['ekintzak']);
			$this->erroreak[] = "Bazkide izan behar zara erosketak egiteko.";
	}
	else unset($_GET['ekintzak']);
		unset($_SESSION['mezua_stock']);
	}

		private function erosketaInsertatu($ida,$kodea,$kantitatea) {
				/*lehenik stock-a egiaztatuko dugu.*/
				$sql="select * from produktu where id=".$ida."";
				$bidali = $this->db->query($sql)->fetch_object();
				//echo '<script>alert("'.$bidali->stock.'")</script>';
				if($bidali->stock>=$kantitatea){
				/*
				 * salmentak taulara informazioa gehitu, lerro bat
				 * gehitzen den bakoitzean exekutatuko da, bi 
				 * parametroak behar-beharrezkoak dira.
				 */
				 $data = date('Y-m-d h:i:s');
				 $sql = "INSERT INTO salmentak
				         (id_er, id_prod, codigo, kantitatea, data)
				         VALUES
				         ('".Session::get('id')."', '".$ida."', '".$kodea."', '".$kantitatea."', '".$data."');";
				 $sartu = $this->db->query($sql);
				$sql1 = "update produktu set stock='".($bidali->stock-$kantitatea)."'
									WHERE id='".$ida."';";
				 $sartu1 = $this->db->query($sql1);}
				 else {
				 if(isset($_SESSION['mezua_stock']))
				 	$_SESSION['mezua_stock']= $_SESSION['mezua_stock'].','.$bidali->izena;
				 	else
				 		$_SESSION['mezua_stock']= $bidali->izena;
				}
		}
		private function formaBalidatu() {
			if(!isset($_POST['codigo'])){
				return true;
			}
			else if(isset($_SESSION['codigo'])) {
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
			public function kodigoaSortu() {
			$length = 10;
 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $string = substr( str_shuffle( $chars ), 0, $length );
   return $string;
}
}
