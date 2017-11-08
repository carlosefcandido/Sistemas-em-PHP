<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$usuario = new classDTO();
	session_start();
	if ($_SESSION['USER']){
		if (!is_array($_SESSION['USER'])){
			$usuario = $_SESSION['USER'];
		}
		unset($_SESSION['USER']);
	}

	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                           <form name="formulario" id="formulario" action="" method="post">
							<input type="hidden" name="acao" id="acao" value="addusuario" />
							
                                <div class="cabecForm">Cadastrar funcion&aacute;rio</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome</th>
                                            <td width="80%"><input type="text" name="funnome" id="funnome" size="70" value="<?php echo $usuario->getCampo("funnome");?>" maxlength="100" OnKeyUp="caixaAlta(this);" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Sexo</th>
                                            <td width="80%">
											<input type="radio" name="funsexo" id="funsexo" value="M" <?php if(($usuario->getCampo("funsexo") == 'M') || ($usuario->getCampo("funsexo") == NULL)){ echo "checked";}?>/>Masculino
											<input type="radio" name="funsexo" id="funsexo" value="F" <?php if($usuario->getCampo("funsexo") == 'F'){ echo "checked";}?>/>Feminino									
											</td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="funtelefone" id="funtelefone" size="15" value="<?php echo $usuario->getCampo("funtelefone");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											&nbsp;Celular <input type="text" name="funcelular" id="funcelular" size="15" value="<?php echo $usuario->getCampo("funcelular");?>" maxlength="13" onkeyup="maskIt(this,event,'(##)####-####')" />
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Perfil</th>
                                            <td width="80%">
												<select name="perfil" id="perfil">
													<option value=""></option>
													<option value="A" <?php if($usuario->getCampo("perfil") == 'A'){ echo "selected";}?>>Administrador</option>
													<option value="U" <?php if($usuario->getCampo("perfil") == 'U'){ echo "selected";}?>>Usu&aacute;rio</option>
												</select>	
											</td>
											
                                        </tr>										
                                        <tr>
                                            <th width="20%">Login</th>
                                            <td width="80%"><input type="text" name="login" id="login" size="20" value="<?php echo $usuario->getCampo("login");?>" onChange="verificaDisponibilidadeLogin(this);" maxlength="10" /><div id="disponibilidade" style="display:block"></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Senha</th>
                                            <td width="80%"><input type="password" name="senha" id="senha" size="20" value="" maxlength="10" OnKeyUp="checa_seguranca(document.formulario.senha.value,'forcasenha');" /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Confirma&ccedil;&atilde;o senha</th>
                                            <td width="80%"><input type="password" name="confirmacaosenha" id="confirmacaosenha" size="20" value="" maxlength="12" OnKeyUp="verifica_senha(document.formulario.senha.value,document.formulario.confirmacaosenha.value);" /><div id="forcasenha" style="display:none"></div></td>
                                        </tr>										
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Cadastrar " id="botao" onclick="adicionarUsuario('Confirma cadastrar o funcionário?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
