<div class="gureinfo zabal">
	<input type="button" class='pure-button' value='Bisiten taula osoa ikusi' onclick='bisitak_erakutsi()' id='bisitenTaula'>
	<script>
function bisitak_erakutsi () {
	if(document.getElementById('taulabisitena').style.display!='none'){
	document.getElementById('taulabisitena').style.display='none';
	document.getElementById('bisitenTaula').value='Bisiten taula osoa ikusi';}
else{
 document.getElementById('taulabisitena').style.display='block';
 document.getElementById('bisitenTaula').value='Bisiten taula ezkutatu';}
}
	</script>
	<table id='taulabisitena' style='display:none' class="pure-table">
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
	<div id='grafikoak'>
			<table class="tabla1" style='display:none'>
	<caption>Top 8 Produktu erosienak</caption>
	<thead>
		<tr>
			<?php if(Sartu::adminBarruan()) { ?>
				<td></td>
			<?php 
			while($lerroa = $proze->fetch_assoc()) {
				echo "<th>".$lerroa['izena']."</th>";
			}
		} ?>
		</tr>
	</thead>
	<tbody>
	<?php
		
		echo "<tr>";
			echo "<th>Erosketak</th>";
			 while($lerroak = $prozea->fetch_assoc()) {
			 	echo "<td>".$lerroak['kant']."</td>";
			 }
		echo "</tr>";
		echo "<tr>";
			echo "<th>Bisitak</th>";
			 while($lerroak = $prozeak->fetch_assoc()) {
			 	if(isset($bisiten_arraya[$lerroak['iz']])){
			 	echo "<td>".$bisiten_arraya[$lerroak['iz']]."</td>";}
			 	else{
			 		echo "<td>0</td>";
			 	}
			 }
		echo "</tr>";
	 ?>
	</tbody>
</table>
<table class="tabla1" style='display:none'>
	<caption>8 Produktu bisitatuenak</caption>
	<thead>
		<tr>
			<?php if(Sartu::adminBarruan()) { ?>
				<td></td>
			<?php 
			
			$i=0;
			foreach($bisiten_arraya as $id=>$bisitak){
				$kontsulta = "SELECT * FROM produktu WHERE id='".$id."';";
				$proz = $this->db->query($kontsulta)->fetch_object();
				echo "<th>".$proz->izena."</th>";
				$i++;
				if ($i == 8) break;
				
			}
			
		} ?>
		</tr>
	</thead>
	<tbody>
	<?php
		
		echo "<tr>";
			echo "<th>bisitak</th>";
		
			$i=0;
			 foreach($bisiten_arraya as $id=>$bisitak){
			 	
			 	echo "<td>".$bisitak."</td>";
			 	$i++;
			 	if ($i == 8) break;
			 }
			
		echo "</tr>";
	 ?>
	</tbody>
</table>
</div>
</div>

</div>
