<?php
	echo '<thead><tr><th>Izena</th><th>Kopurua</th><th>Prezioa</th>
			<th class="zakarra"><form action="" method="post">
			<input id="ezabatzeko" class="tooltip" title="Guztiak ezabatu" type="image" name="ekintzak" src="public/img/zakarra_2.png" value="kendu">';
			
						/*
			 * Hau jarri behar da, karritoaren lokuragatik
			*/
			echo '<input type="hidden" name="erosibotoi" value="erosibotoi">';
			echo '</form></th></tr></thead><tbody>';

			if(isset($_SESSION['karritoa'])){
				$karritoaren_array=array_count_values($_SESSION['karritoa']);
				$totala=0;

			/*
			 * Karritoaren array-ean produktu ezberdinak 
			 * ateratzen ditugu eta bakoitzaren kopurua
			*/
			$mysqli = new mysqli($config["host"],
                               $config["user"],
                               $config["pass"],
                               $config["izen"])
                  or die("Error " . mysqli_error($this->db));
				foreach($karritoaren_array as $x=>$x_value){
				$sql = "SELECT * FROM produktu where id=".$x."";
				$produktuak = $this->db->query($sql);
					while($row = $produktuak->fetch_assoc()) {
						echo '<tr><td>'.$row['izena'].'</td><td>'.$x_value.'</td>';
						echo '<td>'.$row['prezioa']*$x_value.' euro</td>';
						echo '<td><form action="" method="post"><input type="hidden" value="'.$x_value.','.$x.'" name="id_prod"><input id="ezabatzeko" type="image" name="ekintzak" src="public/img/zakarra_2.png" value="kendu"></form></td></tr>';
						$totala+=$row['prezioa']*$x_value;
		
					}
				}
				echo '</tbody><thead><tr><th>Guztira:'.$totala.' euro</th>
				<th colspan="3" class="erosi"><button class="erosibotoi" onClick="location.href=\'erosketa_validatu.php\'">Erosi</button></th>
				</tr></thead>
				</table>';
				}
			else{
				echo '<tr><td colspan="4">Saskia hutsik</td></tr></tbody></table>';
			}?>