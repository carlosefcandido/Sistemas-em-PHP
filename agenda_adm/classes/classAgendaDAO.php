<?php

class classAgendaDAO
{
	
		function listar(){	
			$especialidades = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL31_;
				if(($tipo == 'excluir') || ($tipo == 'horario') || ($tipo == 'agenda')){
					$sql.= "inner join funcionarioespecialidade on (espid = funespespecialidade) ";
					$sql.= " where funespfuncionario = ".$funid." and fununidade = ".$uniid;
				}
				$sql.= " order by espnome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$especialidade = $generic->construir($res,'classDTO');
						$especialidades[$i] = $especialidade;						
					}
				}else{
					$especialidades = NULL;
				}
				$BD->fecharConexao();
			}else{
				$especialidades = NULL;
			}
			return $especialidades;
		}
		function buscar($consulta){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from marcacao ";
				$sql.= " where marid = ".$consulta->getCampo("marid");								
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$consulta = $generic->construir($res,'classDTO');
				}else{
					$consulta = NULL;
				}
				$BD->fecharConexao();
			}else{
				$consulta = NULL;
			}
			return $consulta;
		}
		
		function buscarAgenda($consulta){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from marcacao ";
				$sql.= " where marmedico = ".$consulta->getCampo("medid");
				$sql.= " and DATE_FORMAT( mardatahora,  '%d/%m/%Y' ) = '".$consulta->getCampo("agedata")."'";				
				$sql.= " and DATE_FORMAT( mardatahora,  '%H:%i' ) = '".$consulta->getCampo("agehora")."'";								
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$consulta = $generic->construir($res,'classDTO');
				}else{
					$consulta = NULL;
				}
				$BD->fecharConexao();
			}else{
				$consulta = NULL;
			}
			return $consulta;
		}
		
		function gravar($consulta){	
			$erro = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				session_start();
				$sql = "insert into marcacao values ";
				$sql.= " (NULL,'".formatarDataBD($consulta->getCampo("agedata"))." ".$consulta->getCampo("agehora")."'";
				$sql.= ",".$consulta->getCampo("pacid");
				$sql.= ",".$consulta->getCampo("medid");
				$sql.= ",'".$consulta->getCampo("agetipomarcacao")."'";
				$sql.= ",".$consulta->getCampo("pacconvenioplano").",NOW()";				
				if($consulta->getCampo("exame") != NULL){
					$sql.= ",".$consulta->getCampo("exame");
				}else{
					$sql.= ",NULL";
				}
				if($consulta->getCampo("obs") != NULL){
					$sql.= ",'".$consulta->getCampo("obs")."')";
				}else{
					$sql.= ",NULL)";						
				}				
				
				$res = $BD->executarSQL($sql);
				if ($res < 1){
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
				}
				$BD->fecharConexao();
			}else{
				$erro = "Erro na conex&atilde;o com o Banco de Dados.";
			}
			return $erro;
		}
		
		function atualizar($consulta){	
			$erro = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				session_start();
				$sql = "update marcacao set ";
				$sql.= " mardatahora = '".formatarDataBD($consulta->getCampo("agedata"))." ".$consulta->getCampo("agehora")."'";
				$sql.= ",marmedico = ".$consulta->getCampo("medid");
				$sql.= ",marordem = NOW()";
				$sql.= " where marid = ".$consulta->getCampo("marid");				
				$res = $BD->executarSQL($sql);
				if ($res < 1){
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
				}
				$BD->fecharConexao();
			}else{
				$erro = "Erro na conex&atilde;o com o Banco de Dados.";
			}
			return $erro;
		}
		
		function deletar($consulta){	
			$erro = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				session_start();
				$sql = "delete from marcacao ";
				$sql.= " where marid = ".$consulta->getCampo("marid");
				$res = $BD->executarSQL($sql);
				if ($res < 1){
					$erro = "ERRO | Erro na execução da SQL.";
				}else{
					$erro = "OK | Consulta excluída com sucesso.";
				}
				$BD->fecharConexao();
			}else{
				$erro = "ERRO | Erro na conexão com o Banco de Dados.";
			}
			return $erro;
		}
		function excluir($consulta){	
			$erro = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				session_start();
				$sql = "delete from marcacao ";
				$sql.= " where marid = ".$consulta->getCampo("marid");
				$res = $BD->executarSQL($sql);
				if ($res < 1){
					$erro = "Erro na execução da SQL.";
				}
				$BD->fecharConexao();
			}else{
				$erro = "Erro na conexão com o Banco de Dados.";
			}
			return $erro;
		}		
		function listarRelatorio($filtro){	
			$and = " and ";
			$entrou = 0;
			$consultas = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "SELECT DATE_FORMAT(a.mardatahora, '%d/%m/%Y') as agedata, 
				DATE_FORMAT(a.mardatahora, '%H:%i') as agehora,b.pacid,b.pacnome,c.connome,f.mednome,
				f.medid,a.marid, b.pactelefone, b.paccelular,h.espnome
				FROM marcacao as a 
				inner join paciente as b on (a.marpaciente = b.pacid) 
				inner join convenio as c on (b.pacconvenio = c.conid) 
				inner join medico as f on (f.medid = a.marmedico) 
				inner join medicoespecialidade as g on (g.medespmedico = f.medid) 
				inner join especialidade as h on (g.medespespecialidade = h.espid)
				";
				
				if(($filtro->getCampo("funfuncionario")) || ($filtro->getCampo("fununidade")) ||
				($filtro->getCampo("funespecialidade")) || ($filtro->getCampo("dataini")) ||
				($filtro->getCampo("datafim"))){
					$sql.= " where ";
				}
				
				if($filtro->getCampo("funfuncionario")){
					$entrou = 1;
					$sql.= " medid = ".$filtro->getCampo("funfuncionario");
				}
				if($filtro->getCampo("fununidade")){
					if($entrou == 1){
						$sql.= " and ageunidade = ".$filtro->getCampo("fununidade");
					}else{
						$entrou = 1;
						$sql.= " ageunidade = ".$filtro->getCampo("fununidade");
					}
				}
				if($filtro->getCampo("funespecialidade")){
					if($entrou == 1){
						$sql.= " and espid = ".$filtro->getCampo("funespecialidade");
					}else{
						$entrou = 1;
						$sql.= " espid = ".$filtro->getCampo("funespecialidade");
					}
				}		
				if(($filtro->getCampo("dataini")) && ($filtro->getCampo("datafim"))){
						if($entrou == 1){
							$sql.= " and DATE_FORMAT(a.mardatahora, '%d/%m/%Y') BETWEEN '".$filtro->getCampo("dataini")."' and '".$filtro->getCampo("datafim")."'";
						}else{
							$entrou = 1;
							$sql.= " DATE_FORMAT(a.mardatahora, '%d/%m/%Y') BETWEEN '".$filtro->getCampo("dataini")."' and '".$filtro->getCampo("datafim")."'";
						}								
				}else{
					if($filtro->getCampo("dataini")){
						if($entrou == 1){
							$sql.= " and DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$filtro->getCampo("dataini")."'";
						}else{
							$entrou = 1;
							$sql.= " DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$filtro->getCampo("dataini")."'";
						}				
					}
					if($filtro->getCampo("datafim")){
						if($entrou == 1){
							$sql.= " and DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$filtro->getCampo("datafim")."'";
						}else{
							$entrou = 1;
							$sql.= " DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$filtro->getCampo("datafim")."'";
						}
					}				
				}
				$sql.= " order by a.marmedico,a.mardatahora";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$consulta = $generic->construir($res,'classDTO');
						$consultas[$i] = $consulta;						
					}
				}else{
					$consultas = NULL;
				}
				$BD->fecharConexao();
			}else{
				$consultas = NULL;
			}
			return $consultas;
		}	
		function buscarQtdeAtendimentoPorPlano($agenda){	
			$BD = new classBD();
			if ($BD->conectar()){
				$data = explode("/",$agenda->getCampo("agedata"));
				$mes = $data[1];
				$ano = $data[2];
				$dataPesquisa = $mes."/".$ano;
				$sql = "SELECT COUNT( * ) AS totalAtendimentoMes, (
						SELECT conmaximoatendimento
						FROM convenio
						WHERE conid = ".$agenda->getCampo("pacconvenioplano")." 
						) AS qtdeMaximaAtendimento
						from marcacao
						where DATE_FORMAT( mardatahora,  '%m/%Y' ) = '".$dataPesquisa."'
						and marconvenioplano = ".$agenda->getCampo("pacconvenioplano");

				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$qtdeAtendimentosMes = $generic->construir($res,'classDTO');
				}else{
					$qtdeAtendimentosMes = NULL;
				}
				$BD->fecharConexao();
			}else{
				$qtdeAtendimentosMes = NULL;
			}
			return $qtdeAtendimentosMes;
		}
		function buscarUltimaConsultaPaciente($agenda){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "SELECT DATE_FORMAT( mardatahora,  '%d/%m/%Y' ) AS agedata, 
				DATE_FORMAT( mardatahora,  '%H:%i' ) AS agehora, marconvenioplano, 
				conminimodiaretorno as conplaminimodiaretorno, conmaximoatendimento as conplamaximoatendimento, 
				DATEDIFF('".formatarDataBD($agenda->getCampo("agedata"))." ".$agenda->getCampo("agehora")."', mardatahora ) AS diferenca
				FROM marcacao
				INNER JOIN convenio ON ( conid = marconvenioplano ) ";
				$sql.= " where marpaciente = ".$agenda->getCampo("pacid");
				$sql.= " order by marid desc limit 1";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$ultimaConsulta = $generic->construir($res,'classDTO');
				}else{
					$ultimaConsulta = NULL;
				}
				$BD->fecharConexao();
			}else{
				$ultimaConsulta = NULL;
			}
			return $ultimaConsulta;
		}		

		function validarMinimoRetorno($agenda){
			$ultimaConsulta = classAgendaDAO::buscarUltimaConsultaPaciente($agenda);
			$erro = NULL;
			if($ultimaConsulta){
				if(($ultimaConsulta->getCampo("conplaminimodiaretorno") != NULL) && ($ultimaConsulta->getCampo("conplaminimodiaretorno") != 0)){
					if($ultimaConsulta->getCampo("diferenca") < $ultimaConsulta->getCampo("conplaminimodiaretorno")){
						$erro = "-&nbsp;Per&iacute;odo m&iacute;nimo de retorno em consultas n&atilde;o respeitado. Favor marcar a pr&oacute;xima consulta para daqui a ".(($ultimaConsulta->getCampo("conplaminimodiaretorno") - $ultimaConsulta->getCampo("diferenca")) + 1)." dia(s).<br/>";
					}
				}				
			}
			return $erro;
		}
		
		function validarMaximoAtendimentoPorPlano($agenda){
			$erro = NULL;
			$qtdeAtendimentosMesPorPlano = classAgendaDAO::buscarQtdeAtendimentoPorPlano($agenda);
			if($qtdeAtendimentosMesPorPlano){
				if(($qtdeAtendimentosMesPorPlano->getCampo("qtdeMaximaAtendimento") != 0) && ($qtdeAtendimentosMesPorPlano->getCampo("totalAtendimentoMes") >= $qtdeAtendimentosMesPorPlano->getCampo("qtdeMaximaAtendimento"))){
					$erro = "-&nbsp;Quantidade m&aacute;xima de atendimentos por plano j&aacute; atingiu o limite de atendimentos para o mês/ano informado.<br/>";		
				}
			}
			return $erro;
		}	

		function buscarConsultasPaciente($paciente){	
			$consultas = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "SELECT DATE_FORMAT( mardatahora,  '%d/%m/%Y' ) AS agedata, 
				DATE_FORMAT( mardatahora,  '%H:%i' ) AS agehora, pacnome, pacid, pactelefone, paccelular, conplanome, medid, mednome, marid
				FROM marcacao
				INNER JOIN convenioplano ON (conplaid = marconvenioplano)
				INNER JOIN paciente ON (pacid = marpaciente)
				INNER JOIN medico ON (medid = marmedico) 
				INNER JOIN usuario ON (medid = usuidfuncionariomedico) ";
				$sql.= " where marpaciente = ".$paciente->getCampo("pacid");
				$sql.= " and usuperfil = 'M' and usubloqueado = 'N' ";
				$sql.= " order by marid desc";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$consulta = $generic->construir($res,'classDTO');
						$consultas[$i] = $consulta;						
					}
				}else{
					$consultas = NULL;
				}
				$BD->fecharConexao();
			}else{
				$consultas = NULL;
			}
			return $consultas;
		}

		function buscarConsultaPaciente($consulta){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "SELECT DATE_FORMAT( mardatahora,  '%d/%m/%Y' ) AS agedata, 
				DATE_FORMAT( mardatahora,  '%H:%i' ) AS agehora, pacnome, pacid, pactelefone, paccelular, conplanome, medid, mednome, marid
				FROM marcacao
				INNER JOIN convenioplano ON (conplaid = marconvenioplano)
				INNER JOIN paciente ON (pacid = marpaciente)
				INNER JOIN medico ON (medid = marmedico) 
				INNER JOIN usuario ON (medid = usuidfuncionariomedico) ";
				$sql.= " where marid = ".$consulta->getCampo("marid");
				$sql.= " and usuperfil = 'M' and usubloqueado = 'N' ";
				$sql.= " order by marid desc";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$consulta = $generic->construir($res,'classDTO');
				}else{
					$consulta = NULL;
				}
				$BD->fecharConexao();
			}else{
				$consulta = NULL;
			}
			return $consulta;
		}		
}		

?>