<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
<script type='text/javascript' src='./js/cep.js'></script>
<style>
#tabela {
position:absolute;
left: 50%;
top:50%;
margin-left: -180px;
margin-top: -100px;
border: 1px solid #000;
width: 360px;
height: 200px;
text-align:center;
}
.but {
display: inline-block;
background-color: #ccc;
color: #444;
padding: 10px 20px;
text-decoration: none;
box-sizing: border-box;
font-family: Helvetica, Arial, sans-serif;
font-size: 14px;
border: 0px;
}
</style>
<title>Login</title>
</head>

<body style='font-family: arial, helvetica, serif;'>
<table id="tabela">
  <tr>
    <td colspan="2" align="center">
      <h1>Login</h1>
      <form id="form1" name="form1" method="post" action="">
    </td>
  </tr>
  <tr>
    <td width="8%">Login</td>
    <td width="36%">
      <label for="login"></label>
      <input type="text" name="login" id="login"/>
    </td>
   </tr> 
   <tr>
    <td width="6%">Senha</td>
    <td width="50%">
      <label for="senha"></label>
      <input type="password" name="senha" id="senha"/>
    </td>
   </tr>
   <tr>
    <td colspan="2">
      <a class="but" href="cadastronota.php">Logar</a>
    </td>
   </tr> 
  </table>
  </form>
<p>&nbsp;</p>
</body>
</html>