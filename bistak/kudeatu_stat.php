<div class="gureinfo zabal">
	<table class="pure-table">
	<thead>
		<tr>
			<td>Erabiltzaile ID</td>
			<td>IP helbidea</td>
			<td>Nabigatzailea eta sistema eragilea</td>
			<td>Nondik</td>
			<td>Non</td>
			<td>Data</td>
		</tr>
	</thead>
	<tbody>
		<?php while($lerroa = $bisitak->fetch_assoc()) {
		
			echo "<tr>";
		
			echo "<td>".$lerroa['uid']."</td>";
			echo "<td>".$lerroa['ip']."</td>";
			echo "<td>".$lerroa['user_agent']."</td>";
			echo "<td>".$lerroa['referer']."</td>";
			echo "<td>".$lerroa['orrialdea']."</td>";
			echo "<td>".$lerroa['data']."</td>";
		
			echo "</tr>";
		} ?>
	</tbody>
	</table>
</div>
