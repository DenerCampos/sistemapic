REM DESENVOLVERDOR: Dener Junio
REM DATA: 29-12-2016
REM ENTRADA: Arquivos em \\jaguar\Parametros_ECF\IpSistemaPic
REM 		 Layout do arquivo: formato TXT (UTF-8)
REM 		 CAIXA47;ppcaixa-        Endereço IP . . . . . . . . . . . . : 192.168.2.122
REM 		 CAIXA37;ppcaixa-   Endere‡o IPv4. . . . . . . .  . . . . . . . : 192.168.2.111
REM 		 CAIXA54;ppcaixa-        Endereço IP . . . . . . . . . . . . : 192.168.2.100
REM 		 CAIXA55;ppcaixa-   Endere‡o IPv4. . . . . . . .  . . . . . . . : 192.168.2.116
REM 		 CAIXA46;ppcaixa-   Endere‡o IPv4. . . . . . . .  . . . . . . . : 192.168.2.118
REM 		 CAIXA49;ppcaixa-        Endereço IP . . . . . . . . . . . . : 192.168.2.132
REM SAIDA: Atualiza a tabela de caixas no sistema PIC

php d:\Dener_Junio\www\systems\sistemapic\index.php LoadFile loadFileIP

REM Limpa o arquivo
ECHO OFF >\\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT