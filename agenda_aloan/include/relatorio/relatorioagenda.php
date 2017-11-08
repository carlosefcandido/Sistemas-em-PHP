<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
		
	//buscar médicos
	$medicoDAO = new classMedicoDAO();
	$medicos = $medicoDAO->listar();
	$comboMedicos = "<select name='medico' id='medico'>";
	$comboMedicos.= "<option value=''>Todos</option>";
	if(count($medicos) > 0){
		foreach($medicos as $medico){
			$comboMedicos.= "<option value='".$medico->getCampo("medid")."'>".$medico->getCampo("mednome")."</option>";
		}
	}
	$comboMedicos.= "</select>";

	//buscar especialidade
	$especialidadeDAO = new classEspecialidadeDAO();
	$especialidades = $especialidadeDAO->listar('N');
	$comboEspecialidades = "<select name='especialidade' id='especialidade'>";
	$comboEspecialidades.= "<option value=''>Todas</option>";
	if(count($especialidades) > 0){
		foreach($especialidades as $especialidade){
			$comboEspecialidades.= "<option value='".$especialidade->getCampo("espid")."'>".$especialidade->getCampo("espnome")."</option>";
		}
	}
	$comboEspecialidades.= "</select>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}

?>
                            <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="relatorioagenda" />
                                <div class="cabecForm">Relat&oacute;rio da agenda</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><?php echo $comboMedicos;?></td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Especialidade</th>
                                            <td width="80%"><?php echo $comboEspecialidades;?></td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Per&iacute;odo</th>
                                            <td width="80%">
											Data in&iacute;cio<input type="text" name="dataini" id="dataini" size="10" value="" maxlength="10" onclick="displayCalendar(document.formulario.dataini,'dd/mm/yyyy',this)" />
											Data fim<input type="text" name="datafim" id="datafim" size="10" value="" maxlength="10" onclick="displayCalendar(document.formulario.datafim,'dd/mm/yyyy',this)" />
											</td>
                                        </tr>										
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Gerar " id="botao" onclick="gerarRelatorioAgenda();"/>
                                    <input type="button" value="Cancelar" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
