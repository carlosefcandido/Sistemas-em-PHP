<?php

class classUsuarioDAO
{
	
	function verifyLogin($usuario){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = _SQL1_;
			$sql.= " where usulogin = '".$usuario->getCampo("login")."' ";				
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$erro = "Já existe um usuário com o login informado";
			}
			$BD->fecharConexao();
		}else{
			$erro = "Erro na conexão";
		}
		return $erro;
	}

	function logar($usuario){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL1_;
			$sql.= " where usulogin = '".$usuario->getCampo("login")."' ";
			$sql.= " and ususenha = '".$usuario->getCampo("senha")."' ";				
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$usuario = $generic->construir($res,'classDTO');
				session_start();
				$_SESSION['USUARIO'] = $usuario;
				$_SESSION['MODULO'] = 'agenda';

				if ($usuario->getCampo("usubloqueado") == 'S'){
					$msg = _MSGERRO_;
					$msg.= " | ";	
					$msg.= _MSG0_;
				}else{
					$msg = _MSGOK_;
					$msg.= " | ";		
					$msg.= "./sistema/";
				}
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
				
	function alterarSenha($usuario){
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "update usuario set ";
			$sql.= " ususenha = '".$usuario->getCampo("senha")."'";
			//$sql.= ", usuprimeiroacesso = 'N' ";
			$sql.= " where usuid = ".$usuario->getCampo("id");
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();				
		}
	}

	function bloquearDesbloquear($usuario){
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "update usuario set ";
			$sql.= " usubloqueado = '".$usuario->getCampo("usubloqueado")."'";
			$sql.= " where usuid = ".$usuario->getCampo("usuid");
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();				
		}
	}	
	
	function gravar($usuario){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into usuario values ";
			$sql.= "(NULL";
			$sql.= ",'".$usuario->getCampo("login")."'";
			$sql.= ",'".$usuario->getCampo("senha")."'";
			$sql.= ",'".$usuario->getCampo("perfil")."'";
			$sql.= ",".$usuario->getCampo("id").",'N'";
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
	function alterar($usuario){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update usuario set ";
			$sql.= " usulogin = '".$usuario->getCampo("login")."'";
			$sql.= ", ususenha = '".$usuario->getCampo("senha")."'";
			if($usuario->getCampo("usuperfil")){
				$sql.= ", usuperfil = '".$usuario->getCampo("perfil")."'";
				$sql.= " where usuperfil = '".$usuario->getCampo("usuperfil")."' and usuidfuncionariomedico = ".$usuario->getCampo("id");				
			}else{
				$sql.= " where usuperfil = '".$usuario->getCampo("perfil")."' and usuidfuncionariomedico = ".$usuario->getCampo("id");
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

	function excluir($usuario){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from usuario ";
			$sql.= " where usuperfil = '".$usuario->getCampo("perfil")."' and usuidfuncionariomedico = ".$usuario->getCampo("id");
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
	function buscar($usuario){	
		$users = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from usuario ";
			$sql.= " where usuid = ".$usuario->getCampo("usuid");
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$user = $generic->construir($res,'classDTO');
			}else{
				$user = NULL;
			}
			$BD->fecharConexao();
		}else{
			$user = NULL;
		}
		return $user;
	}	
	function listar(){	
		$users = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = _SQL1_;
			$sql.= " order by usulogin ";					
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$user = $generic->construir($res,'classDTO');
					$users[$i] = $user;						
				}
			}else{
				$users = NULL;
			}
			$BD->fecharConexao();
		}else{
			$users = NULL;
		}
		return $users;
	}	
}		

?>