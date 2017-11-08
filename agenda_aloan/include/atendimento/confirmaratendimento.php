<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$medicoDAO = new classMedicoDAO();
	$medicos = $medicoDAO->listar();
	$data = date("d/m/Y");
	$comboMedicos = "<select name='medico' id='medico' onChange=confirmarAtendimento(this.value,'".$data."');>";
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
							
                                <div class="cabecForm">Confirmar atendimento</div>
                                <div class="corpoForm">
									<table class="tabelaHorizontal">
										<tr>
											<th width="20%">M&eacute;dico</th>
											<td width="80%"><?php echo $comboMedicos;?></td>
										</tr>
									</table>
									<div id="agendaDiaBD" style="display:block"></div>								
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
