<?php

class classDTO
{
	private $campos = array();
		
	function criarCampos($indice,$valor)
	{
		$this->campos[$indice] = $valor;		
	}
		
	function getCampo($indice)
	{
		return $this->campos[$indice];
	}

	function setCampo($indice,$valor)
	{
		$this->campos[$indice] = $valor;
	}
}		

?>