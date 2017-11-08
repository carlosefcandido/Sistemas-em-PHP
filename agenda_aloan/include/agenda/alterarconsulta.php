<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);

	$CONSULTA = new classDTO();
	session_start();
	$CONSULTA = $_SESSION['CONSULTA'];	
	$_SESSION['IDAGENDA'] = $CONSULTA->getCampo("marid");
	unset($_SESSION['CONSULTA']);
	$calendario = new classCalendario();	
	//busca o dia da semana que a data está
	$diadasemana = $calendario->diasemana($CONSULTA->getCampo("agedata"));
	//pega os horários do médico no dia da semana informado
	$medicoDAO = new classMedicoDAO();
	$horariosmedico = array();
	$horariosmedico = $medicoDAO->montarHorariosAtendimento($diadasemana,$CONSULTA->getCampo("medid"),$CONSULTA->getCampo("agedata"));
	
	
	$medicos = $medicoDAO->listar();
	$comboMedicos = '<select name="medico" id="medico" onChange="filtrarAgenda(this.value);">';
	$comboMedicos.= "<option></option>";	
	if($medicos){
		foreach($medicos as $medico){
			if($CONSULTA->getCampo("medid") == $medico->getCampo("medid")){
				$comboMedicos.= "<option value='".$medico->getCampo("medid")."' selected>".$medico->getCampo("mednome")."</option>";		
			}else{
				$comboMedicos.= "<option value='".$medico->getCampo("medid")."'>".$medico->getCampo("mednome")."</option>";		
			}
		}
	}
	$comboMedicos.= "</select>";
		
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}

?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="addmedico" />
							
                                <div class="cabecForm">Alterar consulta</div>
                                <div class="corpoForm">
									<table class="tabelaHorizontal">
										<tr>
											<th width="20%">Tipo Marca&ccedil;&atilde;o</th>
											<td width="80%">
												<select name="tipomarcacao" id="tipomarcacao">
													<option value="C">Consulta</option>
													<option value="E">Exame</option>
												</select>	
											</td>
										</tr>
										<tr>
											<th width="20%">M&eacute;dico</th>
											<td width="80%"><?php echo $comboMedicos;?></td>
										</tr>
									</table>
									<div id="agendaBD" style="display:block"><?php echo $calendario->cria($CONSULTA->getCampo("agedata"),'');?></div>								
									<div id="horarioBD" style="display:block"><?php echo $horariosmedico;?></div>								
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
