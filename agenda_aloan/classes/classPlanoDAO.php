<?php

class classPlanoDAO
{
	
		function buscarPlanoConvenio($plano){	
			$planos = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from convenio ";
				$sql.= "left join convenioplano on (conid = conplaconvenio)";
				$sql.= "where conid = ".$plano->getCampo("conid");
				$sql.= " order by connome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$plano = $generic->construir($res,'classDTO');
						$planos[$i] = $plano;						
					}
				}else{
					$planos = NULL;
				}
				$BD->fecharConexao();
			}else{
				$planos = NULL;
			}
			return $planos;
		}
		function listar(){	
			$planos = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from convenio ";
				$sql.= " order by connome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$plano = $generic->construir($res,'classDTO');
						$planos[$i] = $plano;						
					}
				}else{
					$planos = NULL;
				}
				$BD->fecharConexao();
			}else{
				$planos = NULL;
			}
			return $planos;
		}
		function buscar($plano){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from convenio ";
				$sql.= " where conid = ".$plano->getCampo("conid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$plano = $generic->construir($res,'classDTO');
				}else{
					$plano = NULL;
				}
				$BD->fecharConexao();
			}else{
				$plano = NULL;
			}
			return $plano;
		}		
		
	function deletarPlanoConvenio($plano){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from convenioplano";
			$sql.= " where conplaid = ".$plano->getCampo("conplaid");
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

	function atualizar($plano){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update convenio set ";
			$sql.= " conminimodiaretorno = ".$plano->getCampo("conminimodiaretorno");
			$sql.= ", conmaximoatendimento = ".$plano->getCampo("conmaximoatendimento");
			$sql.= " where conid = ".$plano->getCampo("conid");
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
	
	function updatePlanoConvenio($plano){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update convenioplano set ";
			$sql.= "conplanome = '".$plano->getCampo("conplanome")."'";
			if ($plano->getCampo("conplaminimodiaretorno") != NULL){
				$sql.= ",conplaminimodiaretorno  = ".$plano->getCampo("conplaminimodiaretorno");
			}
			if ($plano->getCampo("conplamaximoatendimento") != NULL){
				$sql.= ",conplamaximoatendimento = ".$plano->getCampo("conplamaximoatendimento");
			}
			$sql.= " where conplaid = ".$plano->getCampo("conplaid");
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

	function gravarPlanoConvenio($plano){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "INSERT INTO convenioplano(
					conplaid,conplaconvenio,conplanome,conplaminimodiaretorno,conplamaximoatendimento) VALUES (
					NULL, ";					
			$sql.= "'".$plano->getCampo("conid")."'";
			$sql.= ",'".$plano->getCampo("conplanome")."'";
			if ($plano->getCampo("conplaminimodiaretorno") != NULL){
				$sql.= ",".$plano->getCampo("conplaminimodiaretorno");
			}else{
				$sql.= ",NULL";
			}
			if ($plano->getCampo("conplamaximoatendimento") != NULL){
				$sql.= ",".$plano->getCampo("conplamaximoatendimento");
			}else{
				$sql.= ",NULL";
			}
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
	
		function buscarConvenioPlano($plano){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from convenioplano ";
				$sql.= " where conplaid = ".$plano->getCampo("conplaid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$convenio = $generic->construir($res,'classDTO');
				}else{
					$convenio = NULL;
				}
				$BD->fecharConexao();
			}else{
				$convenio = NULL;
			}
			return $convenio;
		}	
		
		function listarConvenioPlano(){	
			$planos = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from convenioplano ";
				$sql.= " order by conplanome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$plano = $generic->construir($res,'classDTO');
						$planos[$i] = $plano;						
					}
				}else{
					$planos = NULL;
				}
				$BD->fecharConexao();
			}else{
				$planos = NULL;
			}
			return $planos;
		}
		
}		

?>