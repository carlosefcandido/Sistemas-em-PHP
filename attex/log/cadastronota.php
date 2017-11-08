<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
<script type='text/javascript' src='./js/cep.js'></script>
<title>Cadastro de Notas</title>
</head>

<body style='font-family: arial, helvetica, serif;'>
<table width="700px" border="1" >
  <tr>
    <td width="19%">Chave de Acesso</td>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <input type="text" name="chave_acesso" id="chave_acesso" style="width:90%"/>
    </form></td>
    <td width="9%">Pedido</td>
    <td width="28%"><input type="text" name="pedido" id="pedido" style="width:100%"/></td>
  </tr>
  <tr>
    <td>Nome/Razão Social</td>
    <td colspan="4"><input type="text" name="nome" id="nome" style="width:100%"/></td>
  </tr>
  <tr>
    <td>CPF/CNPJ</td>
    <td colspan="2"><input type="text" name="cpf_cnpj" id="cpf_cnpj" style="width:100%"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Data de Emissão</td>
    <td width="26%"><input type="text" name="data_emissao" id="data_emissao" style="width:100%"/></td>
    <td colspan="2">Data de Saída/Entrega</td>
    <td><input type="text" name="data_saida" id="data_saida" style="width:100%"/></td>
  </tr>
</table>
<table width="700px" border="1">
  <tr>
    <td width="20%">CEP</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>Endereço</td>
    <td colspan="3">&nbsp;</td>
    <td width="13%">Número</td>
    <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td>Bairro</td>
    <td width="22%">&nbsp;</td>
    <td width="9%">Cidade</td>
    <td width="19%">&nbsp;</td>
    <td>Estado</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Telefone</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
</body>
</html>