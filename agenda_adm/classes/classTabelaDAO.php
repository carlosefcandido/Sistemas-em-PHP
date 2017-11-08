<?php

class classTabelaDAO
{	
	function listarTISS(){	
		$vetortiss = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tiss ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tiss = $generic->construir($res,'classDTO');
					$vetortiss[$i] = $tiss;						
				}
			}else{
				$vetortiss = NULL;
			}
			$BD->fecharConexao();
		}else{
			$vetortiss = NULL;
		}
		return $vetortiss;
	}
	function listarTiposMoeda(){	
		$tipos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tipomoeda ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tipo = $generic->construir($res,'classDTO');
					$tipos[$i] = $tipo;						
				}
			}else{
				$tipos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tipos = NULL;
		}
		return $tipos;
	}	
	function listarLaboratorios(){	
		$laboratorios = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from laboratorio ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$laboratorio = $generic->construir($res,'classDTO');
					$laboratorios[$i] = $laboratorio;						
				}
			}else{
				$laboratorios = NULL;
			}
			$BD->fecharConexao();
		}else{
			$laboratorios = NULL;
		}
		return $laboratorios;
	}
	function listarSubstancias(){	
		$substancias = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from substancia ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$substancia = $generic->construir($res,'classDTO');
					$substancias[$i] = $substancia;						
				}
			}else{
				$substancias = NULL;
			}
			$BD->fecharConexao();
		}else{
			$substancias = NULL;
		}
		return $substancias;
	}	
	function listarTipos(){	
		$tipos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelatipo ";
			$sql.= " order by tabtipnome ";					
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tipo = $generic->construir($res,'classDTO');
					$tipos[$i] = $tipo;						
				}
			}else{
				$tipos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tipos = NULL;
		}
		return $tipos;
	}	
	
	function gravarTabelaConvenio($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "insert into conveniotabela values ";
			$sql.= " (NULL,".$tabela->getCampo("plano");
			$sql.= ",".$tabela->getCampo("honorario");
			$sql.= ",".$tabela->getCampo("material");				
			$sql.= ",".$tabela->getCampo("medicamento");				
			$sql.= ",".$tabela->getCampo("alugueltaxa");				
			$sql.= ",".$tabela->getCampo("diaria");				
			$sql.= ",".$tabela->getCampo("pacote");				
			$sql.= ",".$tabela->getCampo("taxasala");				
			$sql.= ",".$tabela->getCampo("curativo");				
			$sql.= ",".$tabela->getCampo("oxigenio");				
			$sql.= ",".$tabela->getCampo("opm");				
			$sql.= ",".$tabela->getCampo("outracobranca");		
			$sql.= ",".$tabela->getCampo("ch");							
			$sql.= ",'".date("Y/m/d")."')";					
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
	
	function gravar($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "insert into tabelanome values ";
			$sql.= " (NULL,'".$tabela->getCampo("tabnomnome")."',".$tabela->getCampo("tabnomtipo");
			if($tabela->getCampo("tabnomtiss") == NULL){
				$tiss = "NULL";
			}else{
				$tiss = $tabela->getCampo("tabnomtiss");
			}
			$sql.= ",".$tiss;
			if($tabela->getCampo("tabnomtipomoeda") == NULL){
				$moeda = "NULL";
			}else{
				$moeda = $tabela->getCampo("tabnomtipomoeda");
			}
			$sql.= ",".$moeda.")";			
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
	function gravarProcedimento($tabela){	
		$dado = classTabelaDAO::listarTabela($tabela);

		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "insert into ".$dado->getCampo("tabtiptabela")." values ";
			$sql.= " (NULL,'".$tabela->getCampo("procedimento")."'";
			$sql.= ",'".$tabela->getCampo("mneumonico")."'";
			$sql.= ",".$tabela->getCampo("referencia");		
			$sql.= ",".$tabela->getCampo("valor");			
			if($tabela->getCampo("especialidade") == NULL){
				$tabela->setCampo("especialidade","NULL");
			}
			$sql.= ",".$tabela->getCampo("especialidade");	
			$sql.= ",".$tabela->getCampo("tabnomid").")";				
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

	function gravarMedicamento($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "insert into tabelamedicamento values ";
			$sql.= "(NULL,NULL,NULL,'".$tabela->getCampo("medicamento")."'";
			$sql.= ",'".$tabela->getCampo("laboratorio")."'";
			$sql.= ",NULL,".$tabela->getCampo("referencia").",'".date("Y/m/d")."'";		
			$sql.= ",".$tabela->getCampo("valor");			
			$sql.= ",NULL,NULL,NULL";	
			$sql.= ",".$tabela->getCampo("tabnomid").")";				
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
	function gravarMaterial($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "insert into tabelamaterial values ";
			$sql.= "(NULL,NULL,NULL,'".$tabela->getCampo("material")."'";
			$sql.= ",'".$tabela->getCampo("laboratorio")."'";
			$sql.= ",NULL,".$tabela->getCampo("referencia").",'".date("Y/m/d")."'";		
			$sql.= ",".$tabela->getCampo("valor");			
			$sql.= ",NULL,NULL,NULL";	
			$sql.= ",".$tabela->getCampo("tabnomid").")";					
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
	function gravarHonorario($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "insert into tabelahonorario values ";
			$sql.= "(NULL,NULL,'".$tabela->getCampo("procedimento")."'";
			$sql.= ",".$tabela->getCampo("valor");				
			
			$sql.= ",'".$tabela->getCampo("porte")."'";				
			$sql.= ",'".$tabela->getCampo("auxiliares")."'";
			$sql.= ",".$tabela->getCampo("filme");							
			$sql.= ",'".$tabela->getCampo("incidencia")."'";				
			$sql.= ",'".$tabela->getCampo("referencia")."'";				
			$sql.= ",'".$tabela->getCampo("especialidade")."'";				
			$sql.= ",'".$tabela->getCampo("mneumonico")."'";				
			if($tabela->getCampo("dopler") != NULL){
				$dopler = 1;
			}else{
				$dopler = 0;
			}
			if($tabela->getCampo("eco") != NULL){
				$eco = 1;
			}else{
				$eco = 0;
			}			
			$sql.= ",".$dopler;				
			$sql.= ",".$eco;				
			$sql.= ",'".$tabela->getCampo("sexo")."'";				
			$sql.= ",".$tabela->getCampo("tabnomid").")";					
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
	function alterarHonorario($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "update tabelahonorario set ";
			$sql.= " tabhonnome = '".$tabela->getCampo("procedimento")."'";
			$sql.= ", tabhonvalor = ".$tabela->getCampo("valor");				
			$sql.= ", tabhonporte = '".$tabela->getCampo("porte")."'";				
			$sql.= ", tabhonaux = '".$tabela->getCampo("auxiliares")."'";
			$sql.= ", tabhonfilme = ".$tabela->getCampo("filme");							
			$sql.= ", tabhonincidencia = '".$tabela->getCampo("incidencia")."'";				
			$sql.= ", tabhonreferencia = '".$tabela->getCampo("referencia")."'";				
			$sql.= ", tabhonespecie = '".$tabela->getCampo("especialidade")."'";				
			$sql.= ", tabhonmneumonico = '".$tabela->getCampo("mneumonico")."'";				
			if($tabela->getCampo("dopler") != NULL){
				$dopler = 1;
			}else{
				$dopler = 0;
			}
			if($tabela->getCampo("eco") != NULL){
				$eco = 1;
			}else{
				$eco = 0;
			}			
			$sql.= ", tabhondoppler = ".$dopler;				
			$sql.= ", tabhoneco = ".$eco;				
			$sql.= ", tabhonsexo = '".$tabela->getCampo("sexo")."'";				
			$sql.= " where tabhonid = ".$tabela->getCampo("tabid");	
			
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
	function alterarProcedimento($tabela){	
		$dado = classTabelaDAO::listarTabela($tabela);

		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "update ".$dado->getCampo("tabtiptabela")." set ";
			$sql.= " tabprocedimento = '".$tabela->getCampo("procedimento")."'";
			$sql.= ", tabmneumonico = '".$tabela->getCampo("mneumonico")."'";
			$sql.= ", tabreferencia = ".$tabela->getCampo("referencia");		
			$sql.= ", tabvalor = ".$tabela->getCampo("valor");			
			if($tabela->getCampo("especialidade") != NULL){
				$sql.= ", tabespecialidade = ".$tabela->getCampo("especialidade");	
			}
			$sql.= " where tabid = ".$tabela->getCampo("tabid");			
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
	function alterarMaterial($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "update tabelamaterial set ";
			$sql.= " tabmatnome = '".$tabela->getCampo("material")."'";
			$sql.= ", tabmatpremedi = ".$tabela->getCampo("referencia");		
			$sql.= ", tabmatvalorultimo = ".$tabela->getCampo("valor");			
			$sql.= ", tabmatdataultimo = '".date("Y/m/d")."'";			
			$sql.= " where tabmatid = ".$tabela->getCampo("tabid");			
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
	
	function alterarMedicamento($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "update tabelamedicamento set ";
			$sql.= " tabmednome = '".$tabela->getCampo("medicamento")."'";
			$sql.= ", tabmedpremedi = ".$tabela->getCampo("referencia");		
			$sql.= ", tabmedvalorultimo = ".$tabela->getCampo("valor");			
			$sql.= ", tabmeddataultimo = '".date("Y/m/d")."'";			
			$sql.= " where tabmedid = ".$tabela->getCampo("tabid");			
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
	
	function listar($tabela){	
		$tabelas = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelanome ";
			$sql.= " where tabnomtipo = ".$tabela->getCampo("tabnomtipo");
			$sql.= " order by tabnomnome ";					
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tabela = $generic->construir($res,'classDTO');
					$tabelas[$i] = $tabela;						
				}
			}else{
				$tabelas = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabelas = NULL;
		}
		return $tabelas;
	}

	function listarTabela($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelanome ";
			$sql.= " inner join tabelatipo on (tabtipid = tabnomtipo)";
			$sql.= " where tabnomid = ".$tabela->getCampo("tabnomid");
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}

	function listarProcedimentosMedicamento($tabela){	
		$tabelas = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelamedicamento ";
			$sql.= " where tabmedtabelanome = ".$tabela->getCampo("tabnomid");	
			$sql.= " order by tabmednome ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tabela = $generic->construir($res,'classDTO');
					$tabelas[$i] = $tabela;						
				}
			}else{
				$tabelas = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabelas = NULL;
		}
		return $tabelas;
	}
	function listarProcedimentosHonorarios($tabela){	
		$tabelas = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelahonorario ";
			$sql.= " where tabhontabelanome = ".$tabela->getCampo("tabnomid");	
			$sql.= " order by tabhonnome ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tabela = $generic->construir($res,'classDTO');
					$tabelas[$i] = $tabela;						
				}
			}else{
				$tabelas = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabelas = NULL;
		}
		return $tabelas;
	}
	function listarProcedimentosMaterial($tabela){	
		$tabelas = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelamaterial ";
			$sql.= " where tabmattabelanome = ".$tabela->getCampo("tabnomid");	
			$sql.= " order by tabmatnome ";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$tabela = $generic->construir($res,'classDTO');
					$tabelas[$i] = $tabela;						
				}
			}else{
				$tabelas = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabelas = NULL;
		}
		return $tabelas;
	}
	
	function buscarTabelaConvenio($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from conveniotabela ";
			$sql.= " where contabconvenio = ".$tabela->getCampo("conid");	
			$sql.= " order by contabid desc limit 1 ";				
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}

	function buscarMedicamento($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelamedicamento ";
			$sql.= " where tabmedid = ".$tabela->getCampo("tabprocedimento");			
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}
	function buscarHonorario($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelahonorario ";
			$sql.= " where tabhonid = ".$tabela->getCampo("tabprocedimento");			
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}
	function buscarMaterial($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from tabelamaterial ";
			$sql.= " where tabmatid = ".$tabela->getCampo("tabprocedimento");			
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}	
	
	function buscarProcedimento($tabela){	
		$dado = classTabelaDAO::listarTabela($tabela);
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from ".$dado->getCampo("tabtiptabela");
			$sql.= " left join especialidade on (tabespecialidade = espid) ";			
			$sql.= " where tabtabelanome = ".$tabela->getCampo("tabnomid");			
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$tabela = $generic->construir($res,'classDTO');
			}else{
				$tabela = NULL;
			}
			$BD->fecharConexao();
		}else{
			$tabela = NULL;
		}
		return $tabela;
	}
	
	function excluirProcedimentos($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "delete from ".$tabela->getCampo("nometabela");
			$sql.= " where tabid = ".$tabela->getCampo("tabnomid");			
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
	
	function excluirHonorario($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "delete from ".$tabela->getCampo("nometabela");
			$sql.= " where tabhonid = ".$tabela->getCampo("tabprocedimento");	
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
	function excluirMedicamento($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "delete from ".$tabela->getCampo("nometabela");
			$sql.= " where tabmedid = ".$tabela->getCampo("tabprocedimento");	
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
	function excluirMaterial($tabela){	
		$BD = new classBD();
		if ($BD->conectar()){		
			$sql = "delete from ".$tabela->getCampo("nometabela");
			$sql.= " where tabmatid = ".$tabela->getCampo("tabprocedimento");	
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