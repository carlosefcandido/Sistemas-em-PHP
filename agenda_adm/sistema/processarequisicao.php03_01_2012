<?php

	$body = NULL;
	
		############################ ALTERAR SENHA  ################################################
	if ($_POST['acao'] == 'alterarsenha'){
		$erro = NULL;
		$user = new classDTO();		
		session_start();
		$user = carregarObjeto($_POST);
		session_start();
		$user->setCampo("id",$_SESSION['USUARIO']->getCampo("usuid"));
		$userDAO = new classUsuarioDAO();
		$erro = $userDAO->alterarSenha($user);
		if(!$erro){
			include "../logout.php";	
		}else{
			$_SESSION['ERRO'] = $erro;
			$body = "<body onLoad=abrirMiolo('trocarsenha');>";				
		}
	}
	############################ FIM DO ALTERAR SENHA  ################################################
		############################ CADASTRAR USUÁRIO ################################################
	if ($_POST['acao'] == 'addusuario'){
		$erros = NULL;
		$usuario = new classDTO();		
		$usuario = carregarObjeto($_POST);
		$usuarioDAO = new classUsuarioDAO();
		$erros = $usuarioDAO->verifyLogin($usuario);		
		if (!$erros){
			$funcionarioDAO = new classFuncionarioDAO();
			$erros = $funcionarioDAO->gravar($usuario);
			if(!$erros){
				$usuarioGravado = $funcionarioDAO->buscarUltimo();
				$usuario->setCampo("id",$usuarioGravado->getCampo("funid"));
				$erros = $usuarioDAO->gravar($usuario);
			}
		}
		if(!$erros){
			$body = "<body onLoad=abrirMiolo('ok');>";	
		}else{
			session_start();
			$_SESSION['USER'] = $usuario;			
			$_SESSION['ERROS'] = $erros;
			$body = "<body onLoad=abrirMiolo('addusuario');>";				
		}
	}
	############################ FIM DO CADASTRAR USUARIO  ################################################
			############################ ALTERAR USUARIO  ################################################
	if ($_POST['acao'] == 'editusuario'){
		$erros = NULL;
		$usuario = new classDTO();		
		$usuario = carregarObjeto($_POST);
		$funcionarioDAO = new classFuncionarioDAO();
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['USER'] = $funcionarioDAO->buscar($usuario);
			$body = "<body onLoad=abrirMiolo('editusuarioview');>";				
		}else{
			$erros = $funcionarioDAO->alterar($usuario);
			if(!$erros){
				$usuarioDAO = new classUsuarioDAO();
				$erros = $usuarioDAO->alterar($usuario);
			}
			if(!$erros){
				unset($_SESSION['USER']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['USER'] = $usuario;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('editusuarioview');>";				
			}
		}
	}
	############################ FIM DO ALTERAR USUARIO  ################################################	

			############################ EXCLUIR USUARIO  ################################################
	if ($_POST['acao'] == 'deleteusuario'){
		$erros = NULL;
		$usuario = new classDTO();		
		$usuario = carregarObjeto($_POST);
		$funcionarioDAO = new classFuncionarioDAO();
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['USER'] = $funcionarioDAO->buscar($usuario);
			$body = "<body onLoad=abrirMiolo('deleteusuarioview');>";				
		}else{
			$erros = $funcionarioDAO->deletar($usuario);
			if(!$erros){
				$usuarioDAO = new classUsuarioDAO();
				$erros = $usuarioDAO->excluir($usuario);
			}
			if(!$erros){
				unset($_SESSION['USER']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['USER'] = $usuario;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('deleteusuarioview');>";				
			}
		}
	}
	############################ FIM DO EXCLUIR USUARIO  ################################################	
			############################ BLOQUEAR/DESBLOQUEAR USUARIO  ################################################
	if ($_POST['acao'] == 'blockusuario'){
		$erros = NULL;
		$usuario = new classDTO();		
		$usuario = carregarObjeto($_POST);
		$usuarioDAO = new classUsuarioDAO();
		if ($_POST['passo'] == 1){
			session_start();
			$usuario = $usuarioDAO->buscar($usuario);
			$funcionario = new classDTO();
			$funcionario->setCampo("usuperfil",$usuario->getCampo("usuperfil"));
			$funcionario->setCampo("usuidfuncionariomedico",$usuario->getCampo("usuidfuncionariomedico"));
			$funcionarioDAO = new classFuncionarioDAO();
			$funcionario = $funcionarioDAO->buscarUsuario($funcionario);
			if($funcionario->getCampo("funnome") == NULL){
				$funcionario->setCampo("funnome",$funcionario->getCampo("mednome"));
			}
			$_SESSION['USER'] = $funcionario;
			$body = "<body onLoad=abrirMiolo('blockusuarioview');>";				
		}else{
			$erros = $usuarioDAO->bloquearDesbloquear($usuario);
			if(!$erros){
				unset($_SESSION['USER']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['USER'] = $usuario;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('editusuarioview');>";				
			}
		}
	}
	############################ FIM DO BLOQUEAR/DESBLOQUEAR USUARIO  ################################################	
	
		############################ CADASTRAR MEDICO ################################################
	if ($_POST['acao'] == 'addmedico'){
		$erros = NULL;
		$medico = new classDTO();		
		$medico = carregarObjeto($_POST);
		$medicoDAO = new classMedicoDAO();
		$erros = $medicoDAO->gravar($medico);
		if(!$erros){
			$medicoGravado = $medicoDAO->buscarUltimo();
			$medico->setCampo("id",$medicoGravado->getCampo("medid"));
			$usuarioDAO = new classUsuarioDAO();
			$erros = $usuarioDAO->gravar($medico);
		}
		
		if(!$erros){
			$body = "<body onLoad=abrirMiolo('ok');>";	
		}else{
			session_start();
			$_SESSION['MEDICO'] = $medico;			
			$_SESSION['ERROS'] = $erros;
			$body = "<body onLoad=abrirMiolo('addmedico');>";				
		}
	}
	############################ FIM DO CADASTRAR MEDICO  ################################################
			############################ ALTERAR MEDICO  ################################################
	if ($_POST['acao'] == 'editmedico'){
		$erros = NULL;
		$medico = new classDTO();		
		$medico = carregarObjeto($_POST);
		$medicoDAO = new classMedicoDAO();
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['MEDICO'] = $medicoDAO->buscar($medico);
			$body = "<body onLoad=abrirMiolo('editmedicoview');>";				
		}else{
			$erros = $medicoDAO->alterar($medico);
			if(!$erros){
				$usuarioDAO = new classUsuarioDAO();
				$erros = $usuarioDAO->alterar($medico);	
			}
			
			if(!$erros){
				unset($_SESSION['MEDICO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				$medico->setCampo("medid",$medico->getCampo("id"));
				session_start();
				$_SESSION['MEDICO'] = $medico;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('editmedicoview');>";				
			}
		}
	}
	############################ FIM DO ALTERAR MEDICO  ################################################	
			############################ EXCLUIR MEDICO  ################################################
	if ($_POST['acao'] == 'deletemedico'){
		$erros = NULL;
		$medico = new classDTO();		
		$medico = carregarObjeto($_POST);
		$medicoDAO = new classMedicoDAO();
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['MEDICO'] = $medicoDAO->buscar($medico);
			$body = "<body onLoad=abrirMiolo('deletemedicoview');>";				
		}else{
			$agenda = $medicoDAO->listarAgenda($medico->getCampo("id"),'');
			if(count($agenda) > 0){
				$erros = "N&atilde;o &eacute; poss&iacute;vel excluir o m&eacute;dico, pois o mesmo j&aacute; possui agenda.";
			}else{
				$erros = $medicoDAO->excluir($medico);
				if(!$erros){
					$usuarioDAO = new classUsuarioDAO();
					$erros = $usuarioDAO->excluir($medico);
				}				
			}
			
			if(!$erros){
				unset($_SESSION['MEDICO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['MEDICO'] = $medico;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('deletemedicoview');>";				
			}
		}
	}
	############################ FIM DO EXCLUIR MEDICO  ################################################	
			############################ ESPECIALIDADE EXAME  ################################################
	if ($_POST['acao'] == 'especialidadeexame'){
		$erros = NULL;
		$especialidade = new classDTO();		
		$especialidadeDAO = new classEspecialidadeDAO();
		if ($_POST['passo'] == 1){
			$especialidade = carregarObjeto($_POST);
			session_start();
			$_SESSION['ESPECIALIDADES'] = $especialidadeDAO->buscarComExames($especialidade);
			$body = "<body onLoad=abrirMiolo('especialidadeexameview');>";				
		}else{
			$especialidade = new classDTO();
			$especialidade->setCampo("espexaespecialidade",$_POST['espid']);
			$especialidadeDAO = new classEspecialidadeDAO();
			if ($_POST['selecionados']){
				$especialidadeDAO->deletarEspecialidadeExame($especialidade);
				foreach($_POST['selecionados'] as $indice=>$value){
					$especialidade->setCampo("espexaexame",$value);
					$erros = $especialidadeDAO->gravarEspecialiadeExame($especialidade);
					if($erro){
						break;
					}
				}
			}	
			if(!$erros){
				unset($_SESSION['ESPECIALIDADE']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['ESPECIALIDADE'] = $especialidade;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('especialidadeexameview');>";				
			}
		}
	}
	############################ FIM DO ESPECIALIDADE EXAME  ################################################	
			############################ MEDICO EXAME  ################################################
	if ($_POST['acao'] == 'medicoexame'){
		$erros = NULL;
		$medico = new classDTO();		
		$medicoDAO = new classMedicoDAO();
		if ($_POST['passo'] == 1){
			$medico = carregarObjeto($_POST);
			session_start();
			$_SESSION['MEDICO'] = $medicoDAO->buscarComExames($medico);
			$body = "<body onLoad=abrirMiolo('medicoexameview');>";				
		}else{
			$medico = new classDTO();
			$medico->setCampo("medexamedico",$_POST['medid']);
			$medico->setCampo("medid",$_POST['medid']);
			$medicoDAO = new classMedicoDAO();
			if ($_POST['selecionados']){
				$medicoDAO->deletarMedicoExame($medico);
				$gravado = array();
				$j = 0;
				foreach($_POST['selecionados'] as $indice=>$value){
					$medico->setCampo("medexaexame",$value);
					$gravou = false;
					for($i=0;$i < count($gravado); $i++){
						if($gravado[$i] == $medico->getCampo("medexaexame")){
							$gravou = true;
							break;
						}
					}
					if(!$gravou){
						$gravado[$j] = $medico->getCampo("medexaexame");
						$j++;
						$erros = $medicoDAO->gravarMedicoExame($medico);
					}
					if($erro){
						break;
					}
				}
			}	
			if(!$erros){
				unset($_SESSION['MEDICO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['MEDICO'] = $medico;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('medicoexameview');>";				
			}
		}
	}
	############################ FIM DO MEDICO EXAME  ################################################	
			############################ PLANO DE CONVENIO  ################################################
	if ($_POST['acao'] == 'planoconvenio'){
		$erros = NULL;
		$plano = new classDTO();		
		$planoDAO = new classPlanoDAO();
		$plano = carregarObjeto($_POST);
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['PLANO'] = $planoDAO->buscar($plano);
			$body = "<body onLoad=abrirMiolo('planoconvenioview');>";				
		}else{
			$erros = $planoDAO->atualizar($plano);	
			if(!$erros){
				unset($_SESSION['PLANO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['PLANO'] = $plano;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('planoconvenioview');>";				
			}
		}
	}
	############################ FIM DO PLANO CONVENIO  ################################################	

			############################ HORARIO MEDICO ################################################
	if ($_POST['acao'] == 'horariomedico'){
		$erros = NULL;
		$medico = new classDTO();		
		$medicoDAO = new classMedicoDAO();
		$medico = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['MEDICO'] = $medicoDAO->buscarComHorarios($medico);
			$body = "<body onLoad=abrirMiolo('horariomedicoview');>";				
		}else{
			$medicoDAO->deletarHorario($medico);
			$medicoDAO->atualizarHorarioIntervalo($medico);
			if ($medico->getCampo("entradaseg1") != NULL){
				$medicoDAO->gravarHorario($medico,'entradaseg1','saidaseg1','seg');
			}
			if ($medico->getCampo("entradaseg2") != NULL){
				$medicoDAO->gravarHorario($medico,'entradaseg2','saidaseg2','seg');
			}
			if ($medico->getCampo("entradater1") != NULL){			
				$medicoDAO->gravarHorario($medico,'entradater1','saidater1','ter');
			}
			if ($medico->getCampo("entradater2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradater2','saidater2','ter');
			}
			if ($medico->getCampo("entradaqua1") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradaqua1','saidaqua1','qua');
			}
			if ($medico->getCampo("entradaqua2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradaqua2','saidaqua2','qua');
			}
			if ($medico->getCampo("entradaqui1") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradaqui1','saidaqui1','qui');
			}
			if ($medico->getCampo("entradaqui2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradaqui2','saidaqui2','qui');
			}
			if ($medico->getCampo("entradasex1") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradasex1','saidasex1','sex');
			}
			if ($medico->getCampo("entradasex2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradasex2','saidasex2','sex');
			}
			if ($medico->getCampo("entradasab1") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradasab1','saidasab1','sab');
			}
			if ($medico->getCampo("entradasab2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradasab2','saidasab2','sab');
			}
			if ($medico->getCampo("entradadom1") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradadom1','saidadom1','dom');
			}
			if ($medico->getCampo("entradadom2") != NULL){						
				$medicoDAO->gravarHorario($medico,'entradadom2','saidadom2','dom');
			}

			if(!$erros){
				unset($_SESSION['MEDICO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['MEDICO'] = $medico;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('medicoexameview');>";				
			}
		}
	}
	############################ FIM DO HORARIO MEDICO  ################################################	
			############################ BLOQUEIO HORARIO MEDICO ################################################
	if ($_POST['acao'] == 'bloquearhorariomedico'){
		$erros = NULL;
		$medico = new classDTO();		
		$medicoDAO = new classMedicoDAO();
		$medico = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			session_start();
			$_SESSION['MEDICO'] = $medicoDAO->buscar($medico);
			$body = "<body onLoad=abrirMiolo('bloquearhorariomedicoview');>";				
		}else{
			if($medico->getCampo("medhorblodata") == $medico->getCampo("medhorblodatafim")){
				$erros = $medicoDAO->gravarBloqueioHorario($medico);
			}else{
				$qtdedias = diferencaEntreDatas($medico->getCampo("medhorblodata"),$medico->getCampo("medhorblodatafim"));
				$qtdedias++;
				for($i=0;$i<$qtdedias;$i++){
					if($i != 0){
						$medico->setCampo("medhorblodata",proximoDia($medico->getCampo("medhorblodata")));
					}
					$erros = $medicoDAO->gravarBloqueioHorario($medico);
				}
			}

			if(!$erros){
				unset($_SESSION['MEDICO']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['MEDICO'] = $medico;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('bloquearhorariomedicoview');>";				
			}
		}
	}
	############################ FIM DO BLOQUEIO DE HORARIO MEDICO  ################################################	

			############################ DELETE CONSULTA  ################################################
	if ($_POST['acao'] == 'deleteconsulta'){
		$erros = NULL;
		$agendaDAO = new classAgendaDAO();
		if ($_POST['passo'] == 1){
			$paciente = new classDTO();		
			$paciente = carregarObjeto($_POST);
			session_start();
			$_SESSION['CONSULTAS'] = $agendaDAO->buscarConsultasPaciente($paciente);
			$body = "<body onLoad=abrirMiolo('deleteconsultaview');>";				
		}else if ($_POST['passo'] == 2){
			unset($_SESSION['CONSULTAS']);
			$consulta = new classDTO();
			$consulta = carregarObjeto($_POST);
			session_start();
			$_SESSION['CONSULTA'] = $agendaDAO->buscarConsultaPaciente($consulta);
			$body = "<body onLoad=abrirMiolo('deleteconsultaviewpasso');>";				
		}else{
			$consulta = new classDTO();
			$consulta = carregarObjeto($_POST);
			$erros = $agendaDAO->excluir($consulta);
			if(!$erros){
				unset($_SESSION['CONSULTA']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('deleteconsultaviewpasso');>";				
			}			
		}
	}
	############################ FIM DO DELETE CONSULTA  ################################################	
			############################ EDIT CONSULTA  ################################################
	if ($_POST['acao'] == 'editconsulta'){
		$erros = NULL;
		$agendaDAO = new classAgendaDAO();
		if ($_POST['passo'] == 1){
			$paciente = new classDTO();		
			$paciente = carregarObjeto($_POST);
			session_start();
			$_SESSION['CONSULTAS'] = $agendaDAO->buscarConsultasPaciente($paciente);
			$body = "<body onLoad=abrirMiolo('editconsultaview');>";				
		}else if ($_POST['passo'] == 2){
			unset($_SESSION['CONSULTAS']);
			$consulta = new classDTO();
			$consulta = carregarObjeto($_POST);
			$consulta = $agendaDAO->buscarConsultaPaciente($consulta);
			session_start();
			$_SESSION['CONSULTA'] = $consulta;
			$body = "<body onLoad=abrirMioloComAlert('alterarconsulta');>";				
		}
	}
	############################ FIM DO EDIT CONSULTA  ################################################	
			############################ ADICIONAR TABELA  ################################################
	if ($_POST['acao'] == 'addtable'){
		$erros = NULL;
		$tabelaDAO = new classTabelaDAO();
		$tabela = new classDTO();		
		$tabela = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			$erros = $tabelaDAO->gravar($tabela);
			if(!$erros){
				unset($_SESSION['TABELA']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['ERROS'] = $erros;
				$_SESSION['TABELA'] = $tabela;
				$body = "<body onLoad=abrirMiolo('addtable');>";				
			}			
		}
	}
	############################ FIM DO ADICIONAR TABELA  ################################################	
			############################ ADICIONAR PROCEDIMENTO TABELA  ################################################
	if ($_POST['acao'] == 'edittable'){
		$erros = NULL;
		$tabelaDAO = new classTabelaDAO();
		$tabela = new classDTO();		
		$tabela = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			if($tabela->getCampo("tabnomtipo") == 1){
				$erros = $tabelaDAO->gravarHonorario($tabela);			
			}else if($tabela->getCampo("tabnomtipo") == 2){
				$erros = $tabelaDAO->gravarMaterial($tabela);			
			}else if($tabela->getCampo("tabnomtipo") == 3){
				$erros = $tabelaDAO->gravarMedicamento($tabela);			
			}
			if(!$erros){
				unset($_SESSION['TABELA']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['TABELA'] = $tabela;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('edittable');>";				
			}			
		}
	}
	############################ FIM DO ADICIONAR PROCEDIMENTO TABELA  ################################################
			############################ EDIT PROCEDIMENTO TABELA  ################################################
	if ($_POST['acao'] == 'edittableupdate'){
		$erros = NULL;
		$tabelaDAO = new classTabelaDAO();
		$tabela = new classDTO();		
		$tabela = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			if($tabela->getCampo("tabnomtipo") == 1){
				$erros = $tabelaDAO->alterarHonorario($tabela);			
			}else if($tabela->getCampo("tabnomtipo") == 2){
				$erros = $tabelaDAO->alterarMaterial($tabela);			
			}else if($tabela->getCampo("tabnomtipo") == 3){
				$erros = $tabelaDAO->alterarMedicamento($tabela);			
			}
			if(!$erros){
				unset($_SESSION['TABELA']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['TABELA'] = $tabela;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('edittable');>";				
			}			
		}
	}
	############################ FIM DO EDIT PROCEDIMENTO TABELA  ################################################
			############################ CONVÊNIO x TABELA  ################################################
	if ($_POST['acao'] == 'linktable'){
		$erros = NULL;
		$tabelaDAO = new classTabelaDAO();
		$tabela = new classDTO();		
		$tabela = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			$erros = $tabelaDAO->gravarTabelaConvenio($tabela);			
			if(!$erros){
				unset($_SESSION['TABELA']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['TABELA'] = $tabela;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('edittable');>";				
			}			
		}
	}
	############################ FIM DO CONVÊNIO x TABELA  ################################################	
			############################ ADICIONAR EXAME  ################################################
	if ($_POST['acao'] == 'addexame'){
		$erros = NULL;
		$exameDAO = new classExameDAO();
		$exame = new classDTO();		
		$exame = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			$erros = $exameDAO->gravar($exame);			
			if(!$erros){
				unset($_SESSION['EXAME']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['EXAME'] = $exame;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('addexame');>";				
			}			
		}
	}
	############################ FIM DO ADICIONAR EXAME ################################################	
			############################ EDIT EXAME  ################################################
	if ($_POST['acao'] == 'editexame'){
		$erros = NULL;
		$exameDAO = new classExameDAO();
		$exame = new classDTO();		
		$exame = carregarObjeto($_POST);		
		if ($_POST['passo'] == 1){
			$erros = $exameDAO->alterar($exame);			
			if(!$erros){
				unset($_SESSION['EXAME']);
				$body = "<body onLoad=abrirMiolo('ok');>";	
			}else{
				session_start();
				$_SESSION['EXAME'] = $exame;			
				$_SESSION['ERROS'] = $erros;
				$body = "<body onLoad=abrirMiolo('addexame');>";				
			}			
		}
	}
	############################ FIM DO EDIT EXAME ################################################	
	
	
?>