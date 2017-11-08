<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$medicos = new classDTO();
	session_start();
	if ($_SESSION['MEDICO']){
		$medicos = $_SESSION['MEDICO'];
		unset($_SESSION['MEDICO']);
	}
	
	if($medicos){
		$seg = 1;
		$ter = 1;
		$qua = 1;
		$qui = 1;
		$sex = 1;
		$sab = 1;
		$dom = 1;	
		foreach($medicos as $medico){
			$horaentrada = explode(":",$medico->getCampo("medhorhorarioentrada"));
			$horasaida = explode(":",$medico->getCampo("medhorhorariosaida"));
			$he = $horaentrada[0];
			$me = $horaentrada[1];
			$hs = $horasaida[0];
			$ms = $horasaida[1];						
			
			if(($medico->getCampo("medhorhorariodiasemana") == 'seg') && ($seg == 1)){
				$entradaseg1 = $he.":".$me;
				$saidaseg1 = $hs.":".$ms;
				$seg = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'seg') && ($seg == 2)){
				$entradaseg2 = $he.":".$me;
				$saidaseg2 = $hs.":".$ms;
				$seg = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'ter') && ($ter == 1)){
				$entradater1 = $he.":".$me;
				$saidater1 = $hs.":".$ms;
				$ter = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'ter') && ($ter == 2)){
				$entradater2 = $he.":".$me;
				$saidater2 = $hs.":".$ms;
				$ter = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'qua') && ($qua == 1)){
				$entradaqua1 = $he.":".$me;
				$saidaqua1 = $hs.":".$ms;
				$qua = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'qua') && ($qua == 2)){
				$entradaqua2 = $he.":".$me;
				$saidaqua2 = $hs.":".$ms;
				$qua = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'qui') && ($qui == 1)){
				$entradaqui1 = $he.":".$me;
				$saidaqui1 = $hs.":".$ms;
				$qui = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'qui') && ($qui == 2)){
				$entradaqui2 = $he.":".$me;
				$saidaqui2 = $hs.":".$ms;
				$qui = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'sex') && ($sex == 1)){
				$entradasex1 = $he.":".$me;
				$saidasex1 = $hs.":".$ms;
				$sex = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'sex') && ($sex == 2)){
				$entradasex2 = $he.":".$me;
				$saidasex2 = $hs.":".$ms;
				$sex = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'sab') && ($sab == 1)){
				$entradasab1 = $he.":".$me;
				$saidasab1 = $hs.":".$ms;
				$sab = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'sab') && ($sab == 2)){
				$entradasab2 = $he.":".$me;
				$saidasab2 = $hs.":".$ms;
				$sab = 3;
			}
			else if(($medico->getCampo("medhorhorariodiasemana") == 'dom') && ($dom == 1)){
				$entradadom1 = $he.":".$me;
				$saidadom1 = $hs.":".$ms;
				$dom = 2;
			}else if (($medico->getCampo("medhorhorariodiasemana") == 'dom') && ($dom == 2)){
				$entradadom2 = $he.":".$me;
				$saidadom2 = $hs.":".$ms;
				$dom = 3;
			}					
		}
		$horarios = '<table class="tabelaHorizontal">
						<tr>
                            <th width="20%">Segunda-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaseg1" id="entradaseg1" size="5" maxlength="5" value="'.$entradaseg1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaseg1" id="saidaseg1" size="5" maxlength="5" value="'.$saidaseg1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaseg2" id="entradaseg2" size="5" maxlength="5" value="'.$entradaseg2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaseg2" id="saidaseg2" size="5" maxlength="5" value="'.$saidaseg2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>
                         </tr>
                         <tr>
                            <th width="20%">Ter&ccedil;a-feira</th>
                             <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradater1" id="entradater1" size="5" maxlength="5" value="'.$entradater1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidater1" id="saidater1" size="5" maxlength="5" value="'.$saidater1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradater2" id="entradater2" size="5" maxlength="5" value="'.$entradater2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidater2" id="saidater2" size="5" maxlength="5" value="'.$saidater2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>		
                        </tr>
                        <tr>
                            <th width="20%">Quarta-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaqua1" id="entradaqua1" size="5" maxlength="5" value="'.$entradaqua1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqua1" id="saidaqua1" size="5" maxlength="5" value="'.$saidaqua1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaqua2" id="entradaqua2" size="5" maxlength="5" value="'.$entradaqua2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqua2" id="saidaqua2" size="5" maxlength="5" value="'.$saidaqua2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>	
						</tr>
                        <tr>
							<th width="20%">Quinta-feira</th>
							<td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaqui1" id="entradaqui1" size="5" maxlength="5" value="'.$entradaqui1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqui1" id="saidaqui1" size="5" maxlength="5" value="'.$saidaqui1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaqui2" id="entradaqui2" size="5" maxlength="5" value="'.$entradaqui2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqui2" id="saidaqui2" size="5" maxlength="5" value="'.$saidaqui2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>				
						</tr>	
                        <tr>
							<th width="20%">Sexta-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradasex1" id="entradasex1" size="5" maxlength="5" value="'.$entradasex1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasex1" id="saidasex1" size="5" maxlength="5" value="'.$saidasex1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradasex2" id="entradasex2" size="5" maxlength="5" value="'.$entradasex2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasex2" id="saidasex2" size="5" maxlength="5" value="'.$saidasex2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>	
						</tr>
                        <tr>
							<th width="20%">S&aacute;bado</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradasab1" id="entradasab1" size="5" maxlength="5" value="'.$entradasab1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasab1" id="saidasab1" size="5" maxlength="5" value="'.$saidasab1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradasab2" id="entradasab2" size="5" maxlength="5" value="'.$entradasab2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasab2" id="saidasab2" size="5" maxlength="5" value="'.$saidasab2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>		
						</tr>
                        <tr>
							<th width="20%">Domingo</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradadom1" id="entradadom1" size="5" maxlength="5" value="'.$entradadom1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidadom1" id="saidadom1" size="5" maxlength="5" value="'.$saidadom1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradadom2" id="entradadom2" size="5" maxlength="5" value="'.$entradadom2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidadom2" id="saidadom2" size="5" maxlength="5" value="'.$saidadom2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>
						</tr></table>';
		
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
							<input type="hidden" name="acao" id="acao" value="horariomedico" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="medid" id="medid" value="<?php echo $medicos[0]->getCampo("medid");?>" />
                                <div class="cabecForm">Hor&aacute;rio m&eacute;dico</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" size="70" maxlength="100" value="<?php echo $medicos[0]->getCampo("mednome");?>" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Intervalo consulta</th>
                                            <td width="80%"><input type="text" name="medintervaloconsulta" id="medintervaloconsulta" size="5" maxlength="3" value="<?php echo $medicos[0]->getCampo("medintervaloconsulta");?>" onkeyup="maskIt(this,event,'###')" />min.</td>
                                        </tr>
									</table>
									<?php echo $horarios;?>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="adicionarHorario('Confirma o horário do médico?');"/>
                                    <input type="button" value="Cancelar" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
