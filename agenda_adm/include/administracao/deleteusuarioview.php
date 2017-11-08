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
							<input type="hidden" name="acao" id="acao" value="deleteusuario" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="id" id="id" value="<?php echo $usuario->getCampo("funid");?>" />
							<input type="hidden" name="perfil" id="perfil" value="<?php echo $usuario->getCampo("usuperfil");?>" />							
							
                                <div class="cabecForm">Excluir funcion&aacute;rio</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome</th>
                                            <td width="80%"><input type="text" name="funnome" id="funnome" size="70" value="<?php echo $usuario->getCampo("funnome");?>" maxlength="100" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Sexo</th>
                                            <td width="80%">
											<input type="radio" name="funsexo" id="funsexo" value="M" <?php if(($usuario->getCampo("funsexo") == 'M') || ($usuario->getCampo("funsexo") == NULL)){ echo "checked";}?> disabled />Masculino
											<input type="radio" name="funsexo" id="funsexo" value="F" <?php if($usuario->getCampo("funsexo") == 'F'){ echo "checked";}?> disabled />Feminino									
											</td>
                                        </tr>										
                                        <tr>
                                            <th width="20%">Telefone</th>
                                            <td width="80%"><input type="text" name="funtelefone" id="funtelefone" size="15" value="<?php echo $usuario->getCampo("funtelefone");?>" maxlength="13" readonly />
											&nbsp;Celular <input type="text" name="funcelular" id="funcelular" size="15" value="<?php echo $usuario->getCampo("funcelular");?>" maxlength="13" readonly />
											</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Perfil</th>
                                            <td width="80%">
												<select name="perfil" id="perfil" disabled>
													<option value=""></option>
													<option value="A" <?php if($usuario->getCampo("usuperfil") == 'A'){ echo "selected";}?>>Administrador</option>
													<option value="U" <?php if($usuario->getCampo("usuperfil") == 'U'){ echo "selected";}?>>Usu&aacute;rio</option>
												</select>	
											</td>
											
                                        </tr>																			
                                        <tr>
                                            <th width="20%">Login</th>
                                            <td width="80%"><input type="text" name="login" id="login" size="20" value="<?php echo $usuario->getCampo("usulogin");?>" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Senha</th>
                                            <td width="80%"><input type="password" name="senha" id="senha" size="20" value="<?php echo $usuario->getCampo("ususenha");?>" maxlength="10" readonly /></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Excluir " id="botao" onclick="excluir('Confirma excluir o funcionário?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
