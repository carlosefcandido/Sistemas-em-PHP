<?php
	require_once "modulo.php";
?>

                    <div id="menuGeral" class="box" style="width: 180px">
                        <div class="rotulo" id="rotuloagenda" style="display:<?php echo $displayagenda; ?>">
                            <strong>Menu Agenda</strong>
                        </div>
                        <div class="corpo" id="menuagenda" style="display:<?php echo $displayagenda; ?>">
                            <div><a href="javascript:abrirMiolo('agendarconsulta');"><img src="../imagens/addagenda.png" border="0">&nbsp;&nbsp;Marcar Consulta</a></div>
                            <div><a href="javascript:abrirMiolo('editconsulta');"><img src="../imagens/editagenda.png" border="0">&nbsp;&nbsp;Alterar Consulta</a></div>							
							<div><a href="javascript:abrirMiolo('deleteconsulta');"><img src="../imagens/deleteagenda.png" border="0">&nbsp;&nbsp;Excluir Consulta</a></div>														
                        </div>
                        
                        <div class="rotulo" id="rotuloreferenciais" style="display:<?php echo $displayreferenciais; ?>">
                            <strong>Menu Informações Referenciais</strong>
                        </div>
                        <div class="corpo" id="menureferenciais" style="display:<?php echo $displayreferenciais; ?>">
                            <div><a href="javascript:abrirMiolo('especialidadeexame');"><img src="../imagens/especialidadeexame.png" border="0">&nbsp;&nbsp;Especialidade x Exame</a></div>
                            <div><a href="javascript:abrirMiolo('medicoexame');"><img src="../imagens/medicoexame.png" border="0">&nbsp;&nbsp;Médico x Exame</a></div>
                            <div><a href="javascript:abrirMiolo('planoconvenio');"><img src="../imagens/plano1.png" border="0">&nbsp;&nbsp;Plano de Convênio</a></div>
                            <div><a href="javascript:abrirMiolo('horariomedico');"><img src="../imagens/clock.png" border="0">&nbsp;&nbsp;Hor&aacute;rio M&eacute;dico</a></div>							
                        </div>

                        <div class="rotulo" id="rotuloadministracao" style="display:<?php echo $displayadministracao; ?>">
                            <strong>Menu Administra&ccedil;&atilde;o</strong>
                        </div>
                        <div class="corpo" id="menuadministracao" style="display:<?php echo $displayadministracao; ?>">
                            <div><a href="javascript:abrirMiolo('addusuario');"><img src="../imagens/addfuncionario.png" border="0">&nbsp;&nbsp;Cadastrar Usu&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('editusuario');"><img src="../imagens/editfuncionario.png" border="0">&nbsp;&nbsp;Alterar Usu&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('deleteusuario');"><img src="../imagens/deletefuncionario.png" border="0">&nbsp;&nbsp;Excluir Usu&aacute;rio</a></div>
                            <div><a href="javascript:abrirMiolo('addmedico');"><img src="../imagens/addmedico.png" border="0">&nbsp;&nbsp;Cadastrar M&eacute;dico</a></div>
                            <div><a href="javascript:abrirMiolo('editmedico');"><img src="../imagens/editmedico.png" border="0">&nbsp;&nbsp;Alterar M&eacute;dico</a></div>
                            <div><a href="javascript:abrirMiolo('deletemedico');"><img src="../imagens/deletemedico.png" border="0">&nbsp;&nbsp;Excluir M&eacute;dico</a></div>
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