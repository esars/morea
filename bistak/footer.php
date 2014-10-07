<footer>
	<h6>enekosar@ikasle.aeg.es/xaxtian.amenabar@ikasle.aeg.es</h6>
	<h6>All rights reserved</h6>
	<script src="public/js/script.js"></script>
	<?php
		if (isset($login)) {
			if ($login->erroreak) {
				foreach ($login->erroreak as $e) {
					echo $e;
				}
			}
			if ($login->mezuak) {
				foreach ($login->mezuak as $m) {
					echo $m;
				}
			}
		}
		if (isset($reg)) {
			if ($reg->errors) {
				foreach ($reg->erroreak as $e) {
					echo $e;
				}
			}
			if ($reg->mezuak) {
				foreach ($reg->mezuak as $m) {
					echo $m;
				}
			}
		}
	?>
</footer>
</body>
</html>
