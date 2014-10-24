<?php
require_once "config/config.php";
require_once "libs/misc.php";
require_once "modeloak/sartu.php";
require_once "modeloak/izenaeman.php";
require_once "modeloak/produktu.php";
require_once "modeloak/saskia.php";

$login = new Sartu();
$reg = new IzenaEman();
$sask = new Saskia();

include("bistak/header.php");?>
<table class='pure-table' style='margin:auto;width:90%;background-color:white'>
	<thead>
	<tr>
		<th>Izena</th>
		<th>Id</th>
		<th>Deskripzioa</th>
		<th>Stock</th>
		<th>Prezioa</th>
		<th><i class='fa fa-camera fa-l'>Argazkiak</i></th>
		<th><i class='fa fa-trash fa-l'>Ezabatu</i></th>
		<th><i class='fa fa-edit fa-l'>Aldatu</i></th>
	</tr></thead>
	<tbody>
		<?php
global $config;
			
			$mysqli = new mysqli($config["host"],
															 $config["user"],
															 $config["pass"],
															 $config["izen"])
									or die("Error " . mysqli_error($this->db));
			$contador=0;
			$sql = "SELECT * FROM produktu;";
			$contador=0;
			$produktuak=$mysqli->query($sql);
			while($lerroa = $produktuak->fetch_assoc()) {
			echo "<tr style='border:solid thin black;' id='sn".$contador."'><form>
		<td><input disabled type='text' value='".$lerroa['izena']."' style='width:100px'></td>
		<td>".$lerroa['id']."</td>
		<td><textarea disabled>".$lerroa['deskripzioa']."</textarea></td>
		<td><input disabled type='number' value='".$lerroa['stock']."' style='width:50px'></td>
		<td><input disabled type='number' value='".$lerroa['prezioa']."' style='width:50px'></td><td>";
$total_imagenes = glob("public/argazkiak/".$lerroa['id']."-{*.jpg,*.gif,*.png}",GLOB_BRACE);
foreach($total_imagenes as $v){
	$ruta_zatiak = explode("/", $v);
	echo $ruta_zatiak[2]."<br>";
}
		echo "</td>
		<td><input id='n".$contador."' type='checkbox'></td>
		<td><input class='txekeatu' type='checkbox'></td></form>
	</tr>";
	$contador++;
			}
		?>
	</tbody>
	<thead>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th colspan='2'>Gehitu</th>
	</tr></thead>
</table>
<script>
//$('#sn0').css('background-color','red');
$(':checkbox').click(aldatu);
$('.txekeatu').click(aldatu1);
function aldatu () {
	id=$(this).attr('id');
	if($(this).is(':checked')){
	$('#s'+id).css('background-color','red');
}
else{
	$('#s'+id).css('background-color','white');
}
	//if($'')
}
</script>
				</section>
<?php
if(Sartu::barruan()) {
	include("bistak/barruan.php");
	if(Sartu::adminBarruan()) {
		include("bistak/admin.php");
}
} else {
	include("bistak/login_registro.php");
}
include("bistak/footer.php");
?>