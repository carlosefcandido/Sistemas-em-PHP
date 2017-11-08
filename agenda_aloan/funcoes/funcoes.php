<?php

	//formata data no formato YYYY-MM-DD para DD/MM/YYYY
	function formatarData($data){
		$ano = substr($data,0,4);
		$mes = substr($data,5,2);
		$dia = substr($data,8,2);
		$hora = substr($data,10,9);
		$data = $dia."/".$mes."/".$ano." ".$hora;
		return $data;
	}

	//formata data no formato DD/MM/YYYY para YYYY-MM-DD
	function formatarDataBD($data){
		$dia = substr($data,0,2);
		$mes = substr($data,3,2);
		$ano = substr($data,6,4);
		$hora = substr($data,10,9);
		$data = $ano."/".$mes."/".$dia." ".$hora;
		return $data;
	}

	
	function nomeImagem($arquivo){
		$tamanho = strlen($arquivo);
		$nomimagem = substr($arquivo,0,($tamanho - 4));						
		return $nomimagem;
	}
	
	function extensaoImagem($arquivo){
		$extimagem = substr($arquivo, -4);
		return $extimagem;
	}
	
	function carregarObjeto($dados){
		$obj = new classDTO();
		if ($dados){
			foreach($dados as $indice=>$value){
				if (trim($indice) == 'senha'){
					$value = md5($value);
				}
				$obj->setCampo(trim($indice),addslashes(trim($value)));
			}
		}
		return $obj;
	}
	
	function testaSessao(){
		session_start();
		if (!isset($_SESSION['USUARIO'])){
			return true;
		}else{
			return false;
		}
	}	
	
		function montaComboEstadoCivil($estado,$nomecampo){
		$combo = '<select name="'.$nomecampo.'" id="'.$nomecampo.'">';
		$combo.= '<option></option>';
		$combo.= '<option value="S" ';
		if ($estado == 'S'){ $combo.= "selected";}
		$combo.= '>Solteiro</option>';
		$combo.= '<option value="C" ';
		if ($estado == 'C'){ $combo.= "selected";}
		$combo.= '>Casado</option>';
		$combo.= '<option value="D" ';
		if ($estado == 'D'){ $combo.= "selected";}
		$combo.= '>Divorciado</option>';
		$combo.= '<option value="V" ';
		if ($estado == 'V'){ $combo.= "selected";}
		$combo.= '>Vi&uacute;vo</option>';
		$combo.= '<option value="O" ';
		if ($estado == 'O'){ $combo.= "selected";}		
		$combo.= '>Outro</option>';
		$combo.= '</select>';
		return $combo;
	
	}
	
	function montaComboNacionalidade($nacionalidade,$nomecampo){
		$combo = '<select name="'.$nomecampo.'" id="'.$nomecampo.'">';
		$combo.= '<option></option>';
		$combo.= '<option value="B" ';
		if ($nacionalidade == 'B'){ $combo.= "selected";}		
		$combo.= '>Brasileira</option>';
		$combo.= '<option value="E" ';
		if ($nacionalidade == 'E'){ $combo.= "selected";}		
		$combo.= '>Estrangeira</option>';
		$combo.= '</select>';
		return $combo;
	}	
	
	function proximoDia($data){
		$dataE = explode("/",$data);
		$dia = $dataE[0];
		$mes = $dataE[1];
		$ano = $dataE[2];
		$dias = 1;
		return date("d/m/Y",mktime(0, 0, 0, $mes, $dia+$dias, $ano));
	}	
	
	function diferencaEntreDatas($dataini, $datafim){
		$databd= explode("/",$dataini); 
		$data = mktime(0,0,0,$databd[1],$databd[0],$databd[2]);
		
		$databdfim= explode("/",$datafim); 
		$datafim = mktime(0,0,0,$databdfim[1],$databdfim[0],$databdfim[2]);
		
		return (($datafim - $data)/86400);
	}
?>