<?php
	require_once "modulo.php";
?>

                    <div id="menuGeral" class="box" style="width: 200px">
                        <div class="rotulo" id="rotuloagenda" style="display:<?php echo $displayagenda; ?>">
                            <strong>Menu Agenda</strong>
                        </div>
                        <div class="corpo" id="menuagenda" style="display:<?php echo $displayagenda; ?>">
                            <div><a href="javascript:abrirMiolo('agendarconsulta');"><img src="../imagens/addagenda.png" border="0">&nbsp;&nbsp;Marcar Consulta</a></div>
                            <div><a href="javascript:abrirMiolo('editconsulta');"><img src="../imagens/editagenda.png" border="0">&nbsp;&nbsp;Alterar Consulta</a></div>							
							<div><a href="javascript:abrirMiolo('deleteconsulta');"><img src="../imagens/deleteagenda.png" border="0">&nbsp;&nbsp;Excluir Consulta</a></div>														
                        </div>

                        <div class="rotulo" id="rotuloatendimento" style="display:<?php echo $displayatendimento; ?>">
                            <strong>Menu Atendimento</strong>
                        </div>
                        <div class="corpo" id="menuatendimento" style="display:<?php echo $displayatendimento; ?>">
							<div><a href="javascript:abrirMiolo('confirmaratendimento');"><img src="../imagens/confirmarconsulta.png" border="0">&nbsp;&nbsp;Confirmar Atendimento</a></div>
                            <div><a href="javascript:abrirMiolo('atenderpaciente');"><img src="../imagens/atenderpaciente.png" border="0">&nbsp;&nbsp;Atender Paciente</a></div>
                            <div><a href="javascript:abrirMiolo('visualizaratendimento');"><img src="../imagens/visualizaratendimento.png" border="0">&nbsp;&nbsp;Visualizar Atendimentos</a></div>							
							
                        </div>
                        
                        <div class="rotulo" id="rotuloreferenciais" style="display:<?php echo $displayreferenciais; ?>">
                            <strong>Menu Configura&ccedil;&otilde;es</strong>
                        </div>
                        <div class="corpo" id="menureferenciais" style="display:<?php echo $displayreferenciais; ?>">
                            <div><a href="javascript:abrirMiolo('especialidadeexame');"><img src="../imagens/especialidadeexame1.png" border="0">&nbsp;&nbsp;Especialidade x Exame</a></div>
                            <div><a href="javascript:abrirMiolo('addexame');"><img src="../imagens/exame1.png" border="0">&nbsp;&nbsp;Exame</a></div>
							<div><a href="javascript:abrirMiolo('medicoexame');"><img src="../imagens/medicoexame.png" border="0">&nbsp;&nbsp;M&eacute;dico x Exame</a></div>
                            <div><a href="javascript:abrirMiolo('planoconvenio');"><img src="../imagens/plano1.png" border="0">&nbsp;&nbsp;Conv&ecirc;nio</a></div>
                            <div><a href="javascript:abrirMiolo('horariomedico');"><img src="../imagens/clock.png" border="0">&nbsp;&nbsp;Hor&aacute;rio M&eacute;dico</a></div>							
                            <div><a href="javascript:abrirMiolo('bloquearhorariomedico');"><img src="../imagens/clockblock.png" border="0">&nbsp;&nbsp;Bloquear Hor&aacute;rio M&eacute;dico</a></div>														
                            <div><a href="javascript:abrirMiolo('addtable');"><img src="../imagens/addtabela.png" border="0">&nbsp;&nbsp;Nova tabela de valores</a></div>														
                            <div><a href="javascript:abrirMiolo('uploadtable');"><img src="../imagens/uploadtabela.png" border="0">&nbsp;&nbsp;Upload de valores</a></div>																					
                            <div><a href="javascript:abrirMiolo('edittable');"><img src="../imagens/edittabela.png" border="0">&nbsp;&nbsp;Alterar valores</a></div>																					
                            <div><a href="javascript:abrirMiolo('linktable');"><img src="../imagens/linktabela.png" border="0">&nbsp;&nbsp;Conv&ecirc;nio x Tabelas</a></div>																												
                        </div>

                        <div class="rotulo" id="rotuloadministracao" style="display:<?php echo $displayadministracao; ?>">
                            <strong>Menu Administra&ccedil;&atilde;o</strong>
                        </div>
                        <div class="corpo" id="menuadministracao" style="display:<?php echo $displayadministracao; ?>">
                            <div><a href="javascript:abrirMiolo('addusuario');"><img src="../imagens/addfuncionario.png" border="0">&nbsp;&nbsp;Cadastrar Funcion&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('editusuario');"><img src="../imagens/editfuncionario.png" border="0">&nbsp;&nbsp;Alterar Funcion&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('deleteusuario');"><img src="../imagens/deletefuncionario.png" border="0">&nbsp;&nbsp;Excluir Funcion&aacute;rio</a></div>
							<div><a href="javascript:abrirMiolo('blockusuario');"><img src="../imagens/deleteuserfornecedor.png" border="0">&nbsp;&nbsp;Bloquear/Desbloquear Usu&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('addmedico');"><img src="../imagens/addmedico.png" border="0">&nbsp;&nbsp;Cadastrar M&eacute;dico</a></div>
                            <div><a href="javascript:abrirMiolo('editmedico');"><img src="../imagens/editmedico.png" border="0">&nbsp;&nbsp;Alterar M&eacute;dico</a></div>
                            <div><a href="javascript:abrirMiolo('deletemedico');"><img src="../imagens/deletemedico.png" border="0">&nbsp;&nbsp;Excluir M&eacute;dico</a></div>
                        </div>

                        <div class="rotulo" id="rotulocotacao" style="display:<?php echo $displaycotacao; ?>">
                            <strong>Menu Cota&ccedil;&atilde;o</strong>
                        </div>
                        <div class="corpo" id="menucotacao" style="display:<?php echo $displaycotacao; ?>">
                            <div><a href="javascript:abrirMiolo('editfornecedor');"><img src="../imagens/editfornecedor.png" border="0">&nbsp;&nbsp;Alterar dados</a></div>
                            <div><a href="javascript:abrirMiolo('adduserfornecedor');"><img src="../imagens/adduserfornecedor.png" border="0">&nbsp;&nbsp;Adicionar Usu&aacute;rio</a></div>							
                            <div><a href="javascript:abrirMiolo('deleteuserfornecedor');"><img src="../imagens/deleteuserfornecedor.png" border="0">&nbsp;&nbsp;Excluir Usu&aacute;rio</a></div>														
                            <div><a href="javascript:abrirMiolo('respondercotacao');"><img src="../imagens/respondercotacao.png" border="0">&nbsp;&nbsp;Responder Cota&ccedil;&atilde;o</a></div>
                            <div><a href="javascript:abrirMiolo('solicitarcotacao');"><img src="../imagens/cotacao.png" border="0">&nbsp;&nbsp;Nova Cota&ccedil;&atilde;o</a></div>
                            <div><a href="javascript:abrirMiolo('editcotacao');"><img src="../imagens/editcotacao.png" border="0">&nbsp;&nbsp;Alterar Cota&ccedil;&atilde;o</a></div>							
                            <div><a href="javascript:abrirMiolo('deletecotacao');"><img src="../imagens/deletecotacao.png" border="0">&nbsp;&nbsp;Excluir Cota&ccedil;&atilde;o</a></div>														
                            <div><a href="javascript:abrirMiolo('relatorioequalizacao');"><img src="../imagens/relatorioequalizacao.png" border="0">&nbsp;&nbsp;Relat&oacute;rio Equaliza&ccedil;&atilde;o</a></div>
                            <div><a href="javascript:abrirMiolo('visualizarcotacao');"><img src="../imagens/visualizarcotacao.png" border="0">&nbsp;&nbsp;Visualizar Cota&ccedil;&atilde;o</a></div>
                        </div>
                        
                        <div class="rotulo" id="rotulorelatorio" style="display:<?php echo $displayrelatorio; ?>">
                            <strong>Menu Relat&oacute;rio</strong>
                        </div>
                        <div class="corpo" id="menurelatorio" style="display:<?php echo $displayrelatorio; ?>">
                            <div><a href="javascript:abrirMiolo('relatoriopacientes');"><img src="../imagens/relatorio.png" border="0">&nbsp;&nbsp;Relat&oacute;rio de pacientes</a></div>
                            <!--<div><a href="javascript:abrirMiolo('relatoriounidades');"><img src="../imagens/relatorio.png" border="0">&nbsp;&nbsp;Relat&oacute;rio de unidades</a></div>-->
                            <!--<div><a href="javascript:abrirMiolo('relatoriofuncionarios');"><img src="../imagens/relatorio.png" border="0">&nbsp;&nbsp;Relat&oacute;rio de funcion&aacute;rios</a></div>-->
							<div><a href="javascript:abrirMiolo('relatorioagenda');"><img src="../imagens/relatorio.png" border="0">&nbsp;&nbsp;Relat&oacute;rio da agenda</a></div>							
                        </div>


                        
                    </div>