<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_admin extends CI_Controller {

    /**
     * Setor_admin.
     * @descripition Controlador setorres do pic (EX: TI, Fiscal)
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Setor_model', 'setor');
        $this->load->model('estado_model', 'estado');
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));     
        //Carrega menu
        $this->load->view('admin/menu', array(
            "assetsUrl" => base_url("assets"),
            "ativo" => "setores"));
        //Carrega setores
        $this->load->view('admin/setores/setores', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "setores" => $this->setor->todosSetores(7, $this->recuperaOffset()),
            "paginas" => $this->listarSetores()));
        //Modal
        $this->load->view('admin/setores/criar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/editar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/remover-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/ativar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));     
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
            "arquivoJS" => "administracao.js"));
    }
    
    //Mensagem sucesso
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
            "msg" => $msg,
            "uri" => $uri
                ));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    //resultado da busca
    public function resultado($resultado, $palavra){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));     
        //Carrega menu
        $this->load->view('admin/menu', array(
            "assetsUrl" => base_url("assets"),
            "ativo" => "setores"));
        //Carrega setores
        $this->load->view('admin/setores/setores', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/setores/criar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/editar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/remover-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/setores/ativar-setores', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*------Requisições--------*/
    //Criar 
    public function criarSetor(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->setor->setorExiste($nome)){
            //cria area
            $this->setor->newSetor($nome, $this->geraEstado($estado));
            $this->setor->addSetor();
            //Log
            $this->gravaLog("ADMIN criação setor", "setor criado: ".$nome);
            redirect(base_url('admin/setor_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação setor", "tentativa de criar setor: ".$nome);
            echo'erro ao criar area';
        }
    }
    
    //Paginação 
    public function listarSetores(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/setor_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->setor->contarTodos(),
            "full_tag_open" => "<ul class='pagination'>",
            "full_tag_close" => "</ul>",
            "first_link" => FALSE,
            "last_link" => FALSE,
            "first_tag_open" => "<li>",
            "first_tag_close" => "</li>",
            "prev_link" => "<span aria-hidden='true'>&laquo;</span>",
            "prev_tag_open" => "<li class='prev'>",
            "prev_tag_close" => "</li>",
            "next_link" => "<span aria-hidden='true'>&raquo;</span>",
            "next_tag_open" => "<li class='next'>",
            "next_tag_close" => "</li>",
            "last_tag_open" => "<li>",
            "last_tag_close" => "</li>",
            "cur_tag_open" => "<li class='active'> <a href='#'>",
            "cur_tag_close" => "</a></li>",
            "num_tag_open" => "<li>",
            "num_tag_close" => "<li>"
        );
        //Inicializar biblioteca pagination
        $this->pagination->initialize($config);
        //html completo dos links
        $paginas = $this->pagination->create_links();
        return $paginas;
    }
    
    //Atualiza setor
    public function atualizaSetor(){
        //recuperando dados do setor
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->setor->verificaSetorAtualiza($id, $nome)){
            //atualiza setor
            $this->setor->atualizaSetor($id, $nome, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração setor", "setor alterado: ".$nome);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração setor", "tentativa de alterar setor: ".$nome);
            echo'erro ao alterar setor';
        }            
    }
    
    //Desabilitar setor
    public function desabilitaSetor(){
        //recupera id setor
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se setor existe e esta ativo
        if ($this->setor->verificaAtivo($id)){
            //desativa setor
            $this->setor->desativaSetor($id);
            //Log
            $this->gravaLog("ADMIN desabilita setor", "setor desabilitado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar setor", "tentativa de desabilitar setor id: ".$id);
            echo'erro ao desabilitar setor';
        }
    }
    
    //Ativar setor
    public function ativaSetor(){
        //recupera id setor
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se setor existe e esta ativo
        if ($this->setor->verificaDesativo($id)){
            //desativa setor
            $this->setor->ativaSetor($id);
            //Log
            $this->gravaLog("ADMIN ativa setor", "setor ativado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar setor", "tentativa de ativar setor id: ".$id);
            echo'erro ao ativar setor';
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->setor->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->setor->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de setores: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    /*----------------Funções AJAX---------------*/
    //Editar setor ajax
    public function editarSetor(){
        //Recupera Id setor
        $id = $this->input->post("idsetor");
        $setor = $this->setor->buscaId($id);
        
        if (isset($setor)){
            $estado = $this->estado->buscaId($setor->getIdestado());
            $mgs = array(
                "idsetor" => $setor->getIdsetor(),
                "nome" => $setor->getNome(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Setor não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover setor ajax
    public function removerSetor(){
        //Recupera Id setor
        $id = $this->input->post("idsetor");
        $setor = $this->setor->buscaId($id);
        
        if (isset($setor)){
            $mgs = array(
                "idsetor" => $setor->getIdsetor(),
                "nome" => $setor->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Setor não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarSetor(){
        //Recupera Id setor
        $id = $this->input->post("idsetor");
        $setor = $this->setor->buscaId($id);
        
        if (isset($setor)){
            $mgs = array(
                "idsetor" => $setor->getIdsetor(),
                "nome" => $setor->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Setor não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
        
    /*------Funções internas--------*/ 
    //Paginação , recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else{
            return 0;
        }
    }
    
    //busca estado
    private function geraEstado($estado){
        return $this->estado->buscaNome($estado)->getIdestado();
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
     
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') != '0'){
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Setor_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Setor_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Setor_adim.php");
            redirect(base_url());
        }
    }
}
