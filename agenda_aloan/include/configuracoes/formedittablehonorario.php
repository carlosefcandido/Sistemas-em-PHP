<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
					$tabela = new classDTO();
					$tabelahonorario = new classDTO();
					$tabela = carregarObjeto($_GET);
					$tabelaDAO = new classTabelaDAO();
					if($tabela->getCampo("tabprocedimento") != NULL){
						$tabelahonorario = $tabelaDAO->buscarHonorario($tabela);
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
					
					//combo especialidades
					$especialidadeDAO = new classEspecialidadeDAO();
					$especialidades = $especialidadeDAO->listar();	
					$comboespecialidade = '<select name="especialidade" id="especialidade">';
					$comboespecialidade.= '<option></option>';					
					if($especialidades){
						foreach($especialidades as $especialidade){
							if($tabelahonorario->getCampo("tabhonespecie") == $especialidade->getCampo("espid")){
								$comboespecialidade.= '<option value="'.$especialidade->getCampo("espid").'" selected>'.$especialidade->getCampo("espnome").'</option>';
							}else{
								$comboespecialidade.= '<option value="'.$especialidade->getCampo("espid").'">'.$especialidade->getCampo("espnome").'</option>';
							}
						}
					}
					$comboespecialidade.= '</select>';

					if($tabelahonorario->getCampo("tabhonsexo") == 'A'){ 
						$sexoAmbos = "checked";
					}else if($tabelahonorario->getCampo("tabhonsexo") == 'M'){ 
						$sexoMasculino = "checked";
					}else if($tabelahonorario->getCampo("tabhonsexo") == 'F'){ 
						$sexoFeminino = "checked";
					}
					
					if($tabelahonorario->getCampo("tabhondoppler") == 1){ 
						$dopler = "checked";
					}
					
					if($tabelahonorario->getCampo("tabhoneco") == 1){ 
						$eco = "checked";
					}
					
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Tabela</th>
									<td width="80%">'.$combotabela.'					
									</td>
								</tr>		
                                <tr>
                                    <th width="20%">Procedimento</th>
                                    <td width="80%">
										<input type="text" name="procedimento" id="procedimento" value="'.$tabelahonorario->getCampo("tabhonnome").'" size="70" OnKeyUp="caixaAlta(this);" />
									</td>
                                </tr>
                                <tr>
                                    <th width="20%">Sexo</th>
                                    <td width="80%">
										<input type="radio" name="sexo" id="sexo" value="A" '.$sexoAmbos.' />Ambos &nbsp;&nbsp;&nbsp;
										<input type="radio" name="sexo" id="sexo" value="M" '.$sexoMasculino.' />Masculino &nbsp;&nbsp;&nbsp;
    									<input type="radio" name="sexo" id="sexo" value="F" '.$sexoFeminino.' />Feminino
									</td>
                                </tr>
                                <tr>
                                    <th width="20%">Mneum&ocirc;nico</th>
                                    <td width="80%">
										<input type="text" name="mneumonico" id="mneumonico" value="'.$tabelahonorario->getCampo("tabhonmneumonico").'" size="20" OnKeyUp="caixaAlta(this);" />
									</td>
                                </tr>
                                <tr>
                                    <th width="20%">Especialidade</th>
                                    <td width="80%">
										'.$comboespecialidade.'
									</td>
                                </tr>								
								<tr>
									<th width="20%">Refer&ecirc;ncia</th>
									<td width="80%">
									<input type="text" name="referencia" id="referencia" value="'.$tabelahonorario->getCampo("tabhonreferencia").'" size="10" onkeyup="maskIt(this,event,\'##########\')" />
									</td>
								</tr>
								<tr>
									<th width="20%">Porte</th>
									<td width="80%">
									<input type="text" name="porte" id="porte" value="'.$tabelahonorario->getCampo("tabhonporte").'" size="5" />
									</td>
								</tr>
								<tr>
									<th width="20%">Auxiliares</th>
									<td width="80%">
									<input type="text" name="auxiliares" id="auxiliares" value="'.$tabelahonorario->getCampo("tabhonaux").'" size="5" />
									</td>
								</tr>
								<tr>
									<th width="20%">Incid&ecirc;ncia</th>
									<td width="80%">
									<input type="text" name="incidencia" id="incidencia" value="'.$tabelahonorario->getCampo("tabhonincidencia").'" size="5" />
									</td>
								</tr>
								<tr>
									<th width="20%">Filme m&#178;</th>
									<td width="80%">
									<input type="text" name="filme" id="filme" value="'.$tabelahonorario->getCampo("tabhonfilme").'" size="5" onKeyPress="return(MascaraMoeda(this,\'\',\'.\',event))" />
									</td>
								</tr>								
								<tr>
									<th width="20%">Valor</th>
									<td width="80%">
									<input type="text" name="valor" id="valor" value="'.$tabelahonorario->getCampo("tabhonvalor").'" size="5" onKeyPress="return(MascaraMoeda(this,\'\',\'.\',event))" />
									<input type="hidden" name="tabid" id="tabid" value="'.$tabelahonorario->getCampo("tabhonid").'" />
									</td>
								</tr>
                                <tr>
                                    <th width="20%">Exame</th>
                                    <td width="80%">
										Doppler <input type="checkbox" name="dopler" id="dopler" value="1" '.$dopler.' /> &nbsp;&nbsp;&nbsp;
										Eco <input type="checkbox" name="eco" id="eco" value="1" '.$eco.' /> &nbsp;&nbsp;&nbsp;
									</td>
                                </tr>								
							</table>';
					$dados.= '<div class="barraBotoes">';

					if($tabela->getCampo("botaoalterar") == 'sim'){
                         $dados.= '<input type="button" value=" Alterar " id="botao" onclick="AlterarValoresTabelaUpdate(\'Confirma a alteração do procedimento?\',1);"  />';
					}else{
						$dados.= '<input type="button" value=" Incluir " id="botao" onclick="AlterarValoresTabelaHonorario(\'Confirma a inclusão do procedimento?\');"  />';
					}
					
                    $dados.= '</div>';		
							  
					$dados.= '<table class="tabelaVertical">';
					$dados.= '<tr>
								<th width="30%">Procedimento</th>
								<th width="10%">Valor</th>								
								<th width="10%">Porte</th>								
								<th width="10%">Auxiliares</th>								
								<th width="10%">Filme m&#178;</th>								
								<th width="10%">Refer&ecirc;ncia</th>
								<th width="10%">Mneum&ocirc;nico</th>	
								<th width="10%">A&ccedil;&otilde;es</th>									
							  </tr>';

					$honorarios = $tabelaDAO->listarProcedimentosHonorarios($tabela);	
					if($honorarios){
						foreach($honorarios as $honorario){
							$dados.= '<tr>
										<td width="30%">'.$honorario->getCampo("tabhonnome").'</td>
										<td width="10%">'.$honorario->getCampo("tabhonvalor").'</td>								
										<td width="10%">'.$honorario->getCampo("tabhonporte").'</td>
										<td width="10%">'.$honorario->getCampo("tabhonaux").'</td>
										<td width="10%">'.$honorario->getCampo("tabhonfilme").'</td>
										<td width="10%">'.$honorario->getCampo("tabhonreferencia").'</td>
										<td width="10%">'.$honorario->getCampo("tabhonmneumonico").'</td>
										<td width="10%"><center><a href="javascript:alterarProcedimento('.$honorario->getCampo("tabhonid").','.$tabela->getCampo("tabnomid").');" title="Alterar procedimento"><img src="../imagens/edit.png" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:excluirProcedimento('.$honorario->getCampo("tabhonid").','.$tabela->getCampo("tabnomid").',\'Honorario\');" title="Excluir procedimento"><img src="../imagens/cancel.png" border="0"></a></center></td>
									  </tr>';							
						}
					}else{
						$dados.= '<tr>
									<td colspan="6"><font color="red">Nenhum procedimento foi encontrado para a tabela selecionada.</font></td>
								  </tr>';
					}
					$dados.= '</table>';
					echo $dados;	
?>
