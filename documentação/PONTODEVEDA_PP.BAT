@echo off
REM 
REM DESENVOLVERDOR: Dener Junio
REM DATA: 01-11-2013
REM ENTRADA: Nenhum
REM SAIDA: Faz backup do arquivo de parametros da CHART para e mapeia unidades nos caixas 
REM	       Salva o nome do caixa e o IP para o sistema PIC - 11-12-2016
REM		   Salva inventario de softwares e o nome do sistema operacional para o sistema PIC - 26-10-2018	

REM Inicio

@echo EXECUTANDO SCRIPT DE MAPEAMENTO PONTOS DE VENDAS.
@echo AGUARDE...(NAO FECHAR ESTA JANELA)

REM Atualizar data
@NET TIME \\SORENTO /SET /YES

REM Fazer copia do arquivo
set nome=%COMPUTERNAME%
copy /Y C:\CHART\WFL\wflparam.ini \\JAGUAR\Parametros_ECF\%nome%.txt

REM Mapear
@NET USE I: /DELETE /YES
@NET USE I: \\JAGUAR\Fotos_CHART /YES  

REM BGInfo
@NET USE y: \\SORENTO\bginfo /YES
@Y:
BGINFO.exe Y:\CONF.BGI /TIMER:00 /NOLICPROMPT
@NET USE Y: /DELETE /YES



REM Sistema PIC
REM Salva nome do computador e ip valido em arquivo txt no servidor.
SET LOCAL=%TEMP%

REM salva em IP.TXT o resultado do comando ipconfig com filtro de ip e 192.168.2.
ipconfig | findstr IP | findstr 192.168.2. > %LOCAL%\IP.TXT

REM salva em uma variavel a string dentro do arquivo ip.txt
IF EXIST %LOCAL%\IP.TXT (
	SET/P IP=<%LOCAL%\IP.TXT
	DEL %LOCAL%\IP.TXT
)

REM abre o arquivo no pc do dener a adiciona a linha com as informações novas
IF EXIST \\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT (
	ECHO %NOME%-%IP%>>\\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT
) ELSE (
	ECHO %NOME%-%IP%>\\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT
)

REM Fazer inventario software
wmic os get caption > \\JAGUAR\Inventario\%nome%.txt
wmic product get name, version >> \\JAGUAR\Inventario\%nome%.txt

exit
