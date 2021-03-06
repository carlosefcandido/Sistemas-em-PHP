<?php	
	require_once "../../classes/classDTO.php";
	require_once "../../classes/classBD.php";
	require_once "../../classes/classGeneric.php";
	require_once "../../classes/classMedicoDAO.php";
	require_once "../../classes/classPlanoDAO.php";	
	require_once "../../classes/classAgendaDAO.php";
	require_once "../../classes/classPacienteDAO.php";	
	require_once "../../classes/classExameDAO.php";	
	require_once "../../funcoes/funcoes.php";

	$erros = NULL;
	$body = "<body>";
	$medico = new classDTO();
	$paciente = new classDTO();	
	$agenda = new classDTO();	
	
	if($_POST['gravar']){
		$agendaDAO = new classAgendaDAO();
		$pacienteDAO = new classPacienteDAO();
		$agenda = new classDTO();
		$paciente = new classDTO();
		$agenda = carregarObjeto($_POST);
		$agenda->setCampo("marcacao",$agenda->getCampo("agetipomarcacao"));
		$agenda->setCampo("tipo",$agenda->getCampo("agetipo"));
		if(($agenda->getCampo("update") == 'S') && ($agenda->getCampo("pacid") != NULL) && ($agenda->getCampo("pacid") != 0)){
			$pacienteDAO->atualizar($agenda);
		}else{
			$pacienteDAO->gravar($agenda);
			$paciente = $pacienteDAO->buscarPaciente($agenda);
			$agenda->setCampo("pacid",$paciente->getCampo("pacid"));
		}		

		//valida dados do plano do paciente
		$erros = $agendaDAO->validarMinimoRetorno($agenda);
		if(!$erros){
			$erros = $agendaDAO->validarMaximoAtendimentoPorPlano($agenda);		
		}
		if(!$erros){
			$agendaDAO->gravar($agenda);
			$body = "<body onLoad=OK('".$agenda->getCampo("agetipo")."');";	
		}		
		
	}else{
		$agenda->setCampo("medid",$_GET['medid']);
		$agenda->setCampo("data",$_GET['data']);
		$agenda->setCampo("hora",$_GET['hora']);
		$agenda->setCampo("tipo",$_GET['tipo']);
		$agenda->setCampo("marcacao",$_GET['marcacao']);
	}	
	
	if($agenda->getCampo("tipo") == 'M'){
		$pergunta = "Confirma o agendamento?";
	}else{
		$pergunta = "Confirma o encaixe?";
	}
	
	//buscar medico
	$medicoDAO = new classMedicoDAO();
	$medico = $medicoDAO->buscar($agenda);
		
	//buscar conv�nios
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
	
	if($agenda->getCampo("marcacao") == 'E'){
		//buscar exames
		$exameDAO = new classExameDAO();
		$exames = $exameDAO->listarPorMedico($agenda->getCampo("medid"));
		$comboExame = ' <tr>
                           <th width="20%">Exame</th>
                           <td width="80%">
						   <select name="exame" id="exame" onChange="buscarObservacao(this.value);" >';
		$comboExame.= "<option></option>";
		if($exames){
			foreach($exames as $exame){
				if($_POST['exame'] == $exame->getCampo("exaid")){
					$comboExame.= "<option value = '".$exame->getCampo("exaid")."' selected >".$exame->getCampo("exanome")."</option>";	
				}else{
					$comboExame.= "<option value = '".$exame->getCampo("exaid")."' >".$exame->getCampo("exanome")."</option>";	
				}
			}
		}
		$comboExame.= "</select>";	
		$comboExame.= '   </td>
                       </tr>';
	}
	
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
		alert("Selecione um conv�nio.");
		document.formulario.pacconvenioplano.focus();
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
        
        // Vari�veis da fun��o
        var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre  = (a ) ? a.pre : "";
        var pos  = (a ) ? a.pos : "";
        var ret  = "";

        if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

        // Loop na m�scara para aplicar os caracteres
        for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                        ret += mask.charAt(x); x++;
                } else{
                        ret += txt.charAt(y); y++; x++;
                }
        }
        
        // Retorno da fun��o
        ret = (!r) ? ret : ret.reverse()        
        w.value = pre+ret+pos;
}

// Novo m�todo para o objeto 'String'
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
							<input type="hidden" name="agetipomarcacao" id="agetipomarcacao" value="<?php echo $agenda->getCampo("marcacao");?>" />
							<input type="hidden" name="agetipo" id="agetipo" value="<?php echo $agenda->getCampo("tipo");?>" />
							<input type="hidden" name="pacid" id="pacid" value="<?php echo $agenda->getCampo("pacid");?>" />
                                <div class="cabecForm">Marcar consulta</div>
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
                                            <th width="20%">Situa&ccedil;&atilde;o</th>
                                            <td width="80%">
											<input type="radio" name="tipo" id="tipo" value="M" <?php if($agenda->getCampo("tipo") == 'M'){ echo "checked";}?> disabled />Marca&ccedil;&atilde;o
											<input type="radio" name="tipo" id="tipo" value="E" <?php if($agenda->getCampo("tipo") == 'E'){ echo "checked";}?> disabled />Encaixe
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Tipo Marca&ccedil;&atilde;o</th>
                                            <td width="80%">
											<input type="radio" name="marcacao" id="marcacao" value="C" <?php if($agenda->getCampo("marcacao") == 'C'){ echo "checked";}?> disabled />Consulta
											<input type="radio" name="marcacao" id="marcacao" value="E" <?php if($agenda->getCampo("marcacao") == 'E'){ echo "checked";}?> disabled />Exame
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Atualiza dados paciente</th>
                                            <td width="80%">
												<input type="radio" name="update" id="update" value="S" <?php if(($agenda->getCampo("update") == 'S') || ($agenda->getCampo("update") == NULL)){ echo "checked";}?> />Sim
												<input type="radio" name="update" id="update" value="N" <?php if($agenda->getCampo("update") == 'N'){ echo "checked";}?> />N&atilde;o											
											</td>
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="80" value="<?php echo $agenda->getCampo("pacnome");?>" />
											</td>
                                        </tr>
										<?php echo $comboExame;?>
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
											<th width="20%">Observa&ccedil;&atilde;o</th>
											<td width="80%">
											<textarea name="obs" id="obs" rows="3" cols="60"><?php echo $agenda->getCampo("obs");?></textarea>
											</td>
											</td>
										</tr>										
									</table>	
                                </div>
                                <div class="barraBotoes">
									<input type="button" value=" Marcar Consulta " id="botao" name="botao" onClick="validar('<?php echo $pergunta;?>');" />
                                    <input type="button" value=" Limpar " id="btnLimpar" name="btnLimpar" onClick="limpar();" />									
                                    <input type="button" value=" Fechar " id="btnFechar" name="btnFechar" onClick="window.close();" />
                                </div>
                            </form>
							
</body>
</html>
