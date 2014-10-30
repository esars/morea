<form id='kontualdatu' class='pure-form' action="" method='post'>
	<h1>Erregistratu</h1>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="text" required maxlength='30' placeholder='<?php Session::get('izena'); ?>' name='izena'>
	<input class='pure-input-1-6' type="text" required maxlength='30' placeholder='Abizena' name='abizena'>
	<input class='pure-input-1-6' type="email" required maxlength='40' placeholder='<?php Session::get('email'); ?>' name='email'>
	</fieldset>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="number" required max='999999999999' placeholder='Telefonoa' name='telefono'>
	<input class='pure-input-1-6' type="text" required maxlength='70' placeholder='Helbidea' name='helbidea'>
	</fieldset>
	<fieldset class='pure-group'>
	<input class='pure-input-1-6' type="password" maxlength='70' required placeholder='Pasahitza' name='pasahitza1'>
	<input class='pure-input-1-6' type="password" maxlength='70' required placeholder='Errepikatu Pasahitza' name='pasahitza2'>
	</fieldset>
	<input type="submit" class='pure-button pure-input-1-6 pure-button-primary formbotoi' id='registro1' value='Erregistratu' name="izenaeman">
</form>
