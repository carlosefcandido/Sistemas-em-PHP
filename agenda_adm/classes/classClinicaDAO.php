<?php

class classClinicaDAO
{
	
		function listar(){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL3_;
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$clinica = $generic->construir($res,'classDTO');
				}else{
					$clinica = NULL;
				}
				$BD->fecharConexao();
			}else{
				$clinica = NULL;
			}
			return $clinica;
		}
		function alterar($clinica){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL6_;
				$sql.= " clinome = '".$clinica->getCampo("clinome")."'";
				$sql.= ",cliendereco = '".$clinica->getCampo("cliendereco")."'";
				$sql.= ",clinumero = ".$clinica->getCampo("clinumero");
				$sql.= ",clicomplemento = '".$clinica->getCampo("clicomplemento")."'";
				$sql.= ",clibairro = '".$clinica->getCampo("clibairro")."'";
				$sql.= ",clitelefone1 = '".$clinica->getCampo("clitelefone1")."'";
				$sql.= ",clitelefone2 = '".$clinica->getCampo("clitelefone2")."'";
				$sql.= ",clitelefone3 = '".$clinica->getCampo("clitelefone3")."'";				
				$sql.= ",clicep = '".$clinica->getCampo("clicep")."'";
				$sql.= ",clicidade = ".$clinica->getCampo("clicidade");
				$sql.= " where cliid = ".$clinica->getCampo("cliid");
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

		function gravar($clinica){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL7_;
				$sql.= " (NULL,'".$clinica->getCampo("clinome")."'";
				$sql.= ",'".$clinica->getCampo("cliendereco")."'";
				$sql.= ",".$clinica->getCampo("clinumero");
				$sql.= ",'".$clinica->getCampo("clicomplemento")."'";
				$sql.= ",'".$clinica->getCampo("clibairro")."'";
				$sql.= ",'".$clinica->getCampo("clitelefone1")."'";
				$sql.= ",'".$clinica->getCampo("clitelefone2")."'";
				$sql.= ",'".$clinica->getCampo("clitelefone3")."'";				
				$sql.= ",'".$clinica->getCampo("clicep")."'";
				$sql.= ",".$clinica->getCampo("clicidade");
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
}		

?>