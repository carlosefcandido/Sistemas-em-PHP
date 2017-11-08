<?php

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	require "classes/classPaginacao.php";

	session_start();
	$PACIENTES = $_SESSION['PACIENTES'];

	if (!$_GET['pagina']){
		$iniciopagina = 1;
		$proxima = 9;
		$anterior = 1;
		$primeira = 1;
		$ultima = count($PACIENTES) - 8;
	}else{
		$iniciopagina = $_GET['pagina'];
		$proxima = $_GET['pagina'] + 8;
		$anterior = $_GET['pagina'] - 8;
		$primeira = 1;
		$ultima = count($PACIENTES) - 8;		
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
	

	$qtdecols = 2;
	$campos = array (0 => 'pacid',
					 1 => 'pacnome',
					 );
	$tamanhos = array (0 => '5%',
					   1 => '95%',
   				     );
	
	$pagina = new classPaginacao();
	$dados = $pagina->paginarGeneric($PACIENTES,$iniciopagina,$qtdecols,$campos,$tamanhos,'sim');
?>

						<font  color="#000000" size="2" face="Arial"><b>Filtro</b></font>
						<input type="text" name="pacnome" id="pacnome" size="70" value="<?php echo $_GET['nome'];?>" maxlength="100" onKeyUp="filtarPaciente(this,'paciente/editpaciente.php');" />
						<input type="button" value=" Limpar " onClick="javascript:abrirMiolo('editpaciente');" />
						<br/><br/>	
							<form name="formulario" id="formulario" action="" method="post">
						   <input type="hidden" name="acao" value="editpaciente" />
						   <input type="hidden" name="passo" value="1" />
							
                                <div class="cabecForm">
                                	<table width="95%">
                                    	<tr>
                                        	<td width="78%"><font color="#666666" size="2pt"><b>Alterar paciente</b></font></td>
                                          	<td width="22%">
<a href="javascript:abrirPaginacao('editpaciente',<?php echo $primeira;?>);"><img src="../imagens/pricinza.png" border="0" title="Primeira p&aacute;gina" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editpaciente',<?php echo $anterior;?>);"><img src="../imagens/antcinza.png" border="0" title="P&aacute;gina anterior" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editpaciente',<?php echo $proxima;?>);"><img src="../imagens/procinza.png" border="0" title="Pr&oacute;xima p&aacute;gina" /></a> &nbsp;&nbsp;&nbsp; 
<a href="javascript:abrirPaginacao('editpaciente',<?php echo $ultima;?>);"><img src="../imagens/ultcinza.png" border="0" title="&Uacute;ltima p&aacute;gina" /></a>&nbsp;&nbsp;                                            
                                            </td>
                                    </table>
                                </div>
                                <div class="corpoForm">
                                    <table class="tabelaRelatorio">
                                        <tr>
                                            <th width="5%">Sel.</th>
                                            <th width="95%">Nome</th>
										</tr>
				   					    <?php echo $dados;?>	
                                    </table>
                                </div>
                                <div class="barraBotoes">
 <input type="submit" value="Continuar" id="botao" onclick="enviar();" />&nbsp;&nbsp;
 <input type="button" value="Cancelar" id="botao2" onclick="abrirMiolo('principal');"/> 
                                </div>
								</form>