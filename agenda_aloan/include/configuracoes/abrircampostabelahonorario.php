<?php		

	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	$tabelaDAO = new classTabelaDAO();
	$codigosTISS = $tabelaDAO->listarTISS();
	$combotiss = '<select name="tabnomtiss" id="tabnomtiss">';
	$combotiss.= '<option></option>';
	
	if ($codigosTISS){
		foreach($codigosTISS as $codigo){
			$combotiss.= '<option value="'.$codigo->getCampo("tisid").'">'.$codigo->getCampo("tisnome").'</option>';
		}
	}	
	$combotiss.= '</select>';	

	$codigosTipo = $tabelaDAO->listarTiposMoeda();	
	$combotipos = '<select name="tabnomtipomoeda" id="tabnomtipomoeda">';
	$combotipos.= '<option></option>';
	
	if ($codigosTipo){
		foreach($codigosTipo as $codigoTipo){
			$combotipos.= '<option value="'.$codigoTipo->getCampo("tipmoeid").'">'.$codigoTipo->getCampo("tipmoenome").'</option>';
		}
	}	
	$combotipos.= '</select>';
	
	if ($_SESSION['ERROS']){
		echo '<div class="mensagemAlerta" style="width:550px">
              <p><strong>Aten&ccedil;&atilde;o:</strong></p>
              <p>'.$_SESSION["ERROS"].'</p>
              </div><br/>';
		unset($_SESSION['ERROS']);
	}
	
?>
                                    <table class="tabelaHorizontal">
                                        <tr>
                                            <th width="20%">Tiss</th>
                                            <td width="80%"><?php echo $combotiss;?></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Tipo</th>
                                            <td width="80%"><?php echo $combotipos;?></td>
                                        </tr>										
                                    </table>
