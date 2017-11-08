<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
					$tabela = new classDTO();
					$tabelamaterial = new classDTO();
					$tabela = carregarObjeto($_GET);
					$tabelaDAO = new classTabelaDAO();
					if($tabela->getCampo("tabprocedimento") != NULL){
						$tabelamaterial = $tabelaDAO->buscarMaterial($tabela);
					}
					$tabelas = $tabelaDAO->listar($tabela);	
					$combotabela = '<select name="tabnomid" id="tabnomid" onChange="buscarProcedimentos(this.value);" >';
					$combotabela.= '<option></option>';					
					if($tabelas){
						foreach($tabelas as $table){
							if($tabela->getCampo("tabnomid") == $table->getCampo("tabnomid")){
								$combotabela.= '<option value="'.$table->getCampo("tabnomid").'" selected>'.$table->getCampo("tabnomnome").'</option>';
							}else{
								$combotabela.= '<option value="'.$table->getCampo("tabnomid").'">'.$table->getCampo("tabnomnome").'</option>';
							}
						}
					}
					$combotabela.= '</select>';
					
					//combo laboratórios
					$laboratorios = $tabelaDAO->listarLaboratorios();	
					$combolaboratorio = '<select name="laboratorio" id="laboratorio">';
					$combolaboratorio.= '<option></option>';					
					if($laboratorios){
						foreach($laboratorios as $laboratorio){
							if($tabelamaterial->getCampo("tabmedprelabo") == $laboratorio->getCampo("labid")){
								$combolaboratorio.= '<option value="'.$laboratorio->getCampo("labid").'" selected>'.$laboratorio->getCampo("labnome").'</option>';
							}else{
								$combolaboratorio.= '<option value="'.$laboratorio->getCampo("labid").'">'.$laboratorio->getCampo("labnome").'</option>';
							}
						}
					}
					$combolaboratorio.= '</select>';

					//combo substancia
					$substancias = $tabelaDAO->listarSubstancias();	
					$combosubstancia = '<select name="substancia" id="substancia">';
					$combosubstancia.= '<option></option>';					
					if($substancias){
						foreach($substancias as $substancia){
							if($tabela->getCampo("substancia") == $substancia->getCampo("subid")){
								$combosubstancia.= '<option value="'.$substancia->getCampo("subid").'" selected>'.$substancia->getCampo("subnome").'</option>';
							}else{
								$combosubstancia.= '<option value="'.$substancia->getCampo("subid").'">'.$substancia->getCampo("subnome").'</option>';
							}
						}
					}
					$combosubstancia.= '</select>';	

					//combo nome comercial
					$combonomecomercial = '<select name="nomecomercial" id="nomecomercial">';
					$combonomecomercial.= '<option></option>';					
					$combonomecomercial.= '</select>';	
					
					//combo apresentacao
					$comboapresentacao = '<select name="apresentacao" id="apresentacao">';
					$comboapresentacao.= '<option></option>';					
					$comboapresentacao.= '</select>';	
					
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Tabela</th>
									<td width="80%">'.$combotabela.'					
									</td>
								</tr>		
                                <tr>
                                    <th width="20%">Material</th>
                                    <td width="80%">
										<input type="text" name="material" id="material" value="'.$tabelamaterial->getCampo("tabmatnome").'" size="70" OnKeyUp="caixaAlta(this);" />
									</td>
                                </tr>
								<tr>
									<th width="20%">Refer&ecirc;ncia</th>
									<td width="80%">
									<input type="text" name="referencia" id="referencia" value="'.$tabelamaterial->getCampo("tabmatpremedi").'" size="10" onkeyup="maskIt(this,event,\'##########\')" />
									</td>
								</tr>
								<tr>
									<th width="20%">Valor</th>
									<td width="80%">
									<input type="text" name="valor" id="valor" value="'.$tabelamaterial->getCampo("tabmatvalorultimo").'" size="5" onKeyPress="return(MascaraMoeda(this,\'\',\'.\',event))" />
									<input type="hidden" name="tabid" id="tabid" value="'.$tabelamaterial->getCampo("tabmatid").'" />
									</td>
								</tr>
								<tr>
									<th width="20%">Laborat&oacute;rio</th>
									<td width="80%">
										'.$combolaboratorio.'
									</td>
								</tr>
								<tr>
									<th width="20%">Nome Comercial</th>
									<td width="80%">
										'.$combonomecomercial.'
									</td>
								</tr>
								<tr>
									<th width="20%">Apresenta&ccedil;&atilde;o</th>
									<td width="80%">
										'.$comboapresentacao.'
									</td>
								</tr>
								<tr>
									<th width="20%">Subst&acirc;ncia</th>
									<td width="80%">
										'.$combosubstancia.'
									</td>
								</tr>
								<tr>
									<th width="20%">Solu&ccedil;&atilde;o</th>
									<td width="80%">
										<input type="checkbox" name="solucao" id="solucao" value="" />
									</td>
								</tr>								
							</table>';
					$dados.= '<div class="barraBotoes">';

					if($tabela->getCampo("botaoalterar") == 'sim'){
                         $dados.= '<input type="button" value=" Alterar " id="botao" onclick="AlterarValoresTabelaUpdate(\'Confirma a alteração do material?\',2);"  />';
					}else{
						$dados.= '<input type="button" value=" Incluir " id="botao" onclick="AlterarValoresTabelaMaterial(\'Confirma a inclusão do material?\');"  />';
					}
					
                    $dados.= '</div>';		
							  
					$dados.= '<table class="tabelaVertical">';
					$dados.= '<tr>
								<th width="55%">Material</th>
								<th width="10%">Referência</th>
								<th width="10%">Valor</th>								
								<th width="10%">Data Atualiza&ccedil;&atilde;o</th>
								<th width="15%">A&ccedil;&otilde;es</th>
							  </tr>';

					$materiais = $tabelaDAO->listarProcedimentosMaterial($tabela);	
					if($materiais){
						foreach($materiais as $material){
							$dados.= '<tr>
										<td width="55%">'.$material->getCampo("tabmatnome").'</td>
										<td width="10%">'.$material->getCampo("tabmatpremedi").'</td>								
										<td width="10%">'.$material->getCampo("tabmatvalorultimo").'</td>
										<td width="10%">'.formatarData($material->getCampo("tabmatdataultimo")).'</td>
										<td width="15%"><center><a href="javascript:alterarProcedimento('.$material->getCampo("tabmatid").','.$tabela->getCampo("tabnomid").');" title="Alterar material"><img src="../imagens/edit.png" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:excluirProcedimento('.$material->getCampo("tabmatid").','.$tabela->getCampo("tabnomid").',\'Material\');" title="Excluir material"><img src="../imagens/cancel.png" border="0"></a></center></td>
									  </tr>';							
						}
					}else{
						$dados.= '<tr>
									<td colspan="6"><font color="red">Nenhum material foi encontrado para a tabela selecionada.</font></td>
								  </tr>';
					}
					$dados.= '</table>';
					echo $dados;	
?>
