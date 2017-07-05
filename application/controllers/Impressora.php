<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressora extends CI_Controller {

    /**
     * Impressora.
     * @descripition Visualização das impressoras no PIC Pampulha
     * @author Dener Junio
     * 
     */

    /*----------------Construtor------------*/
    
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('impressora_model', 'impressora');
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
            "ativo" => "equipamento"));   
        //Carrega
        $this->load->view('impressora/impressora', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "lista" => $this->impressora->todos(6, $this->recuperaOffset()),
            "paginas" => $this->listar()));
        //Modal
        $this->load->view('impressora/criar-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('impressora/editar-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('impressora/remover-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "impressora.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));     
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
            "arquivoJS" => "impressora.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));     
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
            "arquivoJS" => "impressora.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));   
        //Carrega
        $this->load->view('impressora/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
        $this->load->view('impressora/criar-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('impressora/editar-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('impressora/remover-impressora', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "impressora.js"));
    }
    
    /*----------------Funções---------------*/
    
    //Paginação
    public function listar(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('impressora'),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 2,
            "total_rows" => $this->impressora->contarTodos(),
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
    
    //Criar
    public function criar(){
        try {
            $nome; $modelo; $serial; $descricao; $local; $url;
            //recupera dados
            $this->recuperaCriar($nome, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->impressora->existe($serial)){
                //cria novo($modelo, $serial, $nome, $descricao, $local)
                $this->impressora->novo($modelo, $serial, $nome, $descricao, $this->geraLocal($local));
                $this->impressora->adiciona();
                //Log
                $this->gravaLog("criação impressora", "impressora criada: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("PinPad <strong>".$modelo."</strong> criado.", $url);
            }else{
                //Log
                $this->gravaLog("erro criação impressora", "tentativa de criar impressora: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O nome <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de impressora. Tentar novamente.");
        }  
    }
    
    //Atualizar
    public function atualizar(){
        try {
            $id; $nome; $modelo; $serial; $descricao; $local; $url;
            //Recuperando dados
            $this->recuperaEditar($id, $nome, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->impressora->existeAtualiza($id, $serial)){
                //atualiza  atualiza($id, $modelo, $serial, $nome, $descricao, $local)
                $this->impressora->atualiza($id, $modelo, $serial, $nome, $descricao, $this->geraLocal($local));
                //Log
                $this->gravaLog("alteração impressora", "impressora alterado: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("Alteração salva.", $url);
            }else{
                //Log
                $this->gravaLog("erro alteração impressora", "tentativa de alterar impressora: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O nome <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na alteração de impressora. Tentar novamente.");
        }           
    }
    
    //Remove maquina
    public function remove(){ 
        try {
            $id; $url;
            $this->recuperaRemover($id, $url);
            //verifica se existe
            if ($this->impressora->existeId($id)){
                //busca impressora
                $impressora = $this->impressora->buscaId($id);
                //remove 
                $this->impressora->remove($id);
                //Log
                $this->gravaLog("removeu impressora", "pinpad: id:".$id." Nome: ".$impressora->getNome()." Serial: ".$impressora->getSerial()." Usuario: ". $this->session->userdata("id"));
                $this->mensagem("Impressora <strong>".$impressora->getNome()."</strong> removido.", $url);
            }else {
                //Log
                $this->gravaLog("erro remover impressora", "tentativa de remover impressora id: ".$id);
                $this->erro("Não existe este impressora.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao remover impressora. Tente novamente.");
        }
    }
    
    //Buscar maquina
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //Bucar
            $resultado = $this->impressora->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca por impressora. Tente novamente.");
        }
    }


    /*----------------Funções AJAX---------------*/
    
    //Editar ajax
    public function editarImpressora(){
        //Recupera Id
        $id = $this->input->post("idimpressora");
        $equipamento = $this->impressora->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idimpressora" => $equipamento->getIdimpressora(),
                "nome" => $equipamento->getNome(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Impressora não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerImpressora(){
        //Recupera Id
        $id = $this->input->post("idimpressora");
        $equipamento = $this->impressora->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idimpressora" => $equipamento->getIdimpressora(),
                "nome" => $equipamento->getNome(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Impressora não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    /*---------------Funções internas------------*/ 
    
    //Recupera dados de criar
    private function recuperaCriar(&$nome, &$modelo, &$serial, &$descricao, &$local, &$url){
        $nome = trim($this->input->post("iptCriNome"));
        $modelo = trim($this->input->post("iptCriModelo"));
        $serial = trim($this->input->post("iptCriSerial"));
        $descricao = trim($this->input->post("iptCriDesc"));
        $local = trim($this->input->post("selCriLocal"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "impressora";
        }
    }
    
    //Recupera dados de editar
    private function recuperaEditar(&$id, &$nome, &$modelo, &$serial, &$descricao, &$local, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $modelo = trim($this->input->post("iptEdtModelo"));
        $serial = trim($this->input->post("iptEdtSerial"));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $local = trim($this->input->post("selEdtLocal"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "impressora";
        }
    }
    
    //Recupera dados de busca maquina
    private function recuperaBusca(&$texto){
        $texto = strtolower(trim($this->input->post("iptBusca")));
    }
    
    //Recupera dados de remover maquina
    private function recuperaRemover(&$id, &$url){
        $id = trim($this->input->post("iptRmvId"));
        $url = trim($this->input->post("iptRmvUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "impressora";
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Impressora.php");
                redirect(base_url());
            } else {
                //acesso permitido
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Impressora.php");
            redirect(base_url());
        }
    }
}
