$('#erab').hover(aldatu_erab);
$('#erab').mouseout(ber_aldatu_erab);
$('#saski').hover(aldatu_saski);
$('#saski').mouseout(ber_aldatu_saski);
$('.tooltip').tooltipster({contentAsHTML:'true',position:'bottom'});
$('.karrito_gehitu').click(karritora_gehitu);
$('#ezkutatua').load('bistak/saskia_bista.php');
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
$(document).ready(function() {
	$(".notif").fadeIn("slow");
	setTimeout(function() {
		$(".notif").fadeOut("slow");
	},4500);
});
function karritora_gehitu(){
	id=$(this).prev('input').val();
	$('#ezkutatua').load('bistak/saskia_bista.php?produktua='+$(this).prev('input').val()+'&ekintzak=gehitu');
}