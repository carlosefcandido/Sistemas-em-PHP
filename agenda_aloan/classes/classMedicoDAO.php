<?php

class classMedicoDAO
{
	
	function gravar($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into medico values ";
			$sql.= "(NULL";
			$sql.= ",'".$medico->getCampo("mednome")."'";
			$sql.= ",'".$medico->getCampo("medsexo")."'";
			$sql.= ",'".$medico->getCampo("medtelefone")."'";
			$sql.= ",'".$medico->getCampo("medcelular")."'";
			$sql.= ",".$medico->getCampo("medconselhoregional");			
			$sql.= ",'".$medico->getCampo("medregistro")."'";			
			$sql.= ",".$medico->getCampo("medufconselho");			
			$sql.= ",NULL";			
			$sql.= ",'".$medico->getCampo("medencaixe")."'";
			$sql.= ",'".$medico->getCampo("medencaixeconsulta")."'";			
			$sql.= ")";
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();				
			if ($res > 0){
					$ultimomedico = classMedicoDAO::buscarUltimo();
					$medico->setCampo("medid",$ultimomedico->getCampo("medid"));
					$erro = classMedicoDAO::gravarEspecialidadeMedico($medico);
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function buscarUltimo(){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico";
			$sql.= " order by medid desc limit 1";
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$medico = $generic->construir($res,'classDTO');
			}else{
				$medico = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medico = NULL;
		}
		return $medico;
	}	
	
	function gravarMedicoExame($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into medicoexame values ";
			$sql.= "(NULL";
			$sql.= ",".$medico->getCampo("medexamedico");
			$sql.= ",".$medico->getCampo("medexaexame");
			$sql.= ")";
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();				
			if ($res > 0){
					$erro = NULL;
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	function gravarEspecialidadeMedico($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into medicoespecialidade values ";
			$sql.= "(NULL";
			$sql.= ",".$medico->getCampo("medid");
			$sql.= ",".$medico->getCampo("medespecialidade");
			$sql.= ")";
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();				
			if ($res > 0){
					$erro = NULL;
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	function alterar($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update medico set mednome = '".$medico->getCampo("mednome")."'"; 
			$sql.= ",medsexo = '".$medico->getCampo("medsexo")."'";
			$sql.= ",medtelefone = '".$medico->getCampo("medtelefone")."'";
			$sql.= ",medcelular = '".$medico->getCampo("medcelular")."'";
			$sql.= ",medconselhoregional = ".$medico->getCampo("medconselhoregional");			
			$sql.= ",medregistro = '".$medico->getCampo("medregistro")."'";			
			$sql.= ",medufconselho = ".$medico->getCampo("medufconselho");
			$sql.= ",medencaixe = '".$medico->getCampo("medencaixe")."' ";									
			$sql.= ",medencaixeconsulta = '".$medico->getCampo("medencaixeconsulta")."'";												
			$sql.= " where medid = ".$medico->getCampo("id");
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();								
			$erro = classMedicoDAO::alterarEspecialidadeMedico($medico);
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function alterarEspecialidadeMedico($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update medicoespecialidade set ";
			$sql.= "medespespecialidade = ".$medico->getCampo("medespecialidade");
			$sql.= " where medespmedico = ".$medico->getCampo("id");
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();								
			if ($res > 0){
					$erro = NULL;
			}else{
					$erro = "Erro na execu&ccedil;&atilde;o da SQL.";
			}
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}
	function excluir($medico){
		$BD = new classBD();
		$erro = NULL;
		$erro = classMedicoDAO::excluirEspecialidade($medico);
		$erro = classMedicoDAO::deletarMedicoHorario($medico);
		$erro = classMedicoDAO::deletarMedicoExame($medico);
		
		if ($BD->conectar()){
			$sql = "delete from medico";
			$sql.= " where medid = ".$medico->getCampo("medid");
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
	
	function deletarMedicoExame($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from medicoexame";
			$sql.= " where medexamedico = ".$medico->getCampo("medid");
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
	function deletarMedicoHorario($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from medicohorario";
			$sql.= " where medhormedico = ".$medico->getCampo("medid");
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
	function excluirEspecialidade($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from medicoespecialidade";
			$sql.= " where medespmedico = ".$medico->getCampo("medid");
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

	function gravarBloqueioHorario($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into medicohorariobloqueado values ";
			$sql.= "(NULL,'".$medico->getCampo("medhorbloentrada")."'";
			$sql.= ",'".$medico->getCampo("medhorblosaida")."'";
			$sql.= ",'".formatarDataBD($medico->getCampo("medhorblodata"))."'";
			$sql.= ",".$medico->getCampo("medid").")";
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
	
	function buscar($medico){	
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico 
					inner join medicoespecialidade on (medid = medespmedico) 
					inner join usuario on (medid = usuidfuncionariomedico) ";
			$sql.= " where usuperfil = 'M' and medid = ".$medico->getCampo("medid");
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				$medico = $generic->construir($res,'classDTO');
			}else{
				$medico = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medico = NULL;
		}
		return $medico;
	}	

	function listar(){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico 
					inner join medicoespecialidade on (medid = medespmedico) 
					inner join usuario on (medid = usuidfuncionariomedico) 
					where usuperfil = 'M' and usubloqueado = 'N' ";
			$sql.= " order by mednome ";		
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}
	function buscarComExames($medico){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico 
					inner join medicoespecialidade on (medid = medespmedico) 
					left join medicoexame on (medid = medexamedico) 
					where medid = ".$medico->getCampo("medid");
			$sql.= " order by mednome ";					
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}	
	
	function buscarComHorarios($medico){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico 
					inner join medicoespecialidade on (medid = medespmedico) 
					left join medicohorario on (medid = medhormedico) 
					where medid = ".$medico->getCampo("medid");
			$sql.= " order by mednome ";				
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}	
	function gravarHorario($medico,$campoentrada,$camposaida,$diasemana){	
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "insert into medicohorario values ";
			$sql.= "(NULL, '".$medico->getCampo("$campoentrada")."',";
			$sql.= "'".$medico->getCampo("$camposaida")."',";						
			$sql.= "'".$diasemana."',";
			$sql.= $medico->getCampo("medid").")";
			$res = $BD->executarSQL($sql);
			$BD->fecharConexao();
		}else{
			$erro = "Erro na cone&ccedil;&atilde;o com o Banco de Dados.";
		}
		return $erro;
	}	
	function atualizarHorarioIntervalo($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "update medico set medintervaloconsulta = ".$medico->getCampo("medintervaloconsulta");
			$sql.= " where medid = ".$medico->getCampo("medid");
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
	function deletarHorario($medico){
		$BD = new classBD();
		$erro = NULL;
		if ($BD->conectar()){
			$sql = "delete from medicohorario ";
			$sql.= " where medhormedico = ".$medico->getCampo("medid");
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

	function listarMedicosHorariosBloqueados($medid = '',$data = ''){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$dataE = explode("/",$data);
			$mes = $dataE[1];
			$ano = $dataE[2];
			$dataPesquisa = $mes."/".$ano;
		
			$sql = "select * from medicohorariobloqueado ";
			$entrou = 0;
			if($medid){
				$entrou = 1;
				$sql.= " where medhorblomedico = ".$medid;	
			}			
			if($entrou == 1){
				$sql.= " and DATE_FORMAT( medhorblodata,  '%m/%Y' ) = '".$dataPesquisa."'";				
			}else{
				$sql.= " where DATE_FORMAT( medhorblodata,  '%m/%Y' ) = '".$dataPesquisa."'";				
			}
			$sql.= " order by medhorblodata ";	
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}
	
	function listarMedicosHorarios($medid = '',$diadasemana = ''){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "select * from medico
					inner join medicoespecialidade on (medid = medespmedico)
					inner join medicohorario on (medid = medhormedico)
					inner join especialidade ON ( medespespecialidade = espid ) 
					inner join usuario on (medid = usuidfuncionariomedico) ";
					
			$entrou = 0;		
			if($medid != ''){
				$sql.= " where medid = ".$medid;
				$entrou = 1;
			}
			if($diadasemana != ''){
				if($entrou == 1){
					$sql.= " and medhorhorariodiasemana = '".$diadasemana."'";
				}else{
					$sql.= " where medhorhorariodiasemana = '".$diadasemana."'";				
				}
			}
			
			if($entrou == 1){
				$sql.= " and usuperfil = 'M' and usubloqueado = 'N' ";
			}else{
				$sql.= " where usuperfil = 'M' and usubloqueado = 'N' ";
			}
			$sql.= " order by medid, medhorid ";		
			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}
	
	function listarAgenda($medid = '',$data = ''){	
		$medicos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "SELECT DATE_FORMAT(a.mardatahora, '%d/%m/%Y') as agedata,
					DATE_FORMAT(a.mardatahora, '%H:%i') as agehora,b.pacid,b.pacnome,c.connome as conplanome,d.mednome,d.medid,a.marid, b.pactelefone, b.paccelular, a.martipomarcacao
					FROM marcacao as a
					inner join paciente as b on (a.marpaciente = b.pacid)
					inner join convenio as c on (b.pacconvenio = c.conid) 
					inner join medico as d on (d.medid = a.marmedico) ";
			$entrou = 0;		
			if($medid != ''){
				if($entrou == 0){
					$entrou = 1;
					$sql.= " where d.medid = ".$medid;
				}
			}
			if($data != ''){
				if($entrou == 0){
					$sql.= " where DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$data."'";
				}else{
					$sql.= " and DATE_FORMAT(a.mardatahora, '%d/%m/%Y') = '".$data."'";
				}
			}			
			$sql.= " order by medid,marordem ";	

			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$medico = $generic->construir($res,'classDTO');
					$medicos[$i] = $medico;						
				}
			}else{
				$medicos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$medicos = NULL;
		}
		return $medicos;
	}

	function listarAtendimentosDia($medid = '',$data = ''){	
		$atendimentos = array();
		$BD = new classBD();
		if ($BD->conectar()){
			$sql = "SELECT * FROM atendimento ";
			$sql.= " where atemedico = ".$medid;
			$sql.= " and DATE_FORMAT(atedatahorachegada, '%d/%m/%Y') = '".$data."'";
			$sql.= " order by atedatahorachegada ";	

			$res = $BD->executarSQL($sql);
			if ($BD->qtdeLinhas($res) > 0){
				$generic = new classGeneric();
				for($i=0;$i<$BD->qtdeLinhas($res);$i++){
					$atendimento = $generic->construir($res,'classDTO');
					$atendimentos[$i] = $atendimento;						
				}
			}else{
				$atendimentos = NULL;
			}
			$BD->fecharConexao();
		}else{
			$atendimentos = NULL;
		}
		return $atendimentos;
	}
	
	function montarHorarios($intervalo,$medicoHorarios){
		$horarios = array();
		$j=0;
		if($medicoHorarios){
			for ($i=0;$i<count($medicoHorarios);$i++){
				//calcula os segundos da entrada
				$entrada = explode(":",$medicoHorarios[$i]->getCampo("medhorhorarioentrada"));
				$hor_ent = $entrada[0];
				$min_ent = $entrada[1];

				$minutos_ent = $hor_ent * 60;
				$minutos_ent = $minutos_ent + $min_ent;
				$segundos_ent = $minutos_ent * 60;
					
				//calcula os segundos da saída
				$saida = explode(":",$medicoHorarios[$i]->getCampo("medhorhorariosaida"));
				$hor_sai = $saida[0];
				$min_sai = $saida[1];
					
				$minutos_sai = $hor_sai * 60;
				$minutos_sai = $minutos_sai + $min_sai;
				$segundos_sai = $minutos_sai * 60;
				
				while ($segundos_ent <= $segundos_sai){
					$horarioexibicaoentrada = floor(($segundos_ent / 3600));
					$horarioexibicaosaida = floor((($segundos_ent + ($intervalo * 60)) / 3600));
					$horamarcacao = $horarioexibicaoentrada.":".(($segundos_ent / 60)%60);
					$h = $horarioexibicaoentrada.":".(($segundos_ent / 60)%60);	
					$segundos_ent = $segundos_ent + ($intervalo * 60);
					$horarios[$j] = $horamarcacao;
					$j++;
				}
			}
		}
		return $horarios;
	}
	
	function verificaDisponibilidade($medico,$data,$diadasemana){
		$agendas = classMedicoDAO::listarAgenda($medico->getCampo("medid"),$data);		
		$medicoHorarios = classMedicoDAO::listarMedicosHorarios($medico->getCampo("medid"),$diadasemana);		
		$horarios = classMedicoDAO::montarHorarios($medico->getCampo("medintervaloconsulta"),$medicoHorarios);
		if($horarios){
			$temvaga = false;			
			foreach($horarios as $horario){
				if($agendas){
					for($i=0;$i<count($agendas);$i++){
						$horamarcacaodividido = explode(":",$horario);
						$horariomarcadosdividido = explode(":",$agendas[$i]->getCampo("agehora"));
						//verifica se há paciente naquela hora e minuto
						if ((floor($horamarcacaodividido[0]) == floor($horariomarcadosdividido[0])) && (floor($horamarcacaodividido[1]) == floor($horariomarcadosdividido[1]))){
							$i = count($agendas) + 100;	
						}else{
							$temvaga = true;
						}
					}
					if(($i == count($agendas)) && ($temvaga)){
						return true;
					}
				}else{
					$retorno = true;
				}
			}
		}else{
			$retorno = false;
		}
		return $retorno;
	}
	
	function montarHorariosAtendimento($diadasemana,$medid,$data){
		$agendas = classMedicoDAO::listarAgenda($medid,$data);		
		$medicoHorarios = classMedicoDAO::listarMedicosHorarios($medid,$diadasemana);
		$horarios = classMedicoDAO::montarHorarios($medicoHorarios[0]->getCampo("medintervaloconsulta"),$medicoHorarios);
		$horariosBloqueados = classMedicoDAO::listarMedicosHorariosBloqueados($medid,$data);

		$dados = '
				<table class="tabelaHorizontal">
					<tr>
						<th width="20%">Data</th>
						<td width="80%"><input type="text" size="8" id="mardata" name="mardata" value="'.$data.'" readonly /></td>
					</tr>
					<tr>
						<th width="20%">M&eacute;dico</th>
						<td width="80%">
						<input type="hidden" size="80" id="medselecionadoid" name="medselecionadoid" value="'.$medicoHorarios[0]->getCampo("medid").'" />
						<input type="text" size="80" id="mednome" name="mednome" value="'.$medicoHorarios[0]->getCampo("mednome").'" readonly />
						</td>
					</tr>					
				</table>
				<table class="tabelaHorizontal">
					<tr>
						<td width="100%" colspan="2">
						<table class="tabelaVertical">
							<tr>
								<th width="5%">Hora</th>
								<th width="10%">Tipo</th>
								<th width="65%">Paciente</th>
								<th width="20%">A&ccedil;&otilde;es</th>
							</tr>
					';		
		if($horarios){	
			$tempaciente = false;
			$horarioimpresso = "";
			$j = 0;
			foreach($horarios as $horario){
				$horamarcacaodividido = explode(":",$horario);

				if($agendas){
					$tempaciente = false;
					$bloqueia = false;
					$indices = array();					
					for($i=0;$i<count($agendas);$i++){
						$horariomarcadosdividido = explode(":",$agendas[$i]->getCampo("agehora"));
						//verifica se há paciente naquela hora e minuto
						if ((floor($horamarcacaodividido[0]) == floor($horariomarcadosdividido[0])) && (floor($horamarcacaodividido[1]) == floor($horariomarcadosdividido[1]))){
							$tempaciente = true;
							$indices[$j] = $i;
							$j++;
						}
					}
					
					//verifica se o médico possui algum horário bloqueado
					if($horariosBloqueados){
						foreach($horariosBloqueados as $horarioBloqueado){
							if($medid == $horarioBloqueado->getCampo("medhorblomedico")){
								$dataCalendario = explode("/",$data);
								$diaCalendario = $dataCalendario[0];
								$mesCalendario = $dataCalendario[1];
								$anoCalendario = $dataCalendario[2];
								$dataPesquisa = $anoCalendario."-".$mesCalendario."-".$diaCalendario;
								if($dataPesquisa == $horarioBloqueado->getCampo("medhorblodata")){
									if(($horarioBloqueado->getCampo("medhorbloentrada") != '00:00:00') && 
										($horarioBloqueado->getCampo("medhorblosaida") != '00:00:00')){
											//transforma o horário em segundos
											$horarioCalendarioDivididoEntrada = explode(":",$horarioBloqueado->getCampo("medhorbloentrada"));
											$minutosCalendarioEntrada = floor($horarioCalendarioDivididoEntrada[0]) * 60;
											$minutosCalendarioEntrada = $minutosCalendarioEntrada + floor($horarioCalendarioDivididoEntrada[1]);
											$segundosCalendarioEntrada = $minutosCalendarioEntrada * 60;
											
											$horarioCalendarioDivididoSaida = explode(":",$horarioBloqueado->getCampo("medhorblosaida"));
											$minutosCalendarioSaida = floor($horarioCalendarioDivididoSaida[0]) * 60;
											$minutosCalendarioSaida = $minutosCalendarioSaida + floor($horarioCalendarioDivididoSaida[1]);
											$segundosCalendarioSaida = $minutosCalendarioSaida * 60;

											$minutoAgenda = floor($horamarcacaodividido[0]) * 60;
											$minutoAgenda = $minutoAgenda + floor($horamarcacaodividido[1]);
											$segundosAgenda = $minutoAgenda * 60;
											
											if(($segundosAgenda >= $segundosCalendarioEntrada) && 
												($segundosAgenda <= $segundosCalendarioSaida)){
												$bloqueia = true;
											}
									}
								}
							}
						}
					}
					
					if($bloqueia){
							if($horamarcacaodividido[1] == 0){
								$horamarcacaodividido[1] = '00';
							}
							$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];					
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='65%'></td>
										<td width='20%'><center><font color='red'>BLOQUEADO</font></center>
										</td>
									</tr>";					
					}else{
						if($tempaciente){
							for($l=0;$l<count($indices);$l++){
								if($horamarcacaodividido[1] == 0){
									$horamarcacaodividido[1] = '00';
								}
								$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
								if($horarioimpresso == $hora){
									$hora = "<font color='red'>Encaixe</font>";
								}else{
									$horarioimpresso = $hora;
								}
								if($agendas[$indices[$l]]->getCampo("martipomarcacao") == 'C'){
									$tipomarcacao = "Consulta";
								}else{
									$tipomarcacao = "Exame";
								}
								$dados.= "<tr>
											<td width='5%'><center>".$hora."</center></td>
											<td width='10%'><center>".$tipomarcacao."</center></td>
											<td width='65%'>".$agendas[$indices[$l]]->getCampo("pacnome")."</td>
											<td width='20%'>
												<center>
												<a href=javascript:openModal('".$medid."','".$data."','".$horarioimpresso."','E'); title='Encaixar' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;
												<a href=javascript:copy('".$agendas[$indices[$l]]->getCampo("marid")."'); title='Copiar' ><img src='../imagens/copy.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;
												<a href=javascript:paste('".$medid."','".$data."','".$horarioimpresso."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;			
												<a href=javascript:deleteAgenda('".$agendas[$indices[$l]]->getCampo("marid")."','".$medid."','".$data."','".$horarioimpresso."'); title='Excluir' ><img src='../imagens/deleteagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;			
												</center>
											</td>
										</tr>";							
							}
							$tempaciente = false;
							$j = 0;
						}else{
							if($horamarcacaodividido[1] == 0){
								$horamarcacaodividido[1] = '00';
							}
							$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='65%'></td>
										<td width='20%'><center><a href=javascript:openModal('".$medid."','".$data."','".$hora."','M'); title='Marcar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href=javascript:paste('".$medid."','".$data."','".$hora."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></center></a>
										</td>
									</tr>";					
						}
					}
				}else{
					$bloqueia = false;
					if($horamarcacaodividido[1] == 0){
						$horamarcacaodividido[1] = '00';
					}
					$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
											
					//verifica se o médico possui algum horário bloqueado
					if($horariosBloqueados){
						foreach($horariosBloqueados as $horarioBloqueado){
							if($medid == $horarioBloqueado->getCampo("medhorblomedico")){
								$dataCalendario = explode("/",$data);
								$diaCalendario = $dataCalendario[0];
								$mesCalendario = $dataCalendario[1];
								$anoCalendario = $dataCalendario[2];
								$dataPesquisa = $anoCalendario."-".$mesCalendario."-".$diaCalendario;
								if($dataPesquisa == $horarioBloqueado->getCampo("medhorblodata")){
									if(($horarioBloqueado->getCampo("medhorbloentrada") != '00:00:00') && 
										($horarioBloqueado->getCampo("medhorblosaida") != '00:00:00')){
											//transforma o horário em segundos
											$horarioCalendarioDivididoEntrada = explode(":",$horarioBloqueado->getCampo("medhorbloentrada"));
											$minutosCalendarioEntrada = floor($horarioCalendarioDivididoEntrada[0]) * 60;
											$minutosCalendarioEntrada = $minutosCalendarioEntrada + floor($horarioCalendarioDivididoEntrada[1]);
											$segundosCalendarioEntrada = $minutosCalendarioEntrada * 60;
											
											$horarioCalendarioDivididoSaida = explode(":",$horarioBloqueado->getCampo("medhorblosaida"));
											$minutosCalendarioSaida = floor($horarioCalendarioDivididoSaida[0]) * 60;
											$minutosCalendarioSaida = $minutosCalendarioSaida + floor($horarioCalendarioDivididoSaida[1]);
											$segundosCalendarioSaida = $minutosCalendarioSaida * 60;

											$minutoAgenda = floor($horamarcacaodividido[0]) * 60;
											$minutoAgenda = $minutoAgenda + floor($horamarcacaodividido[1]);
											$segundosAgenda = $minutoAgenda * 60;
											
											if(($segundosAgenda >= $segundosCalendarioEntrada) && 
												($segundosAgenda <= $segundosCalendarioSaida)){
												$bloqueia = true;
											}
									}
								}
							}
						}
					}
					
					if($bloqueia){
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='65%'></td>
										<td width='20%'><center><font color='red'>BLOQUEADO</center>
										</td>
									</tr>";					
					}else{
						if($horamarcacaodividido[1] == 0){
							$horamarcacaodividido[1] = '00';
						}
						$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
						$dados.= "<tr>
									<td width='5%'><center>".$hora."</center></td>
									<td width='10%'></td>
									<td width='65%'></td>
									<td width='20%'><center><a href=javascript:openModal('".$medid."','".$data."','".$hora."','M'); title='Marcar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href=javascript:paste('".$medid."','".$data."','".$hora."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></center></a>
									</td>
								</tr>";				
					}
				}
			}
		}
		$dados.= '</table>
				</td>
			</tr>
		</table>';
				
		return $dados;
	}	
		

	function montarHorariosAtendimentoDia($diadasemana,$medid,$data){
	
		$dados = '
				<table class="tabelaHorizontal">
					<tr>
						<td width="100%" colspan="2">
						<table class="tabelaVertical">
							<tr>
								<th width="5%">Hora</th>
								<th width="10%">Tipo</th>
								<th width="5%">Status</th>
								<th width="50%">Paciente</th>
								<th width="30%">A&ccedil;&otilde;es</th>
							</tr>
					';

		$atendimentos = classMedicoDAO::listarAtendimentosDia($medid,$data);					
		$agendas = classMedicoDAO::listarAgenda($medid,$data);		
		$medicoHorarios = classMedicoDAO::listarMedicosHorarios($medid,$diadasemana);
		if($medicoHorarios[0] == NULL){
			$dados.= "<tr>";
			$dados.= '<td colspan="5"><font color="red" size="2">M&eacute;dico n&atilde;o trabalha no dia informado.</font></td>';
			$dados.= "</tr>";
			$dados.= "</table>";
			$dados.= "</td>";
			$dados.= "</tr>";
			$dados.= "</table>";
			return $dados;
		}
		$horarios = classMedicoDAO::montarHorarios($medicoHorarios[0]->getCampo("medintervaloconsulta"),$medicoHorarios);
		$horariosBloqueados = classMedicoDAO::listarMedicosHorariosBloqueados($medid,$data);

		
		if($horarios){	
			$tempaciente = false;
			$horarioimpresso = "";
			$j = 0;
			foreach($horarios as $horario){
				$horamarcacaodividido = explode(":",$horario);

				if($agendas){
					$tempaciente = false;
					$bloqueia = false;
					$indices = array();					
					for($i=0;$i<count($agendas);$i++){
						$horariomarcadosdividido = explode(":",$agendas[$i]->getCampo("agehora"));
						//verifica se há paciente naquela hora e minuto
						if ((floor($horamarcacaodividido[0]) == floor($horariomarcadosdividido[0])) && (floor($horamarcacaodividido[1]) == floor($horariomarcadosdividido[1]))){
							$tempaciente = true;
							$indices[$j] = $i;
							$j++;
						}
					}
					
					//verifica se o médico possui algum horário bloqueado
					if($horariosBloqueados){
						foreach($horariosBloqueados as $horarioBloqueado){
							if($medid == $horarioBloqueado->getCampo("medhorblomedico")){
								$dataCalendario = explode("/",$data);
								$diaCalendario = $dataCalendario[0];
								$mesCalendario = $dataCalendario[1];
								$anoCalendario = $dataCalendario[2];
								$dataPesquisa = $anoCalendario."-".$mesCalendario."-".$diaCalendario;
								if($dataPesquisa == $horarioBloqueado->getCampo("medhorblodata")){
									if(($horarioBloqueado->getCampo("medhorbloentrada") != '00:00:00') && 
										($horarioBloqueado->getCampo("medhorblosaida") != '00:00:00')){
											//transforma o horário em segundos
											$horarioCalendarioDivididoEntrada = explode(":",$horarioBloqueado->getCampo("medhorbloentrada"));
											$minutosCalendarioEntrada = floor($horarioCalendarioDivididoEntrada[0]) * 60;
											$minutosCalendarioEntrada = $minutosCalendarioEntrada + floor($horarioCalendarioDivididoEntrada[1]);
											$segundosCalendarioEntrada = $minutosCalendarioEntrada * 60;
											
											$horarioCalendarioDivididoSaida = explode(":",$horarioBloqueado->getCampo("medhorblosaida"));
											$minutosCalendarioSaida = floor($horarioCalendarioDivididoSaida[0]) * 60;
											$minutosCalendarioSaida = $minutosCalendarioSaida + floor($horarioCalendarioDivididoSaida[1]);
											$segundosCalendarioSaida = $minutosCalendarioSaida * 60;

											$minutoAgenda = floor($horamarcacaodividido[0]) * 60;
											$minutoAgenda = $minutoAgenda + floor($horamarcacaodividido[1]);
											$segundosAgenda = $minutoAgenda * 60;
											
											if(($segundosAgenda >= $segundosCalendarioEntrada) && 
												($segundosAgenda <= $segundosCalendarioSaida)){
												$bloqueia = true;
											}
									}
								}
							}
						}
					}
					
					if($bloqueia){
							if($horamarcacaodividido[1] == 0){
								$horamarcacaodividido[1] = '00';
							}
							$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];					
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='5%'></td>
										<td width='50%'></td>
										<td width='30%'><center><font color='red'>BLOQUEADO</font></center>
										</td>
									</tr>";					
					}else{
						if($tempaciente){
							for($l=0;$l<count($indices);$l++){
								if($horamarcacaodividido[1] == 0){
									$horamarcacaodividido[1] = '00';
								}
								$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
								if($horarioimpresso == $hora){
									$hora = "<font color='red'>Encaixe</font>";
								}else{
									$horarioimpresso = $hora;
								}
								if($agendas[$indices[$l]]->getCampo("martipomarcacao") == 'C'){
									$tipomarcacao = "Consulta";
								}else{
									$tipomarcacao = "Exame";
								}
								
								$status = "<img src='../imagens/frames/alertaPq.gif' border='0'>";
								$codStatus = 0;
								if($atendimentos){
									foreach($atendimentos as $atendimento){
										if(($atendimento->getCampo("atepaciente") == $agendas[$indices[$l]]->getCampo("pacid")) && ($atendimento->getCampo("atedatahorachegada") != NULL)){
											$status = "<img src='../imagens/frames/sucessoPq.gif' border='0'>";
											$codStatus = 1;
										}
									}
								}
								
								$dados.= "<tr>
											<td width='5%'><center>".$hora."</center></td>
											<td width='10%'><center>".$tipomarcacao."</center></td>
											<td width='5%'><center>".$status."</center></td>
											<td width='50%'>".$agendas[$indices[$l]]->getCampo("pacnome")."</td>
											<td width='30%'>
												<center>
										";
										
										if($codStatus == 0){
											$dados.= "<a href=javascript:openModalConfirmarAtendimento('".$medid."','".$data."','".$horarioimpresso."','".$agendas[$indices[$l]]->getCampo("pacid")."'); title='Confirmar atendimento' ><img src='../imagens/confirmarconsulta.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;";	
										}
										if($medicoHorarios[0]->getCampo("medencaixeconsulta") == 'S'){
											$dados.= "<a href=javascript:openModalAtendimento('".$medid."','".$data."','".$horarioimpresso."','".$agendas[$indices[$l]]->getCampo("pacid")."'); title='Encaixar' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;";	
										}
										
											$dados.= "											
												<a href=javascript:copy('".$agendas[$indices[$l]]->getCampo("marid")."'); title='Copiar' ><img src='../imagens/copy.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;
												<a href=javascript:paste('".$medid."','".$data."','".$horarioimpresso."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;			
												<a href=javascript:deleteAtendimento('".$agendas[$indices[$l]]->getCampo("marid")."','".$medid."','".$data."','".$horarioimpresso."'); title='Excluir' ><img src='../imagens/deleteagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;			
												</center>
											</td>
										</tr>";							
							}
							$tempaciente = false;
							$j = 0;
						}else{
							if($horamarcacaodividido[1] == 0){
								$horamarcacaodividido[1] = '00';
							}
							$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='5%'></td>
										<td width='50%'></td>
										<td width='30%'><center><a href=javascript:openModalAtendimento('".$medid."','".$data."','".$hora."','M'); title='Marcar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href=javascript:paste('".$medid."','".$data."','".$hora."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></center></a>
										</td>
									</tr>";					
						}
					}
				}else{
					$bloqueia = false;
					if($horamarcacaodividido[1] == 0){
						$horamarcacaodividido[1] = '00';
					}
					$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
											
					//verifica se o médico possui algum horário bloqueado
					if($horariosBloqueados){
						foreach($horariosBloqueados as $horarioBloqueado){
							if($medid == $horarioBloqueado->getCampo("medhorblomedico")){
								$dataCalendario = explode("/",$data);
								$diaCalendario = $dataCalendario[0];
								$mesCalendario = $dataCalendario[1];
								$anoCalendario = $dataCalendario[2];
								$dataPesquisa = $anoCalendario."-".$mesCalendario."-".$diaCalendario;
								if($dataPesquisa == $horarioBloqueado->getCampo("medhorblodata")){
									if(($horarioBloqueado->getCampo("medhorbloentrada") != '00:00:00') && 
										($horarioBloqueado->getCampo("medhorblosaida") != '00:00:00')){
											//transforma o horário em segundos
											$horarioCalendarioDivididoEntrada = explode(":",$horarioBloqueado->getCampo("medhorbloentrada"));
											$minutosCalendarioEntrada = floor($horarioCalendarioDivididoEntrada[0]) * 60;
											$minutosCalendarioEntrada = $minutosCalendarioEntrada + floor($horarioCalendarioDivididoEntrada[1]);
											$segundosCalendarioEntrada = $minutosCalendarioEntrada * 60;
											
											$horarioCalendarioDivididoSaida = explode(":",$horarioBloqueado->getCampo("medhorblosaida"));
											$minutosCalendarioSaida = floor($horarioCalendarioDivididoSaida[0]) * 60;
											$minutosCalendarioSaida = $minutosCalendarioSaida + floor($horarioCalendarioDivididoSaida[1]);
											$segundosCalendarioSaida = $minutosCalendarioSaida * 60;

											$minutoAgenda = floor($horamarcacaodividido[0]) * 60;
											$minutoAgenda = $minutoAgenda + floor($horamarcacaodividido[1]);
											$segundosAgenda = $minutoAgenda * 60;
											
											if(($segundosAgenda >= $segundosCalendarioEntrada) && 
												($segundosAgenda <= $segundosCalendarioSaida)){
												$bloqueia = true;
											}
									}
								}
							}
						}
					}
					
					if($bloqueia){
							$dados.= "<tr>
										<td width='5%'><center>".$hora."</center></td>
										<td width='10%'></td>
										<td width='5%'></td>
										<td width='50%'></td>
										<td width='30%'><center><font color='red'>BLOQUEADO</center>
										</td>
									</tr>";					
					}else{
						if($horamarcacaodividido[1] == 0){
							$horamarcacaodividido[1] = '00';
						}
						$hora = $horamarcacaodividido[0].":".$horamarcacaodividido[1];
						$dados.= "<tr>
									<td width='5%'><center>".$hora."</center></td>
									<td width='10%'></td>
									<td width='5%'></td>
									<td width='50%'></td>
									<td width='30%'><center><a href=javascript:openModalAtendimento('".$medid."','".$data."','".$hora."','M'); title='Marcar consulta' ><img src='../imagens/addagenda.png' border='0' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href=javascript:paste('".$medid."','".$data."','".$hora."','M'); title='Colar' ><img src='../imagens/paste.png' border='0' width='20' height='20' /></center></a>
									</td>
								</tr>";				
					}
				}
			}
		}
		$dados.= '</table>
				</td>
			</tr>
		</table>';
				
		return $dados;
	}	
}
?>