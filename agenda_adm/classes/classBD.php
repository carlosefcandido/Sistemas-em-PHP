<?php

		 	// Acesso ao banco de dados Mysql
			class classBD
			{
			
					protected $hostname;
					protected $dbname;
					protected $user;
					protected $pass;
					protected $con;
				
					function classBD(){

						/*$this->hostname = "mysql02.websoft.inf.br";
						$this->dbname   = "websoft1";
						$this->user     = "websoft1";
						$this->pass     = "adit2456t@";*/

						$this->hostname = "localhost";
						$this->dbname   = "mpradoin_agendaaloan";
						$this->user     = "mpradoin_adm";
						$this->pass     = "mprado123";
						
						$this->con	    = NULL;
						
					}
									
					function conectar(){
						$this->con = @mysql_connect($this->hostname, $this->user, $this->pass, $this->dbname);
				
						if ($this->con){
							return true;
						}else{
							return false;
						}
					}

					function executarSQL($sql){
						$bd = @mysql_select_db($this->dbname,$this->con);			
						$res = @mysql_query($sql,$this->con);
						return $res;
					}

					function fecharConexao(){
							@mysql_close($this->con);
					}

					function qtdeLinhas($res){
						return @mysql_num_rows($res);			
					}

}		
 
?>