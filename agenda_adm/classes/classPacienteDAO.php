<?php

class classPacienteDAO
{
		function listarLaudoPaciente($id){	
			$pacientes = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from laudopaciente";
				$sql.= " where id = ".$id;
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$paciente = $generic->construir($res,'classDTO');
					
					if($paciente->getCampo("modalidade") == 'CT'){
						$sql = "select * from laudopaciente 
						where paciente = '".$paciente->getCampo("paciente")."' and 
						idade = '".$paciente->getCampo("idade")."' and 
						DATE_FORMAT( datahora,  '%d/%m/%Y' )  = '".formatarDataSomente($paciente->getCampo("datahora"))."'  and 
						exame = '".$paciente->getCampo("exame")."' ";
						
						$res = $BD->executarSQL($sql);
						for($i=0;$i<$BD->qtdeLinhas($res);$i++){
							$paciente = $generic->construir($res,'classDTO');
							$pacientes[$i] = $paciente;						
						}					
					}else{
						$pacientes[0] = $paciente;							
					}
				}else{
					$pacientes = NULL;
				}
				$BD->fecharConexao();
			}else{
				$pacientes = NULL;
			}
			return $pacientes;
		}
		function listarLaudos(){	
			$laudos = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select '' as pac, '' as dt, a.* from laudopaciente as a where a.modalidade <> 'CT' ";
				$sql.= "UNION ALL ";
				$sql.= "SELECT paciente as pac, DATE_FORMAT( datahora,  '%d/%m/%Y' ) as dt, id, paciente, imagemdicom, imagem, laudo, idade, datahora, solicitante, medico, protocolo, descricao, exame, tags, modalidade
						FROM laudopaciente
						WHERE modalidade =  'CT'
						GROUP BY paciente, DATE_FORMAT( datahora,  '%d/%m/%Y' )";
				
				$sql.= " order by paciente";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$laudo = $generic->construir($res,'classDTO');
						$laudos[$i] = $laudo;						
					}
				}else{
					$laudos = NULL;
				}
				$BD->fecharConexao();
			}else{
				$laudos = NULL;
			}
			return $laudos;
		}

		function listarPacienteLaudo($id = ''){	
			$pacientes = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from laudopaciente";
				if($id != NULL){
					$sql.= " where id = ".$id;
				}
				$sql.= " order by paciente";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$paciente = $generic->construir($res,'classDTO');
						$pacientes[$i] = $paciente;						
					}
				}else{
					$pacientes = NULL;
				}
				$BD->fecharConexao();
			}else{
				$pacientes = NULL;
			}
			return $pacientes;
		}
		function gravarLaudoPaciente($paciente){	
			$erros = NULL;
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "update laudopaciente set laudo = '".$paciente->getCampo("texto")."'";
				$sql.= " where id = ".$paciente->getCampo("pacid");
				$res = $BD->executarSQL($sql);
				if ($res < 1){
					$erros = "Erro na execução da SQL. Favor entrar em contato com o Administrador do sistema.";
				}
				$BD->fecharConexao();
			}else{
				$erros = "Erro na execução da SQL. Favor entrar em contato com o Administrador do sistema.";
			}
			return $erros;
		}		
		
		function listar($nome=''){	
			$pacientes = array();
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from paciente";
				if($nome != ''){
					$sql.= " where pacnome like '%".$nome."%' ";
				}
				$sql.= " order by pacnome";
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					for($i=0;$i<$BD->qtdeLinhas($res);$i++){
						$paciente = $generic->construir($res,'classDTO');
						$pacientes[$i] = $paciente;						
					}
				}else{
					$pacientes = NULL;
				}
				$BD->fecharConexao();
			}else{
				$pacientes = NULL;
			}
			return $pacientes;
		}
		function buscar($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from paciente";
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$paciente = $generic->construir($res,'classDTO');
				}else{
					$paciente = NULL;
				}
				$BD->fecharConexao();
			}else{
				$paciente = NULL;
			}
			return $paciente;
		}

		function buscarComConvenio($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from paciente";
				$sql.= " left join convenio on (pacconvenio = conid) ";
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$paciente = $generic->construir($res,'classDTO');
				}else{
					$paciente = NULL;
				}
				$BD->fecharConexao();
			}else{
				$paciente = NULL;
			}
			return $paciente;
		}
		
		function buscarPaciente($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "select * from paciente ";
				$sql.= " where pacnome = '".$paciente->getCampo("pacnome")."'";
				$sql.= " and pactelefone = '".$paciente->getCampo("pactelefone")."'";				
				$sql.= " and pacconvenio = ".$paciente->getCampo("pacconvenioplano");	
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					$generic = new classGeneric();
					$paciente = $generic->construir($res,'classDTO');
				}else{
					$paciente = NULL;
				}
				$BD->fecharConexao();
			}else{
				$paciente = NULL;
			}
			return $paciente;
		}		
		function buscarExiste($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL26_;
				$sql.= " where pacnome = '".$paciente->getCampo("pacnome")."'";
				$sql.= " and (pactelefone = '".$paciente->getCampo("pactelefone")."'";
				$sql.= " or paccelular = '".$paciente->getCampo("paccelular")."')";		
				$res = $BD->executarSQL($sql);
				if ($BD->qtdeLinhas($res) > 0){
					return true;
				}
				$BD->fecharConexao();
			}
			return false;
		}
		
		function deletar($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL27_;
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
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
		function gravar($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "insert into paciente values ";
				$sql.= " (NULL,'".$paciente->getCampo("pacnome")."','".$paciente->getCampo("pactelefone")."'";
				$sql.= ",NULL,".$paciente->getCampo("pacconvenioplano").")";
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

		function alterar($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL36_;
				$sql.= " pacplano = ".$paciente->getCampo("pacplano");
				$sql.= ",pacnumerocarteira = '".$paciente->getCampo("pacnumerocarteira")."'";
				$sql.= ",pacnome = '".$paciente->getCampo("pacnome")."'";					
				if ($paciente->getCampo("pacdatanascimento") != NULL){
					$paciente->setCampo("pacdatanascimento",formatarDataBD($paciente->getCampo("pacdatanascimento")));
				}else{
					$paciente->setCampo("pacdatanascimento",date("Y/m/d"));						
				}
				$sql.= ",pacdatanascimento = '".$paciente->getCampo("pacdatanascimento")."'";								
				$sql.= ",pacidentidade = '".$paciente->getCampo("pacidentidade")."'";
				$sql.= ",pacexpeditor = '".$paciente->getCampo("pacexpeditor")."'";
				$sql.= ",paccpf = '".$paciente->getCampo("paccpf")."'";
				$sql.= ",pacsexo = '".$paciente->getCampo("pacsexo")."'";
				$sql.= ",pacendereco = '".$paciente->getCampo("pacendereco")."'";
				$sql.= ",pacnumero = '".$paciente->getCampo("pacnumero")."'";
				$sql.= ",paccomplemento = '".$paciente->getCampo("paccomplemento")."'";
				$sql.= ",pacbairro = '".$paciente->getCampo("pacbairro")."'";
				$sql.= ",paccep = '".$paciente->getCampo("paccep")."'";
				$sql.= ",paccidade = ".$paciente->getCampo("paccidade");				
				$sql.= ",pactelefone = '".$paciente->getCampo("pactelefone")."'";
				$sql.= ",paccelular = '".$paciente->getCampo("paccelular")."'";				
				$sql.= ",pacemail = '".$paciente->getCampo("pacemail")."'";
				$sql.= ",pacnaturalidade = '".$paciente->getCampo("pacnaturalidade")."'";
				$sql.= ",pacnacionalidade = '".$paciente->getCampo("pacnacionalidade")."'";
				$sql.= ",pacestadocivil = '".$paciente->getCampo("pacestadocivil")."'";
				$sql.= ",pactitular = '".$paciente->getCampo("pactitular")."'";
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
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

		function atualizarDadosBasicos($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = _SQL36_;
				$sql.= " pacplano = ".$paciente->getCampo("pacplano");
				$sql.= ",pacnumerocarteira = '".$paciente->getCampo("pacnumerocarteira")."'";
				$sql.= ",pacnome = '".$paciente->getCampo("pacnome")."'";					
				$sql.= ",pacendereco = '".$paciente->getCampo("pacendereco")."'";
				$sql.= ",pacnumero = '".$paciente->getCampo("pacnumero")."'";
				$sql.= ",paccomplemento = '".$paciente->getCampo("paccomplemento")."'";
				$sql.= ",pacbairro = '".$paciente->getCampo("pacbairro")."'";
				$sql.= ",paccep = '".$paciente->getCampo("paccep")."'";
				$sql.= ",paccidade = ".$paciente->getCampo("paccidade");				
				$sql.= ",pactelefone = '".$paciente->getCampo("pactelefone")."'";
				$sql.= ",paccelular = '".$paciente->getCampo("paccelular")."'";				
				$sql.= ",pactitular = '".$paciente->getCampo("pactitular")."'";
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
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
		function atualizar($paciente){	
			$BD = new classBD();
			if ($BD->conectar()){
				$sql = "update paciente set ";
				$sql.= " pacnome = '".$paciente->getCampo("pacnome")."'";
				$sql.= ",pactelefone = '".$paciente->getCampo("pactelefone")."'";
				$sql.= ",pacconvenio = ".$paciente->getCampo("pacconvenioplano");					
				if($paciente->getCampo("pacnumerocartao") != NULL){
					$sql.= ",pacnumerocartao = '".$paciente->getCampo("pacnumerocartao")."'";					
				}
				$sql.= " where pacid = ".$paciente->getCampo("pacid");
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