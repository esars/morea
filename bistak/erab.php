<h2 class="eizena"><?php echo $erabObj->izena." ".$erabObj->abizena; ?></h2>
<?php if(Sartu::adminBarruan()) { ?>
	<h2>Prozesuan</h2>
	<table class="pure-table hist">
		<thead>
			<td>Erosle ID</td>
			<td>Erosle izena</td>
			<td>Produktua</td>
			<td>Kodigoa</td>
			<td>Prezioa</td>
			<td>Kantitatea</td>
			<td>Data</td>
		</thead>
		<tbody>
			<?php while($lerroa = $proz->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$lerroa['id_er']."</td>";
				echo "<td>".$lerroa['eiz']."</td>";	
				echo "<td>".$lerroa['iz']."</td>";
				echo "<td>".$lerroa['codigo']."</td>";
				echo "<td>".$lerroa['pre']."</td>";
				echo "<td>".$lerroa['kantitatea']."</td>";
				echo "<td>".$lerroa['data']."</td>";
				echo "</tr>";
			} ?>
	</tbody>
	</table>
<?php } ?>
<h2>Azken Erosketak</h2>
<table class="pure-table hist">
	<thead>
		<tr>
			<?php if(Sartu::adminBarruan()) { ?>
				<td>Erosle ID</td>
				<td>Erosle izena</td>
			<?php } ?>
			<td>Produktua</td>
			<td>Kodigoa</td>
			<td>Prezioa</td>
			<td>Kantitatea</td>
			<td>Data</td>
			<?php if(Sartu::adminBarruan()) {
				echo "<td>Jaso al duzu?</td>";
			} ?>
		</tr>
	</thead>
	<tbody>
	<?php while($lerroa = $hist->fetch_assoc()) {
		
		echo "<tr>";
		
		if(Sartu::adminBarruan()) {
			echo "<td>".$lerroa['id_er']."</td>";
			echo "<td>".$lerroa['eiz']."</td>";
		}
		
		echo "<td>".$lerroa['iz']."</td>";
		echo "<td>".$lerroa['codigo']."</td>";
		echo "<td>".$lerroa['pre']."</td>";
		echo "<td>".$lerroa['kantitatea']."</td>";
		echo "<td>".$lerroa['data']."</td>";
		if(Sartu::adminBarruan()) {
			echo "<td><form action='' method='post'><input type='submit' value='Jaso dut!' class='pure-button pure-button-primary' name='jasodut'></form>";
			echo "</tr>";
	} ?>
	</tbody>
</table>
<?php } ?>
