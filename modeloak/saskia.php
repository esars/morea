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
				
				if(isset($_GET['karrito'])) {
					$this->handle($_GET["karrito"]);
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
					break;
				case "kendu":
					$this->saskitikKendu();
					break;
			}
			$this->saskiaErakutsi();
		}
		private function saskiraGehitu() {
			//kontadorea ez bada existitzen 0 balioarekin sortzen dugu
				if(!isset($_SESSION['contador'])){
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
				if(isset($_POST["ezabatzekoak"])) {
			//Ezabatzekoak postak ezabatzeko produktuen id zerrenda ekartzen du ',' banatuak
			//beraz, explode funtzioarekin array bihurtzen dugu "$ezabatzeko_array" izenarekin 
			//ondoren for batekin banan banan ezabatzeko
					$ezabatzeko_array=explode(',',$_POST["ezabatzekoak"]);
			//$max bariableak  arrayaren luzeera esaten digu "sizeOf()" funtzioaren bitartez
					$max=sizeOf($ezabatzeko_array);
					for($i=0;$i<$max;$i++){
						$kendu=$ezabatzeko_array[$i];
						$pos=array_search($kendu,$_SESSION['karritoa']);
						unset($_SESSION['karritoa'][$pos]);
					}
				}
		}
		private function saskiaErakutsi() {
				
		}
}
