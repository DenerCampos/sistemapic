<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadFile extends CI_Controller {

    /**
     * LoadFile: Carrega arquivo em \\JAGUAR\Parametros_ECF\IpSistemaPic
     *           para o banco de dados.
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
    
    //Carregando nome e ip dos caixas por arquivo .txt em \\JAGUAR\Parametros_ECF\IpSistemaPic
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
            $dados["nome"] = $nome;
            $dados["ip"] = $ip;
            $dados["user"] = $user;
            return $dados;
        }
    }
    
    //Grava, atualiza e verifica se existe
    private function gravaDB($dados){
        //Verifica se existe a maquina no banco de dados
        if ($this->maquina->existeMaquina($dados["nome"])){
            //Busca a maquina e atualiza
            $maquina = $this->maquina->buscaMaquinaNome($dados["nome"]);
            $this->maquina->atualizaMaquina($maquina->getIdmaquina(), $dados["nome"], $dados["ip"], $dados["user"], $maquina->getDescricao(), $maquina->getIdlocal(), $maquina->getIdtipo());
            //Log
            $this->gravaLog("ARQUIVO maquina atualizada no BD", "Nome: ".$dados["nome"]." IP: ".$dados["ip"]);
        } else {
            //Adiciona maquina $nome, $ip, $idlocal, $idtipo, $login = NULL, $descricao = NULL
            $this->maquina->newMaquina($dados["nome"], $dados["ip"], 1, 2, $dados["user"]);
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
}
