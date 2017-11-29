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
        $this->load->model("Notificacao_model", "notificacao");
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
            "aba" => "aberto",
            "contadores" => $this->contadorChamados($this->session->userdata("nivel"))));
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
                //editado
                "abertas" => $this->ocorrencia->todasAbertoPorArea($this->session->userdata("id"), $this->session->userdata("area"), 6, $this->recuperaOffset())));
                //"abertas" => $this->ocorrencia->todasPorEstado(1, 6, $this->recuperaOffset())));
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
            "vnc" => $this->gerarVnc(),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
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
            "aba" => "atendimento",
            "contadores" => $this->contadorChamados($this->session->userdata("nivel"))));
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
                //editado
                "atendimentos" => $this->ocorrencia->todasAtendimentoPorArea($this->session->userdata("id"), $this->session->userdata("area"), 6, $this->recuperaOffset())));
                //"atendimentos" => $this->ocorrencia->todasPorEstado(2, 6, $this->recuperaOffset())));
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
            "vnc" => $this->gerarVnc(),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
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
            "aba" => "fechado",
            "contadores" => $this->contadorChamados($this->session->userdata("nivel"))));
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
                //editado
                "fechadas" => $this->ocorrencia->todasFechadosPorArea($this->session->userdata("id"), $this->session->userdata("area"), 6, $this->recuperaOffset())));
                //"fechadas" => $this->ocorrencia->todasPorEstado(3, 6, $this->recuperaOffset())));
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
            "vnc" => $this->gerarVnc(),
            "unidades" => $this->unidade->todasUnidades(),
            "areas" => $this->area->todasAreas(),
            "locais" => $this->local->todosLocais(),
            "problemas" => $this->problema->todosProblemas(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
    }   
    
    //Exibe a view resultado da busca
    public function resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL){
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
            "total" => $total,
            "abertos" => $abertos,
            "atendimentos" => $atendimentos,
            "fechados" => $fechados,
            "problema" => new Problema_model(),
            "estado" => new Ocorrencia_estado_model(),
            "unidade" => new Unidade_model(),
            "area" => new Area_model(),
            "usuario" => new Usuario_model()
        ));
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
        $this->load->view("helpdesk/criar-chamado", array( 
            "assetsUrl" => base_url("assets"),
            "vnc" => $this->gerarVnc(),
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
        $this->load->view("helpdesk/editar-chamado", array( 
                "assetsUrl" => base_url("assets"),
                "unidades" => $this->unidade->todasUnidades(),
                "areas" => $this->area->todasAreas(),
                "locais" => $this->local->todosLocais(),
                "problemas" => $this->problema->todosProblemas(),
                "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "ocorrencia.js"));
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
            "total_rows" => $this->ocorrencia->contarTodosTecn($tipo, $area, $this->session->userdata("id")),
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
            //notificacao
            //enviaNotificacao($id, $remetente, $destinatario, $tipo)
            $this->enviaNotificacao($id, $this->session->userdata("id"), $area, "aberto");
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
                //notificacao
                //enviaNotificacao($id, $remetente, $destinatario, $tipo)
                $this->enviaNotificacao($id, $this->session->userdata("id"), $this->ocorrencia->buscaId($id)->getUsuario_abre(), "atende");
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
                $this->ocorrencia->encaminha($id, $this->geraTecnico($usuario), date('Y-m-d H:i:s'));
                //notificacao
                //enviaNotificacao($id, $remetente, $destinatario, $tipo)
                $this->enviaNotificacao($id, $this->session->userdata("id"), $this->geraUsuario($usuario), "encaminha");
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
            
            //teste
            $chamado = $this->ocorrencia->buscaId($id);
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
                "solucao" => $this->gerarSolucao($id),
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
                $this->gravaLog("chamado removido", "login: ".$this->session->userdata("login")." - chamado: ".$id);
                $this->mensagem("Chamado <strong>".$id."</strong> removido.", $url);
            }else{
                //log
                $this->gravaLog("erro chamado removido", "login: ".$this->session->userdata("login")." - chamado: ".$id);
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
                //notificacao
                //enviaNotificacao($id, $remetente, $destinatario, $tipo)
                $this->enviaNotificacao($id, $this->session->userdata("id"), $this->ocorrencia->buscaId($id)->getUsuario_abre(), "atendimento");
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
                //notificacao
                //enviaNotificacao($id, $remetente, $destinatario, $tipo)
                $this->enviaNotificacao($id, $this->session->userdata("id"), $this->ocorrencia->buscaId($id)->getUsuario_abre(), "fechado");
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
    public function buscarteste(){
        //recupera dados da busca
        $busca = strtolower(trim($this->input->post("iptBusca")));
        //recupera nivel de acesso
        $nivel = $this->session->userdata("nivel");
        //redirect(base_url("ocorrencia/buscar/".$busca));
        try {
            //verifica se foi digitado algo
            if (!empty($busca) && $nivel == 2){ //usuario
                //busca por numero do chamado
                //$abertos = $this->ocorrencia->todasPorBuscaNumero($busca, 1, $this->session->userdata("id"));
                //$this->resultado($busca, $abertos);
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } elseif (!empty($busca) && $nivel == 1){ //tecnico
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } elseif (!empty($busca) && $nivel == 0 ){ //admin
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } else {
                $this->resultado("'vazio'", 0);
            }                       
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca. Favor tentar novamente.");
        }
    }
    
    //Busca por ocorrencia
    public function buscar(){
        //recupera dados da busca
        $busca = strtolower(trim($this->input->post("iptBusca")));
        //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
        if (empty($busca)){
            //recupera o terceiro seguimento da url ocorrencia/buscar/XXXXXX
            $busca = urldecode(strtolower(trim($this->uri->segment(3))));
        } else {
            redirect(base_url("ocorrencia/buscar/".urlencode($busca)));
        }
        //recupera nivel de acesso
        $nivel = $this->session->userdata("nivel");
        try {
            //verifica se foi digitado algo
            if (!empty($busca) && $nivel == 2){ //usuario
                //busca por numero do chamado
                //$abertos = $this->ocorrencia->todasPorBuscaNumero($busca, 1, $this->session->userdata("id"));
                //$this->resultado($busca, $abertos);
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } elseif (!empty($busca) && $nivel == 1){ //tecnico
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } elseif (!empty($busca) && $nivel == 0 ){ //admin
                //Busca todos abertos
                $abertos = $this->buscaTodosPorEstados($busca, 1, $nivel);
                //Busca todos em atendimento
                $atendimentos = $this->buscaTodosPorEstados($busca, 2, $nivel);
                //Busca todos fechados
                $fechados = $this->buscaTodosPorEstados($busca, 3, $nivel);
                //Calcula total
                $total = count($abertos)+count($atendimentos)+count($fechados);
                //chamando a view resultado($palavra, $total, $abertos = NULL, $atendimentos = NULL, $fechados = NULL)
                $this->resultado($busca, $total, $abertos, $atendimentos, $fechados);
            } else {
                $this->resultado("'vazio'", 0);
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
                    $arquivo[] = array(
                        "url" => base_url($value->getLocal().$value->getNome()),
                        "nome" => $value->getNome_antigo(),
                        "imagem" => $this->verificaTipoAnexo($value->getNome())
                        ); 
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
//            if (isset($arquivos)){
//                foreach ($arquivos as $value) {
//                    $arquivo[] = base_url($value->getLocal().$value->getNome()); 
//                }
//                $msg["arquivos"] = $arquivo;
//            }
            if (isset($arquivos)){                
                foreach ($arquivos as $value) {
                    $arquivo[] = array(
                        "url" => base_url($value->getLocal().$value->getNome()),
                        "nome" => $value->getNome_antigo(),
                        "imagem" => $this->verificaTipoAnexo($value->getNome())
                        ); 
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
                    $arquivo[] = array(
                        "url" => base_url($value->getLocal().$value->getNome()),
                        "nome" => $value->getNome_antigo(),
                        "imagem" => $this->verificaTipoAnexo($value->getNome())
                        ); 
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
    
    //Gerar VNC automarico
    private function gerarVnc(){
        //recupera ip
        $ip = $this->input->ip_address();
        //divide pelos pontos
        $pedacos = explode(".", $ip);
        if (isset($pedacos[3])){
            return $pedacos[3];
        } else {
            return null;
        }
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
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getOcorrencia() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Ocorrencia.php");
                redirect(base_url());
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
    
    //Gera usuario
    private function geraTecnico($nome){
        return $this->usuario->buscaTecnicoNome($nome)->getIdusuario();
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
                'allowed_types' => '*',
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
    
    //Gera solução das ocorrencias
    private function gerarSolucao($id){
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
                break;
            }
            //Retorna o ultimo comentario.
            return $coments[0];
        } else {
            return NULL;
        }
    }

    //Gera arquivos das ocorrencias para impressão do chamado
    private function geraArquivos($id){
        //busca todos arquivos
        $arquivos = $this->arquivo->buscaOcorrencia($id);
        //verifica se existe arquivos
        if (isset($arquivos)){
            
            foreach ($arquivos as $value) {
                $arquivo[] = array (
                    "url" => base_url($value->getLocal().$value->getNome()),
                    "nome" => $value->getNome_antigo(),
                    "imagem" => $this->verificaTipoAnexo($value->getNome_antigo())
                ); 
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
    
    //busca todos por estados retornando array com todos os estados pela busca
    private function buscaTodosPorEstados($busca, $estado, $nivel){        
        $numero = $this->buscaPorNumero($busca, $estado, $nivel);
        $problema = $this->buscaPorProblema($busca, $estado, $nivel);
        $descicao = $this->buscaPorDescricao($busca, $estado, $nivel);
        $comentario = $this->buscaPorComentario($busca, $estado, $nivel);
        //Array de resultados por estado
        $resultado = array();
        //Verifica se teve busca e adiciona no resultado cada valor encontrado
        if (isset($numero)){
            foreach ($numero as $key => $value) {
                array_push($resultado, $value);
            }
        }
        //Verifica se teve busca e adiciona no resultado cada valor encontrado
        if (isset($problema)){
            foreach ($problema as $key => $value) {
                array_push($resultado, $value);
            }
        }
        //Verifica se teve busca e adiciona no resultado cada valor encontrado
        if (isset($descicao)){
            foreach ($descicao as $key => $value) {
                array_push($resultado, $value);
            }
        }
        //Verifica se teve busca e adiciona no resultado cada valor encontrado
        if (isset($comentario)){
            foreach ($comentario as $key => $value) {
                //verifica se exite no array (vindo da descrição) o chamado
                if (!in_array($value, $resultado)){
                    array_push($resultado, $value);
                }                
            }
        }
        
        return $resultado;
    }

    //Busca todos estados por numero
    private function buscaPorNumero($busca, $estado, $nivel){
        switch ($nivel) {
            case 0: //admin
                //$resultado = $this->ocorrencia->todasPorBuscaNumero($busca, $estado);
                //todasPorBuscaNumeroAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaNumeroAdmin($busca, $estado);
                break;
            case 1: //tecnico
                //todasPorBuscaNumeroTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaNumeroTecnico($busca, $estado, $this->session->userdata("id"), $this->session->userdata("area"));
                break;
            case 2: //usuario
                //todasPorBuscaNumeroUsuario($palavra, $estado, $usuario, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaNumeroUsuario($busca, $estado, $this->session->userdata("id"));
                break;
            default:
                break;
        }
        //Busca todos --todasPorBuscaNumero($palavra, $estado, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
        //$resultado = $this->ocorrencia->todasPorBuscaNumero($busca, $estado);
        return $resultado;
    }
    
    //Busca todos estados por problema
    private function buscaPorProblema($busca, $estado, $nivel){
        switch ($nivel) {
            case 0: //admin
                //$resultado = $this->ocorrencia->todasPorBuscaNumero($busca, $estado);
                //todasPorBuscaProblemaAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaProblemaAdmin($busca, $estado);
                break;
            case 1: //tecnico
                //todasPorBuscaProblemaTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaProblemaTecnico($busca, $estado, $this->session->userdata("id"), $this->session->userdata("area"));
                break;
            case 2: //usuario
                //todasPorBuscaProblemaUsuario($palavra, $estado, $usuario, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaProblemaUsuario($busca, $estado, $this->session->userdata("id"));
                break;
            default:
                break;
        }
        //Busca todos --todasPorBuscaProblema($palavra, $estado, $usuario = NULL, $limite = NULL, $ponteiro = NULL)
        //$resultado = $this->ocorrencia->todasPorBuscaProblema($busca, $estado);
        return $resultado;
    }
    
    //Busca todos estados por descrição
    private function buscaPorDescricao($busca, $estado, $nivel){
        switch ($nivel) {
            case 0: //admin
                //$resultado = $this->ocorrencia->todasPorBuscaNumero($busca, $estado);
                //todasPorBuscaDescricaoAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaDescricaoAdmin($busca, $estado);
                break;
            case 1: //tecnico
                //todasPorBuscaDescricaoTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaDescricaoTecnico($busca, $estado, $this->session->userdata("id"), $this->session->userdata("area"));
                break;
            case 2: //usuario
                //todasPorBuscaDescricaoUsuario($palavra, $estado,  $usuario, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaDescricaoUsuario($busca, $estado, $this->session->userdata("id"));
                break;
            default:
                break;
        }
        //Busca todos --todasPorBuscaDescricao($palavra, $estado,  $usuario = NULL, $limite = NULL, $ponteiro = NULL)
        //$resultado = $this->ocorrencia->todasPorBuscaDescricao($busca, $estado);
        return $resultado;
    }
    
    //Busca todos estados por comentario
    private function buscaPorComentario($busca, $estado, $nivel){
        switch ($nivel) {
            case 0: //admin
                //$resultado = $this->ocorrencia->todasPorBuscaNumero($busca, $estado);
                //todasPorBuscaComentarioAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaComentarioAdmin($busca, $estado);
                break;
            case 1: //tecnico
                //todasPorBuscaComentarioTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaComentarioTecnico($busca, $estado, $this->session->userdata("id"), $this->session->userdata("area"));
                break;
            case 2: //usuario
                //todasPorBuscaComentarioUsuario($palavra, $estado,  $usuario, $limite = NULL, $ponteiro = NULL)
                $resultado = $this->ocorrencia->todasPorBuscaComentarioUsuario($busca, $estado, $this->session->userdata("id"));
                break;
            default:
                break;
        }
        //Busca todos --todasPorBuscaDescricao($palavra, $estado,  $usuario = NULL, $limite = NULL, $ponteiro = NULL)
        //$resultado = $this->ocorrencia->todasPorBuscaDescricao($busca, $estado);
        return $resultado;
    }
    
    //Contador de chamados por perfil
    private function contadorChamados($nivel){
        $contadores = array();
        //niveis (0 = admin, 1 = tecnico e 2 = usuario)
        switch ($nivel) {
            case '2':
                $contadores[0] = $this->ocorrencia->contarTodosUsua("aberto", $this->session->userdata("id"));
                $contadores[1] = $this->ocorrencia->contarTodosUsua("atendimento", $this->session->userdata("id"));
                $contadores[2] = $this->ocorrencia->contarTodosUsua("fechado", $this->session->userdata("id"));
                break;
            case '1':
                $contadores[0] = $this->ocorrencia->contarTodosTecn("aberto", $this->session->userdata("area"), $this->session->userdata("id"));
                $contadores[1] = $this->ocorrencia->contarTodosTecn("atendimento", $this->session->userdata("area"), $this->session->userdata("id"));
                $contadores[2] = $this->ocorrencia->contarTodosTecn("fechado", $this->session->userdata("area"), $this->session->userdata("id"));
                break;
            case '0':
                $contadores[0] = $this->ocorrencia->contarTodosAdmin("aberto");
                $contadores[1] = $this->ocorrencia->contarTodosAdmin("atendimento");
                $contadores[2] = $this->ocorrencia->contarTodosAdmin("fechado");
                break;
            default:
                $contadores[0] = 'erro';
                $contadores[1] = 'erro';
                $contadores[2] = 'erro';
                break;
        }
        return $contadores;
    }
    
    //Verifica se o anexo é uma imagem (retorna 0 para não e 1 para sim)
    private function verificaTipoAnexo($nome){
        $str = explode(".", $nome);
        $ext = strtolower(end($str));
        if (($ext == "jpg") || ($ext == "jpeg") ||($ext == "png") ||($ext == "bmp") ||($ext == "gif")){
            return 1;
        } else {
            return 0;
        }
    }
    
    //Envia notificação para usuarios
    private function enviaNotificacao($id, $remetente, $destinatario, $tipo){
        try {
            //verifica o tipo de notificação (
            //  Existem 5 tipos:
            //      aberto: notificações para todos os tecnicos da area do chamado, o id da area é o destinatario
            //      atendimento: notificação para o destinatario (usuario que abriu o chamado)
            //      fechado: notificação somente para o destinatario (usuario que abriu o chamado)
            //      atende: notificação somente para o destinatario (usuario que abriu o chamado)
            //      encaminha: notificação para o destinatario (tecnico que recebe o chamado)
            
            switch ($tipo) {
                case "aberto":
                    $titulo = "Novo chamado aberto";                    
                    $link = base_url('ocorrencia/buscar/'.$id);
                    $mensagem = "";
                    //busca todos tecnicos da area de atendimento
                    //todosTecnicosPorArea($area, $limite = NULL, $ponteiro = NULL)
                    $tecnicos = $this->usuario->todosTecnicosPorArea($destinatario);
                    if (isset($tecnicos)){
                        foreach ($tecnicos as $value) {
                            //mensagem
                            $mensagem = 'Chamado '. 
                                        '<a href="'.$link.'"><strong>'.$id.'</strong></a>'. 
                                        ' aberto no sistema por <strong> '.$this->usuario->buscaId($remetente)->getNome().' </strong>';                            
                            //nova notificação
                            //novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link)
                            $this->notificacao->novo($remetente, $value->getIdusuario(), date('Y-m-d H:i:s'), NULL, $titulo, $mensagem, FALSE, FALSE, $link);
                            //adiciona
                            $this->notificacao->adiciona();
                        }                        
                    }                    
                    break;
                case "atendimento":
                    $titulo = "Alteração no chamado";                          
                    $link = base_url('ocorrencia/buscar/'.$id);  
                    $mensagem = 'Chamado '. 
                                '<a href="'.$link.'"><strong>'.$id.'</strong></a>'. 
                                ' foi alterado no sistema por <strong>'.$this->usuario->buscaId($remetente)->getNome().'</strong>';                  
                    //nova notificação
                    //novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link)
                    $this->notificacao->novo($remetente, $destinatario, date('Y-m-d H:i:s'), NULL, $titulo, $mensagem, FALSE, FALSE, $link);
                    //adiciona
                    $this->notificacao->adiciona();                                 
                    break;
                case "fechado":
                    $titulo = "Fechamento de chamado";                          
                    $link = base_url('ocorrencia/buscar/'.$id); 
                    $mensagem = 'Chamado '. 
                                '<a href="'.$link.'"><strong>'.$id.'</strong></a>'. 
                                ' foi fechado no sistema por <strong>'.$this->usuario->buscaId($remetente)->getNome().'</strong>';                  
                    //nova notificação
                    //novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link)
                    $this->notificacao->novo($remetente, $destinatario, date('Y-m-d H:i:s'), NULL, $titulo, $mensagem, FALSE, FALSE, $link);
                    //adiciona
                    $this->notificacao->adiciona(); 
                    break;
                case "atende":
                    $titulo = "Atendimento do chamado";                          
                    $link = base_url('ocorrencia/buscar/'.$id);  
                    $mensagem = 'Chamado '. 
                                '<a href="'.$link.'"><strong>'.$id.'</strong></a>'. 
                                ' está sendo atendido por <strong>'.$this->usuario->buscaId($remetente)->getNome().'</strong>';                  
                    //nova notificação
                    //novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link)
                    $this->notificacao->novo($remetente, $destinatario, date('Y-m-d H:i:s'), NULL, $titulo, $mensagem, FALSE, FALSE, $link);
                    //adiciona
                    $this->notificacao->adiciona(); 
                    break;
                case "encaminha":
                    $titulo = "Encaminhamento de chamado";                          
                    $link = base_url('ocorrencia/buscar/'.$id); 
                    $mensagem = 'Chamado '. 
                                '<a href="'.$link.'"><strong>'.$id.'</strong></a>'. 
                                ' foi encaminhado para você por <strong>'.$this->usuario->buscaId($remetente)->getNome().'</strong>';                  
                    //nova notificação
                    //novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link)
                    $this->notificacao->novo($remetente, $destinatario, date('Y-m-d H:i:s'), NULL, $titulo, $mensagem, FALSE, FALSE, $link);
                    //adiciona
                    $this->notificacao->adiciona(); 
                    break;
                default:
                    break;
            }                                  
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao criar notificação.");
        }
        }
   
}
