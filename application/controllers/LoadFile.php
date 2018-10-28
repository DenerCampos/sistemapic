<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadFile extends CI_Controller {

    /**
     * LoadFile: Carrega arquivo em \\JAGUAR\Parametros_ECF\IpSistemaPic
     *           para o banco de dados. (IP dos caixas)
     *           Carrega arquivo em \\jaguar\Inventario para o banco de dados (Inventario de software)
     *
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //carregando modelo
        $this->load->model('Maquina_model', 'maquina');
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index()
    {
        redirect(base_url());
    }
    
    /*------Funções internas--------*/ 
    
    /*Carregando nome e ip dos caixas por arquivo .txt em \\JAGUAR\Parametros_ECF\IpSistemaPic
     * Layout do arquivo
     * CAIXA55;ppcaixa-   Endere‡o IPv4. . . . . . . .  . . . . . . . : 192.168.2.116
     * CAIXA38;ppcaixa-        Endereço IP . . . . . . . . . . . . : 192.168.2.115
     * CAIXA45;ppcaixa-        Endereço IP . . . . . . . . . . . . : 192.168.2.109
     * 
     * Arquivo BAT
     * REM Sistema PIC
     * REM Local para salvar o IP
     * SET LOCAL=%C:\TEMP%
     * 
     * REM salva em IP.TXT o resultado do comando ipconfig com filtro de ip e 192.168.2.
     * ipconfig | findstr IP | findstr 192.168.2. > %LOCAL%\IP.TXT
     * 
     * IF EXIST %LOCAL%\IP.TXT (
     * 	SET/P IP=<%LOCAL%\IP.TXT
     * 	DEL %LOCAL%\IP.TXT
     * )
     * 
     * REM abre o arquivo no pc do dener a adiciona a linha com as informações novas
     * IF EXIST \\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT (
     * 	ECHO %NOME%;ppcaixa-%IP%>>\\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT
     * ) ELSE (
     * 	ECHO %NOME%;ppcaixa-%IP%>\\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT
     * )
     * */
    public function loadFileIP(){
        $arquivo = "\\\JAGUAR\\Parametros_ECF\\IpSistemaPic\\IP.TXT";
        //abre o arquivo
        $ponteiro = fopen($arquivo, "r");
        
        //verifica erro ao abrir arquivo
        if($ponteiro != 0){
           //lê arquivo até o fim
            while (!feof($ponteiro)){
                //lê a linha do arquivo
                $linha = fgets($ponteiro);
                //busca dados
                $dados = $this->getInfLine($linha);
                //varifica no banco, salva e ou atualiza IP
                if ($dados != NULL){
                    //echo $dados["nome"];
                    //echo ": ".$dados["ip"];
                    //echo "<br>";
                    //verifica, grava e atualiza
                    $this->gravaDB($dados);
                }
            }
            //fecha arquivo
            fclose($ponteiro); 
            //Log
            $this->gravaLog("ARQUIVO fim carregamento do arquivo", "local do arquivo: ".$arquivo);
        } else{
            //Log
            $this->gravaLog("ARQUIVO erro carregamento do arquivo", "local do arquivo: ".$arquivo);
        }       
    }
    
    //Carregando nome e ip dos caixas por arquivo .txt em \\JAGUAR\Parametros_ECF\IpSistemaPic
    public function loadFileIPAjax(){
        $arquivo = "\\\JAGUAR\\Parametros_ECF\\IpSistemaPic\\IP.TXT";
        //abre o arquivo
        $ponteiro = fopen($arquivo, "r");
        
        //verifica erro ao abrir arquivo
        if($ponteiro != 0){
           //lê arquivo até o fim
            while (!feof($ponteiro)){
                //lê a linha do arquivo
                $linha = fgets($ponteiro);
                //busca dados
                $dados = $this->getInfLine($linha);
                //varifica no banco, salva e ou atualiza IP
                if ($dados != NULL){
                    //verifica, grava e atualiza
                    $this->gravaDB($dados);
                }
            }
            //fecha arquivo
            fclose($ponteiro); 
            //Log
            $this->gravaLog("ARQUIVO fim carregamento do arquivo via ajax", "local do arquivo: ".$arquivo);
            $mgs = array(
                "msg" => "Maquinas atualizadas!"
            );
            echo json_encode($mgs);
        } else{
            //Log
            $this->gravaLog("ARQUIVO erro carregamento do arquivo via ajax", "local do arquivo: ".$arquivo);
            $mgs = array(
                "erro" => "Arquivo não encontrado"
            );
            echo json_encode($mgs);
        }
        exit();
    }
    
    //Busca e separa os dados importantes no arquivo (nome e ip)
    //Entra uma linha do arquivo e retorna array com os dados
    private function getInfLine($linha){
        //retirar espaços em branco
        $texto = str_replace(" ", "", $linha);
        //pega nome do pc
        $pos = strpos($texto, ";");
        $nome = substr($texto, 0,$pos);
        //pega nome do usuario
        $pos = strpos($texto, ";");
        $fimnome = strpos($texto, "-");
        $user = substr($texto, $pos+1, $fimnome-($pos+1));
        //pega ip do pc
        $pos = strpos($texto, ":");
        $ip = substr($texto, $pos+1);
        
        //verifica dados do IP e nome da maquina
        if (substr($ip, 0, 3) != "192"){
            return NULL;
        } else {
            $dados["nome"] = trim($nome);
            $dados["ip"] = trim($ip);
            $dados["user"] = trim($user);
            return $dados;
        }
    }
    
    //Grava, atualiza e verifica se existe
    private function gravaDB($dados){
        //Verifica se existe a maquina no banco de dados
        //existeIpArquivo($ip)
        if ($this->maquina->existeIpArquivo($dados["ip"])){
            //Busca a maquina e atualiza
            //buscaMaquinaIpArquivo($ip)
            $maquina = $this->maquina->buscaMaquinaIpArquivo($dados["ip"]);
            //atualizaMaquinaArquivo($id, $nome, $login, $descricao)
            $this->maquina->atualizaMaquinaArquivo($maquina->getIdmaquina(), $dados["nome"], $dados["user"], "Caixa do PIC Pampulha");
            //Log
            $this->gravaLog("ARQUIVO maquina atualizada no BD", "Nome: ".$dados["nome"]." IP: ".$dados["ip"]);
        } else {
            //Adiciona maquina newMaquina($nome, $ip, $idlocal, $idtipo, $idunidade, $login = NULL, $descricao = NULL)
            $this->maquina->newMaquina($dados["nome"], $dados["ip"], 1, 2, 1, $dados["user"], "Caixa do PIC Pampulha");
            $this->maquina->addMaquina();
            //Log
            $this->gravaLog("ARQUIVO maquina nova gravada no BD", "Nome: ".$dados["nome"]." IP: ".$dados["ip"]);
        }
    }
    
    //Grava log no BD
    private function gravaLog($nome, $descricao){
        //dados
        $data = date('Y-m-d H:i:s');
        $ip =  $this->input->ip_address();
        if ($this->session->has_userdata("nome")){
            $idusuario = $this->session->userdata("id");
        } else {
            $idusuario = 0;
        }
        //carrega model
        $this->load->model("Log_model", "registro");
        $this->registro->newLog($nome, $descricao, $data, $ip, $idusuario);
        $this->registro->addLog();
    }
    
    /*Carregando o arquivo com o nome da maquina.txt e pegar dentro do aquivo o nome do sistema operacional 
     * e a lista de programas instalaos em \\jaguar\Inventario - Arquivo em formato UTF-8 e CSV
     * Formato do arquivo
     * 
     * Node,Caption
     * TI00,Microsoft Windows 10 Pro
     * Node,Name,Version
     * TI00,Microsoft Office Enterprise 2007,12.0.6612.1000
     * TI00,Microsoft Office OneNote MUI (Portuguese (Brazil)) 2007,12.0.6612.1000
     * TI00,Microsoft Office InfoPath MUI (Portuguese (Brazil)) 2007,12.0.6612.1000
     * TI00,Microsoft Office Access MUI (Portuguese (Brazil)) 2007,12.0.6612.1000
     * TI00,Microsoft Office Excel MUI (Portuguese (Brazil)) 2007,12.0.6612.1000
     * TI00,Microsoft Office PowerPoint MUI (Portuguese (Brazil)) 2007,12.0.6612.1000 
     * 
     * Arquivo BAT
     * REM Fazer inventario software sistema PIC
     * REM Pegar atraves do wmic o nome sistema operacional do computador, software e versao em formato CSV
     * wmic os get caption /format:CSV  > \\JAGUAR\Inventario\%COMPUTERNAME%1.txt
     * wmic product get name, version /format:CSV >> \\JAGUAR\Inventario\%COMPUTERNAME%1.txt
     * 
     * REM Mudar charset para UTF-8 (Não funciona no windows XP)
     * REM CHCP 65001
     * 
     * REM Converter o arquivo para UTF-8
     * TYPE \\JAGUAR\Inventario\%COMPUTERNAME%1.txt > \\JAGUAR\Inventario\%COMPUTERNAME%.txt
     * 
     * REM Apagar arquivo antigo
     * DEL \\JAGUAR\Inventario\%COMPUTERNAME%1.txt
     */
    public function loadFileSoftware(){        
        //lista de maquinas no PIC Pampulha
        $maquinas = $this->maquinasPicPampulha();
        //diretorio do aqruivo
        $dir = "\\\jaguar\\Inventario\\";
        //extenção do arquivo
        $ext = ".TXT";
        //Array de dados
        $dados = array();
        
        foreach ($maquinas as $key => $value) {
            //verifica se existe o aqruivo
            if (file_exists($dir.$value.$ext)){
                //abre o arquivo                
                $ponteiro = fopen($dir.$value.$ext, "r");
                //verifica erro ao abrir arquivo                
                if($ponteiro != 0){
                    //Contador de linhas
                    $cont = 1;
                    //Array de dados
                    $dados = array();
                    //lê arquivo até o fim
                    while (!feof($ponteiro)){
                        //Lê a linha 
                        $linha = trim(fgets($ponteiro));
                        if (!empty($linha)){
                            //Linha 3 tem o nome do sistema operacional
                            if ($cont == 3){
                                //nome da maquina
                                $dados["nome"] = $value;
                                //pega nome do sistema operacional
                                $vetor = explode(",", $linha);
                                $dados["sistema"] = trim($vetor[1]);
                            }
                            //Linha 5 pra frente são os programas
                            if ($cont > 4){                            
                                //linha 5 até o fim do arquivo é softwares
                                $dados["programas"][] = $this->getInfLineMaquina($linha);
                            }
                        }
                        //proxima linha
                        $cont++;
                    }                    
                    //Grava no banco de dados
                    $this->gravaDBMaquina($dados);   
                    //fecha arquivo
                    fclose($ponteiro); 
                    //Log
                    $this->gravaLog("ARQUIVO fim carregamento do arquivo de software", "local do arquivo: ".$dir.$value.$ext);
                } else{
                    //Log
                    $this->gravaLog("ARQUIVO erro carregamento do arquivo de software", "local do arquivo: ".$dir.$value.$ext);
                }
            }
        }          
    }
    
    //Busca e separa os dados importantes no arquivo (sistema operacional lista de software com suas versões)
    //Entra uma linha do arquivo e retorna array com os dados
    private function getInfLineMaquina($linha){
        //separa por ",". Arquivo estilo CSV
        $dados = explode(",", $linha);
        $resultado = array();
        
        if (is_array($dados)){
            //recupera progama
            if (array_key_exists(1, $dados)){
                $resultado["programa"] = trim($dados[1]);    
            } else {
                $resultado["programa"] = "Sem programa";  
            }
            //recupera versão
            if (array_key_exists(2, $dados)){
                $resultado["versao"] = trim($dados[2]);    
            } else {
                $resultado["versao"] = "Sem versão";  
            }  
        }        
        return $resultado;
    }
    
    //Grava, atualiza e verifica se existe maquina
    private function gravaDBMaquina($dados){
        //carrega modelo software
        $this->load->model("Software_model", "software");
        //Verifica se existe a maquina no banco de dados 
        if (array_key_exists("nome", $dados)){
            if ($this->maquina->existeMaquina($dados["nome"])){
                //Busca a maquina e atualiza
                $maquina = $this->maquina->buscaMaquinaNome($dados["nome"]);
                //atualiza sistema operacional da maquina
                $this->maquina->atualizaSoftware($maquina->getIdmaquina(), $dados["sistema"]);
                //apaga todos os programas da maquina
                $this->software->removeTodosMaquina($maquina->getIdmaquina());
                //atualiza softwares da maquina
                if (array_key_exists("programas", $dados)){
                    foreach ($dados["programas"] as $key => $value) {
                        if ((array_key_exists("programa", $value)) && (array_key_exists("versao", $value))){
                            $this->software->novo($value["programa"], $value["versao"], $maquina->getIdmaquina());
                            $this->software->adiciona();
                        }
                    }
                }
                //Log
                $this->gravaLog("ARQUIVO softwares atualizado no BD", "Nome: ".$dados["nome"]);
            }
        }        
    }
    
    //pegando todos as maquinas do PIC Pampulha
    private function maquinasPicPampulha(){
        //lista de nomes das maquinas
        $lista = array();
        //todas maquinas do pic pampulha
        $maquinas = $this->maquina->buscaTodasPorUnidade(1);
        if (!empty($maquinas)){
            //vetor recebe nome de cada maquina
            foreach ($maquinas as $key => $value) {
                $lista[] = $value->getNome();
            }
        }
        return $lista;
    }    
}
