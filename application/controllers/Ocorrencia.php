<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia extends CI_Controller {

    /**
     * Ocorrencia.
     * @descripition Manupulação das ocorrencias do help-desk 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel
        $this->verificaNivel();
        //carregamento modelo
        $this->load->model("Unidade_model", "unidade");
        $this->load->model("Area_model", "area");
        $this->load->model("Comentario_model", "comentario");
        $this->load->model("Local_model", "local");
        $this->load->model("Problema_model", "problema");
        $this->load->model("Setor_model", "setor");
        $this->load->model("Usuario_model", "usuario");
        $this->load->model("Ocorrencia_model", "ocorrencia");
        $this->load->model("Ocorrencia_estado_model", "estado");
        $this->load->model("Arquivo_model", "arquivo");
    }    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "helpdesk"));      
        //Carrega index
        if ($this->session->userdata("nivel") == "0"){
            $this->load->view('helpdesk/home-admin', array(
                "assetsUrl" => base_url("assets"),
                "abertas" => $this->ocorrencia->todasPorEstado(1),
                "atendimentos" => $this->ocorrencia->todasPorEstado(2),
                "fechadas" => $this->ocorrencia->todasPorEstado(3),
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrencia()));
        } elseif ($this->session->userdata("nivel") == "1") {
            $this->load->view('helpdesk/home-tecn', array(
                "assetsUrl" => base_url("assets"),
                "abertas" => $this->ocorrencia->todasAbertoPorArea($this->session->userdata("area")),
                "atendimentos" => $this->ocorrencia->todasAtendimentoPorArea($this->session->userdata("id")),
                "fechadas" => $this->ocorrencia->todasFechadosPorArea($this->session->userdata("id")),
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrencia()));
        } else {
            $this->load->view('helpdesk/home-user', array(
                "assetsUrl" => base_url("assets"),
                "abertas" => $this->ocorrencia->todasPorUsuario(1, $this->session->userdata("id")),
                "atendimentos" => $this->ocorrencia->todasPorUsuario(2, $this->session->userdata("id")),
                "fechadas" => $this->ocorrencia->todasPorUsuario(3, $this->session->userdata("id")),
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrencia()));
        }
        //Modal
        if ($this->session->userdata("nivel") != "2"){
            $this->load->view("helpdesk/atender-chamado", array( 
                "assetsUrl" => base_url("assets")));
            $this->load->view("helpdesk/encaminhar-chamado", array( 
                "assetsUrl" => base_url("assets"),
                "tecnicos" => $this->usuario->todosTecnicos()));
            $this->load->view("helpdesk/remover-chamado", array( 
                "assetsUrl" => base_url("assets")));
            $this->load->view("helpdesk/fechar-chamado", array( 
                "assetsUrl" => base_url("assets"),
                "unidades" => $this->unidade->todasUnidades(),
                "areas" => $this->area->todasAreas(),
                "locais" => $this->local->todosLocais(),
                "problemas" => $this->problema->todosProblemas(),
                "setores" => $this->setor->todosSetores()));
        }
        $this->load->view("helpdesk/imprimir-chamado", array( 
            "assetsUrl" => base_url("assets")));        
        $this->load->view("helpdesk/visualizar-chamado", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view("helpdesk/editar-chamado", array( 
                "assetsUrl" => base_url("assets"),
                "unidades" => $this->unidade->todasUnidades(),
                "areas" => $this->area->todasAreas(),
                "locais" => $this->local->todosLocais(),
                "problemas" => $this->problema->todosProblemas(),
                "setores" => $this->setor->todosSetores()));
        $this->load->view("helpdesk/criar-chamado", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Resultado
    public function resultado($palavra, $numeros = NULL, $problemas = NULL, $descricao = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "helpdesk"));      
        //Carrega index
        $this->load->view('helpdesk/resultado', array(
            "palavra" => $palavra,
            "numeros" => $numeros,
            "problemas" => $problemas,
            "descricao" => $descricao,
            "problema" => new Problema_model(),
            "estado" => new Ocorrencia_estado_model()
        ));
        $this->load->view("helpdesk/criar-chamado", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view("helpdesk/imprimir-chamado", array( 
            "assetsUrl" => base_url("assets")));        
        $this->load->view("helpdesk/visualizar-chamado", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view("helpdesk/remover-chamado", array( 
                "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }

    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => $msg));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Mensagem de erro
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
            "uri" => $uri));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    /*------Funções internas--------*/ 
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
    
    //Paginação
    public function listarOcorrencia(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('ocorrencia'),
            "per_page" => 10,
            "num_links" => 2,
            "uri_segment" => 2,
            "total_rows" => $this->ocorrencia->contarTodos(),
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
        if ($this->uri->segment(2)){
            return $this->uri->segment(2);
        } else{
            return 0;
        }
    }
    
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') == '3'){
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Ocorrencia.php");
                redirect(base_url());
            } else {
                //acesso permitido
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Ocorrencia.php");
            redirect(base_url());
        }
    }
    
    //gera unidade
    private function geraUnidade($nome){
        return $this->unidade->buscaPorNome($nome)->getIdunidade();
    }
    
    //gera setor
    private function geraSetor($nome){
        return $this->setor->buscaPorNome($nome)->getIdsetor();
    }
    
    //gera problema
    private function geraProblema($nome){
        return $this->problema->buscaPorNome($nome)->getIdproblema();
    }
    
    //gera area
    private function geraArea($nome){
        return $this->area->buscaPorNome($nome)->getIdarea();
    }
    
    //gera usuario
    private function geraUsuario($nome){
        return $this->usuario->buscaUsuarioNome($nome)->getIdusuario();
    }

    //Recupera dados da nova ocorrencia
    private function recuperaDadosNovaOcorrencia(&$unidade, &$setor, &$problema, &$area, &$usuario, &$vnc, &$ramal, &$descricao){
        $unidade = $this->input->post("selCriUnidade");
        $setor = $this->input->post("selCriSetor");
        $problema = $this->input->post("selCriProblema");
        $area = $this->input->post("selCriArea");
        $usuario = $this->input->post("iptCriUsuario");
        $vnc = $this->input->post("iptCriVnc");
        $ramal = $this->input->post("iptCriRamal");
        $descricao = $this->input->post("iptCriDesc");
        
        //pegar unidade
        if (isset($unidade)){
            $unidade = $this->geraUnidade($unidade);
        }
        //pegar setor
        if (isset($setor)){
            $setor = $this->geraSetor($setor);
        }
        //pegar problema
        if (isset($problema)){
            $problema = $this->geraProblema($problema);
        }
        //pegar area
        if (isset($area)){
            $area = $this->geraArea($area);
        }
        //primeira letra maiuscula
        if (isset($usuario)){
            $usuario = ucfirst(strtolower($usuario));
        }
    }
    
    //Recupera dados da nova ocorrencia
    private function recuperaDadosEditaOcorrencia(&$unidade, &$setor, &$problema, &$area, &$usuario, &$vnc, &$ramal){
        $unidade = $this->input->post("selEdtUnidade");
        $setor = $this->input->post("selEdtSetor");
        $problema = $this->input->post("selEdtProblema");
        $area = $this->input->post("selEdtArea");
        $usuario = $this->input->post("iptEdtUsuario");
        $vnc = $this->input->post("iptEdtVnc");
        $ramal = $this->input->post("iptEdtRamal");
        $descricao = $this->input->post("iptEdtDesc");
        
        //pegar unidade
        if (isset($unidade)){
            $unidade = $this->geraUnidade($unidade);
        }
        //pegar setor
        if (isset($setor)){
            $setor = $this->geraSetor($setor);
        }
        //pegar problema
        if (isset($problema)){
            $problema = $this->geraProblema($problema);
        }
        //pegar area
        if (isset($area)){
            $area = $this->geraArea($area);
        }
        //primeira letra maiuscula
        if (isset($usuario)){
            $usuario = ucfirst(strtolower($usuario));
        }
    }
    
    //Cria nova ocorrencia
    public function novaOcorrencia(){
        $unidade; $setor; $problema; $area; $usuario; $vnc; $ramal; $descricao;
        try {
            //recuperda dados
            $this->recuperaDadosNovaOcorrencia($unidade, $setor, $problema, $area, $usuario, $vnc, $ramal, $descricao);
            //gera ocorrencia //data abertura
            $data = date('Y-m-d H:i:s');
            $this->ocorrencia->newOcorrencia($descricao, $vnc, $ramal, $data, $usuario, 
                    $this->session->userdata("id"), $unidade, $area, $setor, $problema, 1);
            //inseri no bd
            $id = $this->ocorrencia->addOcorrencia();
            //salva anexos
            foreach ($_FILES as $key => $value) {
                if ($this->salvaAnexo($key, $id)){
                    //Log
                    $this->gravaLog("anexo chamado", "usuario: ".$this->session->userdata("id")."Nome original: ".$value["name"]);  
                }
            }
            //log
            $this->gravaLog("chamado aberto", "usuario: ".$this->session->userdata("nome")." - chamado: ".$this->ocorrencia->recuperaUltima($this->session->userdata("id"))->getIdocorrencia());
            //mensagem
            $this->mensagem("Chamado ".$id." aberto!", "ocorrencia");
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação do chamado. Tentar novamente.");
        }        
    }
    
    //Salva anexo no servidor
    private function salvaAnexo($nome, $idchamado){
        if ($_FILES[$nome]['error'] == 0){
            //inicia biblioteca do codeigniter
            $this->load->library('upload');
            //configuração
            $config = array(
                'upload_path' => './document/helpdesk/',
                'allowed_types' => 'gif|jpg|png',
                'file_name' => uniqid(md5($idchamado))
            );
            //inicializa
            $this->upload->initialize($config);
            //salvar e verifica erro
            if ($this->upload->do_upload($nome)){
                //salva no bd newArquivo($nome, $local, $nome_antigo, $idocorrencia)
                $arquivo = $this->upload->data();
                $local = 'document/helpdesk/';
                $this->arquivo->newArquivo($arquivo["file_name"], $local, $arquivo["client_name"], $idchamado);
                $this->arquivo->addArquivo();
                return TRUE;
            } else {
                //Log erro foto
                $this->gravaLog("erro anexo chamado", "usuario: ".$this->session->userdata("id")."Erro: ".$this->upload->display_errors());
                return FALSE;
            }
        }
        //Não existe arquivo
        return TRUE;
    }
    
    //Atender ocorrencia
    public function atender(){
        //recupera id
        $id = trim($this->input->post("iptAtdId"));
        try {
            //verifica se existe e esta em aberto
            if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->aberto($id)){
                //atende ocorrencia
                $this->ocorrencia->atende($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 2);
                //log
                $this->gravaLog("chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                redirect("ocorrencia");
            }else{
                //log
                $this->gravaLog("erro chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                $this->erro("Chamado ".$id." não está em aberto no sistema.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao atender o chamado. Favor tentar novamente.");
        }  
    }
    
    //encaminhar ocorrencia
    public function encaminhar(){
        //recupera id
        $id = trim($this->input->post("iptEncId"));
        $usuario = trim($this->input->post("selEncTecnico"));
        $comentario = trim($this->input->post("iptEncComentario"));
        try {
            //verifica se existe e esta em atendimento
             if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->atendimento($id)){
                if (!isset($comentario) || $comentario == ""){
                    $comentario = $this->session->userdata("nome")." encaminhou o chamado ".$id." para o ".$usuario.".";
                }
                //adiciona comentario
                $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                $this->comentario->addComentario();
                //encaminha ocorrencia encaminha($id, $usuario, $dalteracao)
                $this->ocorrencia->encaminha($id, $this->geraUsuario($usuario), date('Y-m-d H:i:s'));
                //log
                $this->gravaLog("chamado emcaminhado", "nome: ".$this->session->userdata("nome")." - chamado: ".$id." para o usuario: ".$usuario);
                redirect("ocorrencia");
            }else{
                //log
                $this->gravaLog("erro chamado emcaminhado", "nome: ".$this->session->userdata("nome")." - chamado: ".$id." para o usuario: ".$usuario);
                $this->erro("Chamado ".$id." não está em atendimento no sistema.");
            }
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao encaminhar chamado. Favor tentar novamente.");
        }
    }
    
    //Gerar comentarios das ocorrencias
    private function gerarComentarios($id){
        //busca todos comentarios da ocorrencia
        $comentarios = $this->comentario->buscaIdOcorrencia($id);
        //verifica se existe comentarios
        if (isset($comentarios)){
            $coments = array();
            foreach ($comentarios as $comentario) {
                $coments[] = date("d/m - H:m", strtotime($comentario->getData())).
                    " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                    ": ".
                    $comentario->getDescricao().
                    "\n";
            }
            return $coments;
        } else {
            return NULL;
        }
    }
    
    //Gera arquivos das ocorrencias
    private function geraArquivos($id){
        //busca todos arquivos
        $arquivos = $this->arquivo->buscaOcorrencia($id);
        //verifica se existe arquivos
        if (isset($arquivos)){
            foreach ($arquivos as $value) {
                $arquivo[] = base_url($value->getLocal().$value->getNome()); 
            }
            return $arquivo;
        } else {
            return NULL;
        }
    }

    //Imprimir ocorrencia
    public function imprimir(){
        //carregando a biblioteca
        $this->load->library('pdf');
        //recupera id
        $id = trim($this->input->post("iptImpId"));
        try {          
            $paginas = $this->load->view("helpdesk/impressao-chamado", array( 
                "assetsUrl" => base_url("assets"),
                "chamado" => $this->ocorrencia->buscaId($id),
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "comentario" => $this->gerarComentarios($id),
                "solucao" => $this->comentario->buscaSolucao($id),
                "anexos" =>  $this->geraArquivos($id),
                "estado" => new Ocorrencia_estado_model()), TRUE);
            $css = file_get_contents(base_url('assets/css/sistemapic.impressao.css')); 
            //gera pdf
            $this->pdf->geraPdf($paginas, $css);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao imprimir chamado. Favor tentar novamente.");
        }        
}
    
    //Remover ocorrencia
    public function remover(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        //verifica se existe
        if ($this->ocorrencia->verificaExiste($id)){
            //remover ocorrencia
            $this->ocorrencia->remove($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 2);
            //log
            $this->gravaLog("chamado removido", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
        }else{
            //erro
            //log
            $this->gravaLog("erro chamado removido", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
        }
        redirect("ocorrencia");
    }

    //Atender ocorrencia ajax
    public function atenderChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        
        if (isset($chamado)){
            $mgs = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "nome" => $chamado->getUsuario(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Imprimir ocorrencia ajax
    public function imprimirChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        
        if (isset($chamado)){
            $mgs = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "nome" => $chamado->getUsuario(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Visualizar ocorrencia ajax
    public function visualizarChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        $comentarios = $this->comentario->buscaIdOcorrencia($id);
        $arquivos = $this->arquivo->buscaOcorrencia($id);
        
        if (isset($chamado)){
            $msg = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "unidade" => $this->unidade->buscaId($chamado->getIdunidade())->getNome(),
                "setor" => $this->setor->buscaId($chamado->getIdsetor())->getNome(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome(),
                "area" => $this->area->buscaId($chamado->getIdarea())->getNome(),
                "nome" => $chamado->getUsuario(),
                "vnc" => $chamado->getVnc(),
                "ramal" => $chamado->getRamal(),
                "descricao" => $chamado->getDescricao()
            );
            if (isset($comentarios)){
                $coments = array();
                foreach ($comentarios as $comentario) {
                    $coments[] = date("d/m - H:m", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": ".
                        $comentario->getDescricao().
                        "\n";
                }
                $msg["comentarios"] = $coments;
            }
            if (isset($arquivos)){
                foreach ($arquivos as $value) {
                    $arquivo[] = base_url($value->getLocal().$value->getNome()); 
                }
                $msg["arquivos"] = $arquivo;
            }
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Encaminhar ocorrencia ajax
    public function encaminharChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        
        if (isset($chamado)){
            $msg = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "nome" => $chamado->getUsuario(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome(),
                "tecnico" => $this->usuario->buscaId($chamado->getUsuario_atende())->getNome()
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ocorrencia ajax
    public function removerChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        
        if (isset($chamado)){
            $msg = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "nome" => $chamado->getUsuario(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome()
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Editar ocorrencia ajax
    public function editarChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
        $chamado = $this->ocorrencia->buscaId($id);
        $comentarios = $this->comentario->buscaIdOcorrencia($id);
        $arquivos = $this->arquivo->buscaOcorrencia($id);
        
        if (isset($chamado)){
            $msg = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "unidade" => $this->unidade->buscaId($chamado->getIdunidade())->getNome(),
                "setor" => $this->setor->buscaId($chamado->getIdsetor())->getNome(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome(),
                "area" => $this->area->buscaId($chamado->getIdarea())->getNome(),
                "nome" => $chamado->getUsuario(),
                "vnc" => $chamado->getVnc(),
                "ramal" => $chamado->getRamal(),
                "descricao" => $chamado->getDescricao()
            );
            if (isset($comentarios)){
                $coments = array();
                foreach ($comentarios as $comentario) {
                    $coments[] = date("d/m - H:m", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": ".
                        $comentario->getDescricao().
                        "\n";
                }
                $msg["comentarios"] = $coments;
            }
            if (isset($arquivos)){
                foreach ($arquivos as $value) {
                    $arquivo[] = base_url($value->getLocal().$value->getNome()); 
                }
                $msg["arquivos"] = $arquivo;
            }
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //editar ocorrencia
    public function editar(){
        //recupera id
        $id = $this->input->post("iptEdtId");
        $unidade; $setor; $problema; $area; $usuario; $vnc; $ramal;
        //recuperda dados
        $this->recuperaDadosEditaOcorrencia($unidade, $setor, $problema, $area, $usuario, $vnc, $ramal);
        //recupera comentario
        $comentario = trim($this->input->post("iptEdtComentarioNovo"));
        try {
            //verifica se existe e se ocorrencia esta em atendimento
            if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->atendimento($id)){
                if ($comentario != ""){
                    //adiciona comentario
                    $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                    $this->comentario->addComentario();
                }
                //atualiza chamado
                $this->ocorrencia->atualiza($id, $vnc, $ramal, $usuario, date('Y-m-d H:i:s'), $unidade, $area, $setor, $problema);
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->mensagem("Chamado salvo.", "ocorrencia");
            }else{
                //log
                $this->gravaLog("erro comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("erro atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->erro("Chamado já foi fechado!");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar chamado. Favor tentar novamente.");
        }

    }
    
    //fechar ocorrencia ajax
    public function fecharChamado(){
        //Recupera Id 
        $id = trim($this->input->post("idocorrencia"));
        $chamado = $this->ocorrencia->buscaId($id);
        $comentarios = $this->comentario->buscaIdOcorrencia($id);

        if (isset($chamado)){
            $msg = array(
                "idocorrencia" => $chamado->getIdocorrencia(),
                "unidade" => $this->unidade->buscaId($chamado->getIdunidade())->getNome(),
                "setor" => $this->setor->buscaId($chamado->getIdsetor())->getNome(),
                "problema" => $this->problema->buscaId($chamado->getIdproblema())->getNome(),
                "area" => $this->area->buscaId($chamado->getIdarea())->getNome(),
                "nome" => $chamado->getUsuario(),
                "vnc" => $chamado->getVnc(),
                "ramal" => $chamado->getRamal(),
                "descricao" => $chamado->getDescricao()
            );
            if (isset($comentarios)){
                $coments = array();
                foreach ($comentarios as $comentario) {
                    $coments[] = date("d/m - H:m", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": ".
                        $comentario->getDescricao().
                        "\n";
                }
                $msg["comentarios"] = $coments;
            }
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Chamado não encontrado"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //fechar ocorrencia
    public function fechar(){
        //recupera id
        $id = trim($this->input->post("iptFchId"));
        //recupera comentario fechamento
        $comentario = trim($this->input->post("iptFchComentarioNovo"));
        try {
            //verifica se existe
            if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->atendimento($id)){
                if (isset($comentario) && $comentario == ""){
                    $comentario = "Chamado fechado sem descrição do fechamento por ".$this->session->userdata("nome");
                }
                //adiciona comentario
                $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                $this->comentario->addComentario();
                //fecha chamado
                $this->ocorrencia->fecha($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 3);
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("fechamento", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->mensagem("Chamado <strong>".$id."</strong> fechado!", "ocorrencia");
            }else{
                //log
                $this->gravaLog("erro fechamento", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->erro("Erro ao fechar o chamado <strong>".$id."</strong>.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao fechar chamado. Favor tentar novamente.");
        }
    }   
       
    //Busca por ocorrencia
    public function buscar(){
        //recupera dados da busca
        $busca = strtolower(trim($this->input->post("iptBusca")));
        try {
            //verifica se foi digitado algo
            //usuario todasPorBuscaNumero($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
            if (isset($busca) && $this->session->userdata("nivel") == 2){
                //busca por numero do chamado
                $numeros = $this->ocorrencia->todasPorBuscaNumero($busca, $this->session->userdata("id"));
                $this->resultado($busca, $numeros);
            } elseif (isset($busca)){
                //busca por numero do chamado todasPorBuscaNumero($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
                $numeros = $this->ocorrencia->todasPorBuscaNumero($busca);
                //busca por problema todasPorBuscaProblema($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
                $problemas = $this->ocorrencia->todasPorBuscaProblema($busca);
                //busca por descricao todasPorBuscaDescricao($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
                $descricao = $this->ocorrencia->todasPorBuscaDescricao($busca);
                //chamando a view
                $this->resultado($busca, $numeros, $problemas, $descricao);
            } else {
                $this->resultado("'vazio'");
            }                       
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca. Favor tentar novamente.");
        }
    }
}
