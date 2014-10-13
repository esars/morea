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
				
				if(isset($_POST['ekintzak'])) {
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
				case null:
					$this->saskiaErakutsi();
					break;
			}
		}
		private function saskiraGehitu() {
			//kontadorea ez bada existitzen 0 balioarekin sortzen dugu
				if(!isset($_SESSION['karritoa'])){
					$_SESSION['contador']=0;
				}
				if(isset($_POST["produktua"])) {
			//karritoaren array-ean kontadorea momentu horretan
			// dagoen posizioan sartuko dugu produktuaren id-a
					$_SESSION['karritoa'][$_SESSION['contador']]=$_POST['produktua'];
			//Urrengo produktua array-ean urrengo posizioan gehitzeko contadorea +1 egiten dugu
					$_SESSION['contador']++;
				}
		}
		private function saskitikKendu() {
				Session::saskia_ustu();
				Mugitu::nora('index.php');
				//if(isset($_POST["ezabatzekoak"])) {
			//Ezabatzekoak postak ezabatzeko produktuen id zerrenda ekartzen du ',' banatuak
			//beraz, explode funtzioarekin array bihurtzen dugu "$ezabatzeko_array" izenarekin 
			//ondoren for batekin banan banan ezabatzeko
					//$ezabatzeko_array=explode(',',$_POST["ezabatzekoak"]);
			//$max bariableak  arrayaren luzeera esaten digu "sizeOf()" funtzioaren bitartez
					//$max=sizeOf($ezabatzeko_array);
					//for($i=0;$i<$max;$i++){
					//	$kendu=$ezabatzeko_array[$i];
						//$pos=array_search($kendu,$_SESSION['karritoa']);
						//unset($_SESSION['karritoa'][$pos]);
					//}
				//}
		//}
	}
		private function saskiaErakutsi() {
			echo '<div id="ezkutatua"><div id="saskia">';
			echo '<h1 style="margin:auto;text-align:center">Erosketen Gurditxoa</h1>';
			echo '<table class="pure-table" style="margin:auto">';
			echo '<thead><tr><th>Izena</th><th>Kopurua</th><th>Prezioa</th></tr></thead><tbody>';
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
						echo '</tr>';
						$totala+=$row['prezioa']*$x_value;
		
					}
				}
				echo '</tbody><thead><tr><th>Guztira:'.$totala.' euro</th>';
				echo '<th class="erosi">Erosi</th><th class="zakarra">';
				echo '<form action="" method="post">';
				echo '<input id="ezabatzeko" type="image" name="ekintzak" src="public/img/zakarra_2.png" value="kendu"></form>';
				echo '</th></tr></thead>';
				echo '</table></div></div>';
			}
			else{
				echo '<tr><td colspan="3">Saskia hutsik</td></tr></tbody></table></div></div>';
			}
		}
}
