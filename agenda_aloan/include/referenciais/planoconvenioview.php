<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	$planos = new classDTO();
	session_start();
	if ($_SESSION['PLANO']){
		$planos = $_SESSION['PLANO'];
		unset($_SESSION['PLANO']);
	}
	
	//planoconvenio
	$comboPlanoConvenio = '<select name="selecionados[]" id="selecionados" multiple="multiple" class="campo" style="width:100%; height:130px;" onClick="carregarPlanoConvenio(this);" >';
	if($planos){
		foreach($planos as $plano){
			$comboPlanoConvenio.= "<option value='".$plano->getCampo("conplaid")."'>".$plano->getCampo("conplanome")."</option>";
		}
	}
	$comboPlanoConvenio.= '</select>';
		
	$planoconvenioBD = '<table class="tabelaHorizontal">
							<tr>
								<th width="20%">Nome conv&ecirc;nio</th>
								<td width="80%"><input type="text" name="conplanome" id="conplanome" size="80" maxlength="100" OnKeyUp="caixaAlta(this);" /></td>
							</tr>										
							<tr>
								<th width="20%">Qtde m&iacute;nima dias retorno</th>
								<td width="80%"><input type="text" name="conplaminimodiaretorno" id="conplaminimodiaretorno" size="5" maxlength="3" onkeyup="maskIt(this,event,\'###\')" /></td>
							</tr>
							<tr>
								<th width="20%">Qtde m&aacute;xima de atendimento</th>
								<td width="80%"><input type="text" name="conplamaximoatendimento" id="conplamaximoatendimento" size="5" maxlength="3" onkeyup="maskIt(this,event,\'###\')" /></td>
							</tr>
						</table>';
						
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="planoconvenio" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="conid" id="conid" value="<?php echo $planos[0]->getCampo("conid");?>" />
							
                                <div class="cabecForm">Plano de conv&ecirc;nio</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Conv&ecirc;nio</th>
                                            <td width="80%"><input type="text" name="connome" id="connome" size="70" value="<?php echo $planos[0]->getCampo("connome");?>" maxlength="100" readonly /></td>
                                        </tr>
										<tr>
											<th width="20%">Plano de Conv&ecirc;nio</th>
											<td width="80%"><?php echo $comboPlanoConvenio;?></td>
										</tr>
									</table>
										<div id="planoconvenioBD" style="display:block"><?php echo $planoconvenioBD;?></div>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="adicionarPlanoConvenio('Confirma a atualização?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
