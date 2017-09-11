<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

    /**
     * Relatorio controller.
     * @descripition Relatorio com graficos utilizando a biblioteca chartjs.
     *                  Contempla todos os relatorio exceto o de plantão. 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Unidade_model", "unidade");
        $this->load->model("Area_model", "area");
        $this->load->model("Local_model", "local");
        $this->load->model("Problema_model", "problema");
        $this->load->model("Setor_model", "setor");
        $this->load->model("Usuario_model", "usuario");
        $this->load->model("Ocorrencia_model", "ocorrencia");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        redirect(base_url());
    }
    
    //Relatorio geral
    public function geral(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('relatorio/geral', array(
            "assetsUrl" => base_url("assets")));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    //Relatorio por setor
    public function setor(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('relatorio/setor', array(
            "assetsUrl" => base_url("assets")));
        //Modal        
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    //Relatorio por usuario
    public function usuario(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('relatorio/usuario', array(
            "assetsUrl" => base_url("assets")));
        //Modal        
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    //Relatorio por tecnico
    public function tecnico(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('relatorio/tecnico', array(
            "assetsUrl" => base_url("assets")));
        //Modal        
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => 'teste de ero'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('mensagens/mensagem', array(
            "assetsUrl" => base_url("assets"),
            "msg" => 'teste de mensagem',
            "uri" => 'home'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "relatorio.js"));
    }
    
    /*------------------Funções------------------*/   
    
    
    
    /*----------------Funções AJAX---------------*/
    //Relatorio geral
    public function relatorioGeral(){
        //recupera as datas
        $inico; $fim;        
        $this->recuperaDatasRelatorio($inicio, $fim);
        
        try {
            //verificando data 
            if (strtotime($inicio) >= strtotime($fim)){
                //erro
                $resultado = array(
                    "erro" => "Data de inicio não pode ser maior que a data fim."
                );
            } else{
                //tecnico que mais fechou chamados
                $tecnico = $this->tecnicoFechouChamados($inicio, $fim);
                //area que mais abriu chamados
                $area = $this->areaAbriuChamados($inicio, $fim);
                //setor que mais abriu chamado
                $setor = $this->setorAbriuChamados($inicio, $fim);
                //problema mais comum
                $problema = $this->problemaAbriuChamados($inicio, $fim); 
                //usuario que mais abriu chamado
                $usuario = $this->usuarioAbriuChamados($inicio, $fim);

                $resultado = array(
                    "abertos" => $this->ocorrencia->contarAbertosPorData($inicio, $fim),
                    "atendimentos" => $this->ocorrencia->contarAtendimentosPorData($inicio, $fim),
                    "fechados" => $this->ocorrencia->contarFechadosPorData($inicio, $fim),
                    "tecnico" => $tecnico[0],
                    "totaltecnico" => $tecnico[1],
                    "area" => $area[0],
                    "totalarea" => $area[1], 
                    "setor" => $setor[0],
                    "totalsetor" => $setor[1],
                    "problema" => $problema[0],
                    "totalproblema" => $problema[1],
                    "usuario" => $usuario[0],
                    "totalusuario" => $usuario[1]
                );
            }

            echo json_encode($resultado);
            exit();
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
    
    //Relatorio por setor
    public function relatorioSetor(){
        //recupera as datas
        $inico; $fim;        
        $this->recuperaDatasRelatorio($inicio, $fim);
        
        try {
            //verificando data 
            if (strtotime($inicio) >= strtotime($fim)){
                //erro
                $resultado = array(
                    "erro" => "Data de inicio não pode ser maior que a data fim."
                );
            } else{
                //setor que mais abriu chamado
                $resultado = array_values($this->relatorioPorSetor($inicio, $fim));
            }

            echo json_encode($resultado);
            exit();
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
    
    //Relatorio por usuario
    public function relatorioUsuario(){
        //recupera as datas
        $inico; $fim;        
        $this->recuperaDatasRelatorio($inicio, $fim);
        
        try {
            //verificando data 
            if (strtotime($inicio) >= strtotime($fim)){
                //erro
                $resultado = array(
                    "erro" => "Data de inicio não pode ser maior que a data fim."
                );
            } else{
                //setor que mais abriu chamado
                $resultado = array_values($this->relatorioPorUsuario($inicio, $fim));
            }

            echo json_encode($resultado);
            exit();
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
    
    //Relatorio por tecnico
    public function relatorioTecnico(){
        //recupera as datas
        $inico; $fim;        
        $this->recuperaDatasRelatorio($inicio, $fim);
        
        try {
            //verificando data 
            if (strtotime($inicio) >= strtotime($fim)){
                //erro
                $resultado = array(
                    "erro" => "Data de inicio não pode ser maior que a data fim."
                );
            } else{
                //setor que mais abriu chamado
                $resultado = array_values($this->relatorioPorTecnico($inicio, $fim));
            }

            echo json_encode($resultado);
            exit();
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }

    /*------------Funções internas---------------*/ 
    //Recuperandos as datas
    private function recuperaDatasRelatorio(&$inicio, &$fim){
        $inicio = trim($this->input->get_post("iptCriDataInicio"));
        $fim = trim($this->input->get_post("iptCriDataFim"));
        
        //atualiza data
        $dinicio = new DateTime($inicio);
        $inicio = $dinicio->format("Y-m-d");        
        //aumenta 1 dia na data fim (para o mysql)
        $dfim = new DateTime($fim);
        $dfim->modify("+1 day");
        $fim = $dfim->format("Y-m-d");
    }
    
    //Calculando tecnico que mais fechou chamados
    private function tecnicoFechouChamados($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do tecnico e a segunda o total de chamados deste tecnico
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaFechadosPorData($inicio, $fim);
            //array tecnicos
            $tecnicos = array();
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){
                //alimenta o array de tecnicos com todos os tecnicos do resultado do chamado.
                foreach ($ocorrencias as $chamado) {
                    if (!array_key_exists($chamado->getUsuario_fecha(), $tecnicos)){
                        $tecnicos[$chamado->getUsuario_fecha()] = 0;
                    }
                }
                //faz a contagem alimentando o array dos tecnicos
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getUsuario_fecha(), $tecnicos)){
                        $tecnicos[$value->getUsuario_fecha()] ++ ;
                    }
                }
                //orderna o array em ordem decrescente e numericamente, mantendo o indice.
                arsort($tecnicos, SORT_NUMERIC);
                //pega o maior
                reset($tecnicos);
                $usuario = key($tecnicos);
                $nome = $this->usuario->buscaId($usuario)->getNome();
                $total = current($tecnicos);
                $resultado = array($nome, $total);                 
            }else {
                $resultado = array ("Não foi fechado nenhum chamado", "0");
            }
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array ("Não foi possível", "Não foi possível");
            return $resultado;
        }
    }
    
    //Calculando area que mais abriu chamados
    private function areaAbriuChamados($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome da area e a segunda o total de chamados desta area
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //array
            $areas = array();
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){
                //alimenta o array de areas com todos as areas do resultado do chamado.
                foreach ($ocorrencias as $chamado) {
                    if (!array_key_exists($chamado->getIdarea(), $areas)){
                        $areas[$chamado->getIdarea()] = 0;
                    }
                }
                //faz a contagem alimentando o array das areas
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getIdarea(), $areas)){
                        $areas[$value->getIdarea()] ++ ;
                    }
                }
                //orderna o array em ordem decrescente e numericamente, mantendo o indice.
                arsort($areas, SORT_NUMERIC);
                //pega o maior
                reset($areas);
                $id = key($areas);
                $nome = $this->area->buscaId($id)->getNome();
                $total = current($areas);
                $resultado = array($nome, $total);                 
            }else {
                $resultado = array ("Não foi aberto nenhum chamado", "0");
            }
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array ("Não foi possível", "Não foi possível");
            return $resultado;
        }
    }
    
    //Calculando setor que mais abriu chamados
    private function setorAbriuChamados($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do setor e a segunda o total de chamados deste setor
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //array
            $setores = array();
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){
                //alimenta o array de areas com todos os setores do resultado do chamado.
                foreach ($ocorrencias as $chamado) {
                    if (!array_key_exists($chamado->getIdsetor(), $setores)){
                        $setores[$chamado->getIdsetor()] = 0;
                    }
                }
                //faz a contagem alimentando o array dos setores
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getIdsetor(), $setores)){
                        $setores[$value->getIdsetor()] ++ ;
                    }
                }
                //orderna o array em ordem decrescente e numericamente, mantendo o indice.
                arsort($setores, SORT_NUMERIC);
                //pega o maior
                reset($setores);
                $id = key($setores);
                $nome = $this->setor->buscaId($id)->getNome();
                $total = current($setores);
                $resultado = array($nome, $total);                 
            }else {
                $resultado = array ("Não foi aberto nenhum chamado", "0");
            }
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array ("Não foi possível", "Não foi possível");
            return $resultado;
        }
    }
    
    //Calculando problema mais comum
    private function problemaAbriuChamados($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do problema e a segunda o total de chamados deste problema
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //array
            $problemas = array();
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){
                //alimenta o array de areas com todos os problemas do resultado do chamado.
                foreach ($ocorrencias as $chamado) {
                    if (!array_key_exists($chamado->getIdproblema(), $problemas)){
                        $problemas[$chamado->getIdproblema()] = 0;
                    }
                }
                //faz a contagem alimentando o array dos problemas
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getIdproblema(), $problemas)){
                        $problemas[$value->getIdproblema()] ++ ;
                    }
                }
                //orderna o array em ordem decrescente e numericamente, mantendo o indice.
                arsort($problemas, SORT_NUMERIC);
                //pega o maior
                reset($problemas);
                $id = key($problemas);
                $nome = $this->problema->buscaId($id)->getNome();
                $total = current($problemas);
                $resultado = array($nome, $total);                 
            }else {
                $resultado = array ("Não foi aberto nenhum chamado", "0");
            }
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array ("Não foi possível", "Não foi possível");
            return $resultado;
        }
    }
    
    //Calculando o usuario que mais abriu chamado
    private function usuarioAbriuChamados($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do usuario e a segunda o total de chamados deste usuario
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //array
            $usuarios = array();
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){
                //alimenta o array de usuarios com todos os usuarios do resultado do chamado.
                foreach ($ocorrencias as $chamado) {
                    if (!array_key_exists($chamado->getUsuario_abre(), $usuarios)){
                        $usuarios[$chamado->getUsuario_abre()] = 0;
                    }
                }
                //faz a contagem alimentando o array dos usuarios
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getUsuario_abre(), $usuarios)){
                        $usuarios[$value->getUsuario_abre()] ++ ;
                    }
                }
                //orderna o array em ordem decrescente e numericamente, mantendo o indice.
                arsort($usuarios, SORT_NUMERIC);
                //pega o maior
                reset($usuarios);
                $id = key($usuarios);
                $nome = $this->usuario->buscaId($id)->getNome();
                $total = current($usuarios);
                $resultado = array($nome, $total);                 
            }else {
                $resultado = array ("Não foi aberto nenhum chamado", "0");
            }
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array ("Não foi possível", "Não foi possível");
            return $resultado;
        }
    }
    
    //Calculando setor que mais abriu chamados
    private function relatorioPorSetor($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do setor e a segunda o total de chamados deste setor
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //todos os setores em ordem alfabetica
            $setores = $this->setor->todosSetores();
            //array para colocar todos setores com o total de cada um
            $resultado = array();    
            
            //alimenta o array com todas setores, onde a chave é o id.
            foreach ($setores as $value) {
                $resultado[$value->getIdsetor()] = array ("nome" => $value->getNome(), "total" => 0);
            }
            
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){//faz a contagem alimentando o array dos setores
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getIdsetor(), $resultado)){
                        $resultado[$value->getIdsetor()]["total"] ++;
                    }
                }
            }
            
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array("erro" => "Erro ao gerar o relatório, favor entrar em contato com a TI.");
            return $resultado;
        }
    }
    
    //Calculando usuario que mais abriu chamados
    private function relatorioPorUsuario($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do setor e a segunda o total de chamados deste setor
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaAbertosPorData($inicio, $fim);
            //todos os usuarios em ordem alfabetica
            $usuarios = $this->usuario->todosUsuarios();
            //array para colocar todos setores com o total de cada um
            $resultado = array();    
            
            //alimenta o array com todos usuarios, onde a chave é o id.
            foreach ($usuarios as $value) {
                $resultado[$value->getIdusuario()] = array ("nome" => $value->getNome(), "total" => 0);
            }
            
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){//faz a contagem alimentando o array dos usuarios
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getUsuario_abre(), $resultado)){
                        $resultado[$value->getUsuario_abre()]["total"] ++;
                    }
                }
            }            
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array("erro" => "Erro ao gerar o relatório, favor entrar em contato com a TI.");
            return $resultado;
        }
    }
    
    //Calculando tecnico que mais fechou chamados
    private function relatorioPorTecnico($inicio, $fim){
        //Retorna um array com duas posições, a primeira é o nome do setor e a segunda o total de chamados deste setor
        try {
            //busca todos ocorrecias pelo periodo indicato
            $ocorrencias = $this->ocorrencia->retornaFechadosPorData($inicio, $fim);
            //todos os usuarios em ordem alfabetica
            $usuarios = $this->usuario->todosUsuarios();
            //array para colocar todos setores com o total de cada um
            $resultado = array();    
            
            //alimenta o array com todos usuarios, onde a chave é o id.
            foreach ($usuarios as $value) {
                $resultado[$value->getIdusuario()] = array ("nome" => $value->getNome(), "total" => 0);
            }
            
            //verifica se tem ocorrencias no periodo indicado
            if (isset($ocorrencias)){//faz a contagem alimentando o array dos usuarios
                foreach ($ocorrencias as $value) {
                    if (array_key_exists($value->getUsuario_fecha(), $resultado)){
                        $resultado[$value->getUsuario_fecha()]["total"] ++;
                    }
                }
            }            
            return $resultado; 
            
        } catch (Exception $exc) {
            $resultado = array("erro" => "Erro ao gerar o relatório, favor entrar em contato com a TI.");
            return $resultado;
        }
    }

    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getRelatorio() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Relatorio.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Relatorio.php");
            redirect(base_url());
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
