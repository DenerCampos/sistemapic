<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends CI_Controller {

    /**
     * Tutorial.
     * @descripition Intaladores de programas basicos para agilizar a procura dos mesmo na internet
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Tutorial_model", "tutorial");
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
        $this->load->view('tutorial/tutorial', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->tutorial->todos()));
        //Modal
        $this->load->view("tutorial/criar-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("tutorial/editar-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("tutorial/remover-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "tutorial.js"));
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
            "arquivoJS" => "tutorial.js"));
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
            "arquivoJS" => "tutorial.js"));
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
        $this->load->view('tutorial/resultado', array(
            "assetsUrl" => base_url("assets"),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
         $this->load->view("tutorial/criar-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("tutorial/editar-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("tutorial/remover-tutorial", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "tutorial.js"));
    }
    
    /*------------------Funções------------------*/   
    //Criar
    public function criar(){
        $nome; $descicao; $link;
        try {
            //recupera dados post e salva anexo
            $this->recuperaCriar($nome, $descicao, $link, $url);
            //verifica se existe a empresa
            if ($this->tutorial->verificaExiste($nome)){
                $this->erro("O tutorial <strong>".$nome."</strong> já está cadastrado no sistema.");
            }else{
                //salva programa novo($nome, $descricao, $link)
                $this->tutorial->novo($nome, $descicao, $link);
                $this->tutorial->adiciona();
                //log
                $this->gravaLog("novo tutorial", "empresa: ".$nome." por ".$this->session->userdata("id"));
                $this->mensagem("Tutorial <strong>".$nome."</strong> cadastrado.", $url);
            }

        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao adicionar novo programa. Tente novamente.");
        }
    }
    
    //Editar
    public function editar(){
        $id; $nome; $descricao; $link; $url;
        try {
            //recupera post
            $this->recuperaEditar($id, $nome, $descricao, $link, $url);
            //verifica se pode atualizar verificaExisteAtualiza($id, $empresa)
            if ($this->tutorial->verificaExisteAtualiza($id, $nome)){
                //existe contato com o mesmo nome
                $this->erro("A programa <strong>".$nome."</strong> já existe no cadastro, edita ou apague para poder cadastra-lo novamente.");
            } else {
                //atualiza atualiza($id, $nome, $descricao, $link)
                $this->tutorial->atualiza($id, $nome, $descricao, $link);
                //log
                $this->gravaLog("programa alterado", "nome: ".$nome." por ".$this->session->userdata("id"));
                $this->mensagem("Alteração concluida", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar programa. Tente novamente.");
        }
    }
    
    public function remover(){
        $id; $nome; $url;
        try {
            //recupera post
            $this->recuperaRemover($id, $nome, $url);
            //verifica se existe contato buscaId($id)
            if (!empty($this->tutorial->buscaId($id))){
                //remove anexo
                $this->excluiAnexo($this->tutorial->buscaId($id)->getLink());
                //remove remove($id)
                $this->tutorial->remove($id);
                //log
                $this->gravaLog("removido tutorial", "nome: ".$nome." por ".$this->session->userdata("id"));
                $this->mensagem("Utilitário <strong>".$nome."</strong> removido", $url);
            } else {
                //não existe id                
                $this->erro("O utulitário <strong>".$nome."</strong> não existe.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao remover utilitário. Tente novamente.");
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
                redirect(base_url("tutorial/buscar/".urlencode($texto)));
            }
            //Bucar
            $resultado = $this->tutorial->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca de utilitário. Tente novamente.");
        }
    }


    /*----------------Funções AJAX---------------*/
    //Editar ajax
    public function editarTutorial(){
        //Recupera Id
        $id = $this->input->post("idtutorial");
        $tutorial = $this->tutorial->buscaId($id);
        
        if (isset($tutorial)){
            $mgs = array(
                "idcontato" => $tutorial->getIdtutorial(),
                "nome" => $tutorial->getNome(),
                "descricao" => $tutorial->getDescricao(),
                "link" =>$tutorial->getLink()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Utilitário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerTutorial(){
        //Recupera Id
        $id = $this->input->post("idtutorial");
        $tutorial = $this->tutorial->buscaId($id);
        
        if (isset($tutorial)){
            $mgs = array(
                "idcontato" => $tutorial->getIdtutorial(),
                "nome" => $tutorial->getNome(),
                "descricao" => $tutorial->getDescricao(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Utilitário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //verificar se existe o contato no BD
    public function verificaExisteTutorial(){
        $nome = trim($this->input->post("nome"));   
        //verifica se existe
        if (!$this->tutorial->verificaExiste($nome)){
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
        $nome = trim($this->input->post("nome"));   
        //verifica se existe
        if (!$this->tutorial->verificaExisteAtualiza($id, $nome)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }


    /*------------Funções internas---------------*/ 
    //recupera criar
    private function recuperaCriar(&$nome, &$descricao, &$link, &$url){
        $nome = trim($this->input->post("iptCriNome"));
        $descricao = trim($this->input->post("iptCriDescricao"));
        $url = $this->input->post("iptCriUrl");
        
        //gerando link e salvando anexo
        if (!$this->salvaAnexo("iptCriAnexo", $link)){
            $link = 'Sem anexo';
        }
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "tutorial";
        }
    }
    
    //recupera editar
    private function recuperaEditar(&$id, &$nome, &$descricao, &$link, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $descricao = trim($this->input->post("iptEdtDescricao"));
        $link = $this->input->post("iptEdtLink");
        $url = $this->input->post("iptEdtUrl");
        
        //verificando se existe um novo anexo
        if ($_FILES["iptEdtAnexo"]['error'] == 0){
            $this->excluiAnexo($this->tutorial->buscaId($id)->getLink());
        }
        
        //gerando link e salvando anexo
        if ($_FILES["iptEdtAnexo"]['error'] == 0){
            if (!$this->salvaAnexo("iptEdtAnexo", $link)){
                $link = 'Erro ao anexar';
            }            
        }else {
            //$link = 'Não existe aquivo.';
        }              
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "tutorial";
        }
    }
    
    //recupera editar
    private function recuperaRemover(&$id, &$nome, &$url){
        $id = trim($this->input->post("iptRmvId"));        
        $nome = trim($this->input->post("iptRmvNome"));
        $url = $this->input->post("iptRmvUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "tutorial";
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
    
    //Salva anexo no servidor
    private function salvaAnexo($campo, &$link){
        if ($_FILES[$campo]['error'] == 0){
            //inicia biblioteca do codeigniter
            $this->load->library('upload');
            //Retira os acentos
            $nome = iconv('UTF-8', 'ASCII//TRANSLIT', $_FILES[$campo]['name']);
            //configuração
            $config = array(
                'upload_path' => './document/tutorial/',
                'allowed_types' => '*',
                'file_name' => $nome
            );
            //inicializa
            $this->upload->initialize($config);
            //verifica se existe o arquivo no diretorio
            if (!file_exists('document/tutorial/'.$nome)){
                //salvar e verifica erro
                if ($this->upload->do_upload($campo)){
                    //retorna o link
                    $arquivo = $this->upload->data();
                    $local = 'document/tutorial/'.$arquivo["file_name"];
                    $link = base_url($local);
                    return TRUE;
                } else {
                    //Log erro foto
                    $this->gravaLog("erro anexo tutorial", "usuario: ".$this->session->userdata("id")."Erro: ".$this->upload->display_errors());
                    return FALSE;
                }
            }else {
                //arquivo existe
                return FALSE;
            }            
        }
        //Não existe arquivo
        return FALSE;
    }
    
    //exclui anexos
    private function excluiAnexo($link){
        $caminho = "document/programas/";
        $file = explode("/", $link);
        $filename = end($file);
        if (file_exists($caminho.$filename)){
            unlink($caminho.$filename);
            return TRUE;
        }else {}
        return FALSE;
    }
}
