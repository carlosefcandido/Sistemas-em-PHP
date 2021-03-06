<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);

	require "../classes/ftp.php";
	require "../classes/classDTO.php";

	session_start();
	if(!isset($_SESSION['LAUDO'])){
		header("Location: http://www.mprado.info/agenda/laudo/");
	}else{
		$LAUDO = $_SESSION['LAUDO'];
	}
	
	$arquivo = $LAUDO->getCampo("arquivo");
	$dirLocal = "arquivos/".$arquivo;

	
	if (file_exists($dirLocal)) {
		$xml = simplexml_load_file($dirLocal);
	} else {
		header("Location: http://www.mprado.info/agenda/laudo/");
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
function imprime() {
	window.print();
}
</script>

</head>
<body onLoad="imprime();">
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td bgcolor="#0000CD" colspan="2">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" >
                <tr> 
                	<td width="80%"><img src="../imagens/logoaloa1.jpg" border="0"></div></td> 
                    <td width="20%" align="center"></td> 
                 </tr> 
                 </table>
                </td>				
            </tr>
</table>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
	<tr>
        <td><br/></td>
	</tr>
</table>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
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
							<td width="100%" align="center">&nbsp;</td>
						</tr>						
					</table>					
				</td>
            </tr>
        </table>
    </body>
</html>

