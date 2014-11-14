<div class="gureinfo zabal">
	<ul id='menu_estadistikak'>
		<li id='lehena' onclick='bisitak_erakutsi("lehena")'>Bisiten taula</li>
		<li id='bigarrena'  onclick='bisitak_erakutsi("bigarrena")'>Produktuen estadistikak</li>
		<li id='hirugarrena'  onclick='bisitak_erakutsi("hirugarrena")'>Erabiltzaileen estadistikak</li>
	</ul>
	<script>
$('#lehena').click(lehenaf);
$('#bigarrena').click(bigarrenaf);
$('#hirugarrena').click(hirugarrenaf);
function lehenaf(){
	$('#ErabiltzaileenGrafikoak').hide();
	$('#ProduktuenGrafikoak').hide();
	$('#taulabisitena').show();
}
function bigarrenaf(){
	$('#ErabiltzaileenGrafikoak').hide();
	$('#taulabisitena').hide();
	$('#ProduktuenGrafikoak').show();
}
function hirugarrenaf(){
	$('#ProduktuenGrafikoak').hide();
	$('#taulabisitena').hide();
	$('#ErabiltzaileenGrafikoak').show();
}//document.getElementById('estiloak').innerHTML='#ErabiltzaileenGrafikoak,#ProduktuenGrafikoak{display:none}';
function bisitak_erakutsi (n) {
// document.getElementById('taulabisitena').style.display='block';
 document.getElementById('estiloak').innerHTML='#menu_estadistikak #bigarrena{background-color:#E84A5F;box-shadow:none;}#menu_estadistikak #'+n+'{display:inline-block;background-color:transparent;border-bottom:solid thin #F4F4E8;margin-bottom:-1px;box-shadow:0px -7px 10px grey}';
}
	</script>
	<div id="kargatzen" style='width:100%'><h1>Estadistikak Kalkulatzen...</h1><img src="public/img/pentsakor.jpg" style='display:block;width:400px;margin-left:auto;margin-right:auto' alt=""></div>
	<div id="biltzailea" style='display:none'>
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
<div id="ProduktuenGrafikoak" style='display:block'>
	

		<div style="width: 95%;float:left">
			<h1 style="text-align:center;clear:both">Produktu Erosienak</h1>
		<div id="canvas-holder">
			<canvas id="canvas0" height="275" width="800" style='float:left'/>
		</div></div>
		<ul style='list-style:none;float:left;margin-left:-20px;margin-right:0px;padding:0px'>
	<li style="margin-top:20px"><span style="background-color:#E84A5F;padding:5px;border-radius:5px">Erosketak</span></li>
	<li style="margin-top:20px"><span style="background-color:rgba(151,187,205,0.5);padding:5px;border-radius:5px">Bisitak</span></li></ul>

	<div style="width: 95%;float:left">
			<h1 style="text-align:center;clear:both">Produktu Bisitatuenak</h1>
		<div id="canvas-holder">
			<canvas id="canvas1" height="275" width="800" style='float:left'/>
		</div></div>
		<ul style='list-style:none;float:left;margin-left:-20px;padding:0px'>
	<li style="margin-top:20px"><span style="background-color:#E84A5F;padding:5px;border-radius:5px">Bisitak</span></li></ul>
	</div>
	<div id="ErabiltzaileenGrafikoak" style='display:none'>
		
		<div style="width: 50%;float:left">
			<h1 style="text-align:center;clear:both">Erabiltzaile erosleenak</h1>
		<div id="canvas-holder" style='clear:both;float:left'>
		<canvas id="canvas2" width="400" height="400" style='float:left'/>
	</div>
			<ul style='list-style:none'>
		<?php 
			$arrayKolor = [
    0 => "#641143",
    1 => "#D4986A",
    2 => "#196811",
    3 => "#808015",
    4 => "#403075",
    5 => "#C986AF",
    6 => "yellow",
    7 => "green",
];
$arrayKolor2 = [
    0 => "#CBCC99",
    1 => "#6498C1",
    2 => "#F79910",
    3 => "#CB1009",
    4 => "#64B832",
    5 => "#F9F966",
    6 => "F79910",
    7 => "F397CA",
];
			
			$i=0;
			
			foreach($array_erosketak as $id=>$erosketak){
				echo '<li style="margin-top:20px">';
				$kontsultak = "SELECT * FROM erabiltzaile WHERE id='".$id."';";
				$prozk = $this->db->query($kontsultak)->fetch_object();
				echo '<span style="background-color:'.$arrayKolor[$i].';padding:5px;border-radius:5px">'.$prozk->izena.'('.$erosketak.')</span>';
				$i++;
				if ($i == 8) break;
				echo '</li>';
				
			}
			
			
		 ?></ul>
</div>
<div style='width:50%;float:left'>
	<h1 style="text-align:center;clear:both">Nabigatzaile erabiliak</h1>
<div id="canvas-holder" style='float:left'>
		<canvas id="canvas3" width="400" height="400" style='float:left'/>
	</div>
			<ul style='list-style:none'>
		<?php 
			
			$i=0;
			foreach($nab as $nabe=>$zenb){
				echo '<li style="margin-top:20px">';
				echo '<span style="background-color:'.$arrayKolor2[$i].';padding:5px;border-radius:5px">'.$nabe.'('.$zenb.')</span>';
				$i++;
				if ($i == 8) break;
				echo '</li>';
				
			}
			
			
		 ?></ul>
		</div>

		<div style='width:50%;float:left'>
	<h1 style="text-align:center;clear:both">S.O erabiliak</h1>
<div id="canvas-holder" style='float:left'>
		<canvas id="canvas4" width="400" height="400" style='float:left'/>
	</div>
			<ul style='list-style:none'>
		<?php 
			
			$i=0;
			foreach($sis as $sistema=>$zenb){
				echo '<li style="margin-top:20px">';
				echo '<span style="background-color:'.$arrayKolor[$i].';padding:5px;border-radius:5px">'.$sistema.'('.$zenb.')</span>';
				$i++;
				if ($i == 8) break;
				echo '</li>';
				
			}
			
			
		 ?></ul>
		</div>
	<script>
		$(window).load(function() {
    
    	$('#biltzailea').show();
    	$('#kargatzen').hide();
    
});
	    var barChartData0 = {
		labels :  <?php 
			echo '[';
			
			while($lerroan = $proze->fetch_assoc()) {
				echo "'".$lerroan['izena']."',";
			
		} 
			echo ']';
			
		 ?>
		,
		datasets : [
			{
				fillColor : "#E84A5F",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightStroke: "rgba(220,220,220,1)",
				data : <?php 
			echo '[';
			$i=0;
			while($lerroak = $prozea->fetch_assoc()) {
			 	echo $lerroak['kant'].",";
			 }
			echo ']';
			
		 ?>
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : <?php 
			echo '[';
			$i=0;
			while($lerroak = $prozeak->fetch_assoc()) {
			 	if(isset($bisiten_arraya[$lerroak['iz']])){
			 	echo $bisiten_arraya[$lerroak['iz']].",";}
			 	else{
			 		echo "0,";
			 	}
			 }
			echo ']';
			
		 ?>}
		]

	}
    var barChartData = {
		labels : <?php 
			echo '[';
			$i=0;
			foreach($bisiten_arraya as $id=>$bisitak){
				$kontsulta = "SELECT * FROM produktu WHERE id='".$id."';";
				$proz = $this->db->query($kontsulta)->fetch_object();
				echo '"'.$proz->izena.'('.$bisitak.')",';
				$data[$i]=$bisitak;
				$i++;
				if ($i == 8) break;
				
			}
			echo ']';
			
		 ?>
		,
		datasets : [
			{
				fillColor : "#E84A5F",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : <?php 
			echo '[';
			$i=0;
			foreach($bisiten_arraya as $id=>$bisitak){
				
				
				echo $bisitak.',';
				$i++;
				if ($i == 8) break;
				
			}
			echo ']';
			
		 ?>
			}
		]

	}
	var pieData = [
				<?php 
			$i=0;
			foreach($array_erosketak as $id=>$erosketak){
				echo '{';
				$kontsultak = "SELECT * FROM erabiltzaile WHERE id='".$id."';";
				$prozk = $this->db->query($kontsultak)->fetch_object();
				echo 'value:'.$erosketak.',';
				echo 'highlight:"'.$arrayKolor2[1].'",';
				echo 'color:"'.$arrayKolor[$i].'",';
				echo 'label:"'.$prozk->izena.'"';
				$i++;
				if ($i == 8) break;
				echo '},';
				
			}
			
			
		 ?>

			];
			var pieData2 = [
				<?php 
			$i=0;
			foreach($nab as $nabe=>$zenb){
				echo '{';
				echo 'value:'.$zenb.',';
				echo 'highlight:"'.$arrayKolor[0].'",';
				echo 'color:"'.$arrayKolor2[$i].'",';
				echo 'label:"'.$nabe.'"';
				$i++;
				if ($i == 8) break;
				echo '},';
				
			}
			
			
		 ?>

			];
			var pieData3 = [
				<?php 
			$i=0;
			foreach($sis as $sistem=>$zenb){
				echo '{';
				echo 'value:'.$zenb.',';
				echo 'highlight:"'.$arrayKolor2[1].'",';
				echo 'color:"'.$arrayKolor[$i].'",';
				echo 'label:"'.$sistem.'"';
				$i++;
				if ($i == 8) break;
				echo '},';
				
			}
			
			
		 ?>

			];
	window.onload = function(){
		var ctx = document.getElementById("canvas1").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
		var ctx1 = document.getElementById("canvas0").getContext("2d");
		window.myBar1 = new Chart(ctx1).Bar(barChartData0, {
			responsive : true
		});
		var ctx2 = document.getElementById("canvas2").getContext("2d");
				window.myPie = new Chart(ctx2).Pie(pieData);
		var ctx3 = document.getElementById("canvas3").getContext("2d");
				window.myPie1 = new Chart(ctx3).Pie(pieData2);
		var ctx4 = document.getElementById("canvas4").getContext("2d");
				window.myPie2 = new Chart(ctx4).Pie(pieData3);
	}

	</script>
</div>

</div>
</div>
