<table class='pure-table' style='margin:auto;width:90%;background-color:white'>
  <thead>
  <tr>
    <th>Izena</th>
    <th>Id</th>
    <th>Deskripzioa</th>
    <th>Stock</th>
    <th>Prezioa</th>
    <th><i class='fa fa-camera fa-l'>Argazkiak</i></th>
    <th class='tooltip botoiak' id='ezabatu_botoia' title='Aukeratuak ezabatu'><i class='fa fa-trash fa-l'>Ezabatu</i><form id='kentzeko_forma' method='post' action='kudeatzailea.php'><input type="hidden" name='pborratu'><input type="hidden" name='ekintza' value='kendu'><input type="hidden" name='id' id='kentzeko_id'></form></th>
    <th class='tooltip botoiak' id='aldatu_botoia' title='Aldaketak gauzatu'><i class='fa fa-edit fa-l'>Aldatu</i></th>
  </tr></thead>
  <tbody>
    <?php
global $config;
      
      $mysqli = new mysqli($config["host"],
                               $config["user"],
                               $config["pass"],
                               $config["izen"])
                  or die("Error " . mysqli_error($this->db));
      $sql = "SELECT * FROM produktu;";
      $contador=0;
      $produktuak=$mysqli->query($sql);
      while($lerroa = $produktuak->fetch_assoc()) {
      echo "<tr class='fila' style='border:solid thin black;'>
    <form action='kudeatzailea.php' method='post' id='aldatu".$contador."'><td class='aldagarriak'><input type='hidden' name='ekintza' value='aldatu'><input type='hidden' name='id' value='".$lerroa['id']."'><input disabled name='pizena' type='text' value='".$lerroa['izena']."' style='width:100px' class='fl".$contador." fn".$contador."'></td>
    <td>".$lerroa['id']."</td>
    <td class='aldagarriak'><textarea  name='deskripzioa' disabled class='fl".$contador." fn".$contador."'>".$lerroa['deskripzioa']."</textarea></td>
    <td class='aldagarriak'><input  name='stock' disabled type='number' value='".$lerroa['stock']."' style='width:50px' class='fl".$contador." fn".$contador."'></td>
    <td class='aldagarriak'><input name='prezioa' disabled type='number' value='".$lerroa['prezioa']."' style='width:50px' class='fl".$contador." fn".$contador."'><input type='hidden' name='paldatu' value='".$lerroa['id']."'></td><td></form>";
$total_imagenes = glob("public/argazkiak/".$lerroa['id']."-{*.jpg,*.gif,*.png}",GLOB_BRACE);
foreach($total_imagenes as $v){
  $ruta_zatiak = explode("/", $v);
  echo $ruta_zatiak[2]."<br>";
}
    echo "</td>
    <td><input id='n".$contador."' class='ezab' type='checkbox' value='".$lerroa['id']."'></td>
    <td><input id='l".$contador."' class='txekeatu' name='aldatu' value='aldatu".$contador."' type='radio'></td>
  </tr>";
  $contador++;
      }
    ?>
  </tbody>
  <thead>
  <tr><form id='gehitu_form' method="post" action="kudeatzailea.php" enctype="multipart/form-data">
    <th> <input style='width:100px' id="pizena" name="pizena" required type="text" placeholder="Izena"></th>
    <th colspan='2'><textarea id="deskripzioa" name="deskripzioa" required placeholder="Deskripzioa"></textarea></th>
    <th><input id="foo" style='width:50px' type="number" min="0" step="any" name="stock" placeholder="Stock"></th>
    <th> <input id="prezioa" style='width:50px' required type="number" min="0" step="any" placeholder="Prezioa" name="prezioa"></th>
    <th><input type="file" id='argazkia' name="imga" required class='primary-button' style='width:200px'></th>
    <input type="hidden" name='pgehitu'>
    <input type="hidden" name='ekintza' value='gehitu'>
    <th colspan='2' id='gehitu1' class='erosi'>Gehitu</th></form>
  </tr></thead>
</table>