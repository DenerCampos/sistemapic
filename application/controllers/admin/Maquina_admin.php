<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquina_admin extends CI_Controller {

    /**
     * Maquina_admin.
     * @descripition Controlador maquinas da area de administraçao do sistema 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('maquina_model', 'maquina');
        $this->load->model('tipo_model', 'tipo');
        $this->load->model('local_model', 'local');
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
            "ativo" => "maquinas"));
        //Carrega usuarios
        $this->load->view('admin/maquinas/maquinas', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "tipo" => new Tipo_model(),
            "maquinas" => $this->maquina->buscaTodas(7, $this->recuperaOffset()),
            "paginas" => $this->listarMaquinas()));
        //Modal
        $this->load->view('admin/maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('admin/maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('admin/maquinas/remover-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
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
    
    //Resultados da busca
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
            "ativo" => "maquinas"));
        //Carrega usuarios
        $this->load->view('admin/maquinas/maquinas', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "tipo" => new Tipo_model(),
            "palavra" => $palavra,
            "resultados" => $resultados));
        //Modal
        $this->load->view('admin/maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('admin/maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('admin/maquinas/remover-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->maquina->buscar($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->maquina->buscar($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de maquinas: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*-------------Funções---------------*/
    //Criar
    public function criarMaquina(){
        //recupera dados
        $nome = strtoupper(trim($this->input->post("iptCriNome")));
        $ip = $this->input->post("iptCriIp");
        $login = strtolower(trim($this->input->post("iptCriUser")));
        $descricao = $this->input->post("iptCriDesc");
        $local = $this->input->post("selCriLocal");
        $tipo = $this->input->post("selCriTipo");
        
        //verifica dados
        if (!$this->maquina->existeMaquina($nome)){
            //cria maquina newMaquina($nome, $ip, $idlocal, $idtipo, $login = NULL, $descricao = NULL)
            $this->maquina->newMaquina($nome, $ip, $this->geraLocal($local), $this->geraTipo($tipo), $login, $descricao);
            $this->maquina->addMaquina();
            //Log
            $this->gravaLog("ADMIN criação maquina", "maquina criada: ".$nome." ip: ". $ip);
            redirect(base_url('admin/maquina_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação maquina", "tentativa de criar maquina: ".$nome." ip: ". $ip);
            echo'erro ao criar maquina';
        }
    }
    
    //Paginação usuario
    public function listarMaquinas(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/maquina_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->maquina->contarTodos(),
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
    
    //Atualiza maquina
    public function atualizaMaquina(){
        //recuperando dados do maquina
        $id = $this->input->post("iptEdtId");
        $nome = strtoupper(trim($this->input->post("iptEdtNome")));
        $ip = $this->input->post("iptEdtIp");
        $login = strtolower(trim($this->input->post("iptEdtUser")));
        $descricao = $this->input->post("iptEdtDesc");
        $local = $this->input->post("selEdtLocal");
        $tipo = $this->input->post("selEdtTipo");
        $url = $this->input->post("iptEdtUrl");
             
        //verifica dados
        if (!$this->maquina->verificaMaquinaAtualiza($id, $nome)){
            //atualiza  atualizaMaquina($id, $nome, $ip, $login, $descricao, $idlocal, $idtipo)
            $this->maquina->atualizaMaquina($id, $nome, $ip, $login, $descricao, $this->geraLocal($local), $this->geraTipo($tipo));
            //Log
            $this->gravaLog("ADMIN alteração maquina", "maquina alterado: ".$nome." ip: ". $ip);
            //redirect(base_url('admin/maquina_admin'));
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração maquina", "tentativa de alterar maquina: ".$nome." ip: ". $ip);
            echo'erro ao alterar maquina';
        }            
    }
    
    //remove maquina
    public function removeMaquina(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        
        //verifica se existe
        if ($this->maquina->existe($id)){
            //remove 
            $this->maquina->removerMaquina($id);
            //Log
            $this->gravaLog("ADMIN removeu maquina", "maquina removida id: ".$id);
            redirect(base_url('admin/maquina_admin'));
        }else {
            //Log
            $this->gravaLog("ADMIN erro remover maquina", "tentativa de remover maquina id: ".$id);
            echo'erro ao remover maquina';
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar ajax
    public function editarMaquina(){
        //Recupera Id maquina
        $id = $this->input->post("idmaquina");
        $maquina = $this->maquina->buscaMaquinaId($id);
        
        if (isset($maquina)){
            $local = $this->local->buscaId($maquina->getIdlocal());
            $tipo = $this->tipo->buscaId($maquina->getIdtipo());
            $mgs = array(
                "idmaquina" => $maquina->getIdmaquina(),
                "nome" => $maquina->getNome(),
                "ip" => $maquina->getIp(),
                "login" =>$maquina->getLogin(),
                "descricao" => $maquina->getDescricao(),
                "local" => $local->getNome(),
                "tipo" => $tipo->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Maquina não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerMaquina(){
        //Recupera Id maquina
        $id = $this->input->post("idmaquina");
        $maquina = $this->maquina->buscaMaquinaId($id);
        
        if (isset($maquina)){
            $mgs = array(
                "idmaquina" => $maquina->getIdmaquina(),
                "nome" => $maquina->getNome(),
                "ip" => $maquina->getIp()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Maquina não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }    
    
    /*------Funções internas--------*/ 
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
    
    //busca local
    private function geraLocal($local){
        return $this->local->buscaLocalNome($local)->getIdlocal();
    }
    
    //busca tipo
    private function geraTipo($tipo){
        return $this->tipo->buscaTipoNome($tipo)->getIdtipo();
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Maquina_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Maquina_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Maquina_adim.php");
            redirect(base_url());
        }
    }
}
