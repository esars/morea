<table class='pure-table' style='margin:auto;width:90%;background-color:rgba(255,255,255, .5)' id='kudeatzailea'>
  <thead>
  <tr>
    <th>Izena</th>
    <th>Abizena</th>
    <th>Helbidea</th>
    <th>Email</th>
    <th>Telefonoa</th>
    <th>Id</th>
    <th class='tooltip botoiak' id='ezabatu_botoia' title='Aukeratuak ezabatu'><i class='fa fa-trash fa-l'>Ezabatu</i>
      <form id='kentzeko_forma' method='post' action='index.php'><input type="hidden" name='eborratu'>
        <input type="hidden" name='codigo' value='<?php echo md5(uniqid(rand(), true)) ?>'>
        <input type="hidden" name='ekintza' value='kendu'><input type="hidden" name='id' id='kentzeko_id'></form></th>
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
      $sql = "SELECT * FROM erabiltzaile;";
      $contador=0;
      $produktuak=$mysqli->query($sql);
      while($lerroa = $produktuak->fetch_assoc()) {
      echo "<tr class='fila' style='border:solid thin black;'>
    <form action='index.php' method='post' id='aldatu".$contador."' enctype='multipart/form-data'>
    <input type='hidden' name='codigo' value='".md5(uniqid(rand(), true))."'><td class='aldagarriak'>
    <input type='hidden' name='ekintza' value='aldatu'><input type='hidden' name='id' value='".$lerroa['id']."'>
    <input disabled name='eizena' type='text' value='".$lerroa['izena']."' style='width:100px' class='fl".$contador." fn".$contador."'></td>
    <td><input disabled name='abizena' type='text' value='".$lerroa['abizena']."' style='width:100px' class='fl".$contador." fn".$contador."'></td>
    <td class='aldagarriak'><textarea  name='helbidea' disabled class='fl".$contador." fn".$contador."'>".$lerroa['helbidea']."</textarea>
    </td><td class='aldagarriak'><input  name='email' disabled type='text' value='".$lerroa['email']."' style='width:150px' class='fl".$contador." fn".$contador."'></td>
    <td class='aldagarriak'><input name='telefonoa' disabled type='number' value='".$lerroa['telefonoa']."' style='width:95px' class='fl".$contador." fn".$contador."'>
    <input type='hidden' name='ealdatu' value='".$lerroa['id']."'></td><td>".$lerroa['id']."
    </form></td>
    <td><input id='n".$contador."' class='ezab' type='checkbox' value='".$lerroa['id']."'></td>
    <td><input id='l".$contador."' class='txekeatu' name='aldatu' value='aldatu".$contador."' type='radio'></td>
  </tr>";
  $contador++;
      }
    ?>
  </tbody>
  <thead>
  <tr><form id='gehitu2_form' method="post" action="index.php" enctype="multipart/form-data">
    <th> <input style='width:100px' id="pizena" name="izena" required type="text" placeholder="Izena"></th>
    <th><input type='text' name="abizena" required placeholder="Abizena" style='width:150px'></th>
    <th><input style='width:150px' type="text" name="helbidea" placeholder="Helbidea"></th>
    <th> <input id="prezioa" style='width:50px' required type="email" placeholder="Email" name="email"></th>
    <th><input id="prezioa" style='width:100px' required type="number" min="0" step="any" placeholder="Telefonoa" name="telefono"></th>
    <th><input type='text' name="pasahitza1" required placeholder="Pasahitza" style='width:75px'></th>
    <th><input type='text' name="pasahitza2" required placeholder="Pasahitza" style='width:75px'></th>
    <input type="hidden" name='codigo' value='<?php echo md5(uniqid(rand(), true)) ?>'>
    <input type="hidden" name='ekintza' value='kudeatzaile_erab'>
    <th id='gehitu2' class='erosi'>Gehitu</th></form>
  </tr></thead>
</table>
