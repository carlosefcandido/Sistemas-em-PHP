<?php	
	require_once "../../classes/classDTO.php";
	require_once "../../classes/classBD.php";
	require_once "../../classes/classGeneric.php";
	require_once "../../classes/classMedicoDAO.php";
	require_once "../../classes/classPlanoDAO.php";	
	require_once "../../classes/classAgendaDAO.php";
	require_once "../../classes/classPacienteDAO.php";	
	require_once "../../classes/classAtendimentoDAO.php";	
	require_once "../../classes/classExameDAO.php";	
	require_once "../../funcoes/funcoes.php";

	$erros = NULL;
	$body = "<body>";
	$medico = new classDTO();
	$paciente = new classDTO();	
	$agenda = new classDTO();	
	
	if($_POST['gravar']){
		$pacienteDAO = new classPacienteDAO();
		$atendimentoDAO = new classAtendimentoDAO();
		
		$agenda = carregarObjeto($_POST);
		
		//atualizar atendimento
		$pacienteDAO->atualizar($agenda);
		//atualizar atendimento
		$erros = $atendimentoDAO->confirmarAtendimento($agenda);
		
		if(!$erros){
			$body = "<body onLoad=OK();";	
		}		
		
	}else{
		$pacienteDAO = new classPacienteDAO();
		$agenda->setCampo("medid",$_GET['medid']);
		$agenda->setCampo("data",$_GET['data']);
		$agenda->setCampo("hora",$_GET['hora']);
		$agenda->setCampo("pacid",$_GET['pacid']);
		$paciente = $pacienteDAO->buscarComConvenio($agenda);
		$agenda->setCampo("pacnome",$paciente->getCampo("pacnome"));
		$agenda->setCampo("pacconvenioplano",$paciente->getCampo("pacconvenio"));
		$agenda->setCampo("pactelefone",$paciente->getCampo("pactelefone"));
		$agenda->setCampo("pacnumerocartao",$paciente->getCampo("pacnumerocartao"));
	}	
		
	//buscar medico
	$medicoDAO = new classMedicoDAO();
	$medico = $medicoDAO->buscar($agenda);
		
	//buscar convênios
	$planoDAO = new classPlanoDAO();
	$planos = $planoDAO->listar();
	$comboPlano = "<select name='pacconvenioplano' id='pacconvenioplano'>";
	$comboPlano.= "<option></option>";
	if($planos){
		foreach($planos as $plano){
			if($agenda->getCampo("pacconvenioplano") == $plano->getCampo("conid")){
				$comboPlano.= "<option value = '".$plano->getCampo("conid")."' selected >".$plano->getCampo("connome")."</option>";	
			}else{
				$comboPlano.= "<option value = '".$plano->getCampo("conid")."' >".$plano->getCampo("connome")."</option>";	
			}
		}
	}
	$comboPlano.= "</select>";
	
	if ($erros){
		echo '<div align="center"><div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$erros.'</p>
              </div><br/></div>';
	}

?>
<html>
    <head>
		<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.bgiframe.min.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/jquery.ajaxQueue.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/lib/thickbox-compressed.js"></script>
		<script type="text/javascript" src="../../jquery-autocomplete/jquery.autocomplete.js"></script>
		<script type='text/javascript' src='../../jquery-autocomplete/demo/localdata.js'></script>
		<link rel="stylesheet" type="text/css" href="../../jquery-autocomplete/jquery.autocomplete.css" />

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

function OK(){
	alert("Consulta confirmada com sucesso.");
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
	document.formulario.pactelefone.value = retorno[1];
	selecionaCombo(retorno[2]);
	document.formulario.pacid.value = retorno[3];
}  

function validar(pergunta){ 
	if(document.formulario.pacnome.value == ''){
		alert("Preencha o nome do paciente.");
		document.formulario.pacnome.focus();
		return false;
	}
	if(document.formulario.pactelefone.value == ''){
		alert("Preencha o telefone do paciente.");
		document.formulario.pactelefone.focus();
		return false;
	}
	if(document.formulario.pacconvenioplano.value == ''){
		alert("Selecione um convênio.");
		document.formulario.pacconvenioplano.focus();
		return false;
	}
	if(document.formulario.pacnumerocartao.value == ''){
		alert("Preencha o número da carteira.");
		document.formulario.pacnumerocartao.focus();
		return false;
	} 	
	if (confirm(pergunta)){ 
		document.formulario.pacnome.value = document.formulario.pacnome.value.toUpperCase();
		window.returnValue="OK";
		document.formulario.botao.disabled = true;	
		document.formulario.botao.value = "Aguarde processando...";
		document.formulario.submit();  
	} 
}    

function limpar(){
	document.formulario.pacid.value = "";
	document.formulario.pacnome.value = "";
	document.formulario.pactelefone.value = "";
	selecionaCombo(0);
} 

function maskIt(w,e,m,r,a){
        
        // Cancela se o evento for Backspace
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        
        // Variáveis da função
        var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre  = (a ) ? a.pre : "";
        var pos  = (a ) ? a.pos : "";
        var ret  = "";

        if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

        // Loop na máscara para aplicar os caracteres
        for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                        ret += mask.charAt(x); x++;
                } else{
                        ret += txt.charAt(y); y++; x++;
                }
        }
        
        // Retorno da função
        ret = (!r) ? ret : ret.reverse()        
        w.value = pre+ret+pos;
}

// Novo método para o objeto 'String'
String.prototype.reverse = function(){
        return this.split('').reverse().join('');
};

</script>
<script language="javascript">
function buscarObservacao(exame)
{
	var acao = "buscarobservacao";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.formulario.obs.value = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../../act.php?acao="+acao+"&exaid="+exame,true);
	xmlhttp.send(null);
}
</script> 

</head>
<?php echo $body; ?>
                           <form name="formulario" id="formulario" action="" method="post" autocomplete="off" >
						   <input type="hidden" name="gravar" id="gravar" value="1" />
							<input type="hidden" name="passo" id="passo" value="1" />
							<input type="hidden" name="medid" id="medid" value="<?php echo $agenda->getCampo("medid");?>" />
							<input type="hidden" name="agedata" id="agedata" value="<?php echo $agenda->getCampo("data");?>" />
							<input type="hidden" name="agehora" id="agehora" value="<?php echo $agenda->getCampo("hora");?>" />
							<input type="hidden" name="pacid" id="pacid" value="<?php echo $agenda->getCampo("pacid");?>" />
                                <div class="cabecForm">Confirmar consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" value="<?php echo $medico->getCampo("mednome");?>" size="80" readonly />										
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Data</th>
                                            <td width="80%"><input type="text" name="data" id="data" value="<?php echo $agenda->getCampo("data");?>" size="8" readonly />										
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Hora</th>
                                            <td width="80%"><input type="text" name="hora" id="hora" value="<?php echo $agenda->getCampo("hora");?>" size="4" readonly />										
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="80" value="<?php echo $agenda->getCampo("pacnome");?>" />
											</td>
                                        </tr>
										<tr>
											<th width="20%">Telefone</th>
											<td width="80%">
											<input type="text" name="pactelefone" id="pactelefone" size="15" value="<?php echo $agenda->getCampo("pactelefone");?>" onkeyup="maskIt(this,event,'(##)####-####')" />									
											</td>
											</td>
										</tr>										
										<tr>
											<th width="20%">Conv&ecirc;nio</th>
											<td width="80%"><?php echo $comboPlano; ?>
											</td>
											</td>
										</tr>
										<tr>
											<th width="20%">N&uacute;mero carteira</th>
											<td width="80%">
											<input type="text" name="pacnumerocartao" id="pacnumerocartao" size="20" value="<?php echo $agenda->getCampo("pacnumerocartao");?>" onkeyup="maskIt(this,event,'####################')" />									
											</td>
											</td>
										</tr>										
									</table>	
                                </div>
                                <div class="barraBotoes">
									<input type="button" value=" Confirmar Consulta " id="botao" name="botao" onClick="validar('Confirmar consulta?');" />
                                    <input type="button" value=" Limpar " id="btnLimpar" name="btnLimpar" onClick="limpar();" />									
                                    <input type="button" value=" Fechar " id="btnFechar" name="btnFechar" onClick="window.close();" />
                                </div>
                            </form>
							
</body>
</html>
