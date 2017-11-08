<?php

class classFuncionarioDAO
{
	function gravar($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into funcionario values ";
			$sql.= "(NULL,'".$funcionario->getCampo("funnome")."'";
			$sql.= ",'".$funcionario->getCampo("funsexo")."'";
			$sql.= ",'".$funcionario->getCampo("funtelefone")."'";	
			$sql.= ",'".$funcionario->getCampo("funcelular")."'";			
			$sql.= ")";						
			$res = $BD->executarSQL($sql);
			if ($res > 0){
					$erro = NULL;
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	

	function alterar($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update funcionario set ";
			$sql.= " funnome = '".$funcionario->getCampo("funnome")."'";
			$sql.= ",funsexo = '".$funcionario->getCampo("funsexo")."'";		
			$sql.= ",funtelefone = '".$funcionario->getCampo("funtelefone")."'";			
			$sql.= ",funcelular = '".$funcionario->getCampo("funcelular")."'";						
			$sql.= " where funid = ".$funcionario->getCampo("id");						
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	

	
	function atualizarDuracaoConsulta($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL20_;
			$sql.= " funintervadoconsulta = ".$funcionario->getCampo("funintervadoconsulta");
			$sql.= " where funid = ".$funcionario->getCampo("funid");	
			$res = $BD->executarSQL($sql);
			if ($res > 0){
					$erro = NULL;
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	
	function buscarUltimo(){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from funcionario ";
			$sql.= " order by funid desc limit 1";						
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$funcionario = $generic->construir($res,'classDTO');
			}
			$BD->fecharConexao();
		}
		return $funcionario;
	}	

	function deletar($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from funcionario ";
			$sql.= " where funid = ".$funcionario->getCampo("id");						
			$res = $BD->executarSQL($sql);
			if ($res < 1){
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function bloquear($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL20_;
			$sql.= " funbloqueado = '".$funcionario->getCampo("funbloqueado")."'";
			$sql.= " where funid = ".$funcionario->getCampo("funid");						
			$res = $BD->executarSQL($sql);
			if ($res > 0){
					$erro = classFuncionarioDAO::deletarHorario($funcionario);
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	function deletarHorario($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL22_;
			$sql.= " where funfuncionario = ".$funcionario->getCampo("funid");	
			$sql.= " and fununidade = ".$funcionario->getCampo("fununidadeselecionada");				
			$sql.= " and funespecialidade = ".$funcionario->getCampo("funespespecialidade");		
			echo $sql;
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function deletarHorarioIntervalo($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL29_;
			$sql.= " where funintfuncionario = ".$funcionario->getCampo("funid");	
			$sql.= " and funintunidade = ".$funcionario->getCampo("fununidadeselecionada");				
			$sql.= " and funespecialidade = ".$funcionario->getCampo("funespespecialidade");	
			echo $sql;
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	
	function buscarEspecialidadeFuncionario($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "select *, 
					(select funespespecialidade from funcionarioespecialidade
					where funespfuncionario = ".$funcionario->getCampo("funid")."
					and fununidade = ".$funcionario->getCampo("fununidadeselecionada")."
					) as funespespecialidade
					from funcionario
					inner join cidades on (funcidade = cidid)
					inner join estados on (cidestado = estid)
					inner join usuario on (funid = usufuncionario) 
					inner join unidade on (fununidade = uniid)
					where funid = ".$funcionario->getCampo("funid");
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$funcionario = $generic->construir($res,'classDTO');
			}else{
				$funcionario = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcionario = NULL;
		}
		return $funcionario;
	}	
	
	function buscarHorario($funcionario){	
		$horarios = array();
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "select *,
					(select funintintervaloconsulta from funcionariointervalo
					where funintunidade = ".$funcionario->getCampo("fununidadeselecionada")." and 
					funintfuncionario = ".$funcionario->getCampo("funid")." and
					funespecialidade = ".$funcionario->getCampo("funespecialidade").") 
					as funintintervaloconsulta 
					from funcionariohorario
					where funfuncionario = ".$funcionario->getCampo("funid")."
					and fununidade = ".$funcionario->getCampo("fununidadeselecionada")."
					and funespecialidade = ".$funcionario->getCampo("funespecialidade")."
					order by funid";
					
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$horario = $generic->construir($res,'classDTO');
					$horarios[$i] = $horario;						
				}
			}else{
				$horarios = NULL;
			}
			$BD->fecharConexao();
		}else{
			$horarios = NULL;
		}
		return $horarios;
	}	
	
	function listarFuncionariosComFuncao($bloqueado = ''){	
			$funcionarios = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select a.*, b.*, c.*, d.*, e.*, f.funnome as funcnome
					 from funcionario as a
					 inner join cidades as b on (a.funcidade = b.cidid)
					 inner join estados as c on (b.cidestado = c.estid)
					 inner join usuario as d on (a.funid = d.usufuncionario) 
					 inner join unidade as e on (a.fununidade = e.uniid) 
					 inner join funcao as f on (f.funid = a.funfuncao) ";
					 
				if ($bloqueado != ''){
					$sql.= " where a.funbloqueado = '".$bloqueado."'";
				}
				$sql.= " order by a.funnome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$funcionario = $generic->construir($res,'classDTO');
						$funcionarios[$i] = $funcionario;						
					}
				}else{
					$funcionarios = NULL;
				}
				$BD->fecharConexao();
			}else{
				$funcionarios = NULL;
			}
			return $funcionarios;
		}
		
	function listar(){	
			$funcionarios = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from funcionario ";
				$sql.= " inner join usuario on (funid = usuidfuncionariomedico)";
				$sql.= " where usuperfil not in('M','F') ";
				$sql.= " order by funnome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$funcionario = $generic->construir($res,'classDTO');
						$funcionarios[$i] = $funcionario;						
					}
				}else{
					$funcionarios = NULL;
				}
				$BD->fecharConexao();
			}else{
				$funcionarios = NULL;
			}
			return $funcionarios;
		}
		
	function listarMedicos(){	
		$funcionarios = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL16_;
			$sql.= " where funfuncao = 1 order by funnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$funcionario = $generic->construir($res,'classDTO');
					$funcionarios[$i] = $funcionario;						
				}
			}else{
				$funcionarios = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcionarios = NULL;
		}
		return $funcionarios;
	}

	function listarMedicosUnidade($unidade){	
		$funcionarios = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL16_;
			$sql.= " where funfuncao = 1 order by funnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$funcionario = $generic->construir($res,'classDTO');
					$funcionarios[$i] = $funcionario;						
				}
			}else{
				$funcionarios = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcionarios = NULL;
		}
		return $funcionarios;
	}
	
	function buscar($funcionario){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from funcionario ";
			$sql.= " inner join usuario on (funid = usuidfuncionariomedico)";
			$sql.= " where usuperfil not in('M','F') ";
			$sql.= " and funid = ".$funcionario->getCampo("funid");			
			$sql.= " order by funnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$funcionario = $generic->construir($res,'classDTO');
			}else{
				$funcionario = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcionario = NULL;
		}
		return $funcionario;
	}		
	function buscarUsuario($funcionario){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from usuario 
					left join funcionario on (funid = usuidfuncionariomedico) 
					left join medico on (medid = usuidfuncionariomedico) ";
			$sql.= " where usuperfil = '".$funcionario->getCampo("usuperfil")."'";
			$sql.= " and usuidfuncionariomedico = ".$funcionario->getCampo("usuidfuncionariomedico");						
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$funcionario = $generic->construir($res,'classDTO');
			}else{
				$funcionario = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcionario = NULL;
		}
		return $funcionario;
	}	
	function atualizarHorarioIntervalo($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL35_;
			$sql.= " funintintervaloconsulta  = ".$funcionario->getCampo("funintervadoconsulta");
			$sql.= " where funintfuncionario = ".$funcionario->getCampo("funid");	
			$sql.= " and funintunidade = ".$funcionario->getCampo("fununidadeselecionada");
			$sql.= " and funespecialidade = ".$funcionario->getCampo("funespespecialidade");
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function gravarHorarioIntervalo($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL30_;
			$sql.= "(NULL, ".$funcionario->getCampo("fununidadeselecionada");
			$sql.= ",".$funcionario->getCampo("funid");	
			$sql.= ",".$funcionario->getCampo("funintervadoconsulta");
			$sql.= ",".$funcionario->getCampo("funespespecialidade").")";	
echo $sql;			
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	
	function atualizarHorario($funcionario,$campoentrada,$camposaida,$diasemana){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			if($funcionario->getCampo("$campoentrada")){
				$sql = _SQL23_;
				$sql.= "(NULL, '".$funcionario->getCampo("$campoentrada")."',";
				$sql.= "'".$funcionario->getCampo("$camposaida")."'";						
				$sql.= ",'".$diasemana."', ".$funcionario->getCampo("funid");
				$sql.= ",".$funcionario->getCampo("fununidadeselecionada");				
				$sql.= ",".$funcionario->getCampo("funespespecialidade").")";	
				echo $sql;
				$res = $BD->executarSQL($sql);
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	
	function buscarEspecialidade($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL32_;
			$sql.= " where funespfuncionario = ".$funcionario->getCampo("funid");
			$sql.= " and fununidade = ".$funcionario->getCampo("fununidadeselecionada");			
			$sql.= " and funespespecialidade = ".$funcionario->getCampo("funespespecialidade");			
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
			if ($BD->qtdeLinhas($res) > 0){
				return true;
			}

		}
		return false;
	}
	
	function gravarEspecialidade($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL33_;
			$sql.= "(NULL, ".$funcionario->getCampo("funid");
			$sql.= ",".$funcionario->getCampo("funespespecialidade");	
			$sql.= ",".$funcionario->getCampo("fununidadeselecionada").")";
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	
	function deletarEspecialidade($funcionario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL34_;
			$sql.= " where funespfuncionario = ".$funcionario->getCampo("funid");
			$sql.= " and fununidade = ".$funcionario->getCampo("fununidadeselecionada");			
			$sql.= " and funespespecialidade = ".$funcionario->getCampo("funespespecialidade");						
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	
	function buscarDiasTrabalhoSemana($funid,$fununidade,$funespecialidade){
		//monta um array com os horarios do médico
		$horariosmedico = array();
		
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL37_;
			$sql.= " WHERE a.funfuncionario = ".$funid;
			$sql.= " and a.fununidade = ".$fununidade;
			$sql.= " and a.funespecialidade = ".$funespecialidade;
			$res = $BD->executarSQL($sql);
			$i = 0;
			while ($linha=mysql_fetch_array($res)){
				$horariosmedico[$i] = $linha['funhorariodia'];
				$i++;
			}	
			
			$BD->fecharConexao();
		}
		return $horariosmedico;
	}	
	
		function buscarHorariosAtendimento($diadasemana,$funid,$data,$fununidade,$funespecialidade,$pacid,$addagenda){
			//monta um array com os horarios do médico
			$horarioentrada = array();
			$horariosaida = array();
			$tempoconsulta;
			$dados = '<table class="tabelaHorizontal">
						<tr>
							<td width="100%" colspan="2">
							<table class="tabelaVertical">
							<tr>
								<th width="30%">Hor&aacute;rio</th>
								<th width="55%">Paciente</th>
								<th width="15%">A&ccedil;&otilde;es</th>
							</tr>
					';
			$BD = new classBD();
			if ($BD->conectar()){
				//busca todos os horários do médico				
				$sql = "SELECT funhorarioent, funhorariosai,
						(
						select funintintervaloconsulta from funcionariointervalo
						where funintunidade = ".$fununidade." and funintfuncionario = ".$funid." 
						and funespecialidade = ".$funespecialidade."
						) as funintervadoconsulta
						FROM funcionariohorario
						where funfuncionario = ".$funid." and funhorariodia = '".$diadasemana."' 
						and fununidade = ".$fununidade." and funespecialidade = ".$funespecialidade." 
						order by funhorarioent";
				$res = $BD->executarSQL($sql);
				$i = 0;
				while ($linha=mysql_fetch_array($res)){
					$horarioentrada[$i] = $linha['funhorarioent'];
					$horariosaida[$i] = $linha['funhorariosai'];					
					$tempoconsulta = $linha['funintervadoconsulta'];					
					$i++;
				}	

				//busca todas as consultas do médico naquela data
				$horariomarcados = array();
				$pacientes = array();
				$idconsultas = array();
				$sql = _SQL39_;
				$sql.= " where d.funid = ".$funid." and DATE_FORMAT(a.agedatahora, '%d/%m/%Y') = '".$data."' ";
				$sql.= " and a.ageunidade = ".$fununidade." and a.ageespecialidade = ".$funespecialidade;
				$sql.= " order by a.agedatahora,a.ageid";
				$res = $BD->executarSQL($sql);
				$i = 0;
				while ($linha=mysql_fetch_array($res)){
					$horariomarcados[$i] = $linha['agehora'];
					$pacientes[$i] = $linha['pacnome'];	
					$idconsultas[$i] = $linha['ageid'];
					$idunidades[$i] = $linha['ageunidade'];
					$idespecialidades[$i] = $linha['ageespecialidade'];
					$idfuncionarios[$i] = $linha['agefuncionario'];
					$idpacientes[$i] = $linha['pacid'];
					$i++;
				}	
				
				$BD->fecharConexao();
				$vezes = 0;	
				$checked = "";
				for ($i=0;$i<count($horarioentrada);$i++){
					//calcula os segundos da entrada
					$entrada = explode(":",$horarioentrada[$i]);
					$hor_ent = $entrada[0];
					$min_ent = $entrada[1];
					$seg_ent = $entrada[2];
					
					$minutos_ent = $hor_ent * 60;
					$minutos_ent = $minutos_ent + $min_ent;
					$segundos_ent = $minutos_ent * 60;
					$segundos_ent = $segundos_ent + $seg_ent;
					
					//calcula os segundos da saída
					$saida = explode(":",$horariosaida[$i]);
					$hor_sai = $saida[0];
					$min_sai = $saida[1];
					$seg_sai = $saida[2];
					
					$minutos_sai = $hor_sai * 60;
					$minutos_sai = $minutos_sai + $min_sai;
					$segundos_sai = $minutos_sai * 60;
					$segundos_sai = $segundos_sai + $seg_sai;					
					
					$cor = "#FFFFFF";
					while ($segundos_ent < $segundos_sai){
						$horarioexibicaoentrada = floor(($segundos_ent / 3600));
						$horarioexibicaosaida = floor((($segundos_ent + ($tempoconsulta * 60)) / 3600));
						$horamarcacao = $horarioexibicaoentrada.":".(($segundos_ent / 60)%60);
						$abre = true;
						$h = $horarioexibicaoentrada.":".(($segundos_ent / 60)%60);						
						$tdpaciente = "<td width='50%'>&nbsp;</td>
									   <td width='15%'>";
						if($addagenda == 'sim'){
							$tdpaciente.= "<a href=javascript:adicionarAgenda('agendarconsulta','".$data."','".$h."'); title='Marcar consulta' ><center><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></center></a>";
						}	
						$tdpaciente.= "</td>";
					    for ($l=0;$l<count($horariomarcados);$l++){
							$horamarcacaodividido = explode(":",$horamarcacao);
							$horariomarcadosdividido = explode(":",$horariomarcados[$l]);
							//verifica se há paciente naquela hora e minuto
							if ((floor($horamarcacaodividido[0]) == floor($horariomarcadosdividido[0])) && (floor($horamarcacaodividido[1]) == floor($horariomarcadosdividido[1]))){
								$abre = false;	
								$tdpaciente = "<td width='50%'>";
								if (is_array($pacientes)){
									$links = "";
									for($co = 0; $co < count($pacientes); $co++){
										if ($horariomarcados[$l] == $horariomarcados[$co]){
											$tdpaciente.= $pacientes[$co];
											if(($co+1) < count($pacientes)){
												$tdpaciente.= "<hr size='1'>";
											}
											$links.= "<center>";
											if($addagenda == 'sim'){
												$links.= "<a href=javascript:adicionarAgenda('encaixarconsulta','".$data."','".$h."'); title='Encaixar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;";
											}
											$links.="<a href=javascript:openmypage(".$idconsultas[$co].");><img src='../imagens/editagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;";
											$links.= "<a href=javascript:removerConsulta(".$idconsultas[$co].",'".$data."',".$funid.",".$fununidade.",".$funespecialidade."); title='Excluir consulta de ".$pacientes[$co]."'><img src='../imagens/deleteagenda.png' border='0' width='20' height='20' /></a></center><br/>";										
										}
									}
								}else{
									$tdpaciente.= $pacientes;
									$links = "<center><a href=javascript:adicionarAgenda('encaixarconsulta','".$data."','".$h."'); title='Encaixar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href=javascript:removerConsulta(".$idconsultas[$l].",'".$data."',".$funid.",".$fununidade.",".$funespecialidade."); title='Excluir consulta'><img src='../imagens/deleteagenda.png' border='0' width='20' height='20' /></center></a>";
								}								
								$tdpaciente.= "</td>
											   <td width='15%'>".$links."</td>";
								
							}
						}

						if ($cor == "#FFFFFF"){
							$dados.= "<tr bgcolor='#FFFFFF'>";
							$cor = "#F4F4F4";
						}else{
							$dados.= "<tr bgcolor='#F4F4F4'>";							
							$cor = "#FFFFFF";							
						}
/*						
						$dados.= "<td width='5%'>";
												
						if ($abre){
							if($vezes == 0){
								$checked = "checked";
								$vezes = 1;
							}else{
								$checked = "";
							}
							$h = $horarioexibicaoentrada.":".(($segundos_ent / 60)%60);
							$dados.= "<input type='radio' name='horario' id='horario' value='".$h."' ".$checked." onclick=selecionarHorario(this); />";
						}else{
							$dados.= "<input type='radio' value='' name='horario' id='horario' disabled='disabled' />";							
						}
						$dados.= "</td>";
*/						
						$dados.= "<td width='30%'>";
						$dados.= "Das ".$horarioexibicaoentrada."h e ".(($segundos_ent / 60)%60)."min às ";
						$dados.= $horarioexibicaosaida."h e ".((($segundos_ent + ($tempoconsulta * 60)) / 60)%60)."min";
						$dados.= "</td>";
					
						$dados.= $tdpaciente;
//						$dados.= "<td width='40%'>".$pacientes[$i]."</td>";
//						$dados.= "<td width='10%'></td>";
						$dados.= "</tr>";												
						$segundos_ent = $segundos_ent + ($tempoconsulta * 60);
					}
				}
			}
			$dados.= '  	</td>
						</tr>										
					</table>';
			return $dados;
		}	
}		

?>