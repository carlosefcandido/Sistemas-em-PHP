<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);

	require "../classes/classDTO.php";
	
	session_start();
	if (!isset($_SESSION['USUARIO']))
	{
			header("Location: ../logout.php");
	}

	$USUARIO = $_SESSION['USUARIO'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

    <head>

        <title>MEDIFILEWEB - Sistema de Gest&atilde;o de Cl&iacute;nicas</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/estilosinternos.css" media="screen" />

<?php
	//JAVASCRIPT DE JORNALISTA
	include "../javascript/javascript.php";
?>
		
    </head>

    <body>

<?php
	eval($topo);
?>
		
 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td colspan="2">
                    <!-- Mensagens -->
                    <div id="mensagens">
                        <p class='avisoProcesso'>&nbsp;Usu&aacute;rio logado: <b><?php echo $USUARIO->getCampo('funnome') ?></b></p>
                  </div>
              </td>
            </tr>

            <tr>

                <td colspan="2">

                    <!-- Miolo -->
					<div id="ajax" style="display: none;" align="center"></div>                  					

                    <center>                        

                        <div style="width: 750px">
                                <div class="corpoForm">
								<br/>
									<div id="mensagemInformacao" class="mensagemInformacao" style="width:550px;display:block">
										<p><strong>Bem vindo ao sistema WEBMED - Sistema de Gest&atilde;o de Cl&iacute;nica.</strong></p>
										<p>Esse &eacute; o seu primeiro acesso, por isso defina uma nova senha para o seu usu&aacute;rio e lembre que a sua senha &eacute; pessoal.</p>
									</div>
								<br/>	
<?php
	session_start();
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}


?>
                            <form name="formulario" id="formulario" action="../sistema/" method="post">
							<input type="hidden" name="acao" id="acao" value="alterarsenha" />
							<input type="hidden" name="passo" id="passo" value="1" />							
                                <div class="cabecForm">Gerar nova senha</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nova senha</th>
                                            <td width="80%"><input type="password" name="senha" id="senha" size="20" value="" maxlength="12" OnKeyUp="checa_seguranca(document.formulario.senha.value,'forcasenha');" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Confirma&ccedil;&atilde;o senha</th>
                                            <td width="80%"><input type="password" name="confirmacaosenha" id="confirmacaosenha" size="20" value="" maxlength="12" OnKeyUp="verifica_senha(document.formulario.senha.value,document.formulario.confirmacaosenha.value);" /><div id="forcasenha" style="display:none"></div></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Alterar " id="botao" onclick="alterarSenha('Confirma alterar a senha?');"/>
                                    <input type="button" value="Cancelar" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>

                                </div>
                        </div>                        

                    </center>

                    <br><br><br>

                </td>

            </tr>

<?php
	include "../paginas/rodape.php";
?>

        </table>

    </body>

</html>



