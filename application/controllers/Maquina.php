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
        $this->load->model('Maquina_model', 'maquina');
        $this->load->model('Tipo_model', 'tipo');
        $this->load->model('Local_model', 'local');
        $this->load->model('Unidade_model', 'unidade');
        $this->load->model("Software_model", "software");
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
        $this->load->view('maquinas/maquinas', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "tipo" => new Tipo_model(),
            "unidade" => new Unidade_model(),
            "software" => new Software_model(),
            "mPicPampulha" => $this->ordenaPorIP($this->maquina->buscaTodasPorUnidade(1)),
            "mPicCidade" => $this->ordenaPorIP($this->maquina->buscaTodasPorUnidade(2)),
            //"maquinas" => $this->maquina->buscaTodas(6, $this->recuperaOffset()),
            //"maquinas" => $this->maquina->buscaTodas(),
            "paginas" => NULL));
            //"paginas" => $this->listarMaquinas()));
        //Modal
        $this->load->view('maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/visualizar-inventario', array(
            "assetsUrl" => base_url("assets")));
        $this->load->view('maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/livre-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
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
            "arquivoJS" => "maquina.js"));
    }
    
    //Resultado da busca
    public function resultado($mPicPampulha, $mPicCidade, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));   
        //Carrega
        $this->load->view('maquinas/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),            
            "tipo" => new Tipo_model(),
            "unidade" => new Unidade_model(),
            "software" => new Software_model(),
            "palavra" => $texto,
            "mPicPampulha" => $this->ordenaPorIP($mPicPampulha),
            "mPicCidade" => $this->ordenaPorIP($mPicCidade)));
        //Modal
        $this->load->view('maquinas/criar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/visualizar-inventario', array(
            "assetsUrl" => base_url("assets")));
        $this->load->view('maquinas/editar-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
            "tipos" => $this->tipo->todosTipos()));
        $this->load->view('maquinas/livre-maquinas', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais(),
            "unidades" => $this->unidade->todasUnidades(),
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
            $nome; $ip; $login; $descricao; $local; $tipo; $unidade; $url;
            //recupera dados
            $this->recuperaCriar($nome, $ip, $login, $descricao, $local, $tipo, $unidade, $url);
            //verifica dados
            if (!$this->maquina->existeMaquina($nome)){
                //cria maquina newMaquina($nome, $ip, $idlocal, $idtipo, $login = NULL, $descricao = NULL)
                //$this->maquina->newMaquina($nome, $ip, $this->geraLocal($local), $this->geraTipo($tipo), $login, $descricao);
                //$this->maquina->addMaquina();
                //criaMaquina($ip, $nome, $login, $descricao, $idlocal, $idtipo, $idunidade)
                $this->maquina->criaMaquina($ip, $nome, $login, $descricao, $this->geraLocal($local), $this->geraTipo($tipo), $this->geraUnidade($unidade));
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
            $id; $nome; $ip; $login; $descricao; $local; $tipo; $unidade; $url;
            //Recuperando dados
            $this->recuperaEditar($id, $nome, $ip, $login, $descricao, $local, $tipo, $unidade, $url);
            //verifica dados
            if (!$this->maquina->verificaMaquinaAtualiza($id, $nome)){
                //atualiza  atualizaMaquina($id, $nome, $login, $descricao, $sistema, $idlocal, $idtipo, $idunidade)
                $this->maquina->atualizaMaquina($id, $nome, $login, $descricao, $this->maquina->buscaMaquinaId($id)->getSistema(), $this->geraLocal($local), $this->geraTipo($tipo), $this->geraUnidade($unidade));
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
                //busca maquina
                $maquina = $this->maquina->buscaMaquinaId($id);
                //remove 
                $this->maquina->removerMaquina($id);
                //Log
                $this->gravaLog("removeu maquina", "maquina removida id: ".$id.". nome: ".$maquina->getNome().". ip: ".$maquina->getIp());
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
    
    //Remove maquina
    public function livreMaquina(){
        try {
            $id; $url;
            $this->recuperaLivre($id, $url);
            //verifica se existe
            if ($this->maquina->existe($id)){
                //busca maquina
                $maquina = $this->maquina->buscaMaquinaId($id);
                //liberar LiberaMaquina($id, $idlocal, $idtipo)
                $this->maquina->LiberaMaquina($id, 1, $this->geraTipo("Livre"));
                //Log
                $this->gravaLog("Liberou maquina", "maquina liberada id: ".$id.". nome: ".$maquina->getNome().". ip: ".$maquina->getIp());
                $this->mensagem("Maquina liberada.", $url);
            }else {
                //Log
                $this->gravaLog("erro liberar maquina", "tentativa de liberar maquina id: ".$id);
                $this->erro("Não existe está maquina.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na liberação de maquina. Tentar novamente.");
        }
    }
    
    //Buscar maquina
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
            if (empty($texto)){
                //recupera o terceiro seguimento da url ocorrencia/buscar/XXXXXX
                $texto = urldecode(strtoupper(trim($this->uri->segment(3))));
            } else {
                redirect(base_url("maquina/buscar/".urlencode($texto)));
            }
            //Bucar buscaPorUnidade($unidade, $texto)
            $mPicPampulha = $this->maquina->buscaPorUnidade(1, $texto);
            $mPicCidade = $this->maquina->buscaPorUnidade(2, $texto);
            $this->resultado($mPicPampulha, $mPicCidade, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na atualização de maquina. Tentar novamente.");
        }
    }
    
    //Buscar maquina
    public function buscarAntigo(){
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
            $unidade = $this->unidade->buscaId($maquina->getIdunidade());
            $mgs = array(
                "idmaquina" => $maquina->getIdmaquina(),
                "nome" => $maquina->getNome(),
                "ip" => $maquina->getIp(),
                "login" =>$maquina->getLogin(),
                "descricao" => $maquina->getDescricao(),
                "local" => $local->getNome(),
                "tipo" => $tipo->getNome(),
                "unidade" => $unidade->getNome()
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
    
    //Liberar ajax
    public function liberarMaquina(){
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
    
    //Remover ajax
    public function verificaNome(){
        //Recupera nome
        $nome = trim($this->input->get_post("iptCriNome"));
        
        if (!$this->maquina->existeMaquina($nome)){
            echo json_encode(TRUE); //não existe
        } else {
            echo json_encode(FALSE); //existe
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //verifica ip ajax
    public function verificaIP(){
        //Recupera ip
        $ip = trim($this->input->get_post("iptCriIp"));
        
        if ($this->maquina->verificaMaquinaLivre($ip)){
            echo json_encode(TRUE); //maquina livre
        } else {
            echo json_encode(FALSE); //maquina ocupada
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function verificaNomeEditar(){
        //Recupera nome
        $id = trim($this->input->post("id"));
        $nome = trim($this->input->post("nome"));
        
        if (!$this->maquina->verificaMaquinaAtualiza($id, $nome)){
            echo json_encode(TRUE); //não existe
        } else {
            echo json_encode(FALSE); //existe
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Pegar novo ip ajax
    public function novoIp(){        
        $maquina = $this->maquina->buscaNovoIp();
        
        if (isset($maquina)){
            $mgs = array(
                "ip" => $maquina->getIp()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Não existe mais IP disponivel"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Visualizar inventario ajax
    public function visualizarInventario(){
        //Recupera Id maquina
        $id = $this->input->post("idmaquina");
        $maquina = $this->maquina->buscaMaquinaId($id);
        $programas = $this->software->todosPorIdMaquina($id);
        
        if (isset($maquina)){
            $mgs = array(
                "nome" => $maquina->getNome(),
                "sistema" => $maquina->getSistema(),
                "programas" => $programas
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
    private function recuperaCriar(&$nome, &$ip, &$login, &$descricao, &$local, &$tipo, &$unidade, &$url){
        $nome = strtoupper(trim($this->input->post("iptCriNome")));
        $ip = trim($this->input->post("iptCriIp"));
        $login = strtolower(trim($this->input->post("iptCriUser")));
        $descricao = trim($this->input->post("iptCriDesc"));
        $local = trim($this->input->post("selCriLocal"));
        $tipo = trim($this->input->post("selCriTipo"));
        $unidade = trim($this->input->post("selCriUnidade"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "maquina";
        }
    }
    
    //Recupera dados de editar maquina
    private function recuperaEditar(&$id, &$nome, &$ip, &$login, &$descricao, &$local, &$tipo, &$unidade, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $nome = strtoupper(trim($this->input->post("iptEdtNome")));
        $ip = trim($this->input->post("iptEdtIp"));
        $login = strtolower(trim($this->input->post("iptEdtUser")));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $local = trim($this->input->post("selEdtLocal"));
        $tipo = trim($this->input->post("selEdtTipo"));
        $unidade = trim($this->input->post("selEdtUnidade"));
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
    
    //Recupera dados de remover maquina
    private function recuperaLivre(&$id, &$url){
        $id = $this->input->post("iptLvrId");
        $url = trim($this->input->post("iptLvrUrl"));
        
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
    
    //busca unidade
    private function geraUnidade($unidade){
        return $this->unidade->buscaPorNome($unidade)->getIdunidade();
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
                $this->gravaLog("tentativa de acesso sem permissao", "acesso ao controlador Maquina.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Maquina.php");
            redirect(base_url());
        }
    }
    
    //Ordena a lista de objetos por id crescente
    private function ordenaPorIP($lista){
        //verifica se lista vazia
        if (isset($lista)){
            //Ordena um array pelos valores utilizando uma função de comparação definida pelo usuário
            usort($lista, function ($a, $b){
                //Comparação de strings usando o algoritmo "natural order"
                return strnatcmp($a->getIp(), $b->getIp());
            });
            return $lista;
        } else {
            return $lista;
        }
    }
}
