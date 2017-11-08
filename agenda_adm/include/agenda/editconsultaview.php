<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	require "classes/classPaginacao.php";

	session_start();
	$CONSULTAS = $_SESSION['CONSULTAS'];
	$disabled = "";
	if(count($CONSULTAS) < 1){
		$disabled = "disabled";
	}

	if (!$_GET['pagina']){
		$iniciopagina = 1;
		$proxima = 9;
		$anterior = 1;
		$primeira = 1;
		$ultima = count($CONSULTAS) - 8;
	}else{
		$iniciopagina = $_GET['pagina'];
		$proxima = $_GET['pagina'] + 8;
		$anterior = $_GET['pagina'] - 8;
		$primeira = 1;
		$ultima = count($CONSULTAS) - 8;		
	}

	if ($ultima <= $primeira){
		$ultima = 1;	
	}
	if ($anterior <= $primeira){
		$anterior = 1;	
	}
	if ($proxima > $ultima){
		$proxima = $ultima;	
	}
	

	$qtdecols = 6;
	$campos = array (0 => 'marid',
					 1 => 'agedata',
					 2 => 'agehora',
					 3 => 'pacnome',
					 4 => 'pactelefone',					 
					 5 => 'mednome',
					 );
	$tamanhos = array (0 => '4%',
					   1 => '5%',
					   2 => '5%',
					   3 => '35%',
					   4 => '16%',
					   5 => '35%',					   
   				     );
	
	$pagina = new classPaginacao();
	$dados = $pagina->paginarGeneric($CONSULTAS,$iniciopagina,$qtdecols,$campos,$tamanhos,'sim');
?>

							<form name="formulario" id="formulario" action="" method="post">
						   <input type="hidden" name="acao" value="editconsulta" />
						   <input type="hidden" name="passo" value="2" />
							
                                <div class="cabecForm">
                                	<table width="95%">
                                    	<tr>
                                        	<td width="78%"><font color="#666666" size="2pt"><b>Alterar consulta</b></font></td>
                                          	<td width="22%">
<a href="javascript:abrirPaginacao('editconsultaview',<?php echo $primeira;?>);"><img src="../imagens/pricinza.png" border="0" title="Primeira p&aacute;gina" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editconsultaview',<?php echo $anterior;?>);"><img src="../imagens/antcinza.png" border="0" title="P&aacute;gina anterior" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editconsultaview',<?php echo $proxima;?>);"><img src="../imagens/procinza.png" border="0" title="Pr&oacute;xima p&aacute;gina" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editconsultaview',<?php echo $ultima;?>);"><img src="../imagens/ultcinza.png" border="0" title="&Uacute;ltima p&aacute;gina" /></a>&nbsp;&nbsp;                                            
                                            </td>
                                    </table>
                                </div>
                                <div class="corpoForm">
                                    <table class="tabelaRelatorio">
                                        <tr>
                                            <th width="4%">Sel.</th>
                                            <th width="5%">Data</th>
											<th width="5%">Hora</th>
											<th width="35%">Paciente</th>
											<th width="16%">Telefone</th>
											<th width="35%">M&eacute;dico</th>
										</tr>
				   					    <?php echo $dados;?>	
                                    </table>
                                </div>
                                <div class="barraBotoes">
 <input type="submit" value="Continuar" id="botao" onclick="enviar();" <?php echo $disabled;?> />&nbsp;&nbsp;
 <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');"/> 
                                </div>
								</form>