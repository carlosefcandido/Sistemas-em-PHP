<?php

class classEstadoDAO
{
	function listar(){	
		$estados = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL5_;
			$sql.= " order by estuf";
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