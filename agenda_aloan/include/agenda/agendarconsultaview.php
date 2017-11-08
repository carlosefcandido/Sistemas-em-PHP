<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);	
	
	$paciente = new classDTO();
	session_start();
	if ($_SESSION['PACIENTE']){
		if (!is_array($_SESSION['PACIENTE'])){
			$paciente = $_SESSION['PACIENTE'];
		}
		unset($_SESSION['PACIENTE']);
	}

	$planoDAO = new classPlanoDAO();
	$planos = $planoDAO->listar();	
	if ($planos){
		$comboplano = '<select name="pacplano" id="pacplano">';
		$comboplano.= '<option></option>';
		foreach($planos as $plano){
			if ($paciente->getCampo("pacplano") == $plano->getCampo("plaid")){
				$comboplano.= '<option value="'.$plano->getCampo("plaid").'" selected>'.$plano->getCampo("planome").'</option>';
			}else{
				$comboplano.= '<option value="'.$plano->getCampo("plaid").'">'.$plano->getCampo("planome").'</option>';
			}
		}
		$comboplano.= '</select>';
	}		
	
	if ($paciente->getCampo("estid") != ''){
		//buscar cidades
		$cidades = array();
		$cidadeDAO = new classCidadeDAO();
		$cidades = $cidadeDAO->buscar($paciente->getCampo("estid"));
		$comboCidade = "<select name='paccidade' id='paccidade'>";
		$comboCidade.= "<option value=''>Selecione uma Cidade</option>";
		if (count($cidades > 0)){
			foreach($cidades as $cidade){
				if ($paciente->getCampo("paccidade") == $cidade->getCampo("cidid")){
					$comboCidade.= "<option value='".$cidade->getCampo("cidid")."' selected>".$cidade->getCampo("cidnome")."</option>";
				}else{
					$comboCidade.= "<option value='".$cidade->getCampo("cidid")."'>".$cidade->getCampo("cidnome")."</option>";
				}
			}
		}
		$comboCidade.= "</select>";
	}else{	
		//buscar cidades
		$comboCidade = "<select name='paccidade' id='paccidade' disabled>";
		$comboCidade.= "<option value=''>Selecione um Estado</option>";
		$comboCidade.= "</select>";
	}

	//buscar estados
	$estadoDAO = new classEstadoDAO();
	$estados = $estadoDAO->listar();
	$comboEstado = "<select name='estid' id='estid' onChange=buscarCidade('buscarcidade',this.value,'paccidade');>";
	$comboEstado.= "<option value=''>Selecione um Estado</option>";
	foreach($estados as $estado){
		if ($paciente->getCampo("estid") == $estado->getCampo("estid")){
			$comboEstado.= "<option value='".$estado->getCampo("estid")."' selected>".$estado->getCampo("estuf")."</option>";
		}else{
			$comboEstado.= "<option value='".$estado->getCampo("estid")."'>".$estado->getCampo("estuf")."</option>";
		}
	}
	$comboEstado.= "</select>";
	
	//buscar unidades
	$unidadeDAO = new classUnidadeDAO();
	$unidades = $unidadeDAO->listar('N');
	$comboUnidades = "<select name='fununidade' id='fununidade' onChange=buscarMedicos(this.value);>";
	$comboUnidades.= "<option value=''>Selecione uma Unidade</option>";
	if(count($unidades) > 0){
		foreach($unidades as $unidade){
			if ($paciente->getCampo("fununidade") == $unidade->getCampo("uniid")){
				$comboUnidades.= "<option value='".$unidade->getCampo("uniid")."' selected>".$unidade->getCampo("uninome")."</option>";
			}else{
				$comboUnidades.= "<option value='".$unidade->getCampo("uniid")."'>".$unidade->getCampo("uninome")."</option>";
			}
		}
	}
	$comboUnidades.= "</select>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="pacid" id="pacid" value="<?php echo $paciente->getCampo("pacid");?>" />
							<input type="hidden" name="agedata" id="agedata" value="" />
							<input type="hidden" name="agehora" id="agehora" value="" />
							<input type="hidden" name="addagenda" id="addagenda" value="sim" />
                                <div class="cabecForm">Marcar consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="70" value="<?php echo $paciente->getCampo("pacnome");?>" maxlength="100" OnKeyUp="caixaAlta(this);" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="pactelefone" id="pactelefone" size="15" value="<?php echo $paciente->getCampo("pactelefone");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											&nbsp;Celular <input type="text" name="paccelular" id="paccelular" size="15" value="<?php echo $paciente->getCampo("paccelular");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											</td>
                                        </tr>											
                                        <tr>
                                            <th width="20%">Plano</th>
                                            <td width="80%"><?php echo $comboplano; ?>
											&nbsp;&nbsp; Titular do plano <input type="radio" name="pactitular" id="pactitular" value="S" <?php if($paciente->getCampo("pactitular") == "S"){ echo "checked"; }?>/> SIM &nbsp;&nbsp;<input type="radio" name="pactitular" id="pactitular" value="N" <?php if($paciente->getCampo("pactitular") == "N"){ echo "checked"; }?> /> N&Atilde;O
											&nbsp;&nbsp; N&uacute;mero da carteira <input type="text" name="pacnumerocarteira" id="pacnumerocarteira" value="<?php echo $paciente->getCampo("pacnumerocarteira");?>" onkeyup="maskIt(this,event,'####################')" />
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Unidade</th>
                                            <td width="80%"><?php echo $comboUnidades; ?><div id="ajaxBD" style="display:block"></div>										
											</td>
                                        </tr>
									</table>	
									<div id="MedicoBD" style="display:block"></div>			
									<div id="EspecialidadeBD" style="display:block"></div>									
									<div id="DataBD" style="display:block"></div>									
									<div id="HorarioBD" style="display:block"></div>																		
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
