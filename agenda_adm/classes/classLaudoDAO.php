<?php

class classLaudoDAO
{
	
	function logar($usuario){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from ";
			$sql.= " where usulogin = '".$usuario->getCampo("login")."' ";
			$sql.= " and ususenha = '".$usuario->getCampo("senha")."' ";				
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$usuario = $generic->construir($res,'classDTO');
				session_start();
				$_SESSION['USUARIO'] = $usuario;

				$msg = _MSGOK_;
				$msg.= " | ";		
				$msg.= "./Laudo/";
			}else{
				$msg = _MSGERRO_;
				$msg.= " | ";	
				$msg.= _MSG0_;				
			}
			$BD->fecharConexao();
		}else{
			$msg = _MSGERRO_;
			$msg.= " | ";
			$msg.= _MSG6_;
		}
		return $msg;
	}
	
	function gravar($hospital){	
		$erro = NULL;
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "insert into laudo values (NULL,";
			$sql.= "'".$hospital."' ";
			$sql.= ",NOW())";				
			$res = $BD->executarSQL($sql);
			if ($res < 1){
				$erro = "Erro na execução da SQL;";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na conexão com o banco de dados.";
		}
		return $msg;
	}	
}		

?>