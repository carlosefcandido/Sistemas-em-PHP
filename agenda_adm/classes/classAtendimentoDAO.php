<?php

class classAtendimentoDAO
{
	
		function confirmarAtendimento($atendimento){	
			$erro = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				session_start();
				$sql = "insert into atendimento values ";
				$sql.= " (NULL,'".formatarDataBD($atendimento->getCampo("agedata"))." ".date("h:i:s")."'";
				$sql.= ",NULL, ".$atendimento->getCampo("pacid");
				$sql.= ",".$atendimento->getCampo("pacconvenioplano");								
				$sql.= ",'".$atendimento->getCampo("pacnumerocartao")."'";
				$sql.= ",".$atendimento->getCampo("medid");
				$sql.= ")";
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
		

}		

?>