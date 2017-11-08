<?php

//classe que define as requisições
class classGeneric
{
		private $obj;
	
		function construir($res,$classe)
		{
			$this->obj = new $classe();
				
			//identifica os campos
			for($i = 0; $i < mysql_num_fields($res); $i++)
			{
				$tipo[$i] = mysql_field_type($res, $i);
				$nome[$i] = mysql_field_name($res, $i);
			}				

			//atribui os valores do banco ao objeto criado
			$linha = mysql_fetch_array($res);

			for($i = 0; $i < mysql_num_fields($res); $i++)
			{
				$this->obj->criarCampos($nome[$i],$linha[$nome[$i]]);
			}
			return $this->obj;
		}

		function construirPostgres($res,$classe)
		{
			$this->obj = new $classe();
				
			//identifica os campos
			for($i = 0; $i < pg_num_fields($res); $i++)
			{
				$tipo[$i] = pg_field_type($res, $i);
				$nome[$i] = pg_field_name($res, $i);
			}				

			//atribui os valores do banco ao objeto criado
			$linha = pg_fetch_array($res);

			for($i = 0; $i < pg_num_fields($res); $i++)
			{
				$this->obj->criarCampos($nome[$i],$linha[$nome[$i]]);
			}
			return $this->obj;
		}
		
}		

?>