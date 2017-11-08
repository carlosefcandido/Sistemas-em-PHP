<?php

class classCidadeDAO
{
	function listar(){	
		$cidades = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL4_;
			$sql.= " order by cidnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$cidade = $generic->construir($res,'classDTO');
					$cidades[$i] = $cidade;						
				}
			}else{
				$cidades = NULL;
			}
			$BD->fecharConexao();
		}else{
			$cidades = NULL;
		}
		return $cidades;
	}
	function buscar($estado){	
		$estados = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL4_;
			$sql.= " where cidestado = ".$estado;
			$sql.= " order by cidnome";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$estado = $generic->construir($res,'classDTO');
					$estados[$i] = $estado;						
				}
			}else{
				$estados = NULL;
			}
			$BD->fecharConexao();
		}else{
			$estados = NULL;
		}
		return $estados;
	}
	
}		

?>