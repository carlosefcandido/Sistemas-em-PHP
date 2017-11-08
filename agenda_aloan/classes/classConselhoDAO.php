<?php

class classConselhoDAO
{
	function listar(){	
			$conselhos = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from conselho ";
				$sql.= " order by consesigla";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$conselho = $generic->construir($res,'classDTO');
						$conselhos[$i] = $conselho;						
					}
				}else{
					$conselhos = NULL;
				}
				$BD->fecharConexao();
			}else{
				$conselhos = NULL;
			}
			return $conselhos;
		}
		
}		

?>