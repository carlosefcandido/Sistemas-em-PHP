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
							<input type="hidden" name="acao" id="acao" value="blockusuario" />
							<input type="hidden" name="passo" id="passo" value="2" />
							<input type="hidden" name="usuid" id="usuid" value="<?php echo $usuario->getCampo("usuid");?>" />
							
                                <div class="cabecForm">Bloquear/desbloquear usu&aacute;rio</div>
                                <div class="corpoForm">
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Nome</th>
                                            <td width="80%"><input type="text" name="funnome" id="funnome" size="70" value="<?php echo $usuario->getCampo("funnome");?>" maxlength="100" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Perfil</th>
                                            <td width="80%">
												<select name="perfil" id="perfil" disabled>
													<option value=""></option>
													<option value="A" <?php if($usuario->getCampo("usuperfil") == 'A'){ echo "selected";}?>>Administrador</option>
													<option value="U" <?php if($usuario->getCampo("usuperfil") == 'U'){ echo "selected";}?>>Usu&aacute;rio</option>
													<option value="M" <?php if($usuario->getCampo("usuperfil") == 'M'){ echo "selected";}?>>M&eacute;dico</option>
												</select>	
											</td>
                                        </tr>																													
                                        <tr>
                                            <th width="20%">Bloquear/Desbloquear</th>
                                            <td width="80%">
											<input type="radio" name="usubloqueado" id="usubloqueado" value="S" <?php if($usuario->getCampo("usubloqueado") == 'S'){ echo "checked";}?>/>Sim
											<input type="radio" name="usubloqueado" id="usubloqueado" value="N" <?php if($usuario->getCampo("usubloqueado") == 'N'){ echo "checked";}?>/>N&atilde;o									
											</td>
                                        </tr>										
                                    </table>
                                </div>
                                <div class="barraBotoes">
                                    <input type="button" value=" Alterar " id="botao" onclick="excluir('Confirma alterar o usuário?');" />
                                    <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');" />
                                </div>
                            </form>
