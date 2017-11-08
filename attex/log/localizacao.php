<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css.css">
<script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
<script type='text/javascript' src='./js/cep.js'></script>
<script type="text/javascript">
	
		function mostra()
		
		{
		  endereco=document.getElementById("endereco").value;
      cep=document.getElementById("cep").value;
      bairro=document.getElementById("bairro").value;
      cidade=document.getElementById("cidade").value;
      estado=document.getElementById("estado").value;
      numero=document.getElementById("numero").value;
		  window.open('https://www.google.com/maps/dir/Meu Local/'+endereco+'-'+bairro+', '+cidade+'-'+estado+'-'+cep);
		  
				 
					  
		}
	
	</script>
	<title>Teste localização</title>
</head>
<body style='font-family: arial, helvetica, serif;'>
	<form id="form1" name="form1" method="post" action="">
<table>		
	<tr>
    <td>CEP (Somente Números)</td>
    <td colspan="2">
      <label for="cep"></label>
      <input type="text" name="cep" id="cep" style="width:90%" maxlength="8"/></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td>Endereço</td>
    <td colspan="3">
      <label for="cidade">
        <input type="text" name="endereco" id="endereco" style="width:95%"/>
        </label>
      <label for="estado"></label></td>
      <td>Número</td>
    <td>
      <label for="numero">
        <input type="text" name="numero" id="numero" style="width:100%"/>
        </label>
     </td>
    </tr>
  <tr>
    <td>Bairro</td>
    <td><input type="text" name="bairro" id="bairro" style="width:90%"/></td>
    <td>Cidade</td>
    <td><input type="text" name="cidade" id="cidade" style="width:90%"/></td>
    <td>Estado</td>
    <td><input type="text" name="estado" id="estado" style="width:100%"/></td>
  </tr>
</table>
<a href="javascript:mostra();"><img src="./images/google-maps-icone.png" width="50"></a>
</body>
</html>