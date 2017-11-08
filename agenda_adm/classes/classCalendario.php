<?php  

	ini_set("max_execution_time", "946080000");
	
class classCalendario{  
  var $mes = array( 
                   '01' => 'JANEIRO', 
                   '02' => 'FEVEREIRO', 
                   '03' => 'MAR&Ccedil;O', 
                   '04' => 'ABRIL', 
                   '05' => 'MAIO', 
                   '06' => 'JUNHO', 
                   '07' => 'JULHO', 
                   '08' => 'AGOSTO', 
                   '09' => 'SETEMBRO', 
                   '10' => 'OUTUBRO', 
                   '11' => 'NOVEMBRO', 
                   '12' => 'DEZEMBRO' 
                  ); 

	function diasemana($data) {
		$dia =  substr("$data", 0, 2);		
		$mes =  substr("$data", 3, 2);		
		$ano =  substr("$data", 6, 4);
		$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	
		switch($diasemana) {
			case"0": $diasemana = "dom";       break;
			case"1": $diasemana = "seg"; break;
			case"2": $diasemana = "ter";   break;
			case"3": $diasemana = "qua";  break;
			case"4": $diasemana = "qui";  break;
			case"5": $diasemana = "sex";   break;
			case"6": $diasemana = "sab";        break;
	}

	return $diasemana;
}

function mes_anterior($dia,$mes,$ano){ 
    if($mes == 1){ 
       $man = 12; 
       $aan = $ano - 1; 
    } else { 
       $man = $mes - 1; 
       $aan = $ano; 
    } 

    $val = checkdate($man,$dia,$aan); 
    if($val == 0){ 
      $dia = 1; 
    } 
    echo '<center><a href="javascript:navegaAgenda(\''.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$man).'/'.$aan.'\');" title="M&ecirc;s anterior"><img src="../imagens/pricinza.png" border="0"></a></center>'; 
  } 
  function proximoDia($data){
    $arr = explode("/",$data); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 
	$dias = 1;
	return date("d/m/Y",mktime(0, 0, 0, $mes, $dia+$dias, $ano));
  }
  function diaAnterior($data){
    $arr = explode("/",$data); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 
	$dias = 1;
	return date("d/m/Y",mktime(0, 0, 0, $mes, $dia-$dias, $ano));
  }
  function dia_anterior($data, $idmedico){ 
    echo '<center><a href="javascript:confirmarAtendimento('.$idmedico.',\''.classCalendario::diaAnterior($data).'\');" title="Dia anterior"><img src="../imagens/pricinza.png" border="0"></a></center>'; 
  }

  function dia_proximo($data, $idmedico){ 
    echo '<center><a href="javascript:confirmarAtendimento('.$idmedico.',\''.classCalendario::proximoDia($data).'\');" title="Pr&oacute;ximo dia"><img src="../imagens/ultcinza.png" border="0"></a></center>'; 
  }
  
  function mes_proximo($dia,$mes,$ano){ 
    if($mes == 12){ 
       $mpr = 1; 
       $apr = $ano + 1; 
    } else { 
       $mpr = $mes + 1; 
       $apr = $ano; 
    } 

    $val = checkdate($mpr,$dia,$apr); 
    if($val == 0){ 
      $dia = 1; 
    } 
    echo '<center><a href="javascript:navegaAgenda(\''.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mpr).'/'.$apr.'\');" title="Pr&oacute;ximo m&ecirc;s"><img src="../imagens/ultcinza.png" border="0"></a></center>'; 
  } 

  function ano_anterior($dia,$mes,$ano){ 
    $aan = $ano - 1; 
    echo '<center><a href="javascript:navegaAgenda(\''.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mes).'/'.$aan.'\');" title="Ano anterior"><img src="../imagens/pricinza.png" border="0"></a></center>'; 
  } 

  function ano_proximo($dia,$mes,$ano){ 
    $apr = $ano + 1; 
    echo '<center><a href="javascript:navegaAgenda(\''.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mes).'/'.$apr.'\');" title="Pr&oacute;ximo ano"><img src="../imagens/ultcinza.png" border="0"></a></center>'; 
  } 
  function criaDia($data,$iddomedico){ 
  
    $arr = explode("/",$data); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 

	$qtdeDiasMesAtual = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); 
	
	$tabela = '<table cellspacing="1" cellpadding="1" width="100%" border="1" bordercolor="#D3DED1">';
	
	$diadasemana = classCalendario::diasemana($data);
	//pega os horários do médico no dia da semana informado
	$medicoDAO = new classMedicoDAO();
	$horariosmedico = array();
	$horariosmedico = $medicoDAO->montarHorariosAtendimentoDia($diadasemana,$iddomedico,$data);

	$tabela.= $horariosmedico;
	$tabela.= '</table>';		
	
  echo ' 
		<input type="hidden" name="dataselecionada" id="dataselecionada" value="'.$dia."/".$mes."/".$ano.'" />
        <table cellspacing="1" cellpadding="1" width="100%" border="1" bordercolor="#D3DED1"> 
          <tr bgcolor="#D3DED1"> 
            <td width="15%"> 
  '; 
  $this->dia_anterior($data, $iddomedico); 
  echo ' 
            </td> 
            <td width="70%"><center><font color="#666666"><b>'.$dia.'/'.$mes.'/'.$ano.'</b></font></center></td> 
            <td width="15%"> 
  '; 
  $this->dia_proximo($data,$iddomedico); 
  echo ' 
</td>  
  '; 
  
  echo $tabela;
  echo ' 
        </table> 
  ';
  }
  
  function cria($data,$iddomedico){ 
	//busca os dias da semana que os médicos trabalham
	$medicoDAO = new classMedicoDAO();
	$medicos = array();
	$medicos = $medicoDAO->listarMedicosHorarios($iddomedico,'');

	//busca os horários bloqueados
	$horariosBloqueados = $medicoDAO->listarMedicosHorariosBloqueados($iddomedico,$data);
	
    $arr = explode("/",$data); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 

    if(($dia == '') OR ($mes = '') OR ($ano = '')){ 
      $data = date("d/m/Y"); 
      $arr = explode("/",$data); 
      $dia = $arr[0]; 
      $mes = $arr[1]; 
      $ano = $arr[2]; 
    } 

    $arr = explode("/",$data); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 

    $val = checkdate($mes,$dia,$ano); // Verifica se a data é válida 
    if($val == 1){ 
      $ver = date('d/m/Y', mktime(0,0,0,$mes,$dia,$ano)); 
    } else { 
      $ver = date('d/m/Y', mktime(0,0,0,date(m),date(d),date(Y))); 
    } 

    $arr = explode("/",$ver); 
    $dia = $arr[0]; 
    $mes = $arr[1]; 
    $ano = $arr[2]; 

    $ult = date("d", mktime(0,0,0,$mes+1,0,$ano)); 
    $dse = date("w", mktime(0,0,0,$mes,1,$ano)); 

    $tot = $ult+$dse; 
    if($tot != 0){ 
      $tot = $tot+7-($tot%7); 
    } 

    for($i=0;$i<$tot;$i++){ 
      $dat = $i-$dse+1; 
      if(($i >= $dse) AND ($i < ($dse+$ult))){ 
        $aux[$i]  = ' 
          <td '; 

        if(($dat == date(d)) AND ($mes == date(m)) AND ($ano == date(Y))){ 
          $aux[$i] .= 'class="calendario_dias"'; 
        } else { 
          $aux[$i] .= 'class="calendario_dias"'; 
        } 

        if(($dat == date(d)) AND ($mes == date(m)) AND ($ano == date(Y))){ 
          $aux[$i] .= 'class="calendario_links_hoje"'; 
        } else { 
          $aux[$i] .= 'class="calendario_links"'; 
        } 		
		$diadasemana = classCalendario::diasemana(sprintf("%02.0f",$dat).'/'.$mes.'/'.$ano);		
		$dadosImpressao = "";
		if($medicos){
			$medicosSemana = array();
			foreach($medicos as $medico){
				//verifica se o médico trabalha naquele dia da semana
				if($medico->getCampo("medhorhorariodiasemana") == $diadasemana){
					$trabalha = true;
					$bloqueia = false;
					for($qtde=0;$qtde<count($medicosSemana);$qtde++){
						//verifica se o médico já foi impresso naquele dia da semana
						if($medicosSemana[$qtde] == $medico->getCampo("medid")){
							$trabalha = false;
							$qtde = count($medicosSemana);
						}
					}
					//verifica se o médico possui algum horário bloqueado
					if($horariosBloqueados){
						foreach($horariosBloqueados as $horarioBloqueado){
							if($medico->getCampo("medid") == $horarioBloqueado->getCampo("medhorblomedico")){
								$dataCalendario = $ano.'-'.$mes.'-'.sprintf("%02.0f",$dat);
								if($dataCalendario == $horarioBloqueado->getCampo("medhorblodata")){
									if(($horarioBloqueado->getCampo("medhorbloentrada") == '00:00:00') && 
										($horarioBloqueado->getCampo("medhorblosaida") == '00:00:00')){
										$bloqueia = true;
									}
								}
							}
						}
					}
					
					//imprime os dados do médico caso haja horário
					if($trabalha){	
						$dataatual = sprintf("%02.0f",$dat).'/'.$mes.'/'.$ano;
						$medicosSemana[count($medicosSemana)] = $medico->getCampo("medid");
						$nomeMedico = explode(" ",$medico->getCampo("mednome"));
						if($medico->getCampo("medsexo") == 'M'){
							$prefixo = "Dr. ";
						}else{
							$prefixo = "Dra. ";
						}
						
						$link = '<a href="javascript:abrirHorarios('.$medico->getCampo("medid").',\''.$dataatual.'\');" title="Abrir hor&aacute;rios">';
						$linkfim = '</a>';	
						if($bloqueia){
							$link = "";
							$linkfim = ""; 									
							$dadosImpressao.= $link;
							$dadosImpressao.= '<font size="1" face="Arial">';
							$dadosImpressao.= $prefixo.$nomeMedico[0]." (".$medico->getCampo("espnome").")</font>".$linkfim."&nbsp;<img src='../imagens/frames/erroPq.gif' border='0'><br/><br/>";													
						
						}else{
							if(!$medicoDAO->verificaDisponibilidade($medico,$dataatual,$diadasemana)){
								//$aux[$i] = '<td class="calendario_dias_hoje"'; 
								if($medico->getCampo("medencaixe") == 'N'){
									$link = "";
									$linkfim = ""; 									
								}						
								$dadosImpressao.= $link;
								$dadosImpressao.= '<font size="1" face="Arial">';
								$dadosImpressao.= $prefixo.$nomeMedico[0]." (".$medico->getCampo("espnome").")</font>".$linkfim."&nbsp;<img src='../imagens/frames/erroPq.gif' border='0'><br/><br/>";													
							}else{
								$dadosImpressao.= $link;
								$dadosImpressao.= '<font size="1" face="Arial">';
								$dadosImpressao.= $prefixo.$nomeMedico[0]." (".$medico->getCampo("espnome").")</font>".$linkfim."&nbsp;<img src='../imagens/frames/sucessoPq.gif' border='0'><br/><br/>";						
							}
						}
					}
				}
			}
		}
//      $aux[$i] .= '><center><a href="calendario.php?data='.sprintf("%02.0f",$dat).'/'.$mes.'/'.$ano.'">'.$dat.'</a></center>          
        $aux[$i] .= '><center><b>DIA '.$dat.'</b><br/>'.$dadosImpressao.'</center> 
          </td> 
        '; 
      } else { 
        $aux[$i] = ' 
          <td> 
          </td> 
        '; 
    } 

    if(($i%7) == 0){ 
      $aux[$i] = '<tr align="center">'.$aux[$i]; 
    } 

    if(($i%7) == 6){ 
      $aux[$i] .= '</tr>'; 
    } 
  } 

  echo ' 
		<input type="hidden" name="dataselecionada" id="dataselecionada" value="'.$dia."/".$mes."/".$ano.'" />
        <table cellspacing="1" cellpadding="1" width="100%" border="1" bordercolor="#D3DED1"> 
          <tr bgcolor="#D3DED1"> 
            <td> 
  '; 
  $this->mes_anterior($dia,$mes,$ano); 
  echo ' 
            </td> 
            <td colspan="5"><center><font color="#666666"><b>'.$this->mes[$mes].'</b></font></center></td> 
            <td> 
  '; 
  $this->mes_proximo($dia,$mes,$ano); 
  echo ' 
</td> 
          </tr> 

          <tr bgcolor="#D3DED1"> 
            <td> 
  '; 
  $this->ano_anterior($dia,$mes,$ano); 
  echo ' 
            </td> 
            <td colspan="5"><center><font color="#666666"><b>'.$ano.'</b></font></center></td> 
            <td> 
  '; 
  $this->ano_proximo($dia,$mes,$ano); 
  echo ' 
            </td> 
          </tr> 

          <tr bgcolor="#D3DED1"> 
            <td WIDTH="15%"><center><font color="#666666"><b>DOMINGO</b></font></center></td> 
            <td WIDTH="14%"><center><font color="#666666"><b>SEGUNDA</b></font></center></td> 
            <td WIDTH="14%"><center><font color="#666666"><b>TER&Ccedil;A</b></font></center></td> 
            <td WIDTH="14%"><center><font color="#666666"><b>QUARTA</b></font></center></td> 
            <td WIDTH="14%"><center><font color="#666666"><b>QUINTA</b></font></center></td> 
            <td WIDTH="14%"><center><font color="#666666"><b>SEXTA</b></font></center></td> 
            <td WIDTH="15"><center><font color="#666666"><b>S&Aacute;BADO</b></font></center></td> 
          </tr> 
  '; 
  echo implode(' ',$aux); 
  if(count($aux) == 35){ 
    echo ' 
          <tr> 
            <td colspan="7">&nbsp;</td> 
          </tr> 
    '; 
  }; 
  echo ' 
        </table> 
  '; 
  
   }  
   
}  

?>