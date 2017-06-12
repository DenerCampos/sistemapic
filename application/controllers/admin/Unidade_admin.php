<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidade_admin extends CI_Controller {

    /**
     * Unidade_admin.
     * @descripition Controlador unidades do pic (EX: PIC CIDADE, PIC PAMPULHA)
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Unidade_model', 'unidade');
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
            "ativo" => "unidades"));
        //Carrega unidades
        $this->load->view('admin/unidades/unidades', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "unidades" => $this->unidade->todasUnidades(7, $this->recuperaOffset()),
            "paginas" => $this->listarUnidades()));
        //Modal
        $this->load->view('admin/unidades/criar-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/editar-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/remover-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/ativar-unidades', array(
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
            "ativo" => "unidades"));
        //Carrega unidades
        $this->load->view('admin/unidades/unidades', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/unidades/criar-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/editar-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/remover-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/unidades/ativar-unidades', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*------Requisições--------*/
    //Criar unidade
    public function criarUnidade(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->unidade->unidadeExiste($nome)){
            //cria area
            $this->unidade->newUnidade($nome, $this->geraEstado($estado));
            $this->unidade->addUnidade();
            //Log
            $this->gravaLog("ADMIN criação unidade", "unidade criada: ".$nome);
            redirect(base_url('admin/unidade_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação unidade", "tentativa de criar unidade: ".$nome);
            echo'erro ao criar unidade';
        }
    }
    
    //Atualiza unidade
    public function atualizaUnidade(){
        //recuperando dados dA unidade
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->unidade->verificaUnidadeAtualiza($id, $nome)){
            //atualiza unidade
            $this->unidade->atualizaUnidade($id, $nome, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração unidade", "unidade alteradA: ".$nome);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração unidade", "tentativa de alterar unidade: ".$nome);
            echo'erro ao alterar unidade';
        }            
    }
    
    //Desabilitar unidade
    public function desabilitaUnidade(){
        //recupera id unidade
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se unidade existe e esta ativo
        if ($this->unidade->verificaAtivo($id)){
            //desativa unidade
            $this->unidade->desativaUnidade($id);
            //Log
            $this->gravaLog("ADMIN desabilita unidade", "unidade desabilitada id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar unidade", "tentativa de desabilitar unidade id: ".$id);
            echo'erro ao desabilitar unidade';
        }
    }
    
    //Ativar unidade
    public function ativaUnidade(){
        //recupera id unidade
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se unidade existe e esta ativo
        if ($this->unidade->verificaDesativo($id)){
            //desativa unidade
            $this->unidade->ativaUnidade($id);
            //Log
            $this->gravaLog("ADMIN ativa unidade", "unidade ativada id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar unidade", "tentativa de ativar unidade id: ".$id);
            echo'erro ao ativar unidade';
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->unidade->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->unidade->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de unidade: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar unidade ajax
    public function editarUnidade(){
        //Recupera Id unidade
        $id = $this->input->post("idunidade");
        $unidade = $this->unidade->buscaId($id);
        
        if (isset($unidade)){
            $estado = $this->estado->buscaId($unidade->getIdestado());
            $mgs = array(
                "idunidade" => $unidade->getIdunidade(),
                "nome" => $unidade->getNome(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Unidade não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover unidade ajax
    public function removerUnidade(){
        //Recupera Id unidade
        $id = $this->input->post("idunidade");
        $unidade = $this->unidade->buscaId($id);
        
        if (isset($unidade)){
            $mgs = array(
                "idunidade" => $unidade->getIdunidade(),
                "nome" => $unidade->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Unidade não encontradA"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarUnidade(){
        //Recupera Id unidade
        $id = $this->input->post("idunidade");
        $unidade = $this->unidade->buscaId($id);
        
        if (isset($unidade)){
            $mgs = array(
                "idunidade" => $unidade->getIdunidade(),
                "nome" => $unidade->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Unidade não encontradA"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    /*------Funções internas--------*/ 
    //Paginação unidade
    public function listarUnidades(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/unidade_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->unidade->contarTodos(),
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
    
    //Paginação usuariao, recupera offset
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Unidade_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Unidade_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Unidade_adim.php");
            redirect(base_url());
        }
    }
}
