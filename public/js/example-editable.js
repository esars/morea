
//‘bar’, ‘area’, ‘pie’, ‘line’
$(function(){	
	 $('.tabla1').visualize({type: 'bar', height: '400px', width: '920px',margin:'auto'});
	 //$('.tabla1').css('display','none');
	 $('.tabla2').visualize({type: 'area', height: '300px', width: '420px'});
	 $('.tabla3').visualize({type: 'line', height: '300px', width: '420px'});
	 $('.tabla4').visualize({type: 'pie', height: '300px', width: '420px'});
});