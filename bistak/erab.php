<h2 class="eizena"><?php echo $erabObj->izena." ".$erabObj->abizena; ?></h2>
<h3>Azken erosketak</h3>
<table class="pure-table">
	<thead>
		<tr>
			<td>Produktua</td>
			<td>Kodigoa</td>
<!--
			<td>Prezioa</td>
-->
			<td>Kantitatea</td>
			<td>Data</td>
		</tr>
	</thead>
	<tbody>
	<?php
	
	while($lerroa = $hist->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$lerroa['Prizena']."</td>";
		echo "<td>".$lerroa['codigo']."</td>";
		echo "<td>".$lerroa['Preezioa']."</td>";
		echo "<td>".$lerroa['kantitatea']."</td>";
		echo "<td>".$lerroa['data']."</td>";
		echo "</tr>";
	}
	
	?>
	</tbody>
</table>
