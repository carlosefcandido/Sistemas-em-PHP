<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$medico = new classDTO();
	session_start();
	if ($_SESSION['MEDICO']){
		if (!is_array($_SESSION['MEDICO'])){
			$medico = $_SESSION['MEDICO'];
		}
		unset($_SESSION['MEDICO']);
	}

	//buscar estados
	$estadoDAO = new classEstadoDAO();
	$estados = $estadoDAO->listar();
	$comboEstado = "<select name='medufconselho' id='medufconselho' disabled>";
	$comboEstado.= "<option value=''></option>";
	if ($estados){
		foreach($estados as $estado){
			if ($medico->getCampo("medufconselho") == $estado->getCampo("estid")){
				$comboEstado.= "<option value='".$estado->getCampo("estid")."' selected>".$estado->getCampo("estuf")."</option>";
			}else{
				$comboEstado.= "<option value='".$estado->getCampo("estid")."'>".$estado->getCampo("estuf")."</option>";
			}
		}
	}
	$comboEstado.= "</select>";

	//buscar conselhos
	$conselhoDAO = new classConselhoDAO();
	$conselhos = $conselhoDAO->listar();
	$comboConselho = "<select name='medconselhoregional' id='medconselhoregional' disabled>";
	$comboConselho.= "<option value=''></option>";
	if ($conselhos){
		foreach($conselhos as $conselho){
			if ($medico->getCampo("medconselhoregional") == $conselho->getCampo("conseid")){
				$comboConselho.= "<option value='".$conselho->getCampo("conseid")."' selected>".$conselho->getCampo("consesigla")."</option>";
			}else{
				$comboConselho.= "<option value='".$conselho->getCampo("conseid")."'>".$conselho->getCampo("consesigla")."</option>";
			}
		}
	}
	$comboConselho.= "</select>";

	//buscar especialidades
	$especialidadeDAO = new classEspecialidadeDAO();
	$especialidades = $especialidadeDAO->listar();
	$comboEspecialidade = "<select name='medespecialidade' id='medespecialidade' disabled>";
	$comboEspecialidade.= "<option value=''></option>";
	if ($especialidades){
		foreach($especialidades as $especialidade){
			if ($medico->getCampo("medespespecialidade") == $especialidade->getCampo("espid")){
				$comboEspecialidade.= "<option value='".$especialidade->getCampo("espid")."' selected>".$especialidade->getCampo("espnome")."</option>";
			}else{
				$comboEspecialidade.= "<option value='".$especialidade->getCampo("espid")."'>".$especialidade->getCampo("espnome")."</option>";
			}
		}
	}
	$comboEspecialidade.= "</select>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>

                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="deletemedico" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="perfil" id="perfil" value="M" />
							<input type="hidden" name="id" id="id" value="<?php echo $medico->getCampo("medid");?>" />
							<input type="hidden" name="medconselhoregional" id="medconselhoregional" value="<?php echo $medico->getCampo("medconselhoregional");?>" />
							<input type="hidden" name="medufconselho" id="medufconselho" value="<?php echo $medico->getCampo("medufconselho");?>" />
							<input type="hidden" name="medespespecialidade" id="medespespecialidade" value="<?php echo $medico->getCampo("medespespecialidade"); ?>" />
							<input type="hidden" name="usulogin" id="usulogin" value="<?php echo $medico->getCampo("usulogin"); ?>" />
							<input type="hidden" name="ususenha" id="ususenha" value="<?php echo $medico->getCampo("ususenha"); ?>" />
							
                                <div class="cabecForm">Excluir m&eacute;dico</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" size="70" value="<?php echo $medico->getCampo("mednome");?>" maxlength="100" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Sexo</th>
                                            <td width="80%">
											<input type="radio" name="medsexo" id="medsexo" value="M" <?php if(($medico->getCampo("medsexo") == 'M') || ($medico->getCampo("medsexo") == NULL)){ echo "checked";}?> disabled />Masculino
											<input type="radio" name="medsexo" id="medsexo" value="F" <?php if($medico->getCampo("medsexo") == 'F'){ echo "checked";}?> disabled />Feminino									
											</td>
											
                                        </tr>										
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="medtelefone" id="medtelefone" size="15" value="<?php echo $medico->getCampo("medtelefone");?>" maxlength="13" readonly />
											&nbsp;Celular <input type="text" name="medcelular" id="medcelular" size="15" value="<?php echo $medico->getCampo("medcelular");?>" maxlength="13" readonly />
											</td>
                                        </tr>																					
                                        <tr>
                                            <th width="20%">Conselho</th>
                                            <td width="80%">
											<?php echo $comboConselho; ?>
											Número <input type="text" name="medregistro" id="medregistro" size="20" value="<?php echo $medico->getCampo("medregistro");?>" maxlength="12" readonly />
											UF <?php echo $comboEstado; ?>
											
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Especialidade</th>
                                            <td width="80%"><?php echo $comboEspecialidade;?></td>
                                        </tr>			
                                        <tr>
                                            <th width="20%">Aceita encaixe agenda</th>
                                            <td width="80%">
											<input type="radio" name="medencaixe" id="medencaixe" value="S" <?php if(($medico->getCampo("medencaixe") == 'S') || ($medico->getCampo("medencaixe") == NULL)){ echo "checked";}?> disabled />Sim
											<input type="radio" name="medencaixe" id="medencaixe" value="N" <?php if($medico->getCampo("medencaixe") == 'N'){ echo "checked";}?> disabled />N&atilde;o											
											</td>
											
                                        </tr>
                                        <tr>
                                            <th width="20%">Aceita encaixe consulta</th>
                                            <td width="80%">
											<input type="radio" name="medencaixeconsulta" id="medencaixeconsulta" value="S" <?php if(($medico->getCampo("medencaixeconsulta") == 'S') || ($medico->getCampo("medencaixeconsulta") == NULL)){ echo "checked";}?> disabled />Sim
											<input type="radio" name="medencaixeconsulta" id="medencaixeconsulta" value="N" <?php if($medico->getCampo("medencaixeconsulta") == 'N'){ echo "checked";}?> disabled />N&atilde;o											
											</td>
											
                                        </tr>										
                                        <tr>
                                            <th width="20%">Login</th>
                                            <td width="80%"><input type="text" name="login" id="login" size="20" value="<?php echo $medico->getCampo("usulogin");?>" maxlength="10" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Senha</th>
                                            <td width="80%"><input type="password" name="senha" id="senha" size="20" value="<?php echo $medico->getCampo("ususenha");?>" /></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Excluir " id="botao" onclick="excluir('Confirma excluir o médico?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
