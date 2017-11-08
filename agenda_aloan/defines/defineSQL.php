<?php

	define (_SQL1_,"select * from usuario ");
	define (_SQL2_,"update usuario set ");	
	define (_SQL3_,"select * from clinica 
					inner join cidades on (clicidade = cidid)
					inner join estados on (cidestado = estid) ");	
	define (_SQL4_,"select * from cidades "); 
	define (_SQL5_,"select * from estados "); 	
	define (_SQL6_,"update clinica set "); 
	define (_SQL7_,"insert into clinica values "); 	
	define (_SQL8_,"select * from estados
					inner join cidades on (cidestado = estid) ");
	define (_SQL9_,"insert into unidade values "); 						
	define (_SQL10_,"select * from unidade 
					inner join cidades on (unicidade = cidid)
					inner join estados on (cidestado = estid) ");	
	define (_SQL11_,"update unidade set "); 
	define (_SQL12_,"delete from unidade "); 
	define (_SQL13_,"select * from funcao "); 
	define (_SQL14_,"insert into usuario values "); 
	define (_SQL15_,"insert into funcionario values "); 
	define (_SQL16_,"select * from funcionario
					 inner join cidades on (funcidade = cidid)
					 inner join estados on (cidestado = estid)
					 inner join usuario on (funid = usufuncionario) 
					 inner join unidade on (fununidade = uniid) "); 
					 
	define (_SQL17_,"delete from funcionario "); 
	define (_SQL18_,"select * from funcionario "); 
	define (_SQL19_,"select * from tipoacesso "); 
	define (_SQL20_,"update funcionario set "); 
	define (_SQL21_,"delete from usuario ");
	define (_SQL22_,"delete from funcionariohorario "); 
	define (_SQL23_,"insert into funcionariohorario values "); 
	define (_SQL24_,"select * from funcionariohorario ");
	define (_SQL25_,"select * from plano ");
	define (_SQL26_,"select * from paciente
					left join cidades on (paccidade = cidid)
					left join estados on (cidestado = estid) ");
	define (_SQL27_,"delete from paciente ");
	define (_SQL28_,"insert into paciente values ");	
	define (_SQL29_,"delete from funcionariointervalo ");
	define (_SQL30_,"insert into funcionariointervalo values ");
	define (_SQL31_,"select * from especialidade ");
	define (_SQL32_,"select * from funcionarioespecialidade ");
	define (_SQL33_,"insert into funcionarioespecialidade values ");
	define (_SQL34_,"delete from funcionarioespecialidade ");
	define (_SQL35_,"update funcionariointervalo set ");
	define (_SQL36_,"update paciente set ");
	define (_SQL37_,"SELECT distinct(a.funhorariodia) as funhorariodia 
				   FROM funcionariohorario as a
				   inner join funcionario as b on (b.funid = a.funfuncionario) ");
	define (_SQL38_,"SELECT a.funhorarioent, a.funhorariosai,b.funintintervaloconsulta as funintervadoconsulta
					FROM funcionariohorario AS a
					INNER JOIN funcionariointervalo AS b ON ( b.funintfuncionario = a.funfuncionario ) ");
					
	define (_SQL39_,"SELECT DATE_FORMAT(a.agedatahora, '%d/%m/%Y') as agedata,
					DATE_FORMAT(a.agedatahora, '%H:%i') as agehora,b.pacid,b.pacnome,c.planome,a.ageatendido,d.funnome,d.funid,a.ageid,
					b.pactelefone, b.paccelular,a.ageunidade, a.ageespecialidade,a.agefuncionario
				    FROM agenda as a
				    inner join paciente as b on (a.agepaciente = b.pacid)
				    inner join plano as c on (b.pacplano = c.plaid) 
				    inner join funcionario as d on (d.funid = a.agefuncionario)
					inner join usuario as e on (d.funid = e.usufuncionario) ");
	define (_SQL40_,"insert into agenda values ");
	define (_SQL41_,"delete from agenda ");
?>