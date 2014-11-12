$('#erab').hover(aldatu_erab);
$('#erab').mouseout(ber_aldatu_erab);
$('#adminarg').hover(aldatu_admin);
$('#adminarg').mouseout(ber_aldatu_admin);
$('#bilatu').hover(aldatu_bilatu);
$('#bilatu').mouseout(ber_aldatu_bilatu);
$('#saski').hover(aldatu_saski);
$('#saski').mouseout(ber_aldatu_saski);
$('.tooltip').tooltipster({contentAsHTML:'true',position:'bottom'});
$('.tooltip2').tooltipster({contentAsHTML:'true',position:'bottom',});
$('.tooltip3').tooltipster({contentAsHTML:'true',position:'right',animation:'grow',content:'ezabatu',});
$('.tooltip4').tooltipster({contentAsHTML:'true',position:'bottom-right',animation:'swing',content:'Argazki berria gehitu',});
$('.karrito_gehitu').click(karritora_gehitu);
$('#ezkutatua').load('bistak/saskia_bista.php');
$('#admin').load('bistak/admin.php');
$('.borratzekoa').click(argazkia_ezabatu);
$("button[name='erakutsi']").click(erakutsi_info);
function aldatu_erab () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#erab').attr('src','public/img/erab_koloreztatua.png');
}
function ber_aldatu_erab () {
	$('#erab').attr('src','public/img/erab.png');
}
function aldatu_bilatu () {
	//$('#erab').fadeToggle(2000,0.5);
	$('#bilatu').attr('src','public/img/bilatu_koloreztatua.png');
	$('#bilatu-input').focus();
}
function ber_aldatu_bilatu () {
	$('#bilatu').attr('src','public/img/bilatu.png');
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
	window.location='index.php?id='+$(this).val()+'&ekintza=erakutsi';
}
//kudeatzailearen zatia

$(':checkbox').click(ezabatu);
$('.txekeatu').click(aldatu);
$('#ezabatu_botoia').click(ezabatzekoak_bidali);
$('#aldatu_botoia').click(aldatutakoa_bidali);
$('#gehitu1').click(function(){
$('#gehitu_form').submit();
});
$('#gehitu2').click(function(){
$('#gehitu2_form').submit();
});
aurreko_id='';
ezabatzekoak_array='';
function ezabatzekoak_bidali(){
	ezabatzekoak_array='';
		for (var i = $('.ezab').length - 1; i >= 0; i--) {
			if($('.ezab:eq('+i+')').is(':checked')){
			ezabatzekoak_array=ezabatzekoak_array+','+$('.ezab:eq('+i+')').val();
		}
	}
$('#kentzeko_id').val(ezabatzekoak_array);
$('#kentzeko_forma').submit();
}
function aldatutakoa_bidali(){
	for (var i = 0; i <= $('.txekeatu').length-1; i++) {
			if($('.txekeatu:eq('+i+')').is(':checked')){
			forma=$('.txekeatu:eq('+i+')').val();
		}
	}
	$('#'+forma).submit();
}
function ezabatu () {
	id=$(this).attr('id');
	if($(this).is(':checked')){
	$(this).parent().parent().css('background-color','#D33B37');
	$(this).parent().next().children('input:radio').removeAttr('checked');
	$('.f'+id).attr('disabled','disabled');
	$('.f'+id+':file').css('display','none');
	$('.sf'+id).css('display','none');
		if($(this).parent().next().children('input:radio').attr('id')==aurreko_id){
			aurreko_id=''
		}
}
else{
	$(this).parent().parent().css('background-color','white');
}
}
function aldatu () {
	id=$(this).attr('id');
	if(aurreko_id!=id&&aurreko_id!=''){
		$('.f'+aurreko_id).attr('disabled','disabled');
		$('.f'+aurreko_id+':file').css('display','none');
		$('.sf'+aurreko_id).css('display','none');
		if(aurreko_id!='0'){
		$('#'+aurreko_id).parent().parent().css('background-color','white');}
	}
	if($(this).is(':checked')){
	$('.f'+id).removeAttr('disabled');
	$('.f'+id+':file').css('display','block');
	$('.sf'+id).css('display','inline-block');
	$(this).parent().parent().css('background-color','grey');
	$(this).parent().prev().children('input:checkbox').removeAttr('checked');
	$('.txekeatu:eq(0)').css('background-color','green');
	aurreko_id=id;
}
else{
	$('.f'+id).attr('disabled','disabled');
	$('.f'+id+':file').css('display','none');
	$('.sf'+id).css('display','none');
	$(this).parent().parent().css('background-color','white');
	aurreko_id='';
}
}
function argazkia_ezabatu(){
	$('#argazki_bakarraren_id').val($(this).attr('id'));
	$('#argazki_bakarraren_forma').submit();
}
function jasotakoak_bidali(){
	jasotakoak_array='';
	kodigoak_array = '';
		for (var i = $('.jasoak').length - 1; i >= 0; i--) {
			if($('.jasoak:eq('+i+')').is(':checked')){
			jasotakoak_array=jasotakoak_array+','+$('.jasoak:eq('+i+')').val();
			kodigoak_array=kodigoak_array+','+$('.jasoak:eq('+i+')').attr('id');
		}
		$('#arraya').val(jasotakoak_array);
		$('#arraiaCod').val(kodigoak_array);
		$('#jasotakoforma').submit();
		}
	}
$('#bisitenTaula').click(taulaErakutsi);
function taulaErakutsi(){
	alert('barruan');
	$('#taulabisitena').hide();
}