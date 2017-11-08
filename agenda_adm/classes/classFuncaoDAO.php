<?php

class classFuncaoDAO
{
	function listar(){	
		$funcoes = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL13_;
			$sql.= " order by funnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$funcao = $generic->construir($res,'classDTO');
					$funcoes[$i] = $funcao;						
				}
			}else{
				$funcoes = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcoes = NULL;
		}
		return $funcoes;
	}
	function buscar($funcao){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL13_;
			$sql.= " where funid = ".$funcao->getCampo("funid");
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$funcao = $generic->construir($res,'classDTO');
			}else{
				$funcao = NULL;
			}
			$BD->fecharConexao();
		}else{
			$funcao = NULL;
		}
		return $funcao;
	}
	
}		

?>