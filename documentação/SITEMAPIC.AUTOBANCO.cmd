@echo off
rem 
rem DESENVOLVERDOR: Dener Junio
rem DATA: 20-09-2017
rem ENTRADA: Nenhum
rem SAIDA: Copia o sistema e o banco de dados do SISTEMAPIC para \\192.168.2.21\Dener\backup\banco

rem Inicio
echo Backup dados do SISTEMAPIC                   V1.001
echo ---------------------------------------------------
echo                Backup bando de dados								
echo ---------------------------------------------------
echo                                        Dener Campos
echo.

rem Parando serviços
net stop wampapache
net stop wampmysqld
rem Verifica se caminho existe
IF EXIST \\192.168.2.21\Dener (	
	rem Compactando e copiando para
	cd /D C:\Program Files\WinRAR
	rar a -ag \\192.168.2.21\Dener\backup\banco\bancodados.rar C:\wamp\bin\mysql\mysql5.6.17\data\sistemapic
) ELSE (
	rem Depois implementar no sistema pic um url para receber os logs do backup automatico.
)
rem Iniciando serviços
net start wampapache
net start wampmysqld
EXIT


