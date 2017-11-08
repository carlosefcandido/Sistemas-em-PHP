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
	$comboestadocivil = montaComboEstadoCivil($pacestadocivil,'pacestadocivil');
	$combonacionalidade = montaComboNacionalidade($pacnacionalidade,'pacnacionalidade');	
	
	if ($paciente->getCampo("paccidade") != ''){
		//buscar cidades
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
	$comboEstado = "<select name='pacestado' id='pacestado' onChange=buscarCidade('buscarcidade',this.value,'paccidade');>";
	$comboEstado.= "<option value=''>Selecione um Estado</option>";
	foreach($estados as $estado){
		if ($paciente->getCampo("estid") == $estado->getCampo("estid")){
			$comboEstado.= "<option value='".$estado->getCampo("estid")."' selected>".$estado->getCampo("estuf")."</option>";
		}else{
			$comboEstado.= "<option value='".$estado->getCampo("estid")."'>".$estado->getCampo("estuf")."</option>";
		}
	}
	$comboEstado.= "</select>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="addpaciente" />
							
                                <div class="cabecForm">Cadastrar paciente</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="70" value="<?php echo $paciente->getCampo("pacnome");?>" maxlength="100" OnKeyUp="caixaAlta(this);" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Data de nascimento</th>
                                            <td width="80%"><input type="text" name="pacdatanascimento" id="pacdatanascimento" size="10" value="<?php echo $paciente->getCampo("pacdatanascimento");?>" maxlength="10" onclick="displayCalendar(document.formulario.pacdatanascimento,'dd/mm/yyyy',this)" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Sexo</th>
                                            <td width="80%"><input type="radio" name="pacsexo" id="pacsexo" value="M" <?php if($paciente->getCampo("pacsexo") == "M"){ echo "checked"; }?>/> Masculino &nbsp;&nbsp;<input type="radio" name="pacsexo" id="pacsexo" value="F" <?php if($paciente->getCampo("pacsexo") == 'F'){ echo "checked"; }?>/> Feminino &nbsp; 
											&nbsp;&nbsp;Estado civil <?php echo $comboestadocivil;?>
											</td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Endere&ccedil;o</th>
                                            <td width="80%"><input type="text" name="pacendereco" id="pacendereco" size="70" value="<?php echo $paciente->getCampo("pacendereco");?>" maxlength="150" OnKeyUp="caixaAlta(this);" />
											&nbsp;Número <input type="text" name="pacnumero" id="pacnumero" size="10" value="<?php echo $paciente->getCampo("pacnumero");?>" maxlength="50" onkeyup="maskIt(this,event,'##########')" />
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Complemento</th>
                                            <td width="80%"><input type="text" name="paccomplemento" id="paccomplemento" size="70" value="<?php echo $paciente->getCampo("paccomplemento");?>" maxlength="100" OnKeyUp="caixaAlta(this);" />											
											</td>
                                        </tr>	
                                        <tr>
                                            <th width="20%">CEP</th>
                                            <td width="80%"><input type="text" name="paccep" id="paccep" size="15" value="<?php echo $paciente->getCampo("paccep");?>" maxlength="10" onkeyup="maskIt(this,event,'#####-###')" />
											&nbsp;&nbsp;Bairro <input type="text" name="pacbairro" id="pacbairro" size="40" value="<?php echo $paciente->getCampo("pacbairro");?>" maxlength="100" OnKeyUp="caixaAlta(this);" />										
											</td>
										</tr>
										<tr>
                                            <th width="20%">Estado</th>
                                            <td width="80%"><?php echo $comboEstado; ?></td>
										</tr>
										<tr><th width="20%">Cidade</th>
                                            <td width="80%">
											<div id="cidadeBD" style="display:block">
												<?php echo $comboCidade;?>
											</div>
											</td>
                                        </tr>	
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="pactelefone" id="pactelefone" size="15" value="<?php echo $paciente->getCampo("pactelefone");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											&nbsp;Celular <input type="text" name="paccelular" id="paccelular" size="15" value="<?php echo $paciente->getCampo("paccelular");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											</td>
                                        </tr>											
                                        <tr>
                                            <th width="20%">Identidade</th>
                                            <td width="80%"><input type="text" name="pacidentidade" id="pacidentidade" size="20" value="<?php echo $paciente->getCampo("pacidentidade");?>" maxlength="50" onkeyup="maskIt(this,event,'####################')" />
											&nbsp;Expeditor <input type="text" name="pacexpeditor" id="pacexpeditor" size="15" value="<?php echo $paciente->getCampo("pacexpeditor");?>" maxlength="50" OnKeyUp="caixaAlta(this);" />
											&nbsp;CPF <input type="text" name="paccpf" id="paccpf" size="20" value="<?php echo $paciente->getCampo("paccpf");?>" maxlength="14" onkeyup="maskIt(this,event,'###.###.###-##')" />
											</td>
                                        </tr>	
                                        <tr>
                                            <th width="20%">Naturalidade</th>
                                            <td width="80%"><input type="text" name="pacnaturalidade" id="pacnaturalidade" size="40" value="<?php echo $paciente->getCampo("pacnaturalidade");?>" maxlength="100" OnKeyUp="caixaAlta(this);" />
											&nbsp;Nacionalidade <?php echo $combonacionalidade;?>
											</td>
                                        </tr>	
                                        <tr>
                                            <th width="20%">E-mail</th>
                                            <td width="80%"><input type="text" name="pacemail" id="pacemail" size="60" value="<?php echo $paciente->getCampo("pacemail");?>" maxlength="100" />
											</td>
                                        </tr>											
                                        <tr>
                                            <th width="20%">Plano</th>
                                            <td width="80%"><?php echo $comboplano; ?>
											&nbsp;&nbsp; Titular do plano <input type="radio" name="pactitular" id="pactitular" value="S" <?php if($paciente->getCampo("pactitular") == "S"){ echo "checked"; }?>/> SIM &nbsp;&nbsp;<input type="radio" name="pactitular" id="pactitular" value="N" <?php if(($paciente->getCampo("pactitular") == "N") || ($paciente->getCampo("pactitular") == NULL)){ echo "checked"; }?> /> N&Atilde;O
											&nbsp;&nbsp; N&uacute;mero da carteira <input type="text" name="pacnumerocarteira" id="pacnumerocarteira" value="<?php echo $paciente->getCampo("pacnumerocarteira");?>" onkeyup="maskIt(this,event,'####################')" />
											</td>
                                        </tr>			
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Cadastrar " id="botao" onclick="adicionarPaciente('confirma cadastrar o paciente?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
