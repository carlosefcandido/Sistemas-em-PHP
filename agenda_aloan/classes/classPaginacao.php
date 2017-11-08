<?php

class classPaginacao
{
		
		function paginar($lista,$iniciopagina,$qtdecols,$campos,$tamanhos,$input)
		{	
			$dados = "";
			$i = 0;
			$j;
			$atual = 1;		
			$final = $iniciopagina + 4;
			if ($lista){
				foreach($lista as $indice => $class){
					
					if ($class){
						if (($atual >= $iniciopagina) && ($atual < $final)){
							if ($i == 0){
								$cor = "#FFFFFF";
								$i = 1;
							}else{
								$cor = "#F4F4F4";
								$i = 0;
							}
							$dados .= '<tr bgcolor="'.$cor.'">';
							for ($j=0; $j < $qtdecols; $j++){
								if (($j == 0) && ($input == 'sim')){
									if ($atual == 1){
										$dados .= '<td width="'.$tamanhos[$j].'%">
										<input type="radio" name="cd_noticia" id="cd_noticia" value="'.$class->getCampo("$campos[$j]").'" checked /></td>';																	
									}else{
										$dados .= '<td width="'.$tamanhos[$j].'%">
										<input type="radio" name="cd_noticia" id="cd_noticia" value="'.$class->getCampo("$campos[$j]").'" /></td>';																										
									}
									
								}else{
									
									if (($campos[$j] == 'status_noticia') and ($class->getCampo("status_noticia") == 1)){
										$dados .= '<td width="'.$tamanhos[$j].'%" align="center"><img src="../imagens/folder_go.png" border="0" title="Mat&eacute;ria publicada" alt="Mat&eacute;ria publicada" /></td>';										
										
									}else if(($campos[$j] == 'status_noticia') and ($class->getCampo("status_noticia") == 0)){
										$dados .= '<td width="'.$tamanhos[$j].'%" align="center"><img src="../imagens/folder_error.png" border="0" title="Mat&eacute;ria aguardando autoriza&ccedil;&atilde;o para publica&ccedil;&atilde;o" alt="Mat&eacute;ria aguardando autoriza&ccedil;&atilde;o para publica&ccedil;&atilde;o" /></td>';										
										
									}else{
										$dados .= '<td width="'.$tamanhos[$j].'%">'.$class->getCampo("$campos[$j]").'</td>';
									}
								}
							}
							$dados .= '</tr>';
						}
						$atual++;
					}
				}
			}else{
				$dados = "<tr><td colspan='".$qtdecols."'><font color='red'>Nenhuma informação foi encontrada.</font></td></tr>";
			}
			return $dados;
		}
		function paginarGeneric($lista,$iniciopagina,$qtdecols,$campos,$tamanhos,$input)
		{	
			$dados = "";
			$i = 0;
			$j;
			$atual = 1;		
			$final = $iniciopagina + 8;
			if ($lista){
				foreach($lista as $indice => $class){
					if ($class){
						if (($atual >= $iniciopagina) && ($atual < $final)){
							if ($i == 0){
								$cor = "#FFFFFF";
								$i = 1;
							}else{
								$cor = "#F4F4F4";
								$i = 0;
							}
							$dados .= '<tr bgcolor="'.$cor.'">';
							for ($j=0; $j < $qtdecols; $j++){
								if (($j == 0) && ($input == 'sim')){
									if ($atual == 1){
										$dados .= '<td width="'.$tamanhos[$j].'%">
										<input type="radio" name="'.$campos[$j].'" id="'.$campos[$j].'" value="'.$class->getCampo("$campos[$j]").'" checked /></td>';																	
									}else{
										$dados .= '<td width="'.$tamanhos[$j].'%">
										<input type="radio" name="'.$campos[$j].'" id="'.$campos[$j].'" value="'.$class->getCampo("$campos[$j]").'" /></td>';																										
									}
									
								}else{
									if ($campos[$j] == 'data'){
										$dados .= '<td width="'.$tamanhos[$j].'%">'.formatarData($class->getCampo("$campos[$j]")).'</td>';									
									}else{
										$dados .= '<td width="'.$tamanhos[$j].'%">'.$class->getCampo("$campos[$j]").'</td>';
									}
								}
							}
							$dados .= '</tr>';
						}
						$atual++;
					}
				}
			}else{
				$dados = "<tr><td colspan='".$qtdecols."'><font color='red'>Nenhuma informação foi encontrada.</font></td></tr>";
			}
			return $dados;
		}		
}		

?>