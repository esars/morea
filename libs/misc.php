<?php
class Session {
		// SESSION ALDAGAI BAT EZARRI
		public static function set($a, $b) {
			if(empty($_SESSION[$a])) {
				$_SESSION[$a] = $b;
			}
		}
		// SESSION ALDAGAI BAT BORRATU
		public static function rm($a) {
			$_SESSION[$a] = null;
		}
		// SESSION ALDAGAI BAT LORTU
		public static function get($a) {
			if(isset($_SESSION[$a])) {
				return $_SESSION[$a];
			} else {
				echo '$_SESSION '.$a.' aldagaia ez da existitzen.';
			}
		}
		// EXISTITZEN BADA
		public static function existitzenBada($a) {
			if(isset($_SESSION[$a])) {
					return true;
			} else {
					return false;
			}
		}
		public static function saioa_itxi() {
			unset($_SESSION['izena']);
			unset($_SESSION['email']);
		}
}
class Mugitu {

		//	REDIRECT BAT EGIN	//

		public static function nora($u) {
			//header("Location: ".$u);
			echo "<script>window.location('".$u."')</script>";
		}
}
?>
