<div class="gureinfo">

<h2 class="eizena"><?php
global $erabObj;
//var_dump($erabObj);
echo $erabObj->izena." ".$erabObj->abizena; ?></h2>
<?php if(Sartu::adminBarruan()) { ?>
	<h2>Prozesuan</h2>
	<table class="pure-table hist taula">
		<thead>
			<td>Erosle ID</td>
			<td>Erosle izena</td>
			<td>Produktua</td>
			<td>Kodigoa</td>
			<td>Prezioa</td>
			<td>Kantitatea</td>
			<td>Data</td>
			<?php if(Sartu::adminBarruan()) { ?>
				<td><form id="jasotakoforma" action='' method='post'><input type="hidden" id="arraya" name="arraya"><input type="hidden" id="arraiaCod" name="arraiaCod"><button onclick="jasotakoak_bidali()" class='pure-button pure-button-primary' name='jasodut'>Jaso dut!</button></form></td>
			<?php } ?>
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
				
				if(Sartu::adminBarruan()) {
					echo "<td><input type='checkbox' value='".$lerroa['codigo']."' id='".$lerroa['codigo']."' class='jasoak'></td>";
				}
				echo "</tr>";
			}
}
 ?>
	</tbody>
	</table>

<h2>Eginak</h2>
<table class="pure-table hist taula">
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
		
		echo "</tr>";
	} ?>
	</tbody>
</table>