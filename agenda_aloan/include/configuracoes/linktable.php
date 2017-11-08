<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$PlanoDAO = new classPlanoDAO();
	$planos = $PlanoDAO->listar();	
	$comboplano = '<select name="plano" id="plano" onChange="buscarTabelasPlano(this.value);" >';
	$comboplano.= '<option></option>';
	
	if ($planos){
		foreach($planos as $plano){
			$comboplano.= '<option value="'.$plano->getCampo("conid").'">'.$plano->getCampo("connome").'</option>';
		}
	}	
	$comboplano.= '</select>';
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}

?>
						   <form name="formulario" id="formulario" action="" method="post">
						   <input type="hidden" name="acao" id="acao" value="linktable" />
						   <input type="hidden" name="passo" id="passo" value="1" />
                                <div class="cabecForm">Conv&ecirc;nio x Tabelas</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Conv&ecirc;nio</th>
                                            <td width="80%"><?php echo $comboplano;?></td>
                                        </tr>									
     
									</table>
									<div id="tabelasBD" style="display:block"></div>								
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Atualizar " id="botao" onclick="AtualizarTabelaConvenio('Confirma a atualização?');" />								
                                    <input type="button" value=" Cancelar " id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
								</form>						
						
