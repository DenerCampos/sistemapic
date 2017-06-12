<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_maquina_admin extends CI_Controller {

    /**
     * Local_maquina_admin.
     * @descripition Controlador de locais das maquinas (CAIXAS) mapa pic
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('local_model', 'local');
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
            "ativo" => "localmaquinas"));
        //Carrega usuarios
        $this->load->view('admin/local-maquina/locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "locais" => $this->local->todosLocais(7, $this->recuperaOffset()),
            "paginas" => $this->listarLocais()));
        //Modal
        $this->load->view('admin/local-maquina/criar-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/editar-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/remover-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/ativar-locais-maquina', array(
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
    
    //Resultado
    public function resultado($resultados, $palavra){
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
            "ativo" => "localmaquinas"));
        //Carrega usuarios
        $this->load->view('admin/local-maquina/locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultados));
        //Modal
        $this->load->view('admin/local-maquina/criar-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/editar-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/remover-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/local-maquina/ativar-locais-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*-------------Funções---------------*/
    //Criar
    public function criarLocal(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $shape = $this->input->post("iptCriShape");
        $coords = $this->input->post("iptCriCoords");
        $caixa = $this->input->post("chkCriCaixa");
        $estado = $this->input->post("selCriEstado");
        
        //verifica se caixa
        if (!isset($caixa)){
            $caixa = 1;
        }
        
        //verifica dados
        if (!$this->local->localExiste($nome)){
            //verifica se é um caixa
            //$caixa = $
            //cria 
            $this->local->newLocal($nome, $shape, $coords, $caixa, $this->geraEstado($estado));
            $this->local->addLocal();
            //Log
            $this->gravaLog("ADMIN criação local", "local criado: ".$nome);
            redirect(base_url('admin/local_maquina_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação local", "tentativa de criar local: ".$nome);
            echo'erro ao criar local';
        }
    }
    
    //Paginação
    public function listarLocais(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/local_maquina_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->local->contarTodos(),
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
    
    //Atualiza
    public function atualizaLocal(){
        //recuperando dados
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $shape = $this->input->post("iptEdtShape");
        $coords = $this->input->post("iptEdtCoords");
        $caixa = $this->input->post("chkEdtCaixa");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica se caixa
        if (!isset($caixa)){
            $caixa = 1;
        }
        
        //verifica dados
        if (!$this->local->verificaLocalAtualiza($id, $nome)){
            //atualiza
            $this->local->atualizaLocal($id, $nome, $shape, $coords, $caixa, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração local", "local alterado: ".$nome);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração local", "tentativa de alterar local: ".$nome);
            echo'erro ao alterar local';
        }            
    }
    
    //Desabilitar 
    public function desabilitaLocal(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se existe e esta ativo
        if ($this->local->verificaAtivo($id)){
            //desativa 
            $this->local->desativaLocal($id);
            //Log
            $this->gravaLog("ADMIN desabilita local", "local desabilitado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar local", "tentativa de desabilitar local id: ".$id);
            echo'erro ao desabilitar local';
        }
    }
    
    //Ativar 
    public function ativaLocal(){
        //recupera id 
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se existe e esta ativo
        if ($this->local->verificaDesativo($id)){
            //desativa 
            $this->local->ativaLocal($id);
            //Log
            $this->gravaLog("ADMIN ativa local", "local ativado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar local", "tentativa de ativar local id: ".$id);
            echo'erro ao ativar local';
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->local->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->local->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de local: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar area ajax
    public function editarLocal(){
        //Recupera Id 
        $id = $this->input->post("idlocal");
        $local = $this->local->buscaId($id);
        
        if (isset($local)){
            $estado = $this->estado->buscaId($local->getIdestado());
            $mgs = array(
                "idlocal" => $local->getIdlocal(),
                "nome" => $local->getNome(),
                "shape" => $local->getShape(),
                "coords" => $local->getCoords(),
                "caixa" => $local->getCaixa(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Local não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover area ajax
    public function removerLocal(){
        //Recupera Id 
        $id = $this->input->post("idlocal");
        $local = $this->local->buscaId($id);
        
        if (isset($local)){
            $mgs = array(
                "idlocal" => $local->getIdlocal(),
                "nome" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Local não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarLocal(){
        //Recupera Id 
        $id = $this->input->post("idlocal");
        $local = $this->local->buscaId($id);
        
        if (isset($local)){
            $mgs = array(
                "idlocal" => $local->getIdlocal(),
                "nome" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Local não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    
    /*------Funções internas--------*/ 
    //Paginação, recupera offset
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
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Local_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Local_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Local_adim.php");
            redirect(base_url());
        }
    }
}
