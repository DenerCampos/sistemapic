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
    //Exibe a view aberto
    public function index(){
        redirect('ocorrencia/aberto');
    }
    
    //Exibe a view aberto
    public function aberto(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "helpdesk"));      
        //Carrega home
        $this->load->view("helpdesk/home", array (
            "assetsUrl" => base_url("assets"),
            "aba" => "aberto"));
        //Carrega chamados em aberto
        if ($this->session->userdata("nivel") == "0"){
            $this->load->view('helpdesk/chamado-aberto-admin', array( 
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaAdmin("aberto", "aberto"),
                "abertas" => $this->ocorrencia->todasPorEstado(1, 6, $this->recuperaOffset())));
        } elseif ($this->session->userdata("nivel") == "1") {
            $this->load->view('helpdesk/chamado-aberto-tecn', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaTecn("aberto", "aberto", $this->session->userdata("area")),
                "abertas" => $this->ocorrencia->todasAbertoPorArea($this->session->userdata("id"), $this->session->userdata("area"), 6, $this->recuperaOffset())));
        } else {
            $this->load->view('helpdesk/chamado-aberto-user', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaUsua("aberto", "aberto", $this->session->userdata("id")),
                "abertas" => $this->ocorrencia->todasPorUsuario(1, $this->session->userdata("id"), 6, $this->recuperaOffset())));
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
    
    //Exibe a view atendimento
    public function atendimento(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "helpdesk"));      
        //Carrega home
        $this->load->view("helpdesk/home", array (
            "assetsUrl" => base_url("assets"),
            "aba" => "atendimento"));
        //Carrega chamados em aberto
        if ($this->session->userdata("nivel") == "0"){
            $this->load->view('helpdesk/chamado-atendimento-admin', array( 
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaAdmin("atendimento", "atendimento"),
                "atendimentos" => $this->ocorrencia->todasPorEstado(2, 6, $this->recuperaOffset())));
        } elseif ($this->session->userdata("nivel") == "1") {
            $this->load->view('helpdesk/chamado-atendimento-tecn', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaTecn("atendimento", "atendimento", $this->session->userdata("area")),
                "atendimentos" => $this->ocorrencia->todasAtendimentoPorArea($this->session->userdata("id"), 6, $this->recuperaOffset())));
        } else {
            $this->load->view('helpdesk/chamado-atendimento-user', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaUsua("atendimento", "atendimento", $this->session->userdata("id")),
                "atendimentos" => $this->ocorrencia->todasPorUsuario(2, $this->session->userdata("id"), 6, $this->recuperaOffset())));
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
    
    //Exibe a view fechado
    public function fechado(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "helpdesk"));      
        //Carrega home
        $this->load->view("helpdesk/home", array (
            "assetsUrl" => base_url("assets"),
            "aba" => "fechado"));
        //Carrega chamados em aberto
        if ($this->session->userdata("nivel") == "0"){
            $this->load->view('helpdesk/chamado-fechado-admin', array( 
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaAdmin("fechado", "fechado"),
                "fechadas" => $this->ocorrencia->todasPorEstado(3, 6, $this->recuperaOffset())));
        } elseif ($this->session->userdata("nivel") == "1") {
            $this->load->view('helpdesk/chamado-fechado-tecn', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaTecn("fechado", "fechado", $this->session->userdata("area")),
                "fechadas" => $this->ocorrencia->todasFechadosPorArea($this->session->userdata("id"), 6, $this->recuperaOffset())));
        } else {
            $this->load->view('helpdesk/chamado-fechado-user', array(
                "usuario" => new Usuario_model(),
                "unidade" => new Unidade_model(),
                "area" => new Area_model(),
                "setor" => new Setor_model(),
                "problema" => new Problema_model(),
                "local" => new Local_model(),
                "estado" => new Ocorrencia_estado_model(),
                "paginas" => $this->listarOcorrenciaUsua("fechado", "fechado", $this->session->userdata("id")),
                "fechadas" => $this->ocorrencia->todasPorUsuario(3, $this->session->userdata("id"), 6, $this->recuperaOffset())));
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
    
    //Exibe a view resultado da busca
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
            "ativo" => "helpdesk"));     
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
            "ativo" => "helpdesk"));     
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
    
    /*----------------Funções---------------*/
    
    //Paginação Admin
    public function listarOcorrenciaAdmin($tipo, $url){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('ocorrencia/'.$url),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 3,
            "total_rows" => $this->ocorrencia->contarTodosAdmin($tipo),
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
    
    //Paginação Admin
    public function listarOcorrenciaTecn($tipo, $url, $area){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('ocorrencia/'.$url),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 3,
            "total_rows" => $this->ocorrencia->contarTodosTecn($tipo, $area),
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
    
    //Paginação Admin
    public function listarOcorrenciaUsua($tipo, $url, $usuario){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('ocorrencia/'.$url),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 3,
            "total_rows" => $this->ocorrencia->contarTodosUsua($tipo, $usuario),
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
    
    //Cria nova ocorrencia
    public function novaOcorrencia(){
        $unidade; $setor; $problema; $area; $usuario; $vnc; $ramal; $descricao; $url; $emailarea; $emailusuario;
        try {
            //recuperda dados
            $this->recuperaDadosNovaOcorrencia($unidade, $setor, $problema, $area, $usuario, $vnc, $ramal, $descricao, $url, $emailarea, $emailusuario);
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
            //Enviando e-mail
            if ($emailarea){
                //criando corpo da mensagem
                $corpo = $this->emailAberturaArea($this->ocorrencia->recuperaUltima($this->session->userdata("id"))->getIdocorrencia());
                //Envia e-mail
                $this->envioEmail($this->area->buscaId($area)->getEmail(), "Abertura chamado (Sistema PIC)", $corpo);
            }
            if ($emailusuario){
                //criando corpo da mensagem
                $corpo = $this->emailAberturaUsuario($this->ocorrencia->recuperaUltima($this->session->userdata("id"))->getIdocorrencia());
                //Envia e-mail
                $this->envioEmail($this->session->userdata("login"), "Abertura chamado (Sistema PIC)", $corpo);
            }                      
            //log
            $this->gravaLog("chamado aberto", "usuario: ".$this->session->userdata("nome")." - chamado: ".$this->ocorrencia->recuperaUltima($this->session->userdata("id"))->getIdocorrencia());
            //mensagem
            $this->mensagem("Chamado <strong>".$id."</strong> aberto!", $url);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação do chamado. Tentar novamente.");
        }        
    }
    
    //Atender ocorrencia
    public function atender(){
        try {
            $id; $url;
            //Recupera inputs
            $this->recuperaDadosAtender($id, $url);
            //verifica se existe e esta em aberto
            if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->aberto($id)){
                //atende ocorrencia
                $this->ocorrencia->atende($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 2);
                //log
                $this->gravaLog("chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                $this->mensagem("Agora você está atendendo o chamado: <strong>".$id."</strong>.", $url);
            }else{
                //log
                $this->gravaLog("erro chamado em atendimento", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                $this->erro("Chamado <strong>".$id."</strong> não está em aberto no sistema.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao atender o chamado. Favor tentar novamente.");
        }  
    }
    
    //Encaminhar ocorrencia
    public function encaminhar(){
        try {
            $id; $usuario; $comentario; $url;
            //Recuperando dados
            $this->recuperaDadosEncaminhar($id, $usuario, $comentario, $url);
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
                $this->mensagem("Chamado <strong>".$id."</strong> encaminhado para <strong>".$usuario."</strong>.", $url);
            }else{
                //log
                $this->gravaLog("erro chamado emcaminhado", "nome: ".$this->session->userdata("nome")." - chamado: ".$id." para o usuario: ".$usuario);
                $this->erro("Chamado <strong>".$id."</strong> não está em atendimento no sistema.");
            } 
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao encaminhar chamado. Favor tentar novamente.");
        }
    }
    
    //Imprimir ocorrencia
    public function imprimir(){
        try {
            //carregando a biblioteca
            $this->load->library('pdf');
            $id; $url;
            //Recupera dados
            $this->recuperaDadosImprimir($id, $url);
            //Gera pagina em html
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
            //Busca arquivo de estilo
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
        try {
            $id; $url;
            //recupera dados
            $this->recuperaDadosRemover($id, $url);
            //verifica se existe
            if ($this->ocorrencia->verificaExiste($id)){
                //remover ocorrencia
                $this->ocorrencia->remove($id, $this->session->userdata("id"), date('Y-m-d H:i:s'), 2);
                //log
                $this->gravaLog("chamado removido", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                $this->mensagem("Chamado <strong>".$id."</strong> removido.", $url);
            }else{
                //log
                $this->gravaLog("erro chamado removido", "nome: ".$this->session->userdata("nome")." - chamado: ".$id);
                $this->erro("Chamado <strong>".$id."</strong> não existe.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao remover chamado. Favor tentar novamente.");
        }

        
    }
    
    //Editar ocorrencia
    public function editar(){        
        try {
            $id; $unidade; $setor; $problema; $area; $usuario; $vnc; $ramal; $comentario; $url; $email;
            //Recupera dados
            $this->recuperaDadosEditar($id, $unidade, $setor, $problema, $area, $usuario, $vnc, $ramal, $comentario, $url, $email);
            //verifica se existe e se ocorrencia esta em atendimento
            if ($this->ocorrencia->verificaExiste($id) && $this->ocorrencia->atendimento($id)){
                if ($comentario != ""){
                    //adiciona comentario
                    $this->comentario->newComentario($comentario, date('Y-m-d H:i:s'), $id, $this->session->userdata("id"));
                    $this->comentario->addComentario();
                }
                //atualiza chamado
                $this->ocorrencia->atualiza($id, $vnc, $ramal, $usuario, date('Y-m-d H:i:s'), $unidade, $area, $setor, $problema);
                //salva anexos
                foreach ($_FILES as $key => $value) {
                    if ($this->salvaAnexo($key, $id)){
                        //Log
                        $this->gravaLog("anexo chamado", "usuario: ".$this->session->userdata("id")."Nome original: ".$value["name"]);  
                    }
                }
                //Enviando e-mail
                if ($email){
                    //criando corpo da mensagem
                    $corpo = $this->emailEdicaoChamado($id, $comentario);
                    //Envia e-mail para usuario do chamado
                    $this->envioEmail($this->usuario->buscaId($this->ocorrencia->buscaId($id)->getUsuario_abre())->getLogin(), "Edição chamado (Sistema PIC)", $corpo);
                    //Envia e-mail para tecnico do chamado
                    $this->envioEmail($this->usuario->buscaId($this->ocorrencia->buscaId($id)->getUsuario_atende())->getLogin(), "Edição chamado (Sistema PIC)", $corpo);
                }
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->mensagem("Chamado <strong>".$id."</strong> atualizado.", $url);
            }else{
                //log
                $this->gravaLog("erro comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("erro atualiza", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->erro("Chamado <strong>".$id."</strong> já foi fechado ou não existe!");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar chamado. Favor tentar novamente.");
        }
    }
    
     //fechar ocorrencia
    public function fechar(){
        try {
            $id; $comentario; $url; $email;
            //recupera dados
            $this->recuperaDadosFechar($id, $comentario, $url, $email);
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
                //salva anexos
                foreach ($_FILES as $key => $value) {
                    if ($this->salvaAnexo($key, $id)){
                        //Log
                        $this->gravaLog("anexo chamado", "usuario: ".$this->session->userdata("id")."Nome original: ".$value["name"]);  
                    }
                }
                //Enviando e-mail
                if ($email){
                    //criando corpo da mensagem
                    $corpo = $this->emailFechaChamado($id, $comentario);
                    //Envia e-mail para usuario do chamado
                    $this->envioEmail($this->usuario->buscaId($this->ocorrencia->buscaId($id)->getUsuario_abre())->getLogin(), "Fechamento de chamado (Sistema PIC)", $corpo);
                }
                //log
                $this->gravaLog("comentario", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->gravaLog("fechamento", "chamado: ".$id." - usuario: ".$this->session->userdata("id"));
                $this->mensagem("Chamado <strong>".$id."</strong> fechado!", $url);
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
    
    /*----------------Funções AJAX---------------*/
    
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
                    $coments[] = "<strong>".date("d/m - H:i", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": </strong><br/>".
                        str_replace("\r\n", "<br/>", $comentario->getDescricao());
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
                    $coments[] = "<strong>".date("d/m - H:i", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": </strong><br/>".
                        str_replace("\r\n", "<br/>", $comentario->getDescricao());
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
    
    //fechar ocorrencia ajax
    public function fecharChamado(){
        //Recupera Id 
        $id = trim($this->input->post("idocorrencia"));
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
                    $coments[] = "<strong>".date("d/m - H:i", strtotime($comentario->getData())).
                        " | ". $this->usuario->buscaId($comentario->getIdusuario())->getNome().
                        ": </strong><br/>".
                        str_replace("\r\n", "<br/>", $comentario->getDescricao());
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
    
    /*---------Funções internas------------*/ 
    
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
    
    //Paginação usuariao, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else{
            return 0;
        }
    }
    
    //Verifica nivel de usuario para acesso ao sistema
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
    
    //Gera unidade
    private function geraUnidade($nome){
        return $this->unidade->buscaPorNome($nome)->getIdunidade();
    }
    
    //Gera setor
    private function geraSetor($nome){
        return $this->setor->buscaPorNome($nome)->getIdsetor();
    }
    
    //Gera problema
    private function geraProblema($nome){
        return $this->problema->buscaPorNome($nome)->getIdproblema();
    }
    
    //Gera area
    private function geraArea($nome){
        return $this->area->buscaPorNome($nome)->getIdarea();
    }
    
    //Gera usuario
    private function geraUsuario($nome){
        return $this->usuario->buscaUsuarioNome($nome)->getIdusuario();
    }
    
    //primeira letra maiuscula 
    private function primeiraLetraMaiuscula($texto){
        return ucfirst(strtolower($texto));
    }
    
    //primeira letra de cada palavra maiuscula 
    private function palavraLetraMaiuscula($texto){
        return ucwords(strtolower($texto));
    }

    //Recupera dados da nova ocorrencia
    private function recuperaDadosNovaOcorrencia(&$unidade, &$setor, &$problema, &$area, &$usuario, &$vnc, &$ramal, &$descricao, &$url, &$emailarea, &$emailusuario){
        $unidade = $this->input->post("selCriUnidade");
        $setor = $this->input->post("selCriSetor");
        $problema = $this->input->post("selCriProblema");
        $area = $this->input->post("selCriArea");
        $usuario = $this->palavraLetraMaiuscula(trim($this->input->post("iptCriUsuario")));
        $vnc = trim($this->input->post("iptCriVnc"));
        $ramal = trim($this->input->post("iptCriRamal"));
        $descricao = $this->input->post("iptCriDesc");
        $emailarea = $this->input->post("iptCriEnviarArea");
        $emailusuario = $this->input->post("iptCriEnviarUsuario");
        $url = trim($this->input->post("iptCriUrl"));
               
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/aberto";
        }
        
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
        //Verifica se manda email para area de atendimento
        if (isset($emailarea)){
            $emailarea = TRUE;
        } else{
            $emailarea = FALSE;
        }
        //Verifica se manda email para usuario
        if (isset($emailusuario)){
            $emailusuario = TRUE;
        } else{
            $emailusuario = FALSE;
        }
    }
    
    //Recupera dados da editar ocorrencia
    private function recuperaDadosEditar(&$id, &$unidade, &$setor, &$problema, &$area, &$usuario, &$vnc, &$ramal, &$comentario, &$url, &$email){
        $id = $this->input->post("iptEdtId");
        $unidade = $this->input->post("selEdtUnidade");
        $setor = $this->input->post("selEdtSetor");
        $problema = $this->input->post("selEdtProblema");
        $area = $this->input->post("selEdtArea");
        $usuario = $this->palavraLetraMaiuscula(trim($this->input->post("iptEdtUsuario")));
        $vnc = trim($this->input->post("iptEdtVnc"));
        $ramal = trim($this->input->post("iptEdtRamal"));
        //$descricao = $this->input->post("iptEdtDesc");
        $comentario = trim($this->input->post("iptEdtComentarioNovo"));
        $url = trim($this->input->post("iptEdtUrl"));
        $email = $this->input->post("iptEdtAcompanharEmail");
        
        //verifica URL existe
        if (!isset($url)){
            $url = base_url("ocorrencia/aberto");
        }        
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
        //Verifica acompanhamento por email
        if (isset($email)){
            $email = TRUE;
        } else{
            $email = FALSE;
        }
    }
    
    //Recupera dados da atender ocorrencia
    private function recuperaDadosAtender(&$id, &$url){
        $id = trim($this->input->post("iptAtdId"));
        $url = trim($this->input->post("iptAtdUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/aberto";
        }
    }
    
    //Recupera dados da encaminher ocorrencia
    private function recuperaDadosEncaminhar(&$id, &$usuario, &$comentario, &$url){
        $id = trim($this->input->post("iptEncId"));
        $usuario = trim($this->input->post("selEncTecnico"));
        $comentario = trim($this->input->post("iptEncComentario"));
        $url = trim($this->input->post("iptEncUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/atendimento";
        }
    }
    
    //Recupera dados da imprimir ocorrencia
    private function recuperaDadosImprimir(&$id, &$url){
        $id = trim($this->input->post("iptImpId"));
        $url = trim($this->input->post("iptImpUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/aberto";
        }
    }
    
    //Recupera dados da remover ocorrencia
    private function recuperaDadosRemover(&$id, &$url){
        $id = $this->input->post("iptRmvId");
        $url = trim($this->input->post("iptRmvUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/aberto";
        }
    }
    
    //Recupera dados da fechar ocorrencia
    private function recuperaDadosFechar(&$id, &$comentario, &$url, &$email){
        $id = trim($this->input->post("iptFchId"));
        $comentario = trim($this->input->post("iptFchComentarioNovo"));
        $url = trim($this->input->post("iptFchUrl"));
        $email = $this->input->post("iptFchAcompanharEmail");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "ocorrencia/atendimento";
        }
        //Verifica acompanhamento por email
        if (isset($email)){
            $email = TRUE;
        } else{
            $email = FALSE;
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
                'allowed_types' => 'gif|jpg|png|pdf',
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
    
    //Gerar comentarios das ocorrencias
    private function gerarComentarios($id){
        //busca todos comentarios da ocorrencia
        $comentarios = $this->comentario->buscaIdOcorrencia($id);
        //verifica se existe comentarios
        if (isset($comentarios)){
            $coments = array();
            foreach ($comentarios as $comentario) {
                $coments[] = date("d/m - H:i", strtotime($comentario->getData())).
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
    
    //Corpo do e-mail para abertura de chamado de area
    private function emailAberturaArea($id){
        //recupera ocorrencia
        $ocorrencia = $this->ocorrencia->buscaId($id);
        //gera dados para view
        if (isset($ocorrencia)){
            $dados['id'] = $ocorrencia->getIdocorrencia();
            $dados['area'] = $this->area->buscaId($ocorrencia->getIdarea())->getNome();
            $dados['usuario'] = $this->usuario->buscaId($ocorrencia->getUsuario_abre())->getNome();
            $dados['problema'] = $this->problema->buscaId($ocorrencia->getIdproblema())->getNome();
            $dados['descricao'] = str_replace("\r\n", "<br/>", $ocorrencia->getDescricao());
        } else{
            return "Erro ao gerar e-mail do chamado!";
        }
        //Carrega view
        return $this->load->view("helpdesk/email/mensagem-email-area", $dados, TRUE);
    }
    
    //Corpo do e-mail para abertura de chamado de usuario
    private function emailAberturaUsuario($id){
        //recupera ocorrencia
        $ocorrencia = $this->ocorrencia->buscaId($id);
        //gera dados para view
        if (isset($ocorrencia)){
            $dados['id'] = $ocorrencia->getIdocorrencia();
            $dados['usuario'] = $this->usuario->buscaId($ocorrencia->getUsuario_abre())->getNome();
            $dados['problema'] = $this->problema->buscaId($ocorrencia->getIdproblema())->getNome();
            $dados['descricao'] = str_replace("\r\n", "<br/>", $ocorrencia->getDescricao());
        } else{
            return "Erro ao gerar e-mail do chamado!";
        }
        //Carrega view
        return $this->load->view("helpdesk/email/mensagem-email-usuario", $dados, TRUE);
    }
    
    //Corpo do e-mail para ediçao de chamado
    private function emailEdicaoChamado($id, $comentario){
        //recupera ocorrencia
        $ocorrencia = $this->ocorrencia->buscaId($id);
        
        //gera dados para view
        if (isset($ocorrencia)){
            $dados['id'] = $ocorrencia->getIdocorrencia();
            $dados['estado'] = "Em atendimento";
            $dados['area'] = $this->area->buscaId($ocorrencia->getIdarea())->getNome();
            $dados['tecnico'] = $this->usuario->buscaId($ocorrencia->getUsuario_atende())->getNome();
            $dados['usuario'] = $this->usuario->buscaId($ocorrencia->getUsuario_abre())->getNome();
            $dados['problema'] = $this->problema->buscaId($ocorrencia->getIdproblema())->getNome();
            $dados['descricao'] = str_replace("\r\n", "<br/>", $ocorrencia->getDescricao());
            $dados['comentario'] = str_replace("\r\n", "<br/>", $comentario);
        } else{
            return "Erro ao gerar e-mail do chamado!";
        }
        //Carrega view
        return $this->load->view("helpdesk/email/mensagem-email-atualiza", $dados, TRUE);
    }
    
    //Corpo do e-mail para ediçao de chamado
    private function emailFechaChamado($id, $solucao){
        //recupera ocorrencia
        $ocorrencia = $this->ocorrencia->buscaId($id);
        
        //gera dados para view
        if (isset($ocorrencia)){
            $dados['id'] = $ocorrencia->getIdocorrencia();
            $dados['estado'] = "Fechado";
            $dados['area'] = $this->area->buscaId($ocorrencia->getIdarea())->getNome();
            $dados['tecnico'] = $this->usuario->buscaId($ocorrencia->getUsuario_atende())->getNome();
            $dados['usuario'] = $this->usuario->buscaId($ocorrencia->getUsuario_abre())->getNome();
            $dados['problema'] = $this->problema->buscaId($ocorrencia->getIdproblema())->getNome();
            $dados['descricao'] = str_replace("\r\n", "<br/>", $ocorrencia->getDescricao());
            $dados['solucao'] = str_replace("\r\n", "<br/>", $solucao);
        } else{
            return "Erro ao gerar e-mail do chamado!";
        }
        //Carrega view
        return $this->load->view("helpdesk/email/mensagem-email-fechamento", $dados, TRUE);
    }

    //enviar email
    private function envioEmail($para, $assunto, $texto, $anexo = NULL){
        try {
            //carregando biblioteca de email
            $this->load->library("email");
            //pegando configuração
            $this->load->model("email_conf_model", "configuracao");
            $config = $this->configuracao->busca("text");
            //preparando o email
            $this->email->initialize($config);
            $this->email->from($config["smtp_user"], "Sistema PIC (help-desk)");
            $this->email->to($para);
            $this->email->subject($assunto);
            $this->email->message($texto);
            $this->email->set_mailtype("html");
            //anexo
            if (isset($anexo)){
                $this->email->attach($anexo);
            }
            if ($this->email->send()) {
                //email enviado com sucesso
                return TRUE;
            } else {
                $head = $this->email->print_debugger(array('headers'));
                $subject = $this->email->print_debugger(array('subject'));;
                $body = $this->email->print_debugger(array('body'));
                $this->gravaLog("erro enviar email plantao", "Usuario: ".$this->session->userdata("id").". Erro: ".$head." - ".$subject." - ".$body);
                //$this->erro($teste);
                return FALSE;
            }
            //enviando email
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
   
}
