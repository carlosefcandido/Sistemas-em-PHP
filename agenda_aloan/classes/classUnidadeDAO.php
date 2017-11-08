<?php

class classUnidadeDAO
{
	
		function listar($bloqueada = ''){	
			$unidades = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL10_;
				if($bloqueada != ''){
					$sql.= "where unibloqueado = '".$bloqueada."' ";
				}
				$sql.= " order by uninome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$unidade = $generic->construir($res,'classDTO');
						$unidades[$i] = $unidade;						
					}
				}else{
					$unidades = NULL;
				}
				$BD->fecharConexao();
			}else{
				$unidades = NULL;
			}
			return $unidades;
		}
		function buscar($unidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL10_;
				$sql.= " where uniid = ".$unidade->getCampo("uniid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$unidade = $generic->construir($res,'classDTO');
				}else{
					$unidade = NULL;
				}
				$BD->fecharConexao();
			}else{
				$unidade = NULL;
			}
			return $unidade;
		}		
		function alterar($unidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL11_;
				$sql.= " uninome = '".$unidade->getCampo("uninome")."'";
				$sql.= ",uniendereco = '".$unidade->getCampo("uniendereco")."'";
				$sql.= ",uninumero = ".$unidade->getCampo("uninumero");
				$sql.= ",unicomplemento = '".$unidade->getCampo("unicomplemento")."'";
				$sql.= ",unibairro = '".$unidade->getCampo("unibairro")."'";
				$sql.= ",unitelefone1 = '".$unidade->getCampo("unitelefone1")."'";
				$sql.= ",unitelefone2 = '".$unidade->getCampo("unitelefone2")."'";
				$sql.= ",unitelefone3 = '".$unidade->getCampo("unitelefone3")."'";				
				$sql.= ",unicep = '".$unidade->getCampo("unicep")."'";
				$sql.= ",unicidade = ".$unidade->getCampo("unicidade");
				$sql.= " where uniid = ".$unidade->getCampo("uniid");
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
		function deletar($unidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL12_;
				$sql.= " where uniid = ".$unidade->getCampo("uniid");
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
		function bloquear($unidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL11_;
				$sql.= " unibloqueado = '".$unidade->getCampo("unibloqueado")."'";
				$sql.= " where uniid = ".$unidade->getCampo("uniid");
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
		function gravar($unidade){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL9_;
				$sql.= " (NULL,".$unidade->getCampo("uniclinica").",'".$unidade->getCampo("uninome")."'";
				$sql.= ",'".$unidade->getCampo("uniendereco")."'";
				$sql.= ",".$unidade->getCampo("uninumero");
				$sql.= ",'".$unidade->getCampo("unicomplemento")."'";
				$sql.= ",'".$unidade->getCampo("unibairro")."'";
				$sql.= ",'".$unidade->getCampo("unitelefone1")."'";
				$sql.= ",'".$unidade->getCampo("unitelefone2")."'";
				$sql.= ",'".$unidade->getCampo("unitelefone3")."'";				
				$sql.= ",'".$unidade->getCampo("unicep")."'";
				$sql.= ",".$unidade->getCampo("unicidade");
				$sql.= ",'N')";
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