$('#erab').hover(aldatu_erab);
$('#erab').mouseout(ber_aldatu_erab);
$('#adminarg').hover(aldatu_admin);
$('#adminarg').mouseout(ber_aldatu_admin);
$('#saski').hover(aldatu_saski);
$('#saski').mouseout(ber_aldatu_saski);
$('.tooltip').tooltipster({contentAsHTML:'true',position:'bottom'});
$('.karrito_gehitu').click(karritora_gehitu);
$('#ezkutatua').load('bistak/saskia_bista.php');
$('#admin').load('bistak/admin.php');
$("button[name='erakutsi']").hover(erakutsi_info);
function aldatu_erab () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#erab').attr('src','public/img/erab_koloreztatua.png');
}
function ber_aldatu_erab () {
	$('#erab').attr('src','public/img/erab.png');
}
function aldatu_admin () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#adminarg').attr('src','public/img/admin_koloreztatua.png');
}
function ber_aldatu_admin () {
	$('#adminarg').attr('src','public/img/admin.png');
}
function aldatu_saski () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#saski').attr('src','public/img/shopping_koloreztatua.png');
}
function ber_aldatu_saski () {
	$('#saski').attr('src','public/img/shopping.png');
}
function notifErakutsi(denbora) {
	$(".notif").fadeIn("slow");
	setTimeout(function() {
		$(".notif").fadeOut("slow");
	},denbora);
}
$(document).ready(function() {
	notifErakutsi(4500);
});
function karritora_gehitu(){
	id=$(this).prev('input').val();
	$('#ezkutatua').load('bistak/saskia_bista.php?produktua='+$(this).prev('input').val()+'&ekintzak=gehitu');
	$('#mezuak').append("<div class='notif mezu'>Produktua gehitu duzu</div>");
	notifErakutsi(2300);
}
function erakutsi_info(){
	$('#ezkutatua2').load('bistak/prod_info.php?id='+$(this).val()+'&ekintza=erakutsi');
}