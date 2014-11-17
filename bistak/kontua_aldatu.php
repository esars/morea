<div class="gureinfo">
	<form id='kontualdatu' class='pure-form' action="" method='post'>
		<h1>Kontua aldatu</h1>
		<fieldset class='pure-group'>
		<input class='pure-input-1-6' type="text" required maxlength='30' value='<?php Session::get('izena'); ?>' name='izena'>
		<input class='pure-input-1-6' type="text" required maxlength='30' value='<?php echo $erabObj->abizena ?>' name='abizena'>
		<input class='pure-input-1-6' type="email" required maxlength='40' value='<?php Session::get('email'); ?>' name='email'>
		</fieldset>
		<fieldset class='pure-group'>
		<input class='pure-input-1-6' type="number" required max='999999999999' value='<?php echo $erabObj->telefonoa ?>' name='telefono'>
		<input class='pure-input-1-6' type="text" required maxlength='70' value='<?php echo $erabObj->helbidea ?>' name='helbidea'>
		</fieldset>
		<input type="submit" class='pure-button pure-input-1-6 pure-button-primary formbotoi' id='registro1' value='Datuak Aldatu' name="daaldatu">
	</form>
</div>
