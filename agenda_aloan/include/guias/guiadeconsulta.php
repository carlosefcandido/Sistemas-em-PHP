<?php
	require_once "../../classes/classDTO.php";
	//require_once "../../funcoes/funcoes.php";
	require_once "../../fpdf/fpdf.php";
	//require_once "../../defines/defineMSG.php";
	
session_start();
$CONSULTAS = $_SESSION['CONSULTAS'];
$consulta = new classDTO();
$consulta->setCampo("registroans","359017");
$consulta->setCampo("dataemissao",date("d/m/Y"));
$consulta->setCampo("numerocarteira","31313131313131313131");
$consulta->setCampo("plano","INTERMEDICA");
$consulta->setCampo("validadecarteira","10/10/2000");
$consulta->setCampo("paciente","RICARDO CEZAR OLIVEIRA DAMASCENO");
$consulta->setCampo("codigonaoperadora","8578");
$consulta->setCampo("clinica","HOSPITAL DE CLINICAS DR. ALOAN");
$consulta->setCampo("codigocnes","3046303");
$consulta->setCampo("tl","081");
$consulta->setCampo("endereco","CHAVES FARIAS");
$consulta->setCampo("numerocartaonacionalsaude","");
$consulta->setCampo("municipio","RIO DE JANEIRO");
$consulta->setCampo("uf","RJ");
$consulta->setCampo("codibge","3304904");
$consulta->setCampo("cep","20910-140");
$consulta->setCampo("medico","ADAO ORLANDO C. GONCALVES");
$consulta->setCampo("conselho","CRM");
$consulta->setCampo("numeroconselho","439288");
$consulta->setCampo("ufconselho","RJ");
$consulta->setCampo("codigocbo","");
$CONSULTAS[0] = $consulta;
####################################### CABE�ALHO ################################################################
//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf= new FPDF("P","mm","A4");
//define a fonte a ser usada
$pdf->SetFont('arial','',10);
// posicao vertical no caso -1.. e o limite da margem
$titulo="GUIA DE CONSULTA";
$pdf->SetY("-1");
//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
$pdf->Cell(0,5,$titulo,0,0,'C');
$pdf->Cell(0,5,'Pagina '.$pdf->PageNo(),0,0,'R');
//endereco da imagem,posicao X(horizontal),posicao Y(vertical), tamanho altura, tamanho largura
$pdf->Image("../../imagens/logo_websoft.jpg",10,1,12,12);
$pdf->Cell(0,5,'',0,1,'R');
$pdf->Cell(0,0,'',1,1,'L');
$pdf->Ln(8);

######################################### CONTE�DO ################################################################
if (!$CONSULTAS){
	$pdf->SetX("10");
	$pdf->SetY("18");	
	$pdf->SetTextColor(255,0,0);
	$pdf->Cell(0,5,_MSGNENHUMAPDF_,0,0,'L');	
}else{
	$linha = 16;
	$cor = 0;
	foreach($CONSULTAS as $consulta){
		if ($linha >= 240){
			##############################  IMPRIME O RODAP� ############################################
			$pdf->SetFont('arial','',8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetY("271");
			$pdf->SetX("5");
			$pdf->MultiCell(0,5,'http://www.websoft.inf.br',0,'C',false);
			//$pdf->Cell(0,5,'http://www.websoft.inf.br',0,0,'C');

			//data atual
			$data=date("d/m/Y");
			$conteudo="gerado em ".$data;
			$texto="Websoft Ltda � 2010";
			//posiciona verticalmente 270mm
			$pdf->SetY("271");
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,0,'',1,1,'L');
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,5,$texto,0,0,'L');
			//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
			$pdf->Cell(0,5,$conteudo,0,1,'R');
			##############################  ADICIONA NOVA P�GINA ############################################
//			$pdf->AddPage('P','A4');
			##############################  IMPRIME O CABE�ALHO ############################################
			//define a fonte a ser usada
			$pdf->SetFont('arial','',10);
			// posicao vertical no caso -1.. e o limite da margem
//			$titulo="RELAT�RIO DE MAT�RIA CADASTRADA";
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

		//CORPO DA GUIA
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(119,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'1- Registro ANS:',0,'L',false);

		$coluna+= 120;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(70,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'3- Data da Emiss�o da Guia',0,'L',false);
		
		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255);
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(190,5,'Dados do Benefici�rio',1,0,'L',true);

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$linha+= 6;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(68,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'4- N�mero da Carteira',0,'L',false);		
		
		$coluna+= 69;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(65,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'5- Plano',0,'L',false);		
		
		$coluna+= 66;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(55,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'6- Validade da Carteira',0,'L',false);
		
		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(134,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'7- Nome',0,'L',false);		
				
		$coluna+= 135;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(55,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'8- N�mero do Cart�o Nacional de Sa�de',0,'L',false);		

		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255);
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(190,5,'Dados do Contratato Solicitante',1,0,'L',true);

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$linha+= 6;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(48,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'9- C�digo na Operadora / CNPJ / CPF',0,'L',false);		
		
		$coluna+= 49;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(95,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'10- Nome do Contratado',0,'L',false);		
		
		$coluna+= 96;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(45,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'11- C�digo CNES',0,'L',false);
		
		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(10,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'12- T.L.',0,'L',false);		
				
		$coluna+= 11;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(90,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'13- 14- 15- Logradouro - N�mero - Complemento',0,'L',false);

		$coluna+= 91;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(38,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'16- Munic�pio',0,'L',false);	

		$coluna+= 39;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(10,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'17- UF',0,'L',false);	

		$coluna+= 11;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(18,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'18- C�d. IBGE',0,'L',false);		
		
		$coluna+= 19;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(19,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'19- CEP',0,'L',false);		
		
		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(90,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'20- Nome do Profissional Executante',0,'L',false);		
				
		$coluna+= 91;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(33,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'21- Conselho Profissional',0,'L',false);	

		$coluna+= 34;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(31,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'22- N�mero do Conselho',0,'L',false);	

		$coluna+= 32;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(10,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'23- UF',0,'L',false);		

		$coluna+= 11;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(22,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'24- C�digo CBO',0,'L',false);		

		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255);
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(190,5,'Hip�teses Diagn�sticas',1,0,'L',true);

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$linha+= 6;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'25- Tipo de Doen�a',0,'L',false);

		$linha+= 5;		
		$coluna = 12;
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'______  (A) Aguda (C) Cr�nica ',0,'L',false);		
		
		$linha-= 5;				
		$coluna+= 40;
		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(55,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'26- Tempo de Doen�a',0,'L',false);		

		$linha+= 5;		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'____ ____ ____  (A) Anos (M) Meses (D) Dias ',0,'L',false);		
		
		$linha-= 5;				
		
		$coluna+= 56;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(92,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'27- Indica��o de Acidente',0,'L',false);

		$linha+= 5;		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'____ (0) Acidente ou doen�a relacionada ao trabalho (1) Tr�nsito (2) Outros ',0,'L',false);		
		
		$linha+= 6;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'28- CID Principal',0,'L',false);		
				
		$coluna+= 42;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'29- CID(2)',0,'L',false);

		$coluna+= 42;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'30- CID(3)',0,'L',false);	

		$coluna+= 42;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'31- CID(4)',0,'L',false);

		$linha+= 11;
		$coluna = 10;
			
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255);
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(190,5,'Hip�teses Diagn�sticas',1,0,'L',true);

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$linha+= 6;
		$coluna = 10;

		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(41,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'32- Data do Atendimento',0,'L',false);

		$linha+= 5;		
		$coluna = 12;
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,date("d/m/Y"),0,'L',false);		
		
		$linha-= 5;				
		$coluna+= 40;
		
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(55,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'33- C�digo da Tabela',0,'L',false);		

		$linha+= 5;		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'',0,'L',false);		
		
		$linha-= 5;				
		
		$coluna+= 56;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(92,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'34- C�digo do Procedimento',0,'L',false);

		$linha+= 5;		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'',0,'L',false);		
		
		$linha+= 6;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(97,10,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'35- Tipo de Consulta',0,'L',false);		
				
		$coluna+= 98;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(92,10,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'36- Tipo de Sa�da',0,'L',false);

		$linha+= 5;		
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'_____  (1) Retorno (2) Retorno SADT (3) Refer�ncia (4) Interna��o (5) Alta',0,'L',false);		


		$linha+= 6;
		$coluna = 10;

		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(190,30,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'37- Observa��o',0,'L',false);

		$linha+= 31;
		$coluna = 10;
			
		$pdf->SetFont('arial','B',7);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->Cell(97,15,'',1,0,'L',false);
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'38- Data e Assinatura do M�dico',0,'L',false);		
				
		$coluna+= 98;
		$pdf->SetY($linha);				
		$pdf->SetX($coluna);
		$pdf->Cell(92,15,'',1,0,'L',false);	
		$pdf->SetY($linha);		
		$pdf->SetX($coluna);
		$pdf->MultiCell(100,5,'39- Data e Assinatura do Benefici�rio ou Respons�vel',0,'L',false);		
		//$pdf->SetFillColor(255,0,0);
		//$pdf->SetTextColor(255);
		//$pdf->SetDrawColor(128,0,0);
		//$pdf->SetLineWidth(.3);

		//$pdf->MultiCell(0,5,'1- Registro ANS',0,'L',true);
				
		
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
########################################### RODAP� ################################################################
$pdf->SetFont('arial','',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetY("271");
$pdf->SetX("5");
$pdf->MultiCell(0,5,'http://www.websoft.inf.br',0,'C',false);
//$pdf->Cell(0,5,'http://www.websoft.inf.br',0,0,'C');

//data atual
$data=date("d/m/Y");
$conteudo="gerado em ".$data;
$texto="Websoft Ltda � 2010";
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


unset($_SESSION['CONSULTAS']);
?>
