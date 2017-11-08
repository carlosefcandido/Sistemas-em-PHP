<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
		
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}

?>
                            <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="agendarconsulta" />
							<input type="hidden" name="passo" id="passo" value="1" />
                                <div class="cabecForm">Agendar consulta</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Paciente</th>
                                            <td width="80%"><input type="text" name="pacid" id="pacid" size="76" onKeyUp="autoCompletePaciente(this);" /></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Continuar " id="botao" onclick="agendarConsultaPasso1();"/>
									<input type="button" value=" Novo Paciente " id="botao" onclick="novoPaciente(formulario.pacnome.value);"/>									
                                    <input type="button" value="Cancelar" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
