<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquina extends CI_Controller {

    /**
     * Maquina.
     * @descripition Visualização das maquinas no PIC Pampulha
     * @author Dener Junio
     * 
     */

    /*----------------Construtor------------*/
    
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('maquina_model', 'maquina');
        $this->load->model('tipo_model', 'tipo');
        $this->load->model('local_model', 'local');
    }
    
    
    /*-----------Carregamento de views---------*/
    
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "maquina"));   
        //Carrega
        $this->load->view('maquinas/maquinas', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "tipo" => new Tipo_model(),
            "maquinas" => $this->maquina->buscaTodas(6, $this->recuperaOffset()),
            //"maquinas" => $this->maquina->buscaTodas(),
            "paginas" => $this->listarMaquinas()));
        //Modal
        $this->load->view('maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/remover-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "maquina.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "maquina"));     
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
            "arquivoJS" => "maquina.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "maquina"));     
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
            "arquivoJS" => "maquina.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "maquina"));   
        //Carrega
        $this->load->view('maquinas/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "tipo" => new Tipo_model(),
            "palavra" => $texto,
            "maquinas" => $resultado));
        //Modal
        $this->load->view('maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/remover-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "tipos" => $this->tipo->todosTipos()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "maquina.js"));
    }
    
    /*----------------Funções---------------*/
    
    //Paginação usuario
    public function listarMaquinas(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('maquina'),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 2,
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
    
    //Criar maquina
    public function criarMaquina(){
        try {
            $nome; $ip; $login; $descricao; $local; $tipo; $url;
            //recupera dados
            $this->recuperaCriar($nome, $ip, $login, $descricao, $local, $tipo, $url);
            //verifica dados
            if (!$this->maquina->existeMaquina($nome)){
                //cria maquina newMaquina($nome, $ip, $idlocal, $idtipo, $login = NULL, $descricao = NULL)
                $this->maquina->newMaquina($nome, $ip, $this->geraLocal($local), $this->geraTipo($tipo), $login, $descricao);
                $this->maquina->addMaquina();
                //Log
                $this->gravaLog("criação maquina", "maquina criada: ".$nome." ip: ". $ip);
                $this->mensagem("Maquina <strong>".$nome."</strong> criada.", $url);
            }else{
                //Log
                $this->gravaLog("erro criação maquina", "tentativa de criar maquina: ".$nome." ip: ". $ip);
                $this->mensagem("O nome <strong>".$nome."</strong> já existe. Tente outro nome ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de maquina. Tentar novamente.");
        }  
    }
    
    //Atualiza maquina
    public function atualizaMaquina(){
        try {
            $id; $nome; $ip; $login; $descricao; $local; $tipo; $url;
            //Recuperando dados
            $this->recuperaEditar($id, $nome, $ip, $login, $descricao, $local, $tipo, $url);
            //verifica dados
            if (!$this->maquina->verificaMaquinaAtualiza($id, $nome)){
                //atualiza  atualizaMaquina($id, $nome, $ip, $login, $descricao, $idlocal, $idtipo)
                $this->maquina->atualizaMaquina($id, $nome, $ip, $login, $descricao, $this->geraLocal($local), $this->geraTipo($tipo));
                //Log
                $this->gravaLog("alteração maquina", "maquina alterado: ".$nome." ip: ". $ip);
                $this->mensagem("Alteração concluída.", $url);
            }else{
                //Log
                $this->gravaLog("erro alteração maquina", "tentativa de alterar maquina: ".$nome." ip: ". $ip);
                $this->erro("Erro ao alterar a maquina, O nome <strong>".$nome."</strong> já exite.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na atualização de maquina. Tentar novamente.");
        }           
    }
    
    //Remove maquina
    public function removeMaquina(){
        try {
            $id; $url;
            $this->recuperaRemover($id, $url);
            //verifica se existe
            if ($this->maquina->existe($id)){
                //remove 
                $this->maquina->removerMaquina($id);
                //Log
                $this->gravaLog("removeu maquina", "maquina removida id: ".$id);
                $this->mensagem("Maquina removida.", $url);
            }else {
                //Log
                $this->gravaLog("erro remover maquina", "tentativa de remover maquina id: ".$id);
                $this->erro("Não existe está maquina.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na atualização de maquina. Tentar novamente.");
        }
    }
    
    //Buscar maquina
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //Bucar
            $resultado = $this->maquina->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na atualização de maquina. Tentar novamente.");
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
    
    /*---------------Funções internas------------*/ 
    
    //Recupera dados de criar maquina
    private function recuperaCriar(&$nome, &$ip, &$login, &$descricao, &$local, &$tipo, &$url){
        $nome = strtoupper(trim($this->input->post("iptCriNome")));
        $ip = trim($this->input->post("iptCriIp"));
        $login = strtolower(trim($this->input->post("iptCriUser")));
        $descricao = trim($this->input->post("iptCriDesc"));
        $local = trim($this->input->post("selCriLocal"));
        $tipo = trim($this->input->post("selCriTipo"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "maquina";
        }
    }
    
    //Recupera dados de editar maquina
    private function recuperaEditar(&$id, &$nome, &$ip, &$login, &$descricao, &$local, &$tipo, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $nome = strtoupper(trim($this->input->post("iptEdtNome")));
        $ip = trim($this->input->post("iptEdtIp"));
        $login = strtolower(trim($this->input->post("iptEdtUser")));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $local = trim($this->input->post("selEdtLocal"));
        $tipo = trim($this->input->post("selEdtTipo"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "maquina";
        }
    }
    
    //Recupera dados de busca maquina
    private function recuperaBusca(&$texto){
        $texto = strtolower(trim($this->input->post("iptBusca")));
    }
    
    //Recupera dados de remover maquina
    private function recuperaRemover(&$id, &$url){
        $id = $this->input->post("iptRmvId");
        $url = trim($this->input->post("iptRmvUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "maquina";
        }
    }

    //Paginação usuariao, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(2)){
            return $this->uri->segment(2);
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
            if ($this->session->userdata('nivel') == '2'){
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Maquina.php");
                redirect(base_url());
            } else {
                //acesso permitido
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Maquina.php");
            redirect(base_url());
        }
    }
}
