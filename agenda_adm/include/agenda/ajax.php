<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);	
	require_once "../../classes/classBD.php";
	require_once "../../defines/defineSQL.php";
	
	$BD = new classBD();
	$q=strtolower ($_GET["q"]);
	
	if ($BD->conectar()){
		$sql = "select * from paciente ";
		$sql.= " where pacnome like '%" . $q . "%'";
		$res = $BD->executarSQL($sql);
		while($reg=mysql_fetch_array($res)){
			//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
			//echo "$key|$value\n";
			echo $reg["pacnome"]."|".$reg["pactelefone"]."|".$reg["pacconvenio"]."|".$reg["pacid"]."\n";
		//	}
		}
	}

?>