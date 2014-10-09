$('#erab').hover(aldatu_erab);
$('#erab').mouseout(ber_aldatu_erab);
$('#saski').hover(aldatu_saski);
$('#saski').mouseout(ber_aldatu_saski);
function aldatu_erab () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#erab').attr('src','public/img/erab_koloreztatua.png');
}
function ber_aldatu_erab () {
	$('#erab').attr('src','public/img/erab.png');
}
function aldatu_saski () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#saski').attr('src','public/img/shopping_koloreztatua.png');
}
function ber_aldatu_saski () {
	$('#saski').attr('src','public/img/shopping.png');
}