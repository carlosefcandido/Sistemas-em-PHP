<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	$plano = new classDTO();
	session_start();
	if ($_SESSION['PLANO']){
		$plano = $_SESSION['PLANO'];
		unset($_SESSION['PLANO']);
	}
							
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
							<input type="hidden" name="conid" id="conid" value="<?php echo $plano->getCampo("conid");?>" />
							
                                <div class="cabecForm">Conv&ecirc;nio</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Conv&ecirc;nio</th>
                                            <td width="80%"><input type="text" name="connome" id="connome" size="70" value="<?php echo $plano->getCampo("connome");?>" maxlength="100" readonly /></td>
                                        </tr>
										<tr>
											<th width="20%">Qtde m&iacute;nima dias retorno</th>
											<td width="80%"><input type="text" name="conminimodiaretorno" id="conminimodiaretorno" size="5" maxlength="3" onkeyup="maskIt(this,event,\'###\')" value="<?php echo $plano->getCampo("conminimodiaretorno");?>" /></td>
										</tr>
										<tr>
											<th width="20%">Qtde m&aacute;xima de atendimento</th>
											<td width="80%"><input type="text" name="conmaximoatendimento" id="conmaximoatendimento" size="5" maxlength="3" onkeyup="maskIt(this,event,\'###\')" value="<?php echo $plano->getCampo("conmaximoatendimento");?>" /></td>
										</tr>
										
									</table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="excluir('Confirma a atualização?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
