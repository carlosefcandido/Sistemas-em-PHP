<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	ini_set("max_execution_time", "946080000");
	
	require_once "../classes/classBD.php";
	require_once "../classes/classGeneric.php";
	require_once "../classes/classDTO.php";
	require_once "../classes/classUsuarioDAO.php";	
	require_once "../classes/classClinicaDAO.php";	
	require_once "../classes/classCidadeDAO.php";	
	require_once "../classes/classEstadoDAO.php";	
	require_once "../classes/classUnidadeDAO.php";	
	require_once "../classes/classFuncaoDAO.php";	
	require_once "../classes/classFuncionarioDAO.php";	
	require_once "../classes/classTipoAcessoDAO.php";	
	require_once "../classes/classPlanoDAO.php";	
	require_once "../funcoes/funcoes.php";	
	require_once "../defines/defineMSG.php";
	require_once "../defines/defineSQL.php";
	require_once "../fckeditor/fckeditor.php";	
	require_once("../fpdf/fpdf.php");
	
	session_start();
	if (testaSessao()){
			header("Location: ../logout.php");
	}

	$USUARIO = $_SESSION['USUARIO'];

	//processamento dos forms
	include "processarequisicao.php";
	//fim do processamento dos forms
	
	if ($_POST['acao']){
		if ($USUARIO->getCampo('usutipoacesso') == 1){
			$topo = "include '../paginas/topomedico.php';";	
		}else if ($USUARIO->getCampo('usutipoacesso') == 3){
			$topo = "include '../paginas/topo.php';";	
		}else{
			$topo = "include '../paginas/topoadministrativo.php';";	
		}
	}
	if (!$body){	
		$body = "<body onLoad=abrirMiolo('principal');>";
		if ($USUARIO->getCampo('usutipoacesso') == 1){
			$topo = "include '../paginas/topomedico.php';";	
		}else if ($USUARIO->getCampo('usutipoacesso') == 3){
			$topo = "include '../paginas/topo.php';";	
		}else{
			$topo = "include '../paginas/topoadministrativo.php';";	
		}
	}

?>

<html>
    <head>
		<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/estilosinternos.css" media="screen" />

<?php

	//JAVASCRIPT DE JORNALISTA
	include "../javascript/javascript.php";
?>

    
    </head>
<?php
	echo $body;
	eval($topo);
?>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td colspan="2">
                    <!-- Mensagens -->
                    <div id="mensagens">
                        <p class='avisoProcesso'>&nbsp;Usu&aacute;rio logado: <?php echo $USUARIO->getCampo('funnome') ?> </p>
                  </div>
              </td>
            </tr>
            <tr>
                <td valign="top" width="1">

                    <!-- Miolo MENU -->
<?php
	//MENU
	if ($USUARIO->getCampo('usutipoacesso') == 1){
		include "../paginas/menumedico.php";
	}else if ($USUARIO->getCampo('usutipoacesso') == 3){
		include "../paginas/menuadmin.php";	
	}else{
		include "../paginas/menuusuario.php";
	}
?>
<br/>

                    <div id="ajuda" class="menu" style="width: 180px">
                        <div class="rotulo">
                            <strong>Como Fazer?</strong>
                        </div>
                        <div class="corpo">
                            <div>
                                <a href="javascript:abrir('../include/paginamanual.php');" class="linkajuda">Manual</a>
                            </div>
                        </div>
                    </div>
                    <br>
                </td>
                <td align="center" valign="top" width="100%">
                    <div id="miolo" style="width:700px;display:none"></div>

                </td>
            </tr>
<?php
	include "../paginas/rodape.php";
?>
        </table>
    </body>
</html>