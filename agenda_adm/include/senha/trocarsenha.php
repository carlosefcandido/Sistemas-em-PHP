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
                            <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="alterarsenha" />
							<input type="hidden" name="passo" id="passo" value="2" />
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
