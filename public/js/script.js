$("input[value='Erregistratu']").click(verificar);
	function verificar () {
		if($("input[name='pasahitza1']").val()!=$("input[name='pasahitza2']").val()){
			$("input[name='pasahitza1']").css('border-color','red');
			$("input[name='pasahitza2']").css('border-color','red');
		}
		else
		$("#registro").submit();
	}