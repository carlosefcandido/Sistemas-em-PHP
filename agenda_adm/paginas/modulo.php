<?php
	session_start();
	$MODULO = $_SESSION['MODULO'];
	//ACESSOS DE ADMINISTRADOR
		if ($MODULO == 'agenda'){
			$displayagenda = "block";
			$displayatendimento = "none";		
			$displaypaciente = "none";		
			$displayreferenciais = "none";
			$displayadministracao = "none";		
			$displaycotacao = "none";		
			$displayrelatorio = "none";				
		}else if ($MODULO == 'atendimento'){
			$displayagenda = "none";
			$displayatendimento = "block";		
			$displaypaciente = "none";		
			$displayreferenciais = "none";
			$displayadministracao = "none";	
			$displaycotacao = "none";					
			$displayrelatorio = "none";						
		}else if ($MODULO == 'paciente'){
			$displayagenda = "none";
			$displayatendimento = "none";		
			$displaypaciente = "block";		
			$displayreferenciais = "none";
			$displayadministracao = "none";		
			$displaycotacao = "none";					
			$displayrelatorio = "none";						
		}else if ($MODULO == 'referenciais'){
			$displayagenda = "none";
			$displayatendimento = "none";		
			$displaypaciente = "none";		
			$displayreferenciais = "block";
			$displayadministracao = "none";		
			$displaycotacao = "none";		
			$displayrelatorio = "none";						
		}else if ($MODULO == 'administracao'){
			$displayagenda = "none";
			$displayatendimento = "none";		
			$displaypaciente = "none";		
			$displayreferenciais = "none";
			$displayadministracao = "block";
			$displaycotacao = "none";					
			$displayrelatorio = "none";						
		}else if ($MODULO == 'cotacao'){
			$displayagenda = "none";
			$displayatendimento = "none";		
			$displaypaciente = "none";		
			$displayreferenciais = "none";
			$displayadministracao = "none";
			$displaycotacao = "block";					
			$displayrelatorio = "none";						
		}else if ($MODULO == 'relatorios'){
			$displayagenda = "none";
			$displayatendimento = "none";		
			$displaypaciente = "none";		
			$displayreferenciais = "none";
			$displayadministracao = "none";		
			$displaycotacao = "none";		
			$displayrelatorio = "block";						
		}
?>
