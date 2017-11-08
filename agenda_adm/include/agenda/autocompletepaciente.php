<?php
	require_once "../../classes/classBD.php";
	require_once "../../defines/defineSQL.php";
	
	$BD = new classBD();
	$q=strtolower ($_GET["q"]);
	
	if ($BD->conectar()){
		$sql = _SQL26_;
		$sql.= " where pacnome like '%" . $q . "%'";
		$res = $BD->executarSQL($sql);
		while($reg=mysql_fetch_array($res)){
			//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
			$telefone = $reg["paccelular"];
			if($reg["pactelefone"] != NULL){
				$telefone = $reg["pactelefone"];
			}
			echo $reg["pacnome"]." - ".$telefone."\n";
		//	}
		}
	}
?>