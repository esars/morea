</section>
<div id="mezuak">
<?php
	if (isset($login)) {
		if ($login->erroreak) {
			foreach ($login->erroreak as $e) {
				echo "<div class='notif error'>".$e."</div>";
			}
		}
		if ($login->mezuak) {
			foreach ($login->mezuak as $m) {
				echo "<div class='notif mezu'>".$m."</div>";
			}
		}
	}
	if (isset($reg)) {

		if (count($reg->erroreak) > 0) {
			foreach ($reg->erroreak as $e) {
				echo "<div class='notif error'>".$e."</div>";
			}
		}
		if ($reg->mezuak) {
			foreach ($reg->mezuak as $m) {
				echo "<div class='notif mezu'>".$m."</div>";
			}
		}
	}
	if (isset($prod)) {
		if ($prod->erroreak) {
			foreach ($prod->erroreak as $e) {
				echo "<div class='notif error'>".$e."</div>";
			}
		}
		if ($prod->mezuak) {
			foreach ($prod->mezuak as $m) {
				echo "<div class='notif mezu'>".$m."</div>";
			}
		}
	}
	if (isset($sask)) {
		if ($sask->erroreak) {
			foreach ($sask->erroreak as $e) {
				echo "<div class='notif error'>".$e."</div>";
			}
		}
		if ($sask->mezuak) {
			foreach ($sask->mezuak as $m) {
				echo "<div class='notif mezu'>".$m."</div>";
			}
		}
		if (isset($_SESSION['mezuak'])){
			echo "<div class='notif mezu'>".$_SESSION['mezuak']."</div>";
			unset($_SESSION['mezuak']);
		}
		if (isset($_SESSION['erroreak'])){
			echo "<div class='notif mezu'>".$_SESSION['erroreak']."</div>";
			unset($_SESSION['erroreak']);
		}
	}
	if (isset($kontua)) {
		if ($kontua->erroreak) {
			foreach ($kontua->erroreak as $e) {
				echo "<div class='notif error'>".$e."</div>";
			}
		}
		if ($kontua->mezuak) {
			foreach ($kontua->mezuak as $m) {
				echo "<div class='notif mezu'>".$m."</div>";
			}
		}
	}
?>
</div>
<footer>
	<h6>enekosar@ikasle.aeg.es  &&  xaxtian.amenabar@ikasle.aeg.es</h6>
	<h6>All rights reserved</h6>
	<script src="public/js/jquery.ezdz.min.js"></script>
	<script src="public/js/script.js"></script>
</footer>
</div>
</body>
</html>
