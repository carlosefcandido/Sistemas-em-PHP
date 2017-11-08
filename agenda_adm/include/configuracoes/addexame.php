<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$exame = new classDTO();
	session_start();
	if ($_SESSION['EXAME']){
		if (!is_array($_SESSION['EXAME'])){
			$exame = $_SESSION['EXAME'];
		}
		unset($_SESSION['EXAME']);
	}
	if($exameAlterado){
		$exame = $exameAlterado;
		$botao = '	<input type="hidden" name="exaid" id="exaid" value="'.$exameAlterado->getCampo("exaid").'" />
					<input type="button" value=" Alterar " id="botao" onclick="adicionarExame(\'Confirma alterar o exame?\');" />';
	}else{
		$botao = '<input type="button" value=" Incluir " id="botao" onclick="adicionarExame(\'Confirma cadastrar o exame?\');" />';	
	}
	
	$dados.= '<div class="corpoForm">
				<table class="tabelaVertical">';
	$dados.= '<tr>
					<th width="40%">Exame</th>
					<th width="50%">Recomenda&ccedil;&atilde;o</th>
					<th width="10%">A&ccedil;&otilde;es</th>
			  </tr>';
	
	$exameDAO = new classExameDAO();
	$exames = $exameDAO->listar();	
	if ($exames){
		foreach($exames as $exa){
			$dados.= '<tr>
						<td width="40%">'.$exa->getCampo("exanome").'</td>
						<td width="50%">'.$exa->getCampo("exarecomendacao").'</td>								
						<td width="10%"><center><a href="javascript:alterarExame('.$exa->getCampo("exaid").');" title="Alterar exame"><img src="../imagens/edit.png" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:excluirExame('.$exa->getCampo("exaid").');" title="Excluir exame"><img src="../imagens/cancel.png" border="0"></a></center></td>
					  </tr>';
		}
	}		
	
	$dados.= "</table>";
	$dados.= "</div>";
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="addexame" />
							<input type="hidden" name="passo" id="passo" value="1" />
							
                                <div class="cabecForm">Exame</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome exame</th>
                                            <td width="80%"><input type="text" name="exanome" id="exanome" size="70" value="<?php echo $exame->getCampo("exanome");?>" maxlength="100" OnKeyUp="caixaAlta(this);" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Recomenda&ccedil;&atilde;o</th>
                                            <td width="80%">
											<textarea name="exarecomendacao" id="exarecomendacao" rows="3" cols="60" OnKeyUp="caixaAlta(this);" ><?php echo $exame->getCampo("exarecomendacao");?></textarea>
											</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <?php echo $botao; ?>
                                </div>
								<div id="exameBD" style="display:block">
									<?php echo $dados; ?>
								</div>	
                                <div class="barraBotoes">
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
								
                            </form>
