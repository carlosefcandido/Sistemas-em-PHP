<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$medicoDAO = new classMedicoDAO();
	$medicos = $medicoDAO->listar();
	$comboMedicos = '<select name="medico" id="medico" onChange="filtrarAgenda(this.value);">';
	$comboMedicos.= "<option></option>";	
	if($medicos){
		foreach($medicos as $medico){
			$comboMedicos.= "<option value='".$medico->getCampo("medid")."'>".$medico->getCampo("mednome")."</option>";		
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

	$calendario = new classCalendario();	

?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="addmedico" />
							
                                <div class="cabecForm">Marcar consulta</div>
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
									<div id="agendaBD" style="display:block"><?php echo $calendario->cria(date('d/m/Y'),'');?></div>								
									<div id="horarioBD" style="display:block"></div>								
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
