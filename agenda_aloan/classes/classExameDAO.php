<?php

class classExameDAO
{
	
		function listar(){	
			$exames = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from exame ";
				$sql.= " order by exanome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$exame = $generic->construir($res,'classDTO');
						$exames[$i] = $exame;						
					}
				}else{
					$exames = NULL;
				}
				$BD->fecharConexao();
			}else{
				$exames = NULL;
			}
			return $exames;
		}
		function buscar($exame){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from exame ";
				$sql.= " where exaid = ".$exame->getCampo("exaid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$exame = $generic->construir($res,'classDTO');
				}else{
					$exame = NULL;
				}
				$BD->fecharConexao();
			}else{
				$exame = NULL;
			}
			return $exame;
		}		
		
		function listarPorEspecialidade($especialidade){	
			$exames = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from exame ";
				$sql.= " inner join especialidadeexame on (exaid = espexaexame) ";
				$sql.= " where espexaespecialidade = ".$especialidade;
				$sql.= " order by exanome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$exame = $generic->construir($res,'classDTO');
						$exames[$i] = $exame;						
					}
				}else{
					$exames = NULL;
				}
				$BD->fecharConexao();
			}else{
				$exames = NULL;
			}
			return $exames;
		}
		function listarPorMedico($medico){	
			$exames = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from exame
						inner join medicoexame on (medexaexame = exaid)
						inner join medico on (medexamedico = medid) ";
				$sql.= " where medid = ".$medico;
				$sql.= " order by exanome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$exame = $generic->construir($res,'classDTO');
						$exames[$i] = $exame;						
					}
				}else{
					$exames = NULL;
				}
				$BD->fecharConexao();
			}else{
				$exames = NULL;
			}
			return $exames;
		}		
	function gravar($exame){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "insert into exame values ";
			$sql.= " (NULL,'".$exame->getCampo("exanome")."'";
			if($exame->getCampo("exarecomendacao") != NULL){
				$sql.= ",'".$exame->getCampo("exarecomendacao")."')";
			}else{
				$sql.= ",NULL)";
			}
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
	function alterar($exame){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "update exame set ";
			$sql.= " exanome = '".$exame->getCampo("exanome")."'";
			if($exame->getCampo("exarecomendacao") != NULL){
				$sql.= ", exarecomendacao = '".$exame->getCampo("exarecomendacao")."'";
			}else{
				$sql.= ", exarecomendacao = NULL";
			}
			$sql.= " where exaid = ".$exame->getCampo("exaid");
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
	function excluir($exame){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "delete from exame ";
			$sql.= " where exaid = ".$exame->getCampo("exaid");
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
}		

?>