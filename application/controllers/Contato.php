<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    /**
     * Contato.
     * @descripition Contatos importantes para o PIC, fornecedores e prestadores de serviços 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Contato_model", "contato");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "utilitario"));      
        //Carrega index
        $this->load->view('contato/contato', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->contato->todos()));
        //Modal
        $this->load->view("contato/criar-contato", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("contato/editar-contato", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("contato/remover-contato", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "contato.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "utilitario"));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => $msg));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "contato.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "utilitario"));     
        //Carrega index
        $this->load->view('mensagens/mensagem', array(
            "assetsUrl" => base_url("assets"),
            "msg" => $msg,
            "uri" => $uri));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "contato.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "utilitario"));   
        //Carrega
        $this->load->view('contato/resultado', array(
            "assetsUrl" => base_url("assets"),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
         $this->load->view("contato/criar-contato", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("contato/editar-contato", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("contato/remover-contato", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "contato.js"));
    }
    
    /*------------------Funções------------------*/   
    //Criar
    public function criar(){
        $empresa; $contato; $tel; $obs; $url;
        try {
            //recupera dados post
            $this->recuperaCriar($empresa, $contato, $tel, $obs, $url);
            //verifica se existe a empresa
            if ($this->contato->verificaExiste($empresa)){
                $this->erro("A empresa <strong>".$empresa."</strong> já está cadastrada no sistema.");
            }else{
                //salva contato novo($empresa, $contato, $tel, $obs)
                $this->contato->novo($empresa, $contato, $tel, $obs);
                $this->contato->adiciona();
                //log
                $this->gravaLog("novo contato", "empresa: ".$empresa." por ".$this->session->userdata("id"));
                $this->mensagem("Empresa <strong>".$empresa."</strong> cadastrada.", $url);
            }

        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao adicionar novo contato. Tente novamente.");
        }

    }
    
    //Editar
    public function editar(){
        $id; $empresa; $contato; $tel; $obs; $url;
        try {
            //recupera post
            $this->recuperaEditar($id, $empresa, $contato, $tel, $obs, $url);
            //verifica se pode atualizar verificaExisteAtualiza($id, $empresa)
            if ($this->contato->verificaExisteAtualiza($id, $empresa)){
                //existe contato com o mesmo nome
                $this->erro("A empresa <strong>".$empresa."</strong> já existe no cadastro, edita ou apague para poder cadastra-la novamente.");
            } else {
                //atualiza atualiza($id, $empresa, $contato, $tel, $obs)
                $this->contato->atualiza($id, $empresa, $contato, $tel, $obs); 
                //log
                $this->gravaLog("contato alterado", "empresa: ".$empresa." por ".$this->session->userdata("id"));
                $this->mensagem("Alteração concluida", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar novo contato. Tente novamente.");
        }
    }
    
    public function remover(){
        $id; $empresa; $url;
        try {
            //recupera post
            $this->recuperaRemover($id, $empresa, $url);
            //verifica se existe contato buscaId($id)
            if (!empty($this->contato->buscaId($id))){
                //remove remove($id)
                $this->contato->remove($id);
                //log
                $this->gravaLog("removido contato", "empresa: ".$empresa." por ".$this->session->userdata("id"));
                $this->mensagem("Empresa <strong>".$empresa."</strong> removida", $url);
            } else {
                //não existe id                
                $this->erro("A empresa <strong>".$empresa."</strong> não existe.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar novo contato. Tente novamente.");
        }
    }
    
     //Buscar
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
            if (empty($texto)){
                //recupera o terceiro seguimento da url ocorrencia/buscar/XXXXXX
                $texto = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("contato/buscar/".urlencode($texto)));
            }
            //Bucar
            $resultado = $this->contato->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca do contato. Tente novamente.");
        }
    }


    /*----------------Funções AJAX---------------*/
    //Editar ajax
    public function editarContato(){
        //Recupera Id
        $id = $this->input->post("idcontato");
        $contato = $this->contato->buscaId($id);
        
        if (isset($contato)){
            $mgs = array(
                "idcontato" => $contato->getIdcontato(),
                "empresa" => $contato->getEmpresa(),
                "contato" => $contato->getContato(),
                "tel" =>$contato->getTel(),
                "obs" => $contato->getObs()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Contato não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerContato(){
        //Recupera Id
        $id = $this->input->post("idcontato");
        $contato = $this->contato->buscaId($id);
        
        if (isset($contato)){
            $mgs = array(
                "idcontato" => $contato->getIdcontato(),
                "empresa" => $contato->getEmpresa(),
                "contato" => $contato->getContato(),
                "tel" =>$contato->getTel(),
                "obs" => $contato->getObs()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Contato não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //verificar se existe o contato no BD
    public function verificaExisteContato(){
        $empresa = trim($this->input->post("nome"));   
        //verifica se existe
        if (!$this->contato->verificaExiste($empresa)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //verificar se existe o contato no BD quando atualiza
    public function verificaExisteContatoAtualiza(){
        $id = trim($this->input->post("id"));  
        $empresa = trim($this->input->post("nome"));   
        //verifica se existe
        if (!$this->contato->verificaExisteAtualiza($id, $empresa)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }


    /*------------Funções internas---------------*/ 
    //recupera criar
    private function recuperaCriar(&$empresa, &$contato, &$tel, &$obs, &$url){
        $empresa = trim($this->input->post("iptCriEmpresa"));
        $contato = trim($this->input->post("iptCriContato"));
        $tel = trim($this->input->post("iptCriTel"));
        $obs = trim($this->input->post("iptCriObs"));
        $url = $this->input->post("iptCriUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "contato";
        }
    }
    
    //recupera editar
    private function recuperaEditar(&$id, &$empresa, &$contato, &$tel, &$obs, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $empresa = trim($this->input->post("iptEdtEmpresa"));
        $contato = trim($this->input->post("iptEdtContato"));
        $tel = trim($this->input->post("iptEdtTel"));
        $obs = trim($this->input->post("iptEdtObs"));
        $url = $this->input->post("iptEdtUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "contato";
        }
    }
    
    //recupera editar
    private function recuperaRemover(&$id, &$empresa, &$url){
        $id = trim($this->input->post("iptRmvId"));        
        $empresa = trim($this->input->post("iptRmvEmpresa"));
        $url = $this->input->post("iptRmvUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "contato";
        }
    }
    
    //recupera buscar
    private function recuperaBusca(&$texto){
        $texto = trim($this->input->post("iptBusca")); 
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


    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getUtilitario() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("acesso negado", "acesso ao controlador Contato.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Contato.php");
            redirect(base_url());
        }
    }
}
