<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true); 	
	
	require_once "classes/classBD.php";
	require_once "classes/classGeneric.php";
	require_once "classes/classDTO.php";
	require_once "classes/classUsuarioDAO.php";	
	require_once "classes/classFuncionarioDAO.php";	
	require_once "classes/classEstadoDAO.php";	
	require_once "classes/classConselhoDAO.php";	
	require_once "classes/classEspecialidadeDAO.php";
	require_once "classes/classMedicoDAO.php";	
	require_once "classes/classExameDAO.php";	
	require_once "classes/classPlanoDAO.php";	
	require_once "classes/classAgendaDAO.php";	
	require_once "classes/classPacienteDAO.php";
	require_once "classes/classTabelaDAO.php";	
	require_once "classes/classLaudoDAO.php";	
	require_once "classes/classCalendario.php";	
	require_once "classes/ftp.php";
	require_once "funcoes/funcoes.php";	
	require_once "defines/defineMSG.php";
	require_once "defines/defineSQL.php";
	require_once "fckeditor/fckeditor.php";	
	require_once "fpdf/fpdf.php";
	


	//pega as informações da ação
	$acao = $_GET['acao'];	
	switch($acao)
	{
	
			case "Logar": 		
						//pega as informações do logon
						$usuario = carregarObjeto($_GET);						
						
						//verifica se há informações
						if (!$usuario->getCampo("login")){
							$msg = _MSGERRO_;
							$msg.= " | ";
							$msg.= _MSG3_;
						}else if (!$usuario->getCampo("senha")){
							$msg = _MSGERRO_;
							$msg.= " | ";
							$msg.= _MSG2_;
						}else{
							$usuarioDAO = new classUsuarioDAO();
							$msg = $usuarioDAO->logar($usuario);
						}
						
						echo $msg;					
						break;

			case "alterarmodulo":
					session_start();
					$_SESSION['MODULO'] = $_GET['modulo'];
					break;

			case "addusuario":
					include "include/administracao/addusuario.php";		
					break;

			case "addmedico":
					include "include/administracao/addmedico.php";		
					break;
					
			case "verificadisponibilidadelogin":
					$usuarioDAO = new classUsuarioDAO();
					$usuario = carregarObjeto($_GET);						
					$erro = $usuarioDAO->verifyLogin($usuario);
					if(!$erro){
						echo "OK";
					}else{
						echo "NAO";
					}
					break;
				
			case "editusuario":
					$funcionarioDAO = new classFuncionarioDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['USER'] = $funcionarioDAO->listar();
					}
					include "include/administracao/editusuario.php";		
					break;

			case "editusuarioview":
					include "include/administracao/editusuarioview.php";		
					break;
					
			case "deleteusuario":
					$funcionarioDAO = new classFuncionarioDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['USER'] = $funcionarioDAO->listar();
					}
					include "include/administracao/deleteusuario.php";		
					break;

			case "deleteusuarioview":
					include "include/administracao/deleteusuarioview.php";		
					break;

			case "blockusuario":
					$usuarioDAO = new classUsuarioDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['USER'] = $usuarioDAO->listar();
					}
					include "include/administracao/blockusuario.php";		
					break;

			case "blockusuarioview":
					include "include/administracao/blockusuarioview.php";		
					break;
					
			case "editmedico":
					$medicoDAO = new classMedicoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['MEDICO'] = $medicoDAO->listar();
					}
					include "include/administracao/editmedico.php";		
					break;					
					
			case "editmedicoview":
					include "include/administracao/editmedicoview.php";		
					break;
					
			case "deletemedico":
					$medicoDAO = new classMedicoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['MEDICO'] = $medicoDAO->listar();
					}
					include "include/administracao/deletemedico.php";		
					break;					
					
			case "deletemedicoview":
					include "include/administracao/deletemedicoview.php";		
					break;					
					
			case "especialidadeexame":
					$especialidadeDAO = new classEspecialidadeDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['ESPECIALIDADE'] = $especialidadeDAO->listar();
					}
					include "include/configuracoes/especialidadeexame.php";		
					break;					
					
			case "especialidadeexameview":
					include "include/configuracoes/especialidadeexameview.php";		
					break;					
					
			case "medicoexame":
					$medicoDAO = new classMedicoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['MEDICO'] = $medicoDAO->listar();
					}
					include "include/configuracoes/medicoexame.php";		
					break;					
					
			case "medicoexameview":
					include "include/configuracoes/medicoexameview.php";		
					break;					
					
			case "planoconvenio":
					$planoDAO = new classPlanoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['PLANO'] = $planoDAO->listar();
					}
					include "include/configuracoes/convenio.php";		
					break;

			case "planoconvenioview":
					include "include/configuracoes/convenioview.php";		
					break;					

			case "carregarplanoconvenio":
					$planoDAO = new classPlanoDAO();
					$plano = new classDTO();
					$plano->setCampo("conplaid",$_GET['conplaid']);
					$plano = $planoDAO->buscarConvenioPlano($plano);		
					echo '<input type="hidden" name="conplaid" id="conplaid" value="'.$plano->getCampo("conplaid").'" />
						<table class="tabelaHorizontal">
						<tr>
							<th width="20%">Nome conv&ecirc;nio</th>
							<td width="80%"><input type="text" name="conplanome" id="conplanome" size="80" maxlength="100" value="'.$plano->getCampo("conplanome").'" OnKeyUp="caixaAlta(this);" /></td>
						</tr>										
						<tr>
							<th width="20%">Qtde m&iacute;nima dias retorno</th>
							<td width="80%"><input type="text" name="conplaminimodiaretorno" id="conplaminimodiaretorno" size="5" maxlength="3" value="'.$plano->getCampo("conplaminimodiaretorno").'" onkeyup="maskIt(this,event,\'###\')" /></td>
						</tr>
						<tr>
							<th width="20%">Qtde m&aacute;xima de atendimento</th>
							<td width="80%"><input type="text" name="conplamaximoatendimento" id="conplamaximoatendimento" size="5" maxlength="3" value="'.$plano->getCampo("conplamaximoatendimento").'" onkeyup="maskIt(this,event,\'###\')" /></td>
						</tr>
						</table>';
					break;

			case "horariomedico":
					$medicoDAO = new classMedicoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['MEDICO'] = $medicoDAO->listar();
					}
					include "include/configuracoes/horariomedico.php";		
					break;

			case "horariomedicoview":
					include "include/configuracoes/horariomedicoview.php";		
					break;
					
			case "bloquearhorariomedico":
					$medicoDAO = new classMedicoDAO();
					session_start();
					if (!$_GET['pagina']){
						$_SESSION['MEDICO'] = $medicoDAO->listar();
					}
					include "include/configuracoes/bloquearhorariomedico.php";		
					break;
					
			case "bloquearhorariomedicoview":
					include "include/configuracoes/bloquearhorariomedicoview.php";		
					break;

			case "agendarconsulta":
					include "include/agenda/agendarconsulta.php";		
					break;
					
			case "navegaragenda":
					$calendario = new classCalendario();
					$dadosImpresso = $calendario->cria($_GET['data'],$_GET['medico']);
					echo $dadosImpresso;
					break;

			case "filtraragenda":
					$calendario = new classCalendario();
					$dadosImpresso = $calendario->cria($_GET['data'],$_GET['medico']);
					//echo $dadosImpresso;
					break;			

			case "copy":
					session_start();
					$_SESSION['IDAGENDA'] = $_GET['marid'];	
					echo "Consulta copiada";
					break;
					
			case "paste":
					$agenda = new classDTO();
					$agenda = carregarObjeto($_GET);									
					session_start();
					if(isset($_SESSION['IDAGENDA'])){
						$agenda->setCampo("marid",$_SESSION['IDAGENDA']);
						$agendaDAO = new classAgendaDAO();
						$consulta = $agendaDAO->buscarAgenda($agenda);
						if($agenda->getCampo("acaoBD") == 'sim'){
							$erros = $agendaDAO->atualizar($agenda);
						}else{
							$agendaAntiga = $agendaDAO->buscar($agenda);
							$agendaAntiga->setCampo("agedata",$agenda->getCampo("agedata"));
							$agendaAntiga->setCampo("agehora",$agenda->getCampo("agehora"));
							$agendaAntiga->setCampo("pacid",$agendaAntiga->getCampo("marpaciente"));
							$agendaAntiga->setCampo("medid",$agendaAntiga->getCampo("marmedico"));
							$agendaAntiga->setCampo("agetipomarcacao",$agendaAntiga->getCampo("martipomarcacao"));
							$agendaAntiga->setCampo("pacconvenioplano",$agendaAntiga->getCampo("marconvenioplano"));
							$erros = $agendaDAO->validarMinimoRetorno($agendaAntiga);
							if(!$erros){
								$erros = $agendaDAO->validarMaximoAtendimentoPorPlano($agendaAntiga);
								if(!$erros){
									$erros = $agendaDAO->gravar($agendaAntiga);
								}
							}
						}
						
						if(!$erros){
							echo "OK | Consulta colada.";
						}else{
							$acentos = array('&iacute;' => 'í', '&atilde;' => 'ã', '&oacute;' => 'ó','<br/>' => '','&nbsp;' => ' ','marcar' => 'colar','&aacute;' => 'á');
							$erros = strTr($erros, $acentos);

							echo "ERRO | ".$erros;
						}
						unset($_SESSION['IDAGENDA']);
					}else{
						echo "ERRO | Primeiro copie uma consulta.";
					}
					break;					
				
			case "deletarconsulta":
					$agenda = new classDTO();
					$agenda = carregarObjeto($_GET);	
					$agendaDAO = new classAgendaDAO();
					$erro = $agendaDAO->deletar($agenda);
					echo $erro;
					break;
				
			case "abrirhorarios":
					//busca o dia da semana que a data está
					$calendario = new classCalendario();
					$diadasemana = $calendario->diasemana($_GET['data']);
					//pega os horários do médico no dia da semana informado
					$medicoDAO = new classMedicoDAO();
					$horariosmedico = array();
					$horariosmedico = $medicoDAO->montarHorariosAtendimento($diadasemana,$_GET['medid'],$_GET['data']);
					echo $horariosmedico;
					break;

			case "deleteconsulta":
					echo '<IFRAME name="Delete" src="../include/agenda/deleteconsulta.php" frameBorder="0" width="710" height=400 scrolling=no></IFRAME>';			
					break;

			case "deleteconsultaview":
					include "include/agenda/deleteconsultaview.php";								
					break;

			case "deleteconsultaviewpasso":
					include "include/agenda/deleteconsultaviewpasso.php";								
					break;
					
			case "editconsulta":
					echo '<IFRAME name="Edit" src="../include/agenda/editconsulta.php" frameBorder="0" width="710" height=400 scrolling=no></IFRAME>';			
					break;

			case "editconsultaview":
					include "include/agenda/editconsultaview.php";								
					break;
					
			case "alterarconsulta":
					include "include/agenda/alterarconsulta.php";						
					break; 
					
			case "filtrarpaciente":
					$pacienteDAO = new classPacienteDAO();
					session_start();
					$_SESSION['PACIENTES'] = $pacienteDAO->listar($_GET['nome']);
					$include = "include 'include/".$_GET['caminho']."';";	
					eval($include);
					break;					

			case "atenderpaciente":
					$agendaDAO = new classAgendaDAO();
					session_start();
					$_SESSION['CONSULTAS'] = $agendaDAO->listar($_GET['nome']);
					include "include/atendimento/atenderpaciente.php";						
					break; 

			case "addtable":
					include "include/configuracoes/addtable.php";								
					break;

			case "uploadtable":
					include "include/configuracoes/uploadtable.php";								
					break;
			
			case "uploadtableview":
					$tabela = new classDTO();
					$tabela = carregarObjeto($_GET);
					$tabelaDAO = new classTabelaDAO();
					$tabelas = $tabelaDAO->listar($tabela);	
					$combotabela = '<select name="tabnomid" id="tabnomid">';
					$combotabela.= '<option></option>';					
					if($tabelas){
						foreach($tabelas as $table){
							$combotabela.= '<option value="'.$table->getCampo("tabnomid").'">'.$table->getCampo("tabnomnome").'</option>';
						}
					}
					$combotabela.= '</select>';
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Tabela</th>
									<td width="80%">'.$combotabela.'					
									</td>
								</tr>		
                                <tr>
                                    <th width="20%">Arquivo</th>
                                    <td width="80%">
										<input type="file" name="file[]" />
									</td>
                                </tr>								
							</table>';
					echo $dados;
					break;
					
			case "edittable":
					include "include/configuracoes/edittable.php";								
					break;
					
			case "edittableview":
					$tabela = new classDTO();
					$tabela = carregarObjeto($_GET);
					$tabelaDAO = new classTabelaDAO();
					$tabelas = $tabelaDAO->listar($tabela);	
					$combotabela = '<select name="tabnomid" id="tabnomid" onChange="buscarProcedimentos(this.value);" >';
					$combotabela.= '<option></option>';					
					if($tabelas){
						foreach($tabelas as $table){
							$combotabela.= '<option value="'.$table->getCampo("tabnomid").'">'.$table->getCampo("tabnomnome").'</option>';
						}
					}
					$combotabela.= '</select>';
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Tabela</th>
									<td width="80%">'.$combotabela.'					
									</td>
								</tr>		
							</table>';
					echo $dados;
					break;

		case "edittableprocedimentoview":
					$tabela = new classDTO();
					$tabela = carregarObjeto($_GET);
					//Abre form específico de cada tabela
					if($tabela->getCampo("tabnomtipo") == 1){
						include "include/configuracoes/formedittablehonorario.php";								
					}else if($tabela->getCampo("tabnomtipo") == 2){
						include "include/configuracoes/formedittablematerial.php";								
					}else if($tabela->getCampo("tabnomtipo") == 3){
						include "include/configuracoes/formedittablemedicamento.php";								
					}else if($tabela->getCampo("tabnomtipo") == 4){
						include "include/configuracoes/formedittablealugueltaxa.php";								
					}else if($tabela->getCampo("tabnomtipo") == 5){
						include "include/configuracoes/formedittablediaria.php";								
					}else if($tabela->getCampo("tabnomtipo") == 6){
						include "include/configuracoes/formedittablepacote.php";								
					}else if($tabela->getCampo("tabnomtipo") == 7){
						include "include/configuracoes/formedittabletaxasala.php";								
					}else if($tabela->getCampo("tabnomtipo") == 8){
						include "include/configuracoes/formedittablecurativo.php";								
					}else if($tabela->getCampo("tabnomtipo") == 9){
						include "include/configuracoes/formedittableoxigenio.php";								
					}else if($tabela->getCampo("tabnomtipo") == 10){
						include "include/configuracoes/formedittableopm.php";								
					}else if($tabela->getCampo("tabnomtipo") == 11){
						include "include/configuracoes/formedittableoutracobranca.php";								
					}
					break;
					
			case "excluirprocedimento":
					$tabela = new classDTO();
					$tabela = carregarObjeto($_GET);			
					$tabelaDAO = new classTabelaDAO();
					$dado = $tabelaDAO->listarTabela($tabela);		  
					$tabela->setCampo("nometabela",$dado->getCampo("tabtiptabela"));	
					if($tabela->getCampo("nometabela") == 'tabelahonorario'){
						$erros = $tabelaDAO->excluirHonorario($tabela);					
					}else if($tabela->getCampo("nometabela") == 'tabelamaterial'){
						$erros = $tabelaDAO->excluirMaterial($tabela);					
					}else if($tabela->getCampo("nometabela") == 'tabelamedicamento'){
						$erros = $tabelaDAO->excluirMedicamento($tabela);					
					}else{
						$erros = $tabelaDAO->excluirProcedimentos($tabela);
					}
					if(!$erros){
						echo "Operação realizada com sucesso.";
					}else{
						echo $erros;
					}
					break;
					
			case "linktable":
					include "include/configuracoes/linktable.php";								
					break;
					
			case "linktableview";
					$tabela = new classDTO();
					$tabelaDAO = new classTabelaDAO();
					$tabela = carregarObjeto($_GET);
					$tabelaConvenio = $tabelaDAO->buscarTabelaConvenio($tabela);
					
					$combotabelahonorario = "<select name='honorario' id='honorario'>";
					$combotabelahonorario.= "<option></option>";					
					$tabela->setCampo("tabnomtipo",1);					
					$tabelasHonorario = $tabelaDAO->listar($tabela);
					if($tabelasHonorario){
						foreach($tabelasHonorario as $tabelaHonorario){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabhonorario") == $tabelaHonorario->getCampo("tabnomid"))){
								$combotabelahonorario.= "<option value='".$tabelaHonorario->getCampo("tabnomid")."' selected>".$tabelaHonorario->getCampo("tabnomnome")."</option>";							
							}else{
								$combotabelahonorario.= "<option value='".$tabelaHonorario->getCampo("tabnomid")."'>".$tabelaHonorario->getCampo("tabnomnome")."</option>";	
							}	
						}
					}
					$combotabelahonorario.= "</select>";
					
					$combotabelamaterial = "<select name='material' id='material'>";
					$combotabelamaterial.= "<option></option>";					
					$tabela->setCampo("tabnomtipo",2);					
					$tabelasMaterial = $tabelaDAO->listar($tabela);
					if($tabelasMaterial){
						foreach($tabelasMaterial as $tabelaMaterial){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabmaterial") == $tabelaMaterial->getCampo("tabnomid"))){
								$combotabelamaterial.= "<option value='".$tabelaMaterial->getCampo("tabnomid")."' selected>".$tabelaMaterial->getCampo("tabnomnome")."</option>";								
							}else{		
								$combotabelamaterial.= "<option value='".$tabelaMaterial->getCampo("tabnomid")."'>".$tabelaMaterial->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelamaterial.= "</select>";

					$combotabelamedicamento = "<select name='medicamento' id='medicamento'>";
					$combotabelamedicamento.= "<option></option>";
					$tabela->setCampo("tabnomtipo",3);					
					$tabelasMedicamento = $tabelaDAO->listar($tabela);
					if($tabelasMedicamento){
						foreach($tabelasMedicamento as $tabelaMedicamento){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabmedicamento") == $tabelaMedicamento->getCampo("tabnomid"))){
								$combotabelamedicamento.= "<option value='".$tabelaMedicamento->getCampo("tabnomid")."' selected>".$tabelaMedicamento->getCampo("tabnomnome")."</option>";								
							}else{					
								$combotabelamedicamento.= "<option value='".$tabelaMedicamento->getCampo("tabnomid")."'>".$tabelaMedicamento->getCampo("tabnomnome")."</option>";	
							}
						}
					}										
					$combotabelamedicamento.= "</select>";

					$combotabelaalugueltaxa = "<select name='alugueltaxa' id='alugueltaxa'>";
					$combotabelaalugueltaxa.= "<option></option>";
					$tabela->setCampo("tabnomtipo",4);
					$tabelasAluguelTaxa = $tabelaDAO->listar($tabela);
					if($tabelasAluguelTaxa){
						foreach($tabelasAluguelTaxa as $tabelaAluguelTaxa){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabalugueltaxa") == $tabelaAluguelTaxa->getCampo("tabnomid"))){
								$combotabelaalugueltaxa.= "<option value='".$tabelaAluguelTaxa->getCampo("tabnomid")."' selected>".$tabelaAluguelTaxa->getCampo("tabnomnome")."</option>";								
							}else{					
								$combotabelaalugueltaxa.= "<option value='".$tabelaAluguelTaxa->getCampo("tabnomid")."'>".$tabelaAluguelTaxa->getCampo("tabnomnome")."</option>";	
							}
						}
					}
					$combotabelaalugueltaxa.= "</select>";

					$combotabeladiaria = "<select name='diaria' id='diaria'>";
					$combotabeladiaria.= "<option></option>";
					$tabela->setCampo("tabnomtipo",5);					
					$tabelasDiaria = $tabelaDAO->listar($tabela);
					if($tabelasDiaria){
						foreach($tabelasDiaria as $tabelaDiaria){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabdiaria") == $tabelaDiaria->getCampo("tabnomid"))){
								$combotabeladiaria.= "<option value='".$tabelaDiaria->getCampo("tabnomid")."' selected>".$tabelaDiaria->getCampo("tabnomnome")."</option>";								
							}else{												
								$combotabeladiaria.= "<option value='".$tabelaDiaria->getCampo("tabnomid")."'>".$tabelaDiaria->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabeladiaria.= "</select>";

					$combotabelapacote = "<select name='pacote' id='pacote'>";
					$combotabelapacote.= "<option></option>";
					$tabela->setCampo("tabnomtipo",6);					
					$tabelasPacote = $tabelaDAO->listar($tabela);
					if($tabelasPacote){
						foreach($tabelasPacote as $tabelaPacote){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabpacote") == $tabelaPacote->getCampo("tabnomid"))){
								$combotabelapacote.= "<option value='".$tabelaPacote->getCampo("tabnomid")."' selected>".$tabelaPacote->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelapacote.= "<option value='".$tabelaPacote->getCampo("tabnomid")."'>".$tabelaPacote->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelapacote.= "</select>";
					
					$combotabelataxasala = "<select name='taxasala' id='taxasala'>";
					$combotabelataxasala.= "<option></option>";
					$tabela->setCampo("tabnomtipo",7);					
					$tabelasTaxaSala = $tabelaDAO->listar($tabela);
					if($tabelasTaxaSala){
						foreach($tabelasTaxaSala as $tabelaTaxaSala){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabtaxasala") == $tabelaTaxaSala->getCampo("tabnomid"))){
								$combotabelataxasala.= "<option value='".$tabelaTaxaSala->getCampo("tabnomid")."' selected>".$tabelaTaxaSala->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelataxasala.= "<option value='".$tabelaTaxaSala->getCampo("tabnomid")."'>".$tabelaTaxaSala->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelataxasala.= "</select>";

					$combotabelacurativo = "<select name='curativo' id='curativo'>";
					$combotabelacurativo.= "<option></option>";
					$tabela->setCampo("tabnomtipo",8);					
					$tabelasCurativo = $tabelaDAO->listar($tabela);
					if($tabelasCurativo){
						foreach($tabelasCurativo as $tabelaCurativo){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabcurativo") == $tabelaCurativo->getCampo("tabnomid"))){
								$combotabelacurativo.= "<option value='".$tabelaCurativo->getCampo("tabnomid")."' selected>".$tabelaCurativo->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelacurativo.= "<option value='".$tabelaCurativo->getCampo("tabnomid")."'>".$tabelaCurativo->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelacurativo.= "</select>";

					$combotabelaoxigenio = "<select name='oxigenio' id='oxigenio'>";
					$combotabelaoxigenio.= "<option></option>";
					$tabela->setCampo("tabnomtipo",9);					
					$tabelasOxigenio = $tabelaDAO->listar($tabela);
					if($tabelasOxigenio){
						foreach($tabelasOxigenio as $tabelaOxigenio){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contaboxigenio") == $tabelaOxigenio->getCampo("tabnomid"))){
								$combotabelaoxigenio.= "<option value='".$tabelaOxigenio->getCampo("tabnomid")."' selected>".$tabelaOxigenio->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelaoxigenio.= "<option value='".$tabelaOxigenio->getCampo("tabnomid")."'>".$tabelaOxigenio->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelaoxigenio.= "</select>";

					$combotabelaopm = "<select name='opm' id='opm'>";
					$combotabelaopm.= "<option></option>";
					$tabela->setCampo("tabnomtipo",10);					
					$tabelasOpm = $tabelaDAO->listar($tabela);
					if($tabelasOpm){
						foreach($tabelasOpm as $tabelaOpm){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contabopm") == $tabelaOpm->getCampo("tabnomid"))){
								$combotabelaopm.= "<option value='".$tabelaOpm->getCampo("tabnomid")."' selected>".$tabelaOpm->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelaopm.= "<option value='".$tabelaOpm->getCampo("tabnomid")."'>".$tabelaOpm->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelaopm.= "</select>";

					$combotabelaoutracobranca = "<select name='outracobranca' id='outracobranca'>";
					$combotabelaoutracobranca.= "<option></option>";
					$tabela->setCampo("tabnomtipo",11);					
					$tabelasOutraCobranca = $tabelaDAO->listar($tabela);
					if($tabelasOutraCobranca){
						foreach($tabelasOutraCobranca as $tabelaOutraCobranca){
							if(($tabelaConvenio) && ($tabelaConvenio->getCampo("contaboutracobranca") == $tabelaOutraCobranca->getCampo("tabnomid"))){
								$combotabelaoutracobranca.= "<option value='".$tabelaOutraCobranca->getCampo("tabnomid")."' selected>".$tabelaOutraCobranca->getCampo("tabnomnome")."</option>";								
							}else{														
								$combotabelaoutracobranca.= "<option value='".$tabelaOutraCobranca->getCampo("tabnomid")."'>".$tabelaOutraCobranca->getCampo("tabnomnome")."</option>";	
							}
						}
					}					
					$combotabelaoutracobranca.= "</select>";
							
					if (($tabelaConvenio) && ($tabelaConvenio->getCampo("contabch") != NULL)){
						$ch = $tabelaConvenio->getCampo("contabch");
					}else{
						$ch = NULL;
					}
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Honor&aacute;rios</th>
									<td width="80%">'.$combotabelahonorario.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Consulta normal</th>
									<td width="80%">
										R$ <input type="text" name="valorconsultanormal" id="valorconsultanormal" size="5">
										&nbsp;&nbsp;&nbsp;
										Refer&ecirc;ncia <select name="referenciaconsultanormal" id="referenciaconsultanormal">
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<th width="20%">Pronto atendimento</th>
									<td width="80%">
										R$ <input type="text" name="valorprontoatendimento" id="valorprontoatendimento" size="5">
										&nbsp;&nbsp;&nbsp;
										Refer&ecirc;ncia <select name="referenciaprontoatendimento" id="referenciaprontoatendimento">
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<th width="20%">Caracter&iacute;sticas - CHs</th>
									<td width="80%">
										Ambulat&oacute;rio CH <input type="text" name="chambulatorio" id="chambulatorio" size="5">
										&nbsp;&nbsp;&nbsp;
										Interna&ccedil;&atilde;o CH <input type="text" name="chinternacao" id="chinternacao" size="5">
										<br/>
										Exames CH <input type="text" name="chexames" id="chexames" size="5">
										&nbsp;&nbsp;&nbsp;
										Filme M&#178; <input type="text" name="filmem2" id="filmem2" size="5">										
									</td>
								</tr>								
								<tr>
									<th width="20%">Material</th>
									<td width="80%">'.$combotabelamaterial.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Medicamento</th>
									<td width="80%">'.$combotabelamedicamento.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Aluguel e taxa</th>
									<td width="80%">'.$combotabelaalugueltaxa.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Di&aacute;ria</th>
									<td width="80%">'.$combotabeladiaria.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Pacote</th>
									<td width="80%">'.$combotabelapacote.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Taxax de sala</th>
									<td width="80%">'.$combotabelataxasala.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Curativo</th>
									<td width="80%">'.$combotabelacurativo.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Oxig&ecirc;nio</th>
									<td width="80%">'.$combotabelaoxigenio.'					
									</td>
								</tr>
								<tr>
									<th width="20%">OPM</th>
									<td width="80%">'.$combotabelaopm.'					
									</td>
								</tr>
								<tr>
									<th width="20%">Outras cobran&ccedil;as</th>
									<td width="80%">'.$combotabelaoutracobranca.'					
									</td>
								</tr>
								<tr>
									<th width="20%">CH</th>
									<td width="80%">
									<input type="text" name="ch" id="ch" value="'.$ch.'" size="5" />
									</td>
								</tr>								
							   </table>';
					echo $dados;
					break;
					
			case "abrircampostabelahonorario":
					if($_GET['tabnomtipo'] == 1){
						include "include/configuracoes/abrircampostabelahonorario.php";								
					}else{
						echo "";
					}
					break;
					
			case "buscarobservacao":
					$exame = new classDTO();
					$exame = carregarObjeto($_GET);
					$exameDAO = new classExameDAO();
					$exame = $exameDAO->buscar($exame);
					if($exame){
						echo $exame->getCampo("exarecomendacao");
					}
					break;

			case "addexame":
					include "include/configuracoes/addexame.php";								
					break;
					
			case "editexame":
					$exameDAO = new classExameDAO();
					$exameAlterado = new classDTO();
					$exameAlterado = carregarObjeto($_GET);
					$exameAlterado = $exameDAO->buscar($exameAlterado);
					include "include/configuracoes/addexame.php";								
					break;
					
			case "deleteexame":
					$exameDAO = new classExameDAO();
					$exame = new classDTO();
					$exame = carregarObjeto($_GET);
					$erros = $exameDAO->excluir($exame);
					if(!$erros){
						echo "Operação realizada com sucesso.";
					}else{
						echo $erros;
					}
					break;
	
			case "visualizarlaudo":
					$erro = NULL;
					$laudo = new classDTO();
					$laudo = carregarObjeto($_GET);						
					$arquivo = $laudo->getCampo("login");
					$arquivo = $arquivo.".xml";
					
					if($laudo->getCampo("login") == NULL){
						$erro = "Erro | Informe o usuário.";
					}
					if($_GET['senha'] == NULL){
						$erro = "Erro | Informe a senha.";
					}

					if(!$erro){
						$ftp = new ftp($arquivo);
						$dirLocal = "laudo/arquivos/".$arquivo;					

						if (file_exists($dirLocal)) {
							$xml = simplexml_load_file($dirLocal);
						} else {
							$erro = "Erro | Laudo em análise.";
						}
						if(!$erro){
							if($xml){
								if($xml[0]->Atendimento->Cliente->Senha == $_GET['senha']){
									session_start();
									$laudo->setCampo("arquivo",$arquivo);
									$_SESSION['LAUDO'] = $laudo;
									$erro = "Ok | http://www.websoft.inf.br/agenda/laudo/abrirlaudo.php";
								}else{
									$erro = "Erro | Senha inválida.";
								}
							}
						}
					}
   				    echo $erro;
					break;

			case "gerarlaudo":
					$laudo = new classDTO();
					$laudo = carregarObjeto($_GET);						
					$laudoDAO = new classLaudoDAO();
					
					$conexao = ibase_connect("192.168.1.220:d:/medilab/MEDISYSTEM.GDB","sysdba","masterkey");
					$msg = "CONEXAO: ".$conexao;
					$sql = "select * from laudos  ";
					$resultado = ibase_query($conexao, $sql);
					while ($linha=ibase_fetch_object($resultado));
					if($linha == 0){
						$msg.= "Nao tem linha";
					}else{
						$msg.= "Tem linha";
					}
					
					for ($x = 0; $x < $linha; $x++){
						$exame = ibase_num_rows ($resultado,$x,"os_exame");
						$pac = ibase_num_rows ($resultado,$x,"nm_pac");
						$titulo = ibase_num_rows ($resultado,$x,"titulo_lfinal");
						$msg.= " - ".$exame." - ".$pac." - ".$titulo." <br> ";
					}
					
					$msg.= " - RESULTADO: ".$resultado; 
					ibase_close($conexao);
					echo "Erro | aqui".$msg;	
					break;
					
			case "erro":
					include "include/paginaerro.php";								
					break;																				
							
			case "ok":
							include "include/paginaok.php";								
							break;																	
					
			case "principal":
							include "include/paginaprincipal.php";	
							break;

			case "trocarsenha":
							include "include/senha/trocarsenha.php";	
							break;							

			case "buscarmedicos":
					$unidade = new classDTO();		
					$funcionarioDAO = new classFuncionarioDAO();
					$unidade->setCampo("funid",$_GET['fununidade']);
					$funcionarios = $funcionarioDAO->listarMedicos();
					$comboMedicos = "<select name='funid' id='funid' onChange=buscarEspecialidade(".$_GET['fununidade'].",this.value,'agenda');>";
					$comboMedicos.= "<option value=''>Selecione um m&eacute;dico</option>";					
					if($funcionarios){
						foreach($funcionarios as $funcionario){
								$comboMedicos.= "<option value='".$funcionario->getCampo("funid")."'>".$funcionario->getCampo("funnome")."</option>";					
						}
					}
					$comboMedicos.= "</select>";
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">M&eacute;dico</th>
									<td width="80%">
										'.$comboMedicos.'
									</td>
								</tr>										
								</table>';
					echo $dados;					
					break;
			
			
			case "buscarespecialidade":
					$funcionario = new classDTO();		
					$funcionarioDAO = new classFuncionarioDAO();
					$especialidadeDAO = new classEspecialidadeDAO();
					$funcionario->setCampo("funid",$_GET['funid']);
					$funcionario->setCampo("fununidadeselecionada",$_GET['fununidade']);
					$especialidades = $especialidadeDAO->listar($_GET['tipo'],$funcionario->getCampo("funid"),$funcionario->getCampo("fununidadeselecionada"));
					if ($_GET['tipo'] == 'horario'){
						$comboEspecialidade = "<select name='funespespecialidade' id='funespespecialidade' onChange=buscarHorario(this.value,".$funcionario->getCampo("funid").",".$funcionario->getCampo("fununidadeselecionada").");>";
					}else if ($_GET['tipo'] == 'agenda'){
						$comboEspecialidade = "<select name='funespespecialidade' id='funespespecialidade' onChange=buscarDataMedico(this.value,".$funcionario->getCampo("funid").",".$funcionario->getCampo("fununidadeselecionada").",'".date("d/m/Y")."');>";
					}else{
						$comboEspecialidade = "<select name='funespespecialidade' id='funespespecialidade'>";
					}
					$comboEspecialidade.= "<option value=''>Selecione uma especialidade</option>";					
					if($especialidades){
						foreach($especialidades as $especialidade){
								$comboEspecialidade.= "<option value='".$especialidade->getCampo("espid")."'>".$especialidade->getCampo("espnome")."</option>";					
						}
					}
					$comboEspecialidade.= "</select>";
					$dados = '<table class="tabelaHorizontal">
								<tr>
									<th width="20%">Especialidade</th>
									<td width="80%">
										'.$comboEspecialidade.'
									</td>
								</tr>										
								</table>';
					echo $dados;
					break;
					
			case "buscarhorario":
				$funcionario = new classDTO();		
				$funcionarioDAO = new classFuncionarioDAO();
				$funcionario->setCampo("funid",$_GET['funid']);
				$funcionario->setCampo("fununidadeselecionada",$_GET['fununidade']);
				$funcionario->setCampo("funespecialidade",$_GET['funespecialidade']);
				$horarios = $funcionarioDAO->buscarHorario($funcionario);
				$funcionario->setCampo("funintintervaloconsulta","");
				$seg = 1;
				$ter = 1;
				$qua = 1;
				$qui = 1;
				$sex = 1;
				$sab = 1;
				$dom = 1;
				if (count($horarios) > 0){
					$funcionario->setCampo("funintintervaloconsulta",$horarios[0]->getCampo("funintintervaloconsulta"));
					foreach($horarios as $horario){
						$horaentrada = explode(":",$horario->getCampo("funhorarioent"));
						$horasaida = explode(":",$horario->getCampo("funhorariosai"));
						$he = $horaentrada[0];
						$me = $horaentrada[1];
						$hs = $horasaida[0];
						$ms = $horasaida[1];						
						
						if(($horario->getCampo("funhorariodia") == 'seg') && ($seg == 1)){
							$entradaseg1 = $he.":".$me;
							$saidaseg1 = $hs.":".$ms;
							$seg = 2;
						}else if (($horario->getCampo("funhorariodia") == 'seg') && ($seg == 2)){
							$entradaseg2 = $he.":".$me;
							$saidaseg2 = $hs.":".$ms;
							$seg = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'ter') && ($ter == 1)){
							$entradater1 = $he.":".$me;
							$saidater1 = $hs.":".$ms;
							$ter = 2;
						}else if (($horario->getCampo("funhorariodia") == 'ter') && ($ter == 2)){
							$entradater2 = $he.":".$me;
							$saidater2 = $hs.":".$ms;
							$ter = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'qua') && ($qua == 1)){
							$entradaqua1 = $he.":".$me;
							$saidaqua1 = $hs.":".$ms;
							$qua = 2;
						}else if (($horario->getCampo("funhorariodia") == 'qua') && ($qua == 2)){
							$entradaqua2 = $he.":".$me;
							$saidaqua2 = $hs.":".$ms;
							$qua = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'qui') && ($qui == 1)){
							$entradaqui1 = $he.":".$me;
							$saidaqui1 = $hs.":".$ms;
							$qui = 2;
						}else if (($horario->getCampo("funhorariodia") == 'qui') && ($qui == 2)){
							$entradaqui2 = $he.":".$me;
							$saidaqui2 = $hs.":".$ms;
							$qui = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'sex') && ($sex == 1)){
							$entradasex1 = $he.":".$me;
							$saidasex1 = $hs.":".$ms;
							$sex = 2;
						}else if (($horario->getCampo("funhorariodia") == 'sex') && ($sex == 2)){
							$entradasex2 = $he.":".$me;
							$saidasex2 = $hs.":".$ms;
							$sex = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'sab') && ($sab == 1)){
							$entradasab1 = $he.":".$me;
							$saidasab1 = $hs.":".$ms;
							$sab = 2;
						}else if (($horario->getCampo("funhorariodia") == 'sab') && ($sab == 2)){
							$entradasab2 = $he.":".$me;
							$saidasab2 = $hs.":".$ms;
							$sab = 3;
						}
						else if(($horario->getCampo("funhorariodia") == 'dom') && ($dom == 1)){
							$entradadom1 = $he.":".$me;
							$saidadom1 = $hs.":".$ms;
							$dom = 2;
						}else if (($horario->getCampo("funhorariodia") == 'dom') && ($dom == 2)){
							$entradadom2 = $he.":".$me;
							$saidadom2 = $hs.":".$ms;
							$dom = 3;
						}					
					}
				}
				$dados = '<table class="tabelaHorizontal">
                        <tr>
                            <th width="20%">Dura&ccedil;&atilde;o da consulta</th>
                            <td width="80%"><input type="text" name="funintervadoconsulta" id="funintervadoconsulta" size="5" maxlength="6" value="'.$funcionario->getCampo("funintintervaloconsulta").'" onkeyup="maskIt(this,event,\'######\')" /><font color="red" size="1">min.</font></td>
                        </tr>										
						<tr>
                            <th width="20%">Segunda-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaseg1" id="entradaseg1" size="5" maxlength="5" value="'.$entradaseg1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaseg1" id="saidaseg1" size="5" maxlength="5" value="'.$saidaseg1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaseg2" id="entradaseg2" size="5" maxlength="5" value="'.$entradaseg2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaseg2" id="saidaseg2" size="5" maxlength="5" value="'.$saidaseg2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>
                         </tr>
                         <tr>
                            <th width="20%">Ter&ccedil;a-feira</th>
                             <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradater1" id="entradater1" size="5" maxlength="5" value="'.$entradater1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidater1" id="saidater1" size="5" maxlength="5" value="'.$saidater1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradater2" id="entradater2" size="5" maxlength="5" value="'.$entradater2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidater2" id="saidater2" size="5" maxlength="5" value="'.$saidater2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>		
                        </tr>
                        <tr>
                            <th width="20%">Quarta-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaqua1" id="entradaqua1" size="5" maxlength="5" value="'.$entradaqua1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqua1" id="saidaqua1" size="5" maxlength="5" value="'.$saidaqua1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaqua2" id="entradaqua2" size="5" maxlength="5" value="'.$entradaqua2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqua2" id="saidaqua2" size="5" maxlength="5" value="'.$saidaqua2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>	
						</tr>
                        <tr>
							<th width="20%">Quinta-feira</th>
							<td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradaqui1" id="entradaqui1" size="5" maxlength="5" value="'.$entradaqui1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqui1" id="saidaqui1" size="5" maxlength="5" value="'.$saidaqui1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradaqui2" id="entradaqui2" size="5" maxlength="5" value="'.$entradaqui2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidaqui2" id="saidaqui2" size="5" maxlength="5" value="'.$saidaqui2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>				
						</tr>	
                        <tr>
							<th width="20%">Sexta-feira</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradasex1" id="entradasex1" size="5" maxlength="5" value="'.$entradasex1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasex1" id="saidasex1" size="5" maxlength="5" value="'.$saidasex1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradasex2" id="entradasex2" size="5" maxlength="5" value="'.$entradasex2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasex2" id="saidasex2" size="5" maxlength="5" value="'.$saidasex2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>	
						</tr>
                        <tr>
							<th width="20%">S&aacute;bado</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradasab1" id="entradasab1" size="5" maxlength="5" value="'.$entradasab1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasab1" id="saidasab1" size="5" maxlength="5" value="'.$saidasab1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradasab2" id="entradasab2" size="5" maxlength="5" value="'.$entradasab2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidasab2" id="saidasab2" size="5" maxlength="5" value="'.$saidasab2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>		
						</tr>
                        <tr>
							<th width="20%">Domingo</th>
                            <td width="80%">
									Hor&aacute;rio entrada <input type="text" name="entradadom1" id="entradadom1" size="5" maxlength="5" value="'.$entradadom1.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidadom1" id="saidadom1" size="5" maxlength="5" value="'.$saidadom1.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>

									Hor&aacute;rio entrada <input type="text" name="entradadom2" id="entradadom2" size="5" maxlength="5" value="'.$entradadom2.'" onkeyup="maskIt(this,event,\'##:##\')" />
									Hor&aacute;rio sa&iacute;da <input type="text" name="saidadom2" id="saidadom2" size="5" maxlength="5" value="'.$saidadom2.'" onkeyup="maskIt(this,event,\'##:##\')" /><br/>
							</td>
						</tr></table>';
						echo $dados;
						break;

	case "buscardatamedico":
			if ($_GET['data']){
				$data = $_GET['data'];
			}else{
				$data = date("d/m/Y");
			}
			$calendario = new classCalendario();	
			$comboDatas = $cal = $calendario->cria($data,$_GET['funfuncionario'],$_GET['fununidade'],$_GET['funespecialidade']).'</td>';
				echo $comboDatas;					
				break;
	
	case "buscarhorariomedico":	
			//busca o dia da semana que a data está
			$calendario = new classCalendario();
			$diadasemana = $calendario->diasemana($_GET['data']);
			//pega os horários do médico no dia da semana informado
			$funcionarioDAO = new classFuncionarioDAO();
			$horariosmedico = array();
			$horariosmedico = $funcionarioDAO->buscarHorariosAtendimento($diadasemana,$_GET['funfuncionario'],$_GET['data'],$_GET['fununidade'],$_GET['funespecialidade'],$_GET['pacid'],$_GET['addagenda']);
			echo $horariosmedico;
			break;
			
	
	
	case "relatoriopacientes":
			$pacienteDAO = new classPacienteDAO();
			session_start();
			$_SESSION['PACIENTES'] = $pacienteDAO->listar();
			echo '<IFRAME name="Relatório" src="../include/relatorio/relatoriopacientes.php" frameBorder="1" width="710" height=400 scrolling=auto></IFRAME>';
			break;
	
	case "relatoriounidades":
			$unidadeDAO = new classUnidadeDAO();
			session_start();
			$_SESSION['UNIDADES'] = $unidadeDAO->listar();
			echo '<IFRAME name="Relatório" src="../include/relatorio/relatoriounidades.php" frameBorder="1" width="710" height=400 scrolling=auto></IFRAME>';
			break;

	case "relatoriofuncionarios":
			$funcionarioDAO = new classFuncionarioDAO();
			session_start();
			$_SESSION['FUNCIONARIOS'] = $funcionarioDAO->listarFuncionariosComFuncao();
			echo '<IFRAME name="Relatório" src="../include/relatorio/relatoriofuncionarios.php" frameBorder="1" width="710" height=400 scrolling=auto></IFRAME>';
			break;

	case "relatorioagenda":
			include "include/relatorio/relatorioagenda.php";
			break;

	case "relatorioagendaview":
			$agendaDAO = new classAgendaDAO();
			$filtro = new classDTO();
			$filtro->setCampo("dataini",$_GET['dataini']);
			$filtro->setCampo("datafim",$_GET['datafim']);
			$filtro->setCampo("funespecialidade",$_GET['especialidade']);
			$filtro->setCampo("funfuncionario",$_GET['medico']);
			session_start();
			$_SESSION['CONSULTAS'] = $agendaDAO->listarRelatorio($filtro);
			echo '<IFRAME name="Relatório" src="../include/relatorio/relatorioagendaview.php" frameBorder="1" width="710" height=400 scrolling=auto></IFRAME>';
			break;	
			
	case "encerrarsessaolaudo": 
			unset($_SESSION['LAUDO']);
			break;
			
	default: header("Location: index.php");
			 break;
	
	}	

?>