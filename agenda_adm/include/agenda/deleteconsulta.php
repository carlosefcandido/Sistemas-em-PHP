<html>
    <head>
		<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>

		<link rel="stylesheet" type="text/css" href="../../jquery-autocomplete/jquery.autocomplete.css" />
		
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.bgiframe.min.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.ajaxQueue.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/thickbox-compressed.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/jquery.autocomplete.js"></script>
		<script type='text/javascript' src='../../jquery-autocomplete/demo/localdata.js'></script>
		
<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		preencheDados(data);
	} 
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
	$("#pacnome").focus().autocomplete("ajax.php");	
	
	$(":text, textarea").result(log).next().click(function() {
		$(this).prev().search();
	});
	
	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
});

function OK(tipo){
	if(tipo == 'M'){
		alert("Agendamento realizado com sucesso.");
	}else{
		alert("Encaixe realizado com sucesso.");
	}
	window.close();
}


function selecionaCombo(itemSelecionar){
	var elemento = document.formulario.pacconvenioplano;
	for ( i =0; i < elemento.length; i++){
		if(elemento[i].value == itemSelecionar){
			elemento[i].selected = true;
		}
	}       
}

function preencheDados(dado) 
{ 
	var resultado = "" + dado;
	var retorno = resultado.split(",");
	document.formulario.pacnome.value = retorno[0].toUpperCase(); 
	document.formulario.pacid.value = retorno[3];
}  

function validar(pergunta){ 
	if(document.formulario.pacnome.value == ''){
		alert("Preencha o nome do paciente.");
		document.formulario.pacnome.focus();
		return false;
	} 
	if(document.formulario.pacid.value == 0){
		alert("Preencha o nome de um paciente válido.");
		document.formulario.pacnome.focus();
		return false;
	}	
	document.formulario.botao.disabled = true;	
	document.formulario.botao.value = "Aguarde processando...";
	document.formulario.target = '_parent';
	document.formulario.submit();  
}    

</script>
</head>
<body>
                           <form name="formulario" id="formulario" action="../../sistema/" method="post" autocomplete="off" >
						   <input type="hidden" name="acao" id="acao" value="deleteconsulta" />
							<input type="hidden" name="passo" id="passo" value="1" />
							<input type="hidden" name="pacid" id="pacid" value="0" />
                                <div class="cabecForm">Excluir consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="80" value="" />
											</td>
                                        </tr>
									</table>	
                                </div>
                                <div class="barraBotoes">
									<input type="button" value=" Continuar " id="botao" name="botao" onClick="validar();" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
							
</body>
</html>
