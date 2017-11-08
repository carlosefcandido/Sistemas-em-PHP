<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$medico = new classDTO();
	session_start();
	if ($_SESSION['MEDICO']){
		$medico = $_SESSION['MEDICO'];
		unset($_SESSION['MEDICO']);
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
							<input type="hidden" name="acao" id="acao" value="bloquearhorariomedico" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="medid" id="medid" value="<?php echo $medico->getCampo("medid");?>" />
                                <div class="cabecForm">Bloquear Hor&aacute;rio m&eacute;dico</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" size="70" maxlength="100" value="<?php echo $medico->getCampo("mednome");?>" readonly /></td>
                                        </tr>
										<tr>	
											<th width="20%">Per&iacute;odo</th>
											<td width="80%">
											In&iacute;cio <input type="text" name="medhorblodata" id="medhorblodata" size="10" value="<?php echo $medico->getCampo("medhorblodata")?>" maxlength="10" onclick="displayCalendar(document.formulario.medhorblodata,'dd/mm/yyyy',this)" />
											&nbsp;&nbsp;&nbsp;
											Fim <input type="text" name="medhorblodatafim" id="medhorblodatafim" size="10" value="<?php echo $medico->getCampo("medhorblodatafim")?>" maxlength="10" onclick="displayCalendar(document.formulario.medhorblodatafim,'dd/mm/yyyy',this)" />
											</td>
										</tr>
										<tr>	
											<th width="20%">Hor&aacute;rio</th>
											<td width="80%">
											In&iacute;cio <input type="text" name="medhorbloentrada" id="medhorbloentrada" size="5" maxlength="5" value="<?php echo $medico->getCampo("medhorbloentrada")?>" onkeyup="maskIt(this,event,'##:##')" />
											&nbsp;&nbsp;&nbsp;
											Fim <input type="text" name="medhorblosaida" id="medhorblosaida" size="5" maxlength="5" value="<?php echo $medico->getCampo("medhorblosaida")?>" onkeyup="maskIt(this,event,'##:##')" />
											</td>
										</tr>
									</table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="bloquearHorario('Confirma o bloqueio de horário do médico?');"/>
                                    <input type="button" value="Cancelar" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
