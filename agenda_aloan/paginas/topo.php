<?php
	require_once "modulo.php";
?>

 <table border="0" width="100%" cellpadding="0" cellspacing="0" class="principal">
            <tr>
                <td bgcolor="#D3DED1" colspan="2">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr> 
                	<td width="60%"><div id="logoAloa"></div></td> 
                    <td width="40%"><div id="usuario"> 
						<a href="javascript:abrirMiolo('trocarsenha');" title="Trocar senha"><img src="../imagens/seguranca.png" border="0" alt="Trocar senha"> Trocar Senha</a> 
						|
						<a href="../logout.php" title="Sair do sistema"><img src="../imagens/logout.png" border="0" alt="Sair do sistema"> Sair do sistema</a> 
                    </div></td> 
                 </tr> 
                 </table>
                </td>				
            </tr>
            <tr bgcolor="#D3DED1">
                <td colspan="2">
                    <!-- Abas de Cima -->
                    <div class="tabs" id="agenda" style="display:<?php echo $displayagenda; ?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <!--<th><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;Agenda&nbsp;</a></th>
								<td><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;<u>Atendimento</u>&nbsp;</a></td>																																								
								<td><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;<u>Configura&ccedil;&otilde;es</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;<u>Administra&ccedil;&atilde;o</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;<u>Cota&ccedil;&atilde;o</u>&nbsp;</a></td>																								
								<td><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;<u>Relat&oacute;rio</u>&nbsp;</a></td>	-->															
                            </tr>
                        </table>
                    </div>
                    <div class="tabs" id="atendimento" style="display:<?php echo $displayatendimento;?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;<u>Agenda</u>&nbsp;</a></td>
								<th><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;Atendimento&nbsp;</a></th>																																								
								<td><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;<u>Configura&ccedil;&otilde;es</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;<u>Administra&ccedil;&atilde;o</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;<u>Cota&ccedil;&atilde;o</u>&nbsp;</a></td>																								
								<td><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;<u>Relat&oacute;rio</u>&nbsp;</a></td>														
                            </tr>
                        </table>
                    </div>					
                    <div class="tabs" id="referenciais" style="display:<?php echo $displayreferenciais;?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;<u>Agenda</u>&nbsp;</a></td>
								<td><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;<u>Atendimento</u>&nbsp;</a></td>																																								
								<th><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;Configura&ccedil;&otilde;es&nbsp;</a></th>								
								<td><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;<u>Administra&ccedil;&atilde;o</u>&nbsp;</a></td>							
								<td><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;<u>Cota&ccedil;&atilde;o</u>&nbsp;</a></td>																
								<td><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;<u>Relat&oacute;rio</u>&nbsp;</a></td>																
                            </tr>
                        </table>
                    </div>
                    <div class="tabs" id="administracao" style="display:<?php echo $displayadministracao;?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;<u>Agenda</u>&nbsp;</a></td>
								<td><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;<u>Atendimento</u>&nbsp;</a></td>																																								
								<td><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;<u>Configura&ccedil;&otilde;es</u>&nbsp;</a></td>								
								<th><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;Administra&ccedil;&atilde;o&nbsp;</a></th>	
								<td><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;<u>Cota&ccedil;&atilde;o</u>&nbsp;</a></td>																								
								<td><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;<u>Relat&oacute;rio</u>&nbsp;</a></td>																
                            </tr>
                        </table>
                    </div>

                    <div class="tabs" id="cotacao" style="display:<?php echo $displaycotacao;?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;<u>Agenda</u>&nbsp;</a></td>
								<td><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;<u>Atendimento</u>&nbsp;</a></td>																																								
								<td><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;<u>Configura&ccedil;&otilde;es</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;<u>Administra&ccedil;&atilde;o</u>&nbsp;</a></td>	
								<th><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;Cota&ccedil;&atilde;o&nbsp;</a></th>																								
								<td><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;<u>Relat&oacute;rio</u>&nbsp;</a></td>																
                            </tr>
                        </table>
                    </div>
					
                    <div class="tabs" id="relatorios" style="display:<?php echo $displayrelatorio;?>">
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td><a href="javascript:alternarAba('agenda','menuagenda','rotuloagenda');" title="M&oacute;dulo de Agenda">&nbsp;<img src="../imagens/agenda2.png" border="0">&nbsp;<u>Agenda</u>&nbsp;</a></td>
								<td><a href="javascript:alternarAba('atendimento','menuatendimento','rotuloatendimento');" title="M&oacute;dulo de Atendimento">&nbsp;<img src="../imagens/atendimento.png" border="0">&nbsp;<u>Atendimento</u>&nbsp;</a></td>																																								
								<td><a href="javascript:alternarAba('referenciais','menureferenciais','rotuloreferenciais');" title="M&oacute;dulo de Configura&ccedil;&otilde;es">&nbsp;<img src="../imagens/information.png" border="0">&nbsp;<u>Configura&ccedil;&otilde;es</u>&nbsp;</a></td>								
								<td><a href="javascript:alternarAba('administracao','menuadministracao','rotuloadministracao');" title="M&oacute;dulo de Administra&ccedil;&atilde;o">&nbsp;<img src="../imagens/ferramenta1.png" border="0">&nbsp;Administra&ccedil;&atilde;o&nbsp;</a></td>	
								<td><a href="javascript:alternarAba('cotacao','menucotacao','rotulocotacao');" title="M&oacute;dulo de Cota&ccedil;&atilde;o">&nbsp;<img src="../imagens/cotacao2.png" border="0">&nbsp;<u>Cota&ccedil;&atilde;o</u>&nbsp;</a></td>																								
								<th><a href="javascript:alternarAba('relatorios','menurelatorio','rotulorelatorio');" title="M&oacute;dulo de Relat&oacute;rio">&nbsp;<img src="../imagens/relatorio.png" border="0">&nbsp;Relat&oacute;rio&nbsp;</a></th>																
                            </tr>
                        </table>
                    </div>
					
                </td>
            </tr>
	</table>
