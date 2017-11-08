<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	$medicos = new classDTO();
	session_start();
	if ($_SESSION['MEDICO']){
		$medicos = $_SESSION['MEDICO'];
		unset($_SESSION['MEDICO']);
	}

	//buscar Exames
	$exameDAO = new classExameDAO();
	$exames = $exameDAO->listar();
	$comboExames = '<select multiple="multiple" name="modulos" class="campo" id="modulos" style="width:100%; height:130px;" onkeydown="if(event.keyCode==39) adicionaItens(); if(event.keyCode==13) event.keyCode=9;">';
	if($exames){
		foreach($exames as $exame){
			$comboExames.= "<option value='".$exame->getCampo("exaid")."'>".$exame->getCampo("exanome")."</option>";
		}
	}
    $comboExames.= '</select>';
	
	//buscarmedicoexame
	$comboMedicoExame = '<select name="selecionados[]" id="selecionados" multiple="multiple" class="campo" style="width:100%; height:130px;" onkeydown="if(event.keyCode==37) removeItens(); if(event.keyCode==13) event.keyCode=9;">';
	if($medicos){
		foreach($medicos as $medico){
			if($exames){
				foreach($exames as $exame){
					if($exame->getCampo("exaid") == $medico->getCampo("medexaexame")){
						$comboMedicoExame.= "<option value='".$exame->getCampo("exaid")."'>".$exame->getCampo("exanome")."</option>";
					}
				}
			}
		}	
	}
	$comboMedicoExame.= '</select>';
		
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                           <form name="form" id="form" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="medicoexame" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="medid" id="medid" value="<?php echo $medicos[0]->getCampo("medid");?>" />
							
                                <div class="cabecForm">M&eacute;dico x Exame</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" size="70" value="<?php echo $medicos[0]->getCampo("mednome");?>" maxlength="100" readonly /></td>
                                        </tr>
                                    </table>
									<table class="tabelaVertical">
										<tr>
											<th width="45%">Exames</th>
											<th width="5%">&nbsp;</th>
											<th width="45%">M&eacute;dico x Exame</th>
										</tr>
										<tr>
											<td width="45%"><?php echo $comboExames;?></td>
											<td width="5%">
											    <input type="button" name="btnDireita" id="btnDireita" value=">>" onclick="adicionaItens()" class="botao" /><br/><br/>
												<input type="button" name="btnEsquerda" id="btnEsquerda" value="<<" onclick="removeItens()" class="botao" />	
											</td>
											<td width="45%"><?php echo $comboMedicoExame;?></td>
										</tr>
									</table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="adicionarMedicoExame('Confirma a atualização?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
