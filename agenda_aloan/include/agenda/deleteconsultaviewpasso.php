<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$consulta = new classDTO();
	session_start();
	if ($_SESSION['CONSULTA']){
		if (!is_array($_SESSION['CONSULTA'])){
			$consulta = $_SESSION['CONSULTA'];
		}
		unset($_SESSION['CONSULTA']);
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
							<input type="hidden" name="acao" id="acao" value="deleteconsulta" />
							<input type="hidden" name="passo" value="3" />
							<input type="hidden" name="marid" id="marid" value="<?php echo $consulta->getCampo("marid");?>" />
							
                                <div class="cabecForm">Excluir consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Data</th>
                                            <td width="80%"><input type="text" name="data" id="data" size="10" value="<?php echo $consulta->getCampo("agedata");?>" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Hora</th>
                                            <td width="80%"><input type="text" name="hora" id="hora" size="10" value="<?php echo $consulta->getCampo("agehora");?>" readonly /></td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacnome" id="pacnome" size="80" value="<?php echo $consulta->getCampo("pacnome");?>" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="pactelefone" id="pactelefone" size="15" value="<?php echo $consulta->getCampo("pactelefone");?>" readonly /></td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">M&eacute;dico</th>
                                            <td width="80%"><input type="text" name="mednome" id="mednome" size="80" value="<?php echo $consulta->getCampo("mednome");?>" readonly /></td>
                                        </tr>
										
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Excluir " id="botao" onclick="excluir('confirma excluir a consulta?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
