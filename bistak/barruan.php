<div id="ezkutatua">
	<div id="mylightbox">
		<p>Saioa hasia <?php echo Session::get('izena');?> erabiltzaile izenarekin</p><br>
		<p>Erabiltzaile honek <?php echo Session::get('email');?> emaila du</p><br>
		<p>Saioa ixteko klikatu 'saioa itxi' botoiean</p>
		<form class='pure-form' action="" method='post'><input class='pure-button pure-input-1-6 pure-button-primary formbotoi' type="submit" name="logout" value='Saioa itxi'></form>
	</div>
</div>