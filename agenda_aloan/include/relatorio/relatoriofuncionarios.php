<?php
	require_once "../../classes/classDTO.php";
	require_once "../../funcoes/funcoes.php";
	require_once "../../fpdf/fpdf.php";
	require_once "../../defines/defineMSG.php";
	
session_start();
$FUNCIONARIOS = $_SESSION['FUNCIONARIOS'];
$funcionario = new classDTO();

####################################### CABEÇALHO ################################################################
//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf= new FPDF("P","mm","A4");
//define a fonte a ser usada
$pdf->SetFont('arial','',10);
// posicao vertical no caso -1.. e o limite da margem
$titulo="RELATÓRIO DE FUNCIONÁRIOS";
$pdf->SetY("-1");
//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
$pdf->Cell(0,5,$titulo,0,0,'C');
$pdf->Cell(0,5,'Pagina '.$pdf->PageNo(),0,0,'R');
//endereco da imagem,posicao X(horizontal),posicao Y(vertical), tamanho altura, tamanho largura
$pdf->Image("../../imagens/logo_websoft.jpg",10,1,12,12);
$pdf->Cell(0,5,'',0,1,'R');
$pdf->Cell(0,0,'',1,1,'L');
$pdf->Ln(8);

######################################### CONTEÚDO ################################################################
if (!$FUNCIONARIOS){
	$pdf->SetX("10");
	$pdf->SetY("18");	
	$pdf->SetTextColor(255,0,0);
	$pdf->Cell(0,5,_MSGNENHUMAPDF_,0,0,'L');	
}else{
	$linha = 16;
	$cor = 0;
	foreach($FUNCIONARIOS as $funcionario){
		if ($linha >= 240){
			##############################  IMPRIME O RODAPÉ ############################################
			$pdf->SetFont('arial','',8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetY("271");
			$pdf->SetX("5");
			$pdf->MultiCell(0,5,'http://www.websoft.inf.br',0,'C',false);
			//$pdf->Cell(0,5,'http://www.websoft.inf.br',0,0,'C');

			//data atual
			$data=date("d/m/Y");
			$conteudo="gerado em ".$data;
			$texto="Websoft Ltda © 2010";
			//posiciona verticalmente 270mm
			$pdf->SetY("271");
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,0,'',1,1,'L');
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,5,$texto,0,0,'L');
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,5,$conteudo,0,1,'R');
			##############################  ADICIONA NOVA PÁGINA ############################################
//			$pdf->AddPage('P','A4');
			##############################  IMPRIME O CABEÇALHO ############################################
			//define a fonte a ser usada
			$pdf->SetFont('arial','',10);
			// posicao vertical no caso -1.. e o limite da margem
//			$titulo="RELATÓRIO DE MATÉRIA CADASTRADA";
			$pdf->SetY("-1");
			//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
			$pdf->Cell(0,5,$titulo,0,0,'C');
			$pdf->Cell(0,5,'Pagina '.$pdf->PageNo(),0,0,'R');			
			//endereco da imagem,posicao X(horizontal),posicao Y(vertical), tamanho altura, tamanho largura
			$pdf->Image("../../imagens/logo_websoft.jpg",10,1,12,12);
			$pdf->Cell(0,5,'',0,1,'R');
			$pdf->Cell(0,0,'',1,1,'L');
			$pdf->Ln(8);
			$linha = 16;
			$cor = 0;
		}	
		$coluna = 10;
		if($cor == 0){
			$pdf->SetFillColor(235,235,235);			
			$cor = 1;	
		}else{
			$pdf->SetFillColor(255,255,255);					
			$cor = 0;			
		}

		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'CÓD:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+7);
//		$pdf->Link($culna,$linha,190,13,'../include/materias/consultamateriaview.php?cd_noticia='.$paciente->getCampo("pacid"));
		$pdf->MultiCell(0,5,$funcionario->getCampo("funid"),0,'L',true);		
				
		
		$pdf->SetFont('arial','B',7);		
		$coluna+= 25;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'FUNCIONÁRIO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+19);
		$pdf->MultiCell(0,5,$funcionario->getCampo("funnome"),0,'L',true);		
		
		$linha+= 4;
		$coluna = 10;
		
		$pdf->SetFont('arial','B',7);		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'ENDEREÇO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+16);
		$pdf->MultiCell(0,5,$funcionario->getCampo("funendereco"),0,'L',true);		

		$pdf->SetFont('arial','B',7);		
		$coluna+= 150;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'NÚMERO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+13);
		$pdf->MultiCell(0,5,$funcionario->getCampo("funnumero"),0,'L',true);				
		
		$linha+= 4;
		$coluna = 10;
		
		$pdf->SetFont('arial','B',7);		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'BAIRRO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha+1);		
		$pdf->SetX($coluna+12);
		$pdf->MultiCell(0,3,$funcionario->getCampo("funbairro"),0,'J',true);

		$coluna+= 80;
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'CIDADE:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+11);
		$pdf->MultiCell(0,5,$funcionario->getCampo("cidnome"),0,'L',true);

		$coluna+= 70;
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'ESTADO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+12);
		$pdf->MultiCell(0,5,$funcionario->getCampo("estuf"),0,'L',true);		
		
		$linha+= 4;
		$coluna = 10;
		
		$pdf->SetFont('arial','B',7);		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'TELEFONE:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha+1);		
		$pdf->SetX($coluna+15);
		$pdf->MultiCell(0,3,$funcionario->getCampo("telefone"),0,'J',true);

		$coluna+= 80;
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'TELEFONE:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+14);
		$pdf->MultiCell(0,5,$funcionario->getCampo("celular"),0,'L',true);

		$linha+= 4;
		$coluna = 10;
		
		$pdf->SetFont('arial','B',7);		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'FUNÇÃO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha+1);		
		$pdf->SetX($coluna+12);
		$pdf->MultiCell(0,3,$funcionario->getCampo("funcnome"),0,'J',true);

		$coluna+= 80;
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'UNIDADE CONTRATANTE:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+33);
		$pdf->MultiCell(0,5,$funcionario->getCampo("uninome"),0,'L',true);
		
		$coluna+= 80;
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(0,5,'BLOQUEADO:',0,'L',true);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna+18);
		$pdf->MultiCell(0,5,$funcionario->getCampo("funbloqueado"),0,'L',true);		
		
//		$tamanhoresumo = strlen(trim($paciente->getCampo("resumo_noticia")));
//		$linha+= floor(3*($tamanhoresumo / 130));
//		$pdf->MultiCell(0,3,$linha1." - ".$linha,0,'L',true);				
		$linha+= 4;
		
/*		$pdf->SetFont('arial','B',7);		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'TEXTO:',0,'L',false);
		$pdf->SetFont('arial','',7);		
		$pdf->SetY($linha+1);		
		$pdf->SetX($coluna+12);
		$pdf->MultiCell(0,3,utf8_encode($materia->getCampo("texto_noticia")),0,'L',false);				

		$tamanhotexto = strlen($materia->getCampo("texto_noticia"));
		$linha+= ($tamanhotexto / 40) + 6;
*/
	}
}
########################################### RODAPÉ ################################################################
$pdf->SetFont('arial','',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetY("271");
$pdf->SetX("5");
$pdf->MultiCell(0,5,'http://www.websoft.inf.br',0,'C',false);
//$pdf->Cell(0,5,'http://www.websoft.inf.br',0,0,'C');

//data atual
$data=date("d/m/Y");
$conteudo="gerado em ".$data;
$texto="Websoft Ltda © 2010";
//posiciona verticalmente 270mm
$pdf->SetY("271");
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,0,'',1,1,'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,5,$texto,0,0,'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,5,$conteudo,0,1,'R');
//imprime a saida do arquivo..
$pdf->Output();


unset($_SESSION['FUNCIONARIOS']);
?>
