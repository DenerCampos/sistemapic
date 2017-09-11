<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiscal extends CI_Controller {

    /**
     * Fiscal.
     * @descripition Visualização das impressoras fiscais no PIC Pampulha
     * @author Dener Junio
     * 
     */

    /*----------------Construtor------------*/
    
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('impressora_fiscal_model', 'fiscal');
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
        $this->load->view('fiscal/fiscal', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "lista" => $this->fiscal->todos(6, $this->recuperaOffset()),
            "paginas" => $this->listar()));
        //Modal
        $this->load->view('fiscal/criar-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('fiscal/editar-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('fiscal/remover-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "fiscal.js"));
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
            "arquivoJS" => "fiscal.js"));
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
            "arquivoJS" => "fiscal.js"));
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
        $this->load->view('fiscal/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
        $this->load->view('fiscal/criar-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('fiscal/editar-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('fiscal/remover-fiscal', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "fiscal.js"));
    }
    
    /*----------------Funções---------------*/
    
    //Paginação
    public function listar(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('fiscal'),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 2,
            "total_rows" => $this->fiscal->contarTodos(),
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
            $caixa; $modelo; $serial; $descricao; $local; $url;
            //recupera dados
            $this->recuperaCriar($caixa, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->fiscal->existe($serial)){
                //cria novo($modelo, $serial, $descricao, $caixa, $local)
                $this->fiscal->novo($modelo, $serial, $descricao, $caixa, $this->geraLocal($local));
                $this->fiscal->adiciona();
                //Log
                $this->gravaLog("criação impressora fiscal", "impressora fiscal criado: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("Impressora fiscal <strong>".$caixa."</strong> criada.", $url);
            }else{
                //Log
                $this->gravaLog("erro criação impressora fiscal", "tentativa de criar impressora fiscal: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O serial <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de impressora fiscal. Tentar novamente.");
        }  
    }
    
    //Atualizar
    public function atualizar(){
        try {
            $id; $caixa; $modelo; $serial; $descricao; $local; $url;
            //Recuperando dados
            $this->recuperaEditar($id, $caixa, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->fiscal->existeAtualiza($id, $serial)){
                //atualiza  atualiza($id, $modelo, $serial, $descricao, $caixa, $local)
                $this->fiscal->atualiza($id, $modelo, $serial, $descricao, $caixa, $this->geraLocal($local));
                //Log
                $this->gravaLog("alteração impressora fiscal", "impressora fiscal alterado: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("Alteração salva.", $url);
            }else{
                //Log
                $this->gravaLog("erro alteração impressora fiscal", "tentativa de alterar impressora fiscal: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O serial <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na alteração de impressora fiscal. Tentar novamente.");
        }           
    }
    
    //Remove maquina
    public function remove(){ 
        try {
            $id; $url;
            $this->recuperaRemover($id, $url);
            //verifica se existe
            if ($this->fiscal->existeId($id)){
                //busca pos
                $fiscal = $this->fiscal->buscaId($id);
                //remove 
                $this->fiscal->remove($id);
                //Log
                $this->gravaLog("removeu impressora fiscal", "impressora fiscal: id:".$id." Modelo: ".$fiscal->getModelo()." Serial: ".$fiscal->getSerial()." Usuario: ". $this->session->userdata("id"));
                $this->mensagem("Impressora Fiscal <strong>".$fiscal->getModelo()."</strong> removido.", $url);
            }else {
                //Log
                $this->gravaLog("erro remover impressora", "tentativa de remover pos id: ".$id);
                $this->erro("Não existe esta impressora fiscal.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao remover pos. Tente novamente.");
        }
    }
    
    //Buscar maquina
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //Bucar
            $resultado = $this->fiscal->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca por impressora fiscal. Tente novamente.");
        }
    }


    /*----------------Funções AJAX---------------*/
    
    //Editar ajax
    public function editarFiscal(){
        //Recupera Id
        $id = $this->input->post("idimpressora_fiscal");
        $equipamento = $this->fiscal->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idimpressorafiscal" => $equipamento->getIdimpressora_fiscal(),
                "caixa" => $equipamento->getCaixa(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Impressora fiscal não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerFiscal(){
        //Recupera Id
        $id = $this->input->post("idimpressora_fiscal");
        $equipamento = $this->fiscal->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idimpressorafiscal" => $equipamento->getIdimpressora_fiscal(),
                "caixa" => $equipamento->getCaixa(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "POS não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Verifica se existe o serial cadastrado
    public function verificaSerial(){
        $serial = trim($this->input->get_post("iptCriSerial"));
        //verifica se existe
        if (!$this->fiscal->existe($serial)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
            exit();
    }
    
    //Verifica se existe o serial cadastrado
    public function verificaSerialAtualiza(){
        $id = trim($this->input->post("id"));
        $serial = trim($this->input->post("serial"));        
        //verifica se existe
        if (!$this->fiscal->existeAtualiza($id, $serial)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
            exit();
    }


    /*---------------Funções internas------------*/ 
    
    //Recupera dados de criar
    private function recuperaCriar(&$caixa, &$modelo, &$serial, &$descricao, &$local, &$url){
        $caixa = trim($this->input->post("iptCriNome"));
        $modelo = trim($this->input->post("iptCriModelo"));
        $serial = trim($this->input->post("iptCriSerial"));
        $descricao = trim($this->input->post("iptCriDesc"));
        $local = trim($this->input->post("selCriLocal"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "fiscal";
        }
    }
    
    //Recupera dados de editar
    private function recuperaEditar(&$id, &$caixa, &$modelo, &$serial, &$descricao, &$local, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $caixa = trim($this->input->post("iptEdtNome"));
        $modelo = trim($this->input->post("iptEdtModelo"));
        $serial = trim($this->input->post("iptEdtSerial"));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $local = trim($this->input->post("selEdtLocal"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "fiscal";
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
            $url = "fiscal";
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
    
    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getEquipamento() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso sem permissao", "acesso ao controlador Fiscal.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Fiscal.php");
            redirect(base_url());
        }
    }
}
