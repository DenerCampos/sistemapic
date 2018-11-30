REM DESENVOLVERDOR: Dener Junio
REM DATA: 28-10-2018
REM ENTRADA: Arquivos em \\jaguar\Inventario (arquivo com o mesmo nome da maquina)
REM 		 Layout do arquivo: formato CSV (UTF-8)
REM 		 "linha em branco"
REM 		 Node,Caption
REM 		 CAIXA38,Microsoft Windows XP Professional
REM 		 Node,Name,Version
REM 		 CAIXA38,WebFldrs XP,9.50.7523
REM 		 CAIXA38,LG United Mobile Drivers,3.8.1
REM 		 CAIXA38,MSI to redistribute MS VS2005 CRT libraries,8.0.50727.42
REM 		 CAIXA38,ESET Remote Administrator Agent,6.5.522.0
REM SAIDA: Atualiza a a lista de inventario de softwares do PIC Pampulha

php d:\Dener_Junio\www\systems\sistemapic\index.php LoadFile loadFileSoftware
