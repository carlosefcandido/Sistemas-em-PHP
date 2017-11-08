<script language="javascript">
function deleteAgenda(marid, medico,data,hora) 
{	 
	if(confirm("Confirma deletar a consulta?")){
		var acao = "deletarconsulta";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var resultado = xmlhttp.responseText; 
				var retorno = resultado.split(" | ");
				if (retorno[0] == "OK"){
					alert(retorno[1]);
					abrirHorarios(medico,data);
				}else{
					alert(retorno[1]);
				}			
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&medid="+medico+"&agedata="+data+"&agehora="+hora+"&marid="+marid,true);
		xmlhttp.send(null);
	}
}
</script>

<script language="javascript">
function deleteAtendimento(marid, medico,data,hora) 
{	 
	if(confirm("Confirma deletar a consulta?")){
		var acao = "deletarconsulta";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var resultado = xmlhttp.responseText; 
				var retorno = resultado.split(" | ");
				if (retorno[0] == "OK"){
					alert(retorno[1]);
					confirmarAtendimento(medico,data);
				}else{
					alert(retorno[1]);
				}			
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&medid="+medico+"&agedata="+data+"&agehora="+hora+"&marid="+marid,true);
		xmlhttp.send(null);
	}
}
</script>

<script language="javascript">
function copy(marid) 
{	
	var acao = "copy";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&marid="+marid,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function paste(medico,data,hora,tipo) 
{	
	var pUrl = "../include/agenda/confirm.php";
	var pWidth = "350";
	var	pHeight = "60";
	if (window.showModalDialog) { 	
		var dialogReturn = window.showModalDialog(pUrl, window,
		  "dialogWidth:" + pWidth + "px;dialogHeight:" + pHeight + "px");	  
		if(dialogReturn == 'sim'){
			acaoBD = "sim";
		}else{
			acaoBD = "nao";
		}
	} else {
		try {
			netscape.security.PrivilegeManager.enablePrivilege(
			  "UniversalBrowserWrite");
			window.open(pUrl, "wndModal", "width=" + pWidth
			  + ",height=" + pHeight + ",resizable=no,modal=yes");
			return true;
		}
		catch (e) {
			alert("Script não confiável, não é possível abrir janela modal.");
			return false;
		}
	}	

	var acao = "paste";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var resultado = xmlhttp.responseText; 
			var retorno = resultado.split(" | ");
            if (retorno[0] == "OK"){
				alert(retorno[1]);
				abrirHorarios(medico,data);
            }else{
				alert(retorno[1]);
            }			
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&medid="+medico+"&agedata="+data+"&agehora="+hora+"&tipo="+tipo+"&acaoBD="+acaoBD,true);
	xmlhttp.send(null);
}
</script>

<script type="text/javascript"> 
function openModal(medico,data,hora,tipo) {
	var tipomarcacao = document.formulario.tipomarcacao.value;
	var pUrl = "../include/agenda/gravaragenda.php?medid="+medico+"&data="+data+"&hora="+hora+"&tipo="+tipo+"&marcacao="+tipomarcacao;
	var pWidth = "700";
	var	pHeight = "440";
	if (window.showModalDialog) { 	
		var dialogReturn = window.showModalDialog(pUrl, window,
		  "dialogWidth:" + pWidth + "px;dialogHeight:" + pHeight + "px");	  
		if(dialogReturn == 'OK'){
			abrirHorarios(medico,data);
		}
	} else {
		try {
			netscape.security.PrivilegeManager.enablePrivilege(
			  "UniversalBrowserWrite");
			window.open(pUrl, "wndModal", "width=" + pWidth
			  + ",height=" + pHeight + ",resizable=no,modal=yes");
			return true;
		}
		catch (e) {
			alert("Script não confiável, não é possível abrir janela modal.");
			return false;
		}
	}
}
</script>

<script type="text/javascript"> 
function openModalConfirmarAtendimento(medico,data,hora,paciente) {
	var pUrl = "../include/atendimento/gravarconfirmaratendimento.php?medid="+medico+"&data="+data+"&hora="+hora+"&pacid="+paciente;
	var pWidth = "700";
	var	pHeight = "300";
	if (window.showModalDialog) { 	
		var dialogReturn = window.showModalDialog(pUrl, window,
		  "dialogWidth:" + pWidth + "px;dialogHeight:" + pHeight + "px");	  
		if(dialogReturn == 'OK'){
			confirmarAtendimento(medico,data);
		}
	} else {
		try {
			netscape.security.PrivilegeManager.enablePrivilege(
			  "UniversalBrowserWrite");
			window.open(pUrl, "wndModal", "width=" + pWidth
			  + ",height=" + pHeight + ",resizable=no,modal=yes");
			return true;
		}
		catch (e) {
			alert("Script não confiável, não é possível abrir janela modal.");
			return false;
		}
	}
}
</script>

<script type="text/javascript"> 
function openModalAtendimento(medico,data,hora,tipo) {
	var tipomarcacao = "C";
	var pUrl = "../include/agenda/gravaragenda.php?medid="+medico+"&data="+data+"&hora="+hora+"&tipo="+tipo+"&marcacao="+tipomarcacao;
	var pWidth = "700";
	var	pHeight = "440";
	if (window.showModalDialog) { 	
		var dialogReturn = window.showModalDialog(pUrl, window,
		  "dialogWidth:" + pWidth + "px;dialogHeight:" + pHeight + "px");	  
		if(dialogReturn == 'OK'){
			confirmarAtendimento(medico,data);
		}
	} else {
		try {
			netscape.security.PrivilegeManager.enablePrivilege(
			  "UniversalBrowserWrite");
			window.open(pUrl, "wndModal", "width=" + pWidth
			  + ",height=" + pHeight + ",resizable=no,modal=yes");
			return true;
		}
		catch (e) {
			alert("Script não confiável, não é possível abrir janela modal.");
			return false;
		}
	}
}
</script>

<script language="javascript">
function abrirHorarios(medid,data) 
{	
	document.getElementById("horarioBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	var acao = "abrirhorarios";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("horarioBD").innerHTML =  xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&medid="+medid+"&data="+data,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function confirmarAtendimento(medid, data) 
{	
	document.getElementById("agendaDiaBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	var acao = "abrirAgendaDia";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("agendaDiaBD").innerHTML =  xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&medid="+medid+"&data="+data,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function buscarProcedimentos(tabela) 
{		
	var acao = "edittableprocedimentoview";
	var tipo = document.formulario.tabnomtipo.value;
	document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("tabelasBD").innerHTML =  xmlhttp.responseText;
			document.formulario.botao.disabled = false;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&tabnomtipo="+tipo+"&tabnomid="+tabela,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function verificarTabelas(tipo) 
{		

		var acao = "abrircampostabelahonorario";
		document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("tabelasBD").innerHTML =  xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&tabnomtipo="+tipo,true);
		xmlhttp.send(null);

	if(tipo == ''){
		document.formulario.botao.disabled = true;				
	}else{
		document.formulario.botao.disabled = false;				
	}

}
</script>

<script language="javascript">
function buscarTabelas(acao,tipo) 
{		
	document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("tabelasBD").innerHTML =  xmlhttp.responseText;
			if(tipo != '' && acao == 'uploadtableview'){
				document.formulario.botao.disabled = false;
			}else if(tipo == '' && acao == 'uploadtableview'){
				document.formulario.botao.disabled = true;
			}
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&tabnomtipo="+tipo,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function buscarTabelasPlano(convenio) 
{		
	var acao = "linktableview";
	document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("tabelasBD").innerHTML =  xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&conid="+convenio,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function filtrarAgenda(medico) 
{	var data = document.formulario.dataselecionada.value;	
	document.getElementById("horarioBD").innerHTML = "";
	document.getElementById("agendaBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	var acao = "filtraragenda";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("agendaBD").innerHTML =  xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&medico="+medico+"&data="+data,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function navegaAgenda(data) 
{	
	document.getElementById("horarioBD").innerHTML = "";
	document.getElementById("agendaBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	var medico = document.formulario.medico.value;	
	var acao = "navegaragenda";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("agendaBD").innerHTML =  xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&data="+data+"&medico="+medico,true);
	xmlhttp.send(null);
}
</script>

<script type="text/javascript">
        function adicionaItens() {
        
                var form = document.form;
                var fl = form.modulos.length -1;
                var au = form.selecionados.length -1;
                var deptos1 = "x";
        
                for (au; au > -1; au--) {
                        deptos1 = deptos1 + "," + form.selecionados.options[au].value + ","
                }
        
                for (fl; fl > -1; fl--) {
                        
                        if (form.modulos.options[fl].selected && deptos1.indexOf( "," + form.modulos.options[fl].value + "," ) == -1) {
                        
                                t = form.selecionados.length;
                                opt = new Option( form.modulos.options[fl].text, form.modulos.options[fl].value );
                                form.selecionados.options[t] = opt;
                                        
                        }
                        
                }
                                
        }
        
        function removeItens() {
        
                var form = document.form;
                fl = document.getElementById('selecionados').length -1;
        
                for (fl; fl>-1; fl--) {
                        
                        if (document.getElementById('selecionados').options[fl].selected) {
                                
                                  document.getElementById('selecionados').options[fl] = null;
                                
                        }
                }
                
        }
        
        function selectAll(){
                
                var selecionados = document.getElementById('selecionados');
                
                for(i=0; i<=selecionados.length-1; i++){
                
                        selecionados.options[i].selected = true;
                
                }
        
        }
</script>

 <script type="text/javascript">
	function autoCompletePaciente(paciente){
		caixaAlta(paciente);
		$("#pacid").autocomplete("../include/agenda/autocompletepaciente.php", {
			width:410,
			selectFirst: false
		});

	}
 </script>

<script language="javascript"> 
function gerarRelatorioAgenda()
{
	var acao = "relatorioagendaview";
	var medico = document.formulario.medico.value;
	var especialidade = document.formulario.especialidade.value;
	var dataini = document.formulario.dataini.value;
	var datafim = document.formulario.datafim.value;
	
	document.getElementById("miolo").style.display = "block";
	document.getElementById("miolo").innerHTML = "<img src='../imagens/011.gif' />";	
	
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&medico="+medico+"&especialidade="+especialidade+"&dataini="+dataini+"&datafim="+datafim,true);
	xmlhttp.send(null);
	
}
</script> 


<script language="javascript"> 
function formatarTextoResumo(objeto)
{
campo = eval(objeto);
campo.value = campo.value.toUpperCase();
document.getElementById("resumo").style.fontWeight = 'bold';
}
</script> 

<script language="javascript"> 
function caixaAlta(objeto)
{
campo = eval(objeto);
campo.value = campo.value.toUpperCase();
}
</script> 
 

<script language="javascript">
function adicionarCampos(id){
var tbody = document.getElementById
(id).getElementsByTagName("TBODY")[0];
var row = document.createElement("TR")
//cria a primeiro td
var td1 = document.createElement("TH")
td1.appendChild(document.createTextNode("Imagem Galeria"))


//cria o segundo td
var td2 = document.createElement("TD")

var currentElement = document.createElement("input");  
    currentElement.setAttribute("type", "file");  
    currentElement.setAttribute("name", "filegaleria[]" + id);  
    currentElement.setAttribute("id", "filegaleria[]" + id);  
  
    td2.appendChild(currentElement);  




row.appendChild(td1);
row.appendChild(td2);
tbody.appendChild(row); 
}
</script>

<script language="javascript">
function abrirCampos(valor){
	if(valor.value == 0){
		document.getElementById("imagens").style.display = "block";	
	}else{
		document.getElementById("imagens").style.display = "none";		
	}
}
</script>

<script language="javascript">
function agendarConsultaPasso1()
{
	if (document.formulario.pacid.value == ''){
		alert("Preencha o nome do paciente");	
		document.formulario.pacid.focus();
		return false;
	}

	document.formulario.botao.disabled = true;		
	enviar();

}
</script>

<script language="javascript">
function AtualizarTabelaConvenio(pergunta)
{ 
	if (document.formulario.plano.value == ''){
		alert("Selecione um convênio");	
		document.formulario.plano.focus();
		return false;
	} 
	if (document.formulario.honorario.value == ''){
		alert("Selecione a tabela Honorário");	
		document.formulario.honorario.focus();
		return false;
	} 
	if (document.formulario.material.value == ''){
		alert("Selecione a tabela Material");	
		document.formulario.material.focus();
		return false;
	} 
	if (document.formulario.ch.value == ''){
		alert("Preencha o CH");	
		document.formulario.ch.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>


<script language="javascript">
function adicionarExame(pergunta)
{ 
	if (document.formulario.exanome.value == ''){
		alert("Preencha o nome do exame");	
		document.formulario.exanome.focus();
		return false;
	} 
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function excluir(pergunta)
{
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function bloquearHorario(pergunta)
{
	if (document.formulario.medhorblodata.value == ''){
		alert("Preencha o início do período.");	
		document.formulario.medhorblodata.focus();
		return false;
	}
	if (document.formulario.medhorblodatafim.value == ''){
		alert("Preencha final do período.");	
		document.formulario.medhorblodatafim.focus();
		return false;
	}	
	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function alterarClinica(pergunta)
{
	if (document.formulario.clinome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.clinome.focus();
		return false;
	}
	if (document.formulario.cliendereco.value == ''){
		alert("Preencha o endereço.");	
		document.formulario.cliendereco.focus();
		return false;
	}
	if (document.formulario.clinumero.value == ''){
		alert("Preencha o número.");	
		document.formulario.clinumero.focus();
		return false;
	}
	if (document.formulario.clicep.value == ''){
		alert("Preencha o CEP.");	
		document.formulario.clicep.focus();
		return false;
	}	
	if (document.formulario.clibairro.value == ''){
		alert("Preencha o bairro.");	
		document.formulario.clibairro.focus();
		return false;
	}
	if (document.formulario.clitelefone1.value == '' && document.formulario.clitelefone2.value == '' && document.formulario.clitelefone3.value == ''){
		alert("Preencha pelo menos um telefone.");	
		document.formulario.clitelefone1.focus();
		return false;
	}		
	if (document.formulario.cliestado.value == ''){
		alert("Selecione o estado.");	
		document.formulario.cliestado.focus();
		return false;
	}	
	if (document.formulario.clicidade.value == ''){
		alert("Selecione a cidade.");	
		document.formulario.clicidade.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>


<script language="javascript">
function uploadValoresTabela(pergunta)
{
	if (document.formulario.tabnomid.value == ''){
		alert("Selecione uma tabela");
		document.formulario.tabnomid.focus();
		return false;
	} 
	if (confirm(pergunta)){
		enviar();
	}	
}
</script>

<script language="javascript">
function adicionarTabela(pergunta)
{
	if (document.formulario.tabnomnome.value == ''){
		alert("Preencha o nome da tabela");
		document.formulario.tabnomnome.focus();
		return false;
	} 
	if (document.formulario.tabnomtipo.value == ''){
		alert("Selecione o tipo de tabela.");	
		document.formulario.tabnomtipo.focus();
		return false;
	}	
	if (confirm(pergunta)){
		enviar();
	}	
}
</script>

<script language="javascript">
function adicionarMedicoExame(pergunta)
{
	if (document.form.selecionados.length < 1){
		alert("Selecione um exame");
		return false;
	}
	if (confirm(pergunta)){
	    var selecionados = document.form.selecionados;
        for(i=0; i<=selecionados.length-1; i++){
            selecionados.options[i].selected = true;
        }
		document.form.submit();
	}	
}
</script>

<script language="javascript">
function adicionarEspecialidadeExame(pergunta)
{
	if (document.form.selecionados.length < 1){
		alert("Selecione um exame");
		return false;
	}
	if (confirm(pergunta)){
	    var selecionados = document.form.selecionados;
        for(i=0; i<=selecionados.length-1; i++){
            selecionados.options[i].selected = true;
        }
		document.form.submit();
	}	
}
</script>

<script language="javascript">
function AlterarValoresTabelaMedicamento(pergunta)
{
	if (document.formulario.tabnomid.value == ''){
		alert("Selecione a tabela.");	
		document.formulario.tabnomid.focus();
		return false;
	} 
	if (document.formulario.medicamento.value == ''){
		alert("Preencha o nome do medicamento.");	
		document.formulario.medicamento.focus();
		return false;
	}	
	if (document.formulario.referencia.value == ''){
		alert("Preencha a referência.");	
		document.formulario.referencia.focus();
		return false;
	}
	if (document.formulario.valor.value == ''){
		alert("Preencha o valor do medicamento.");	
		document.formulario.valor.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}	
}
</script>

<script language="javascript">
function AlterarValoresTabelaHonorario(pergunta)
{
	if (document.formulario.tabnomid.value == ''){
		alert("Selecione a tabela.");	
		document.formulario.tabnomid.focus();
		return false;
	} 
	if (document.formulario.procedimento.value == ''){
		alert("Preencha o nome do procedimento.");	
		document.formulario.procedimento.focus();
		return false;
	}	
	if (document.formulario.referencia.value == ''){
		alert("Preencha a referência.");	
		document.formulario.referencia.focus();
		return false;
	}
	if (document.formulario.valor.value == ''){
		alert("Preencha o valor do procedimento.");	
		document.formulario.valor.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}	
}
</script>

<script language="javascript">
function AlterarValoresTabelaMaterial(pergunta)
{
	if (document.formulario.tabnomid.value == ''){
		alert("Selecione a tabela.");	
		document.formulario.tabnomid.focus();
		return false;
	} 
	if (document.formulario.material.value == ''){
		alert("Preencha o nome do material.");	
		document.formulario.material.focus();
		return false;
	}	
	if (document.formulario.referencia.value == ''){
		alert("Preencha a referência.");	
		document.formulario.referencia.focus();
		return false;
	}
	if (document.formulario.valor.value == ''){
		alert("Preencha o valor do material.");	
		document.formulario.valor.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}	
}
</script>


<script language="javascript">
function AlterarValoresTabelaUpdate(pergunta,funcao)
{ 
	document.formulario.acao.value = "edittableupdate";
	if(funcao == 2){
		AlterarValoresTabelaHonorario(pergunta);
	}else if(funcao == 2){
		AlterarValoresTabelaMaterial(pergunta);
	}else if(funcao == 3){
		AlterarValoresTabelaMedicamento(pergunta);
	}else{
		AlterarValoresTabela(pergunta);
	}
} 
</script>

<script language="javascript">
function AlterarValoresTabela(pergunta)
{
	if (document.formulario.tabnomid.value == ''){
		alert("Selecione a tabela.");	
		document.formulario.tabnomid.focus();
		return false;
	} 
	if (document.formulario.procedimento.value == ''){
		alert("Preencha o nome do procedimento.");	
		document.formulario.procedimento.focus();
		return false;
	}	
	if (document.formulario.referencia.value == ''){
		alert("Preencha a referência.");	
		document.formulario.referencia.focus();
		return false;
	}
	if (document.formulario.valor.value == ''){
		alert("Preencha o valor do procedimento.");	
		document.formulario.valor.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}	
}
</script>
	
<script language="javascript">
function adicionarMedico(pergunta)
{
	if (document.formulario.mednome.value == ''){
		alert("Preencha o nome do médico.");	
		document.formulario.mednome.focus();
		return false;
	}
	if (document.formulario.medtelefone.value == '' && document.formulario.medcelular.value == ''){
		alert("Preencha pelo menos um telefone do médico.");	
		document.formulario.medtelefone.focus();
		return false;
	}	
	
	if (document.formulario.medconselhoregional.value == ''){
		alert("Selecione o conselho do médico.");	
		document.formulario.medconselhoregional.focus();
		return false;
	}
	if (document.formulario.medregistro.value == ''){
		alert("Preencha o número do conselho.");	
		document.formulario.medregistro.focus();
		return false;
	}	
	if (document.formulario.medufconselho.value == ''){
		alert("Selecione a UF do conselho.");	
		document.formulario.medufconselho.focus();
		return false;
	}
	if (document.formulario.medespecialidade.value == ''){
		alert("Selecione a especialidade do médico.");	
		document.formulario.medespecialidade.focus();
		return false;
	} 
	if (document.formulario.login.value == ''){
		alert("Preencha o login.");	
		document.formulario.login.focus();
		return false;
	}
	if (document.formulario.senha.value == ''){
		alert("Preencha a senha.");	
		document.formulario.senha.focus();
		return false;
	}
	if (document.formulario.confirmacaosenha.value == ''){
		alert("Preencha a confirmação.");	
		document.formulario.confirmacaosenha.focus();
		return false;
	}	
	if (document.formulario.senha.value != document.formulario.confirmacaosenha.value){
		alert("A senha e a confirmação são diferentes.");	
		document.formulario.senha.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.submit();
	}	
}
</script>

<script language="javascript">
function adicionarUsuario(pergunta)
{
	if (document.formulario.funnome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.funnome.focus();
		return false;
	}
	if (document.formulario.funsexo.value == ''){
		alert("Selecione o sexo.");	
		document.formulario.funsexo.focus();
		return false;
	}
	if (document.formulario.funtelefone.value == '' && document.formulario.funcelular.value == ''){
		alert("Preencha pelo menos um telefone do funcionário.");	
		document.formulario.funtelefone.focus();
		return false;
	}	
	if (document.formulario.perfil.value == ''){
		alert("Selecione o perfil.");	
		document.formulario.perfil.focus();
		return false;
	}	
	if (document.formulario.login.value == ''){
		alert("Preencha o login.");	
		document.formulario.login.focus();
		return false;
	}
	if (document.formulario.senha.value == ''){
		alert("Preencha a senha.");	
		document.formulario.senha.focus();
		return false;
	}
	if (document.formulario.confirmacaosenha.value == ''){
		alert("Preencha a confirmação.");	
		document.formulario.confirmacaosenha.focus();
		return false;
	}	
	if (document.formulario.senha.value != document.formulario.confirmacaosenha.value){
		alert("A senha e a confirmação são diferentes.");	
		document.formulario.senha.focus();
		return false;
	}
	if (confirm(pergunta)){
		document.formulario.submit();
	}	
}
</script>

<script language="javascript">
function adicionarAgenda(tipo,data,hora)
{
	if (document.formulario.pacnome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.pacnome.focus();
		return false;
	}
	if (document.formulario.pactelefone.value == '' && document.formulario.paccelular.value == ''){
		alert("Preencha pelo menos um telefone.");	
		document.formulario.pactelefone.focus();
		return false;
	}	
	if (document.formulario.pacplano.value == ''){
		alert("Selecione um plano.");	
		document.formulario.pacplano.focus();
		return false;
	}
	if (document.formulario.pacnumerocarteira.value == ''){
		alert("Preencha o número da carteira.");	
		document.formulario.pacnumerocarteira.focus();
		return false;
	}
	document.formulario.agedata.value = data;
	document.formulario.agehora.value = hora;
	document.formulario.acao.value = tipo;
	var pergunta = "";	
	if(tipo == 'agendarconsulta'){
		pergunta = "Confirma a marcação da consulta?";
	}else if(tipo == 'encaixarconsulta'){
		pergunta = "Confirma o encaixe?";
	}
	if (confirm(pergunta)){
		document.formulario.submit();
	}	
}
</script>
<script language="javascript">
function adicionarEspecialidade(pergunta)
{
	if (document.formulario.fununidadeselecionada.value == '' ){
		alert("Selecione a unidade.");	
		document.formulario.fununidadeselecionada.focus();
		return false;
	}
	if (document.formulario.funespespecialidade.value == '' ){
		alert("Selecione a especialidade.");	
		document.formulario.funespespecialidade.focus();
		return false;
	}
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}	
}
</script>

<script language="javascript">
function adicionarHorario(pergunta)
{
	if (document.formulario.medintervaloconsulta.value == '' ){
		alert("Preencha o intervalo da consulta.");	
		document.formulario.medintervaloconsulta.focus();
		return false;
	}
	if ((document.formulario.entradaseg1.value != '' && document.formulario.saidaseg1.value == '') || 
		(document.formulario.entradaseg1.value == '' && document.formulario.saidaseg1.value != '')){
		alert("O preenchimento da Segunda-feira está incompleto.");	
		document.formulario.entradaseg1.focus();
		return false;
	}
	if ((document.formulario.entradaseg2.value != '' && document.formulario.saidaseg2.value == '') || 
		(document.formulario.entradaseg2.value == '' && document.formulario.saidaseg2.value != '')){
		alert("O preenchimento da Segunda-feira está incompleto.");	
		document.formulario.entradaseg2.focus();
		return false;
	}
	if ((document.formulario.entradater1.value != '' && document.formulario.saidater1.value == '') || 
		(document.formulario.entradater1.value == '' && document.formulario.saidater1.value != '')){
		alert("O preenchimento da Terça-feira está incompleto.");	
		document.formulario.entradater1.focus();
		return false;
	}
	if ((document.formulario.entradater2.value != '' && document.formulario.saidater2.value == '') || 
		(document.formulario.entradater2.value == '' && document.formulario.saidater2.value != '')){
		alert("O preenchimento da Terça-feira está incompleto.");	
		document.formulario.entradater2.focus();
		return false;
	}	
	if ((document.formulario.entradaqua1.value != '' && document.formulario.saidaqua1.value == '') || 
		(document.formulario.entradaqua1.value == '' && document.formulario.saidaqua1.value != '')){
		alert("O preenchimento da Quarta-feira está incompleto.");	
		document.formulario.entradaqua1.focus();
		return false;
	}
	if ((document.formulario.entradaqua2.value != '' && document.formulario.saidaqua2.value == '') || 
		(document.formulario.entradaqua2.value == '' && document.formulario.saidaqua2.value != '')){
		alert("O preenchimento da Quarta-feira está incompleto.");	
		document.formulario.entradaqua2.focus();
		return false;
	}	
	if ((document.formulario.entradaqui1.value != '' && document.formulario.saidaqui1.value == '') || 
		(document.formulario.entradaqui1.value == '' && document.formulario.saidaqui1.value != '')){
		alert("O preenchimento da Quinta-feira está incompleto.");	
		document.formulario.entradaqui1.focus();
		return false;
	}
	if ((document.formulario.entradaqui2.value != '' && document.formulario.saidaqui2.value == '') || 
		(document.formulario.entradaqui2.value == '' && document.formulario.saidaqui2.value != '')){
		alert("O preenchimento da Quinta-feira está incompleto.");	
		document.formulario.entradaqui2.focus();
		return false;
	}	
	if ((document.formulario.entradasex1.value != '' && document.formulario.saidasex1.value == '') || 
		(document.formulario.entradasex1.value == '' && document.formulario.saidasex1.value != '')){
		alert("O preenchimento da Sexta-feira está incompleto.");	
		document.formulario.entradasex1.focus();
		return false;
	}
	if ((document.formulario.entradasex2.value != '' && document.formulario.saidasex2.value == '') || 
		(document.formulario.entradasex2.value == '' && document.formulario.saidasex2.value != '')){
		alert("O preenchimento da Sexta-feira está incompleto.");	
		document.formulario.entradasex2.focus();
		return false;
	}	
	if ((document.formulario.entradasab1.value != '' && document.formulario.saidasab1.value == '') || 
		(document.formulario.entradasab1.value == '' && document.formulario.saidasab1.value != '')){
		alert("O preenchimento do Sábado está incompleto.");	
		document.formulario.entradasab1.focus();
		return false;
	}
	if ((document.formulario.entradasab2.value != '' && document.formulario.saidasab2.value == '') || 
		(document.formulario.entradasab2.value == '' && document.formulario.saidasab2.value != '')){
		alert("O preenchimento do Sábado está incompleto.");	
		document.formulario.entradasab2.focus();
		return false;
	}	
	if ((document.formulario.entradadom1.value != '' && document.formulario.saidadom1.value == '') || 
		(document.formulario.entradadom1.value == '' && document.formulario.saidadom1.value != '')){
		alert("O preenchimento do Domingo está incompleto.");	
		document.formulario.entradadom1.focus();
		return false;
	}
	if ((document.formulario.entradadom2.value != '' && document.formulario.saidadom2.value == '') || 
		(document.formulario.entradadom2.value == '' && document.formulario.saidadom2.value != '')){
		alert("O preenchimento do Domingo está incompleto.");	
		document.formulario.entradadom2.focus();
		return false;
	}
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function adicionarUnidade(pergunta)
{
	if (document.formulario.uninome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.uninome.focus();
		return false;
	}
	if (document.formulario.uniendereco.value == ''){
		alert("Preencha o endereço.");	
		document.formulario.uniendereco.focus();
		return false;
	}
	if (document.formulario.uninumero.value == ''){
		alert("Preencha o número.");	
		document.formulario.uninumero.focus();
		return false;
	}
	if (document.formulario.unicep.value == ''){
		alert("Preencha o CEP.");	
		document.formulario.unicep.focus();
		return false;
	}	
	if (document.formulario.unibairro.value == ''){
		alert("Preencha o bairro.");	
		document.formulario.unibairro.focus();
		return false;
	}
	if (document.formulario.unitelefone1.value == '' && document.formulario.unitelefone2.value == '' && document.formulario.unitelefone3.value == ''){
		alert("Preencha pelo menos um telefone.");	
		document.formulario.unitelefone1.focus();
		return false;
	}	
	if (document.formulario.uniestado.value == ''){
		alert("Selecione o estado.");	
		document.formulario.uniestado.focus();
		return false;
	}		
	if (document.formulario.unicidade.value == ''){
		alert("Selecione a cidade.");	
		document.formulario.unicidade.focus();
		return false;
	}
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function adicionarPaciente(pergunta)
{
	if (document.formulario.pacnome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.pacnome.focus();
		return false;
	}
	if (document.formulario.pactelefone.value == '' && document.formulario.paccelular.value == ''){
		alert("Preencha pelo menos um telefone.");	
		document.formulario.pactelefone.focus();
		return false;
	}	
	if (document.formulario.pacplano.value == ''){
		alert("Selecione um plano.");	
		document.formulario.pacplano.focus();
		return false;
	}
	if (document.formulario.pacnumerocarteira.value == ''){
		alert("Preencha o número da carteira.");	
		document.formulario.pacnumerocarteira.focus();
		return false;
	}	
	if (confirm(pergunta)){
		enviar();
	}
}
</script>

<script language="javascript">
function adicionarFuncionario(pergunta)
{
	if (document.formulario.fununidade.value == ''){
		alert("Selecione uma unidade.");	
		document.formulario.fununidade.focus();
		return false;
	}
	if (document.formulario.funfuncao.value == ''){
		alert("Selecione uma função.");	
		document.formulario.funfuncao.focus();
		return false;
	}

	if (document.formulario.funnome.value == ''){
		alert("Preencha o nome.");	
		document.formulario.funnome.focus();
		return false;
	}
	if (document.formulario.funendereco.value == ''){
		alert("Preencha o endereço.");	
		document.formulario.funendereco.focus();
		return false;
	}
	if (document.formulario.funnumero.value == ''){
		alert("Preencha o número.");	
		document.formulario.funnumero.focus();
		return false;
	}
	if (document.formulario.funcep.value == ''){
		alert("Preencha o CEP.");	
		document.formulario.funcep.focus();
		return false;
	}	
	if (document.formulario.funbairro.value == ''){
		alert("Preencha o bairro.");	
		document.formulario.funbairro.focus();
		return false;
	}
	if (document.formulario.funtelefone.value == '' && document.formulario.funcelular.value == ''){
		alert("Preencha pelo menos um telefone.");	
		document.formulario.funtelefone.focus();
		return false;
	}	
	if (document.formulario.funestado.value == ''){
		alert("Selecione o estado.");	
		document.formulario.funestado.focus();
		return false;
	}		
	if (document.formulario.funcidade.value == ''){
		alert("Selecione a cidade.");	
		document.formulario.funcidade.focus();
		return false;
	}
	if (document.formulario.login.value == ''){
		alert("Preencha um login.");	
		document.formulario.login.focus();
		return false;
	}
	if (document.formulario.senha.value == ''){
		alert("Preencha uma senha.");	
		document.formulario.senha.focus();
		return false;
	}
	if (document.formulario.usutipoacesso.value == ''){
		alert("Selecione um tipo de acesso.");	
		document.formulario.usutipoacesso.focus();
		return false;
	}	
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function alterarSenha(pergunta)
{
	if (document.formulario.senha.value == ''){
		alert("Preencha a nova senha.");	
		document.formulario.senha.focus();
		return false;
	}
	if (document.formulario.confirmacaosenha.value == ''){
		alert("Preencha a confirmação.");	
		document.formulario.confirmacaosenha.focus();
		return false;
	}	
	if (document.formulario.senha.value != document.formulario.confirmacaosenha.value){
		alert("A senha e a confirmação são diferentes.");	
		document.formulario.senha.focus();
		return false;
	}
	if (confirm(pergunta)){
		document.formulario.botao.disabled = true;		
		enviar();
	}
}
</script>

<script language="javascript">
function enviar(){
	document.formulario.botao.disabled = true;
	document.formulario.botao.value = "Aguarde processando...";
	document.formulario.submit();
}
</script>
<script language="Javascript"> 
function maskIt(w,e,m,r,a){
        
        // Cancela se o evento for Backspace
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        
        // Variáveis da função
        var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre  = (a ) ? a.pre : "";
        var pos  = (a ) ? a.pos : "";
        var ret  = "";

        if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

        // Loop na máscara para aplicar os caracteres
        for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                        ret += mask.charAt(x); x++;
                } else{
                        ret += txt.charAt(y); y++; x++;
                }
        }
        
        // Retorno da função
        ret = (!r) ? ret : ret.reverse()        
        w.value = pre+ret+pos;
}

// Novo método para o objeto 'String'
String.prototype.reverse = function(){
        return this.split('').reverse().join('');
};
</script>

<script language="JavaScript">
function checa_seguranca(pass, campo){   
        var senha = pass;   
        var entrada = 0;   
        var resultado;   
           
        if(senha.length < 6){   
                entrada = entrada - 3;   
        }   
           
        if(!senha.match(/[a-z_]/i) || !senha.match(/[0-9]/)){   
                entrada = entrada - 1;   
        }   
           
        if(!senha.match(/\W/)){   
                entrada = entrada - 1;   
        }   
           
        if(entrada == 0){   
                resultado = 'A Segurança de sua senha : <font color=\'#99C55D\'>EXCELENTE</font>';   
        } else if(entrada == -1){   
                resultado = 'A Segurança de sua senha : <font color=\'#7F7FFF\'>BOM</font>';   
        } else if(entrada == -2){   
                resultado = 'A Segurança de sua senha : <font color=\'#FF5F55\'>FRACA</font>';   
        } else if(entrada < -2){   
                resultado = 'A Segurança de sua senha : <font color=\'#A04040\'>MUITO FRACA</font>';   
        }   
        document.getElementById(campo).innerHTML = resultado;   
		document.getElementById(campo).style.display = "block";		
           
        return;   
}  

</script>		

<script language="JavaScript">
function verifica_senha(novasenha,confirmacaosenha){   
        var entrada = 0;   
        var resultado;   

        if(novasenha == confirmacaosenha){   
            entrada = 1;   
        }
                      
        if(entrada == 0){   
                resultado = 'A Senha e a confirmação são: <font color=\'#A04040\'>DIFERENTES</font>';   
        } else {   
                resultado = 'A Senha e a confirmação são: <font color=\'#99C55D\'>IGUAIS</font>';   
        }   
        document.getElementById('forcasenha').innerHTML = resultado;   
		document.getElementById('forcasenha').style.display = "block";		
           
        return;   
}  

</script>		

<script language="JavaScript">
function abrir(URL) {

  var width = 710;
  var height = 410;

  var left = 120;
  var top = 60;

  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}
</script>

<script language="javascript">
function carregarPlanoConvenio(conplaid)
{	
	document.getElementById("planoconvenioBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	var acao = "carregarplanoconvenio";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("planoconvenioBD").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&conplaid="+conplaid.value,true);
	xmlhttp.send(null);
}
</script>
<script language="javascript">
function removerConsulta(ageid,data,medico,unidade,especialidade)
{
	var acao = "removerconsulta";
	if (confirm("Confirma deletar a consulta?")){
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var resultado = xmlhttp.responseText;
				if (resultado == 'OK'){
					alert("Operação realizada com sucesso.");
					buscarHorarioMedico(especialidade,medico,unidade,data);
				}else{
					alert(resultado);
				}	
				
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&ageid="+ageid,true);
		xmlhttp.send(null);
	}
}
</script> 


<script language="javascript">
function verificaDisponibilidadeLogin(login)
{
	var acao = "verificadisponibilidadelogin";
	document.getElementById("disponibilidade").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'> Verificando disponibilidade de login... ";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var resultado = xmlhttp.responseText;
			if(resultado == 'OK'){
				document.getElementById("disponibilidade").innerHTML = "<img src='../imagens/tick.png' border='0'> Login dispon&iacute;vel ";	
			}else{
				document.getElementById("disponibilidade").innerHTML = "<img src='../imagens/delete.png' border='0'> Login indispon&iacute;vel ";	
			}
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&login="+login.value,true);
	xmlhttp.send(null);
}
</script> 

<script language="javascript">
function buscarEspecialidade(fununidade,funid,tipo)
{
	var acao = "buscarespecialidade";
	if(fununidade != ''){ 
		if(tipo == 'horario'){
			document.getElementById("HorarioBD").innerHTML = "";
			document.getElementById("HorarioBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		}else if(tipo == 'agenda'){
			document.getElementById("DataBD").innerHTML = "";
			document.getElementById("HorarioBD").innerHTML = "";
			document.getElementById("DataBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		}else{
			document.getElementById("ajaxBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		}
	
		
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if(tipo == 'horario'){
					document.getElementById("HorarioBD").innerHTML = "";
				}else if(tipo == 'agenda'){
					document.getElementById("DataBD").innerHTML = "";
				}else{
					document.getElementById("ajaxBD").innerHTML = "";
				}
				document.getElementById("EspecialidadeBD").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&fununidade="+fununidade+"&funid="+funid+"&tipo="+tipo,true);
		xmlhttp.send(null);
	}
}
</script> 

<script language="javascript">
function buscarDataMedico(especialidade,medico,unidade,data)
{
	var acao = "buscardatamedico";
	document.getElementById("HorarioBD").innerHTML = "";
	if(especialidade != ''){ 
		document.getElementById("DataBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("DataBD").innerHTML = xmlhttp.responseText;;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&funespecialidade="+especialidade+"&funfuncionario="+medico+"&fununidade="+unidade+"&data="+data,true);
		xmlhttp.send(null);
	}	
}
</script>

<script language="javascript">
function buscarHorarioMedico(especialidade,medico,unidade,data)
{
	var paciente = document.formulario.pacid.value;
	var addagenda = document.formulario.addagenda.value;
	var acao = "buscarhorariomedico";
	if(especialidade != ''){ 
		document.getElementById("HorarioBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("HorarioBD").innerHTML = xmlhttp.responseText;
				//alert(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&funespecialidade="+especialidade+"&funfuncionario="+medico+"&fununidade="+unidade+"&data="+data+"&pacid="+paciente+"&addagenda="+addagenda,true);
		xmlhttp.send(null);
	}	
}
</script>

<script language="javascript">
function buscarMedicos(fununidade)
{
	var acao = "buscarmedicos";
	if(fununidade != ''){ 
		document.getElementById("MedicoBD").innerHTML = "";
		document.getElementById("DataBD").innerHTML = "";
		document.getElementById("EspecialidadeBD").innerHTML = "";
		document.getElementById("ajaxBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("ajaxBD").innerHTML = "";
				document.getElementById("HorarioBD").innerHTML = "";
				document.getElementById("MedicoBD").innerHTML = xmlhttp.responseText;;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&fununidade="+fununidade,true);
		xmlhttp.send(null);
	}
}
</script> 

<script language="javascript">
function buscarHorario(funespecialidade,funid,fununidade)
{
	var acao = "buscarhorario";
	if(fununidade != ''){ 
		document.getElementById("ajaxBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("ajaxBD").innerHTML = "";
				document.getElementById("HorarioBD").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&fununidade="+fununidade+"&funid="+funid+"&funespecialidade="+funespecialidade,true);
		xmlhttp.send(null);
	}
}
</script>    


<script language="javascript">
function buscarCidade(acao,estado,campo)
{
	var cidade = "<select name='"+campo+"' id='"+campo+"' disabled>";
	cidade = cidade + "<option>Aguarde processando ...</option>";
	cidade = cidade + "</select>";
	cidade = cidade + "&nbsp;&nbsp;";
	cidade = cidade + "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	document.getElementById("cidadeBD").innerHTML = cidade;
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("cidadeBD").innerHTML = retorno;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&estado="+estado+"&campo="+campo,true);
	xmlhttp.send(null);
}
</script>    

<script language="javascript">
function abrirPaginacao(acao,pagina)
{
	document.getElementById("miolo").style.display = "block";
	document.getElementById("miolo").innerHTML = "<img src='../imagens/011.gif' />";	
	
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
			document.getElementById("miolo").style.display = "block";							
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&pagina="+pagina,true);
	xmlhttp.send(null);

}
</script>    

<script language="javascript">
function filtarPaciente(nome,caminho)
{
	caixaAlta(nome);
	var pacnome = nome.value;
	if((pacnome.length) % 2 == 0){
		var acao = "filtrarpaciente";
		caixaAlta(nome);
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				retorno = xmlhttp.responseText;
				document.getElementById("miolo").innerHTML = retorno;
				document.getElementById("pacnome").focus();
				document.getElementById("pacnome").value = document.getElementById("pacnome").value;
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&nome="+nome.value+"&caminho="+caminho,true);
		xmlhttp.send(null);	
	}
}
</script>
<script language="javascript">
function filtro(acao,parametro)
{
	document.getElementById("miolo").style.display = "block";
	document.getElementById("miolo").innerHTML = "<img src='../imagens/011.gif' />";	
	
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
			document.getElementById("miolo").style.display = "block";							
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&parametro="+parametro,true);
	xmlhttp.send(null);

}
</script>    

<script language="javascript">
function excluirProcedimento(procedimento,tabela,pergunta)
{
	if(confirm("Confirma excluir o "+ pergunta +"?")){
		document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		var acao = "excluirprocedimento";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				retorno = xmlhttp.responseText;
				alert(retorno);
				buscarProcedimentos(tabela);				
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&tabprocedimento="+procedimento+"&tabnomid="+tabela,true);
		xmlhttp.send(null);
	}

}
</script>

<script language="javascript">
function alterarProcedimento(procedimento,tabela)
{ 
	var acao = "edittableprocedimentoview";
	var botaoalterar = "sim";
	var tipo = document.formulario.tabnomtipo.value;
	document.getElementById("tabelasBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("tabelasBD").innerHTML =  xmlhttp.responseText;
			document.formulario.botao.disabled = false;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&tabnomtipo="+tipo+"&tabnomid="+tabela+"&tabprocedimento="+procedimento+"&botaoalterar="+botaoalterar,true);
	xmlhttp.send(null);
}
</script>

<script language="javascript">
function alterarExame(exame)
{ 
	var acao = "editexame";
	var botaoalterar = "sim";
	document.getElementById("exameBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{ 
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
			document.getElementById("miolo").style.display = "block";							
			document.formulario.acao.value = "editexame";			
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&exaid="+exame+"&botaoalterar="+botaoalterar,true);
	xmlhttp.send(null);
}
</script>
<script language="javascript">
function excluirExame(exame)
{ 
	if(confirm("Confirma excluir o exame?")){
		var acao = "deleteexame";
		document.getElementById("exameBD").innerHTML = "<img src='../imagens/frames/ajaxLoaderPq.gif' border='0'>";
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{ 
				alert(xmlhttp.responseText);
				abrirMiolo("addexame");
			}
		}
		xmlhttp.open("GET","../act.php?acao="+acao+"&exaid="+exame,true);
		xmlhttp.send(null);
	}
}
</script>

<script language="javascript">
function alterarModulo(acao,modulo)
{
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao+"&modulo="+modulo,true);
	xmlhttp.send(null);

}
</script>    
		
<script language="javascript">
function abrirMiolo(acao)
{
	document.getElementById("miolo").style.display = "block";
	document.getElementById("miolo").innerHTML = "<img src='../imagens/011.gif' />";	
	
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
			document.getElementById("miolo").style.display = "block";							
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao,true);
	xmlhttp.send(null);

}
</script>    
<script language="javascript">
function abrirMioloComAlert(acao)
{
	alert("Atenção \n\n Altere os dados da consulta e clique ação colar para finalizar a alteração.");
	document.getElementById("miolo").style.display = "block";
	document.getElementById("miolo").innerHTML = "<img src='../imagens/011.gif' />";	
	
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			retorno = xmlhttp.responseText;
			document.getElementById("miolo").innerHTML = retorno;
			document.getElementById("miolo").style.display = "block";							
		}
	}
	xmlhttp.open("GET","../act.php?acao="+acao,true);
	xmlhttp.send(null);

}
</script>
<script language="javascript">
function alternarAbaAdministrativo(aba,menu,rotulo)
{
		var acao = "alterarmodulo";
		//desabilita todas as divs do menu de cima
		document.getElementById('agenda').style.display = "none";
		document.getElementById('paciente').style.display = "none";

		//desabilita todas as divs do menu de ao lado
		document.getElementById('menuagenda').style.display = "none";
		document.getElementById('menupaciente').style.display = "none";

		//desabilita todas as divs do rótulo do menu
		document.getElementById('rotuloagenda').style.display = "none";
		document.getElementById('rotulopaciente').style.display = "none";
		
		document.getElementById(aba).style.display = "block";
		document.getElementById(rotulo).style.display = "block";
		document.getElementById(menu).style.display = "block";	

		alterarModulo(acao,aba);
		abrirMiolo('principal');
}        
</script>
<script language="javascript">
function alternarAbaMedico(aba,menu,rotulo)
{
		var acao = "alterarmodulo";
		//desabilita todas as divs do menu de cima
		document.getElementById('agenda').style.display = "none";
		document.getElementById('paciente').style.display = "none";
		document.getElementById('relatorios').style.display = "none";				

		//desabilita todas as divs do menu de ao lado
		document.getElementById('menuagenda').style.display = "none";
		document.getElementById('menupaciente').style.display = "none";
		document.getElementById('menurelatorio').style.display = "none";				


		//desabilita todas as divs do rótulo do menu
		document.getElementById('rotuloagenda').style.display = "none";
		document.getElementById('rotulopaciente').style.display = "none";
		document.getElementById('rotulorelatorio').style.display = "none";				
		
		document.getElementById(aba).style.display = "block";
		document.getElementById(rotulo).style.display = "block";
		document.getElementById(menu).style.display = "block";	

		alterarModulo(acao,aba);
		abrirMiolo('principal');
}        
</script>

<script language="javascript">
function alternarAba(aba,menu,rotulo)
{
		var acao = "alterarmodulo";
		//desabilita todas as divs do menu de cima
		document.getElementById('agenda').style.display = "none";
		document.getElementById('atendimento').style.display = "none";		
		document.getElementById('referenciais').style.display = "none";
		document.getElementById('administracao').style.display = "none";	
		document.getElementById('cotacao').style.display = "none";			
		document.getElementById('relatorios').style.display = "none";				

		//desabilita todas as divs do menu de ao lado
		document.getElementById('menuagenda').style.display = "none";
		document.getElementById('menuatendimento').style.display = "none";		
		document.getElementById('menureferenciais').style.display = "none";
		document.getElementById('menuadministracao').style.display = "none";		
		document.getElementById('menucotacao').style.display = "none";				
		document.getElementById('menurelatorio').style.display = "none";				


		//desabilita todas as divs do rótulo do menu
		document.getElementById('rotuloagenda').style.display = "none";
		document.getElementById('rotuloatendimento').style.display = "none";		
		document.getElementById('rotuloreferenciais').style.display = "none";
		document.getElementById('rotuloadministracao').style.display = "none";		
		document.getElementById('rotulocotacao').style.display = "none";				
		document.getElementById('rotulorelatorio').style.display = "none";				
		
		document.getElementById(aba).style.display = "block";
		document.getElementById(rotulo).style.display = "block";
		document.getElementById(menu).style.display = "block";	

		alterarModulo(acao,aba);
		abrirMiolo('principal');		
}        
</script>

<script language="javascript">
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){

    var sep = 0;

    var key = '';

    var i = j = 0;

    var len = len2 = 0;

    var strCheck = '0123456789';

    var aux = aux2 = '';

    var whichCode = (window.Event) ? e.which : e.keyCode;

    if (whichCode == 13) return true;

    key = String.fromCharCode(whichCode); // Valor para o código da Chave

    if (strCheck.indexOf(key) == -1) return false; // Chave inválida

    len = objTextBox.value.length;

    for(i = 0; i < len; i++)

        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;

    aux = '';

    for(; i < len; i++)

        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);

    aux += key;

    len = aux.length;

    if (len == 0) objTextBox.value = '';

    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;

    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;

    if (len > 2) {

        aux2 = '';

        for (j = 0, i = len - 3; i >= 0; i--) {

            if (j == 3) {

                aux2 += SeparadorMilesimo;

                j = 0;

            }

            aux2 += aux.charAt(i);

            j++;

        }

        objTextBox.value = '';

        len2 = aux2.length;

        for (i = len2 - 1; i >= 0; i--)

        objTextBox.value += aux2.charAt(i);

        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);

    }

    return false;

}

</script>
