<?php

class classEspecialidadeDAO
{
	
		function listar($tipo = '',$funid = '', $uniid = ''){	
			$especialidades = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from especialidade ";
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
		function buscar($especialidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL31_;
				$sql.= " where espid = ".$especialidade->getCampo("espid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$especialidade = $generic->construir($res,'classDTO');
				}else{
					$especialidade = NULL;
				}
				$BD->fecharConexao();
			}else{
				$especialidade = NULL;
			}
			return $especialidade;
		}

		function buscarComExames($especialidade){	
			$especialidades = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL31_;
				$sql.= "left join especialidadeexame on (espid = espexaespecialidade) ";
				$sql.= "left join exame on (espexaexame = exaid) ";
				$sql.= " where espid = ".$especialidade->getCampo("espid");
				$sql.= " order by exanome ";
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

		function gravarEspecialiadeExame($especialidade){	
			$BD = new classBD();
			$erros = NULL;
			if ($BD->conectar()){
				$sql = "insert into especialidadeexame values (";
				$sql.= "NULL";
				$sql.= ",".$especialidade->getCampo("espexaespecialidade");
				$sql.= ",".$especialidade->getCampo("espexaexame");
				$sql.= ")";
				$res = $BD->executarSQL($sql);
				if ($res > 0){
					$erros = NULL;
				}else{
						$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
				}
			}else{
				$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
			}
			return $erro;
		}
		function deletarEspecialidadeExame($especialidade){	
			$BD = new classBD();
			$erros = NULL;
			if ($BD->conectar()){
				$sql = "delete from especialidadeexame ";
				$sql.= " where espexaespecialidade = ".$especialidade->getCampo("espexaespecialidade");
				$res = $BD->executarSQL($sql);
				if ($res > 0){
					$erros = NULL;
				}else{
						$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
				}
			}else{
				$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
			}
			return $erro;
		}		
		
}		

?>