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
                "abertas" => $this->ocorrencia->todasPorEstado(1, 10, $this->recuperaOffset()),
                "atendimentos" => $this->ocorrencia->todasPorEstado(2, 10, $this->recuperaOffset()),
                "fechadas" => $this->ocorrencia->todasPorEstado(3, 10, $this->recuperaOffset()),
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
                "abertas" => $this->ocorrencia->todasPorArea(1, $this->session->userdata("area"), 10, $this->recuperaOffset(), 10, $this->recuperaOffset()),
                "atendimentos" => $this->ocorrencia->todasPorArea(2, $this->session->userdata("area"), $this->session->userdata("id"), 10, $this->recuperaOffset()),
                "fechadas" => $this->ocorrencia->todasPorArea(3, $this->session->userdata("area"), $this->session->userdata("id"), 10, $this->recuperaOffset()),
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
                "abertas" => $this->ocorrencia->todasPorUsuario(1, $this->session->userdata("id"), 10, $this->recuperaOffset()),
                "atendimentos" => $this->ocorrencia->todasPorUsuario(2, $this->session->userdata("id"), 10, $this->recuperaOffset()),
                "fechadas" => $this->ocorrencia->todasPorUsuario(3, $this->session->userdata("id"), 10, $this->recuperaOffset()),
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
            "msgerro" => 'teste de ero'));
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
            "msg" => 'teste de mensagem',
            "uri" => 'home'));
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
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Ocorrencia.php");
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
        //recuperda dados
        $this->recuperaDadosNovaOcorrencia($unidade, $setor, $problema, $area, $usuario, $vnc, $ramal, $descricao);
        //gera ocorrencia
        //data abertura
        $data = date('Y-m-d H:i:s');
        $this->ocorrencia->newOcorrencia($descricao, $vnc, $ramal, $data, $usuario, 
                $this->session->userdata("id"), $unidade, $area, $setor, $problema, 1);
        //inseri no bd
        $this->ocorrencia->addOcorrencia();
        //log
        $this->gravaLog("chamado aberto", "usuario: ".$this->session->userdata("nome")." - chamado: ".$this->ocorrencia->recuperaUltima($this->session->userdata("id"))->getIdocorrencia());
        //index
        redirect("ocorrencia");
    }
    
    //Atender ocorrencia
    public function atender(){
        //recupera id
        $id = $this->input->post("iptAtdId");
        //verifica se existe
        if ($this->ocorrencia->verificaExiste($id)){
            //atende ocorrencia
            $this->ocorrencia->atende($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 2);
            //log
            $this->gravaLog("chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
        }else{
            //erro
            //log
            $this->gravaLog("erro chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
        }
        redirect("ocorrencia");
    }
    
    //Imprimir ocorrencia
    public function imprimir(){
        //a fazer pdf
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
    
    //editar ocorrencia
    public function editar(){
        //recupera id
        $id = $this->input->post("iptEdtId");
        $unidade; $setor; $problema; $area; $usuario; $vnc; $ramal;
        //recuperda dados
        $this->recuperaDadosEditaOcorrencia($unidade, $setor, $problema, $area, $usuario, $vnc, $ramal);
        //recupera comentario
        $comentario = $this->input->post("iptEdtComentarioNovo");
        //verifica se existe
        if ($this->ocorrencia->verificaExiste($id)){
            if ($comentario != ""){
                //adiciona comentario
                $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                $this->comentario->addComentario();
                //atualiza chamado
                $this->ocorrencia->atualiza($id, $vnc, $ramal, $usuario, date('Y-m-d H:i:s'), $unidade, $area, $setor, $problema);
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
            } else {
                //atualiza chamado
                $this->ocorrencia->atualiza($id, $vnc, $ramal, $usuario, date('Y-m-d H:i:s'), $unidade, $area, $setor, $problema);
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
            }
        }else{
            //erro
            //log
            $this->gravaLog("erro comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
            $this->gravaLog("erro atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
        }
        redirect("ocorrencia");
    }
    
    //fechar ocorrencia ajax
    public function fecharChamado(){
        //Recupera Id 
        $id = $this->input->post("idocorrencia");
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
        $id = $this->input->post("iptFchId");
        //recupera comentario fechamento
        $comentario = $this->input->post("iptFchComentarioNovo");
        //verifica se existe
        if ($this->ocorrencia->verificaExiste($id)){
            if (isset($comentario)){
                //adiciona comentario
                $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                $this->comentario->addComentario();
                //fecha chamado
                $this->ocorrencia->fecha($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 3);
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("fechamento", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
            }
        }else{
            //erro
            //log
            $this->gravaLog("erro comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
            $this->gravaLog("erro fechamento", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
        }
        redirect("ocorrencia");
    }
}
