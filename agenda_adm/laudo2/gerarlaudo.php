<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="width:100%;height:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<title>WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>

<script language="javascript">
<!--
function handleEnter(event) {
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

if (document.getElementById("login") == null)
{
	document.getElementById("login").focus();
	return false;
}
else if (document.getElementById("senha") == null)
{
	document.getElementById("senha").focus();
	return false;
}
else if (keyCode == 13) {
  valida_login();
}
return false;
}
-->
</script>

<script type="text/javascript">
function valida_login()
{
	acao = "gerarlaudo";
	login = document.getElementById("login").value;
	senha = document.getElementById("senha").value;	
	document.getElementById('ajax').innerHTML = "<img src='imagens/011.gif' />";	
	document.getElementById('ajax').style.display = "block";

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
			document.getElementById("ajax").innerHTML="";
			var resultado = xmlhttp.responseText;
			document.getElementById('ajax').style.display = "none";			
			document.getElementById("login").value = login;
			document.getElementById("senha").value = "";		
			document.getElementById('login').focus();				
			var retorno = resultado.split(" | ");
            if (retorno[0] == "Ok"){
           		window.location.href=retorno[1];
            }else{
				alert(retorno[1]);
            }
		}
	}
	xmlhttp.open("GET","act.php?login="+login+"&senha="+senha+"&acao="+acao,true);
	xmlhttp.send(null);
}

</script>

</head>

<body style="width:100%;
		   height:100%;
		   margin:0px;" class="bodyLogin">
           
<table width="100%" class="table_principal" height="100%" align="left" cellpadding="0" cellspacing="0" border="0">	
    <tr>
    	<td align="center" valign="middle" width="100%" style="border:0px; padding-bottom:40px">
        	<table width="560px" align="center" height="318" border="0" cellpadding="0" cellspacing="0" background="imagens/back_web.png" style="background-repeat:no-repeat;">
<tr>
                	<td align="right" style=" padding-right:55px; padding-top:15px">
<div id="ajax" style="display: none;" align="center"></div>                  
                  </td>
</tr>                         

          
            	<tr>
                	<td align="right" style=" padding-right:55px; padding-top:0px">

                        <form name="frm_login" id="frm_login" method="post" action="">
                        <br />
                        <table cellpadding="0" cellspacing="0" width="152px" height="100px" border="0" style="border:1px solid #006600; background-color:#FDFFFD;">

                            <tr><td align="left" valign="bottom" style="color:#006600; padding-left:15px; padding-top:5px">Login:</td></tr>
                            <tr>
                                <td align="center"><input type="text" style="width:80px; border:1px solid #006600; font-size:10px;" name="login" id="login" onkeypress="handleEnter(event)" /></td>
                            </tr>
                            <tr><td align="left" valign="bottom" style="color:#006600; padding-left:15px">Senha:</td></tr>
                            <tr>
                                <td align="center"><input type="password" style="width:80px; border:1px solid #006600; font-size:10px" name="senha" id="senha" onkeypress="handleEnter(event)" /></td>
                            </tr>            
                            <tr>
                                <td height="12px"></td>
                            </tr>                            
                            <tr><td height="5px" align="center">
                            <input type="button" name="botao" id="botao" value=" Acessar " class="botao" onclick="valida_login()" /></td></tr>
                            <tr>
                                <td height="15px"></td>
                            </tr>
                          </table>
                        </form>
                    </td>
                </tr>
                    <span style="position:relative; top:360px; text-align:center; font-size: 10px"><img src="imagens/logo_websoft.gif" border="0" width="15px" height="15px">&nbsp;<a href="http://www.websoft.inf.br" target="_blank">Websoft Ltda</a></span>
            </table>
        </td>   
    </tr>
</table>            
</body>
</html>
<script language="javascript">
	document.getElementById('login').focus();
</script>
