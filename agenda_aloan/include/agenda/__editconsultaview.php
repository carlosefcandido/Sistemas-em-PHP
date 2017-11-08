<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);	
	require_once "../../classes/classDTO.php";
	require_once "../../classes/classBD.php";
	require_once "../../classes/classGeneric.php";
	require_once "../../classes/classUnidadeDAO.php";
	require_once "../../classes/classFuncionarioDAO.php";
	
	$paciente = new classDTO();
	session_start();
	if ($_SESSION['PACIENTE']){
		if (!is_array($_SESSION['PACIENTE'])){
			$paciente = $_SESSION['PACIENTE'];
		}
		unset($_SESSION['PACIENTE']);
	}

	
	//buscar unidades
	$unidadeDAO = new classUnidadeDAO();
	$unidades = $unidadeDAO->listar('N');
	$comboUnidades = "<select name='fununidade' id='fununidade' onChange=buscarMedicos(this.value);>";
	$comboUnidades.= "<option value=''>Selecione uma Unidade</option>";
	if(count($unidades) > 0){
		foreach($unidades as $unidade){
			if ($paciente->getCampo("fununidade") == $unidade->getCampo("uniid")){
				$comboUnidades.= "<option value='".$unidade->getCampo("uniid")."' selected>".$unidade->getCampo("uninome")."</option>";
			}else{
				$comboUnidades.= "<option value='".$unidade->getCampo("uniid")."'>".$unidade->getCampo("uninome")."</option>";
			}
		}
	}
	$comboUnidades.= "</select>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
	echo "AQUI ".$_GET['id'];
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="addagenda" id="addagenda" value="nao" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="pacid" id="pacid" value="" />
							<input type="hidden" name="agedata" id="agedata" value="" />
							<input type="hidden" name="agehora" id="agehora" value="" />
                                <div class="cabecForm">Alterar consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Unidade</th>
                                            <td width="80%"><?php echo $comboUnidades; ?><div id="ajaxBD" style="display:block"></div>										
											</td>
                                        </tr>
									</table>	
									<div id="MedicoBD" style="display:block"></div>			
									<div id="EspecialidadeBD" style="display:block"></div>									
									<div id="DataBD" style="display:block"></div>									
									<div id="HorarioBD" style="display:block"></div>																		
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
