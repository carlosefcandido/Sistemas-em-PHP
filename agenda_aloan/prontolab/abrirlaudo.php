<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);

	require "../classes/ftp.php";
	require "../classes/classDTO.php";

	session_start();
	if(!isset($_SESSION['LAUDO'])){
		header("Location: http://www.websoft.inf.br/agenda/prontolab/");
	}else{
		$LAUDO = $_SESSION['LAUDO'];
	}
	
	$arquivo = $LAUDO->getCampo("arquivo");
	$dirLocal = "arquivos/".$arquivo;

	
	if (file_exists($dirLocal)) {
		$xml = simplexml_load_file($dirLocal);
	} else {
		header("Location: http://www.websoft.inf.br/agenda/prontolab/");
	}

	
?>

<html>
    <head>
		<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/estilosinternos.css" media="screen" />

<link type="text/css" rel="stylesheet" href="../css/calendariohtml.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../css/calendariohtml.js"></script>

<script type="text/javascript">
function encerrarSessao()
{
	var acao = "encerrarsessaolaudo";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			window.close();
		}
	}
	xmlhttp.open("GET","act.php?acao="+acao,true);
	xmlhttp.send(null);
}

</script>

<script type="text/javascript"> 
function openModal() {
	var pUrl = "imprimirlaudo.php";
	var pWidth = "800";
	var	pHeight = "600";
	if (window.showModalDialog) { 	
		var dialogReturn = window.showModalDialog(pUrl, window,
		  "dialogWidth:" + pWidth + "px;dialogHeight:" + pHeight + "px");	  
		if(dialogReturn == 'OK'){
			abrirHorarios(medico,data);
		}
	} else {
		try {
			netscape.security.PrivilegeManager.enablePrivilege(
			  "UniversalBrowserWrite");
			window.open(pUrl, "wndModal", "width=" + pWidth
			  + ",height=" + pHeight + ",resizable=no,modal=yes");
			return true;
		}
		catch (e) {
			alert("Script não confiável, não é possível abrir janela modal.");
			return false;
		}
	}
}
</script>

</head>
<body unload="encerrarSessao();">
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td bgcolor="#FFFFFF" colspan="2">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" >
                <tr> 
                	<td width="80%"><div id="logoProntoLab"></div></td> 
                    <td width="20%" align="center"></td> 
                 </tr> 
                 </table>
                </td>				
            </tr>
</table>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td colspan="2">
                    <!-- Mensagens -->
                    <div id="mensagens">
                        <p class='avisoProcesso'>&nbsp;Laudo on line</p>
                  </div>
              </td>
            </tr>
				<tr>
					<td>
					<table border="0" width="90%" cellpadding="0" cellspacing="0" align="center" bgcolor="#EEEEE0">
						<tr>
							<td width="100%" align="left"><b>Laudo</b></td>
						</tr>							
					</table>
					
					<table border="0" width="90%" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
						<tr>
							<td><br></td>
						</tr>

						<tr>
							<td width="100%"><?php echo utf8_decode($xml[0]->Atendimento->Laudo->Conteudo); ?></td>
						</tr>	
						<tr>
							<td width="100%"><img src="http://www.medifile.com.br/Laudo/<?php echo $xml[0]->Atendimento->Laudo->MedicoExecutante->Codigo;?>.jpg" border="0"></td>
						</tr>
						<tr>
							<td><br></td>
						</tr>
						<tr>
							<td><font size="2"><b>OBS:</b> Este &eacute; um exame complementar e, como tal, deve ser analisado pelo m&eacute;dico assistente para correla&ccedil;&atilde;o cl&iacute;nica e decis&atilde;o terap&ecirc;utica.</font></td>
						</tr>
						<tr>
							<td><br></td>
						</tr>						
						<tr>
							<td width="100%" align="center"><input type="button" value=" Imprimir Laudo " onClick="openModal();"></td>
						</tr>		
						<tr>
							<td width="100%" align="center">&nbsp;</td>
						</tr>						
					</table>					
				</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="rodape"><a href="http://www.websoft.inf.br" target="_blank"><img src="../imagens/logo_websoft.gif" border="0" width="15px" height="15px"></a>&nbsp;<a href="http://www.websoft.inf.br" target="_blank">Websoft Ltda</a></div>
                </td>
            </tr>
        </table>
    </body>
</html>

