<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$tabela = new classDTO();
	session_start();
	if ($_SESSION['TABELA']){
		if (!is_array($_SESSION['TABELA'])){
			$tabela = $_SESSION['TABELA'];
		}
		unset($_SESSION['TABELA']);
	}

	$tabelaDAO = new classTabelaDAO();
	$tipos = $tabelaDAO->listarTipos();	
	$combotipo = '<select name="tabnomtipo" id="tabnomtipo" onChange="buscarTabelas(\'edittableview\',this.value);" >';
	$combotipo.= '<option></option>';
	
	if ($tipos){
		foreach($tipos as $tipo){
			if ($tabela->getCampo("tabnomtipo") == $tipo->getCampo("tabtipid")){
				$combotipo.= '<option value="'.$tipo->getCampo("tabtipid").'" selected>'.$tipo->getCampo("tabtipnome").'</option>';
			}else{
				$combotipo.= '<option value="'.$tipo->getCampo("tabtipid").'">'.$tipo->getCampo("tabtipnome").'</option>';
			}
		}
		$combotipo.= '</select>';
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
						   <input type="hidden" name="acao" id="acao" value="edittable" />
						   <input type="hidden" name="passo" id="passo" value="1" />
                                <div class="cabecForm">Alterar valores</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Tipo</th>
                                            <td width="80%"><?php echo $combotipo;?></td>
                                        </tr>									
     
									</table>
									<div id="tabelasBD" style="display:block"></div>								
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
								</form>						
						
