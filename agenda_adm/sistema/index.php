<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	ini_set("max_execution_time", "946080000");
	
	require_once "../classes/classBD.php";
	require_once "../classes/classGeneric.php";
	require_once "../classes/classDTO.php";
	require_once "../classes/classUsuarioDAO.php";	
	require_once "../classes/classFuncionarioDAO.php";	
	require_once "../classes/classEstadoDAO.php";	
	require_once "../classes/classConselhoDAO.php";	
	require_once "../classes/classEspecialidadeDAO.php";
	require_once "../classes/classMedicoDAO.php";	
	require_once "../classes/classExameDAO.php";	
	require_once "../classes/classPlanoDAO.php";
	require_once "../classes/classPacienteDAO.php";	
	require_once "../classes/classAgendaDAO.php";	
	require_once "../classes/classTabelaDAO.php";	
	require_once "../classes/classCalendario.php";	
	require_once "../funcoes/funcoes.php";	
	require_once "../defines/defineMSG.php";
	require_once "../defines/defineSQL.php";
	require_once "../fckeditor/fckeditor.php";	
	require_once "../fpdf/fpdf.php";
	
	session_start();
	if (testaSessao()){
			header("Location: ../logout.php");
	}

	$USUARIO = $_SESSION['USUARIO'];

	//processamento dos forms
	include "processarequisicao.php";
	//fim do processamento dos forms
	
	if ($_POST['acao']){
		$topo = "include '../paginas/topo.php';";	
	}
	
	if (!$body){	
		$body = "<body onLoad=abrirMiolo('principal');>";
		$topo = "include '../paginas/topo.php';";	
	}

?>

<html>
    <head>
		<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/estilosinternos.css" media="screen" />

<link type="text/css" rel="stylesheet" href="../css/calendariohtml.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../css/calendariohtml.js"></script>

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
                        <p class='avisoProcesso'>&nbsp;Usu&aacute;rio logado: <?php echo $USUARIO->getCampo('usulogin') ?> </p>
                  </div>
              </td>
            </tr>
            <tr>
                <td valign="top" width="1">

                    <!-- Miolo MENU -->
<?php
	//MENU
	include "../paginas/menu.php";	
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
                    <div id="miolo" style="width:750px;display:none"></div>

					
					
				</td>
            </tr>
<?php
	include "../paginas/rodape.php";
?>
        </table>
    </body>
</html>