<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_model extends CI_Model {

    /**
     * Ocorrencia
     * 
     * @autor: Dener Junio
     * @desc: Manipulação dos dados de ocorrencia (help-desk) do sistema PIC 
     */
    /* ------Atributos-------- */
    var $idocorrencia;
    var $descricao;
    var $vnc;
    var $ramal;
    var $data_abertura;
    var $data_fechamento;
    var $data_alteracao;
    var $usuario;
    var $usuario_atende;
    var $usuario_fecha;
    var $usuario_abre;
    var $idunidade;
    var $idarea;
    var $idsetor;
    var $idproblema;
    var $idestado;
    var $idocorrencia_estado;

    /* ------Construtor-------- */

    public function __construct() {
        parent::__construct();
    }

    /* ------Requisições-------- */
    //Instancia novo
    public function newOcorrencia($descricao, $vnc, $ramal, $data_abertura, $usuario, $usuario_abre, $idunidade, $idarea, $idsetor, $idproblema, $idocorrencia_estado){
        $this->setDescricao($descricao);
        $this->setVnc($vnc);
        $this->setRamal($ramal);
        $this->setData_abertura($data_abertura);
        $this->setUsuario($usuario);
        $this->setUsuario_abre($usuario_abre);
        $this->setIdunidade($idunidade);
        $this->setIdarea($idarea);
        $this->setIdsetor($idsetor);
        $this->setIdproblema($idproblema);
        $this->setIdestado(1); //1 ativo 2 desativo
        $this->setIdocorrencia_estado($idocorrencia_estado); //1=aberto, 2=em atendimento e 3=fechado
    }
    
    //Insere
    public function addOcorrencia(){
        $this->db->insert("ocorrencia", $this);
        return $this->db->insert_id();
    }
           
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE idocorrencia = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se ocorrencia existe
    public function verificaExiste($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE idocorrencia = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Atende ocorrencia
    public function atende($id, $usuario, $dalteracao, $estado){
        $dados = array(
            "data_alteracao" => $dalteracao,
            "usuario_atende" => $usuario,
            "idocorrencia_estado" => $estado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }
    
    //Encaminha ocorrencia
    public function encaminha($id, $usuario, $dalteracao){
        $dados = array(
            "data_alteracao" => $dalteracao,
            "usuario_atende" => $usuario
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }
    
    //Atualiza ocorrencia $descricao, $vnc, $ramal, $data_abertura, $usuario, $usuario_abre, $idunidade, $idarea, $idsetor, $idproblema, $idocorrencia_estado
    public function atualiza($id, $vnc, $ramal, $usuario, $dalteracao, $idunidade, $idarea, $idsetor, $idproblema){
        $dados = array(
            "vnc" => $vnc,
            "ramal" => $ramal,
            "data_alteracao" => $dalteracao,
            "usuario" => $usuario,
            "idunidade" => $idunidade,
            "idarea" => $idarea,
            "idsetor" => $idsetor,
            "idproblema" => $idproblema
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }
    
    //Fecha ocorrencia
    public function fecha($id, $usuario, $dfecha, $estado){
        $dados = array(
            "data_fechamento" => $dfecha,
            "usuario_fecha" => $usuario,
            "idocorrencia_estado" => $estado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }
    
    //Remove ocorrencia
    public function Remove($id, $usuario, $dalteracao, $estado){
        $dados = array(
            "data_alteracao" => $dalteracao,
            "usuario_atende" => $usuario,
            "idestado" => $estado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }

    //Recupera ultima ocorrencia aberto pelo usuario
    public function recuperaUltima($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE usuario_abre = $id
                ORDER BY idocorrencia DESC
                LIMIT 1");
        //retorna objeto
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
        
    //Verifica se a ocorrencia esta fechada
    public function fechado($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE idocorrencia = $id AND
                    idocorrencia_estado = 3");
        //retorna objeto
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
     //Verifica se a ocorrencia esta em atendimento
    public function atendimento($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE idocorrencia = $id AND
                    idocorrencia_estado = 2");
        //retorna objeto
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
     //Verifica se a ocorrencia esta em aberto
    public function aberto($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE idocorrencia = $id AND
                    idocorrencia_estado = 1");
        //retorna objeto
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    //Busca todos
    public function todasOcorrencias($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                ORDER BY idocorrencia
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por estado (1=aberta, 2=atendimento e 3=fechadas)
    public function todasPorEstado($idestado, $limite = NULL, $ponteiro = NULL){
        //muda organização
        switch ($idestado) {
            case 1:
                $org = 'data_abertura DESC';
                break;
            case 2:
                $org = 'data_alteracao DESC';
                break;
            case 3:
                $org = 'data_fechamento DESC';
                break;
            default:
                $org = 'data_abertura';
                break;
        }
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = $idestado AND
                    idestado = 1
                ORDER BY $org
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = $idestado AND
                        idestado = 1
                    ORDER BY $org");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (numero do chamado)
    public function todasPorBuscaNumero($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '$palavra' AND
                        usuario_abre = $usuario AND
                        idestado = 1
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } elseif (isset ($usuario)) {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '$palavra' AND
                        usuario_abre = $usuario AND
                        idestado = 1
                ORDER BY data_abertura DESC");
        } elseif (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '$palavra' AND
                        idestado = 1
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '$palavra' AND
                        idestado = 1
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (problema)
    public function todasPorBuscaProblema($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%'
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } elseif (isset ($usuario)) {
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%'
                ORDER BY data_abertura DESC");
        } elseif (isset ($limite)){
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%'
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%'
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (Descricao)
    public function todasPorBuscaDescricao($palavra, $usuario = NULL, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } elseif (isset ($usuario)) {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1
                ORDER BY data_abertura DESC");
        } elseif (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por estado (1=aberta, 2=atendimento e 3=fechadas)
    public function todasPorUsuario($idestado, $usuario, $limite = NULL, $ponteiro = NULL){
        //muda organização
        switch ($idestado) {
            case 1:
                $org = 'data_abertura DESC';
                break;
            case 2:
                $org = 'data_alteracao DESC';
                break;
            case 3:
                $org = 'data_fechamento DESC';
                break;
            default:
                $org = 'data_abertura';
                break;
        }
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = $idestado AND
                    idestado = 1 AND
                    usuario_abre = $usuario
                ORDER BY $org
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = $idestado AND
                        idestado = 1 AND
                        usuario_abre = $usuario                 
                    ORDER BY $org");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos em aberto por area de atendimento do tecnico
    public function todasAbertoPorArea($usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 1 AND
                    idestado = 1 AND
                    idarea = $area OR
                    usuario_abre = $usuario
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 1 AND
                idestado = 1 AND
                    idarea = $area OR
                    usuario_abre = $usuario
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos em atendimento por area de atendimento do tecnico
    public function todasAtendimentoPorArea($usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 2 AND
                    idestado = 1 AND
                    (usuario_abre = $usuario OR
                    usuario_atende = $usuario)
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 2 AND
                    idestado = 1 AND
                    (usuario_abre = $usuario OR
                    usuario_atende = $usuario)
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos em atendimento por area de atendimento do tecnico
    public function todasFechadosPorArea($usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 3 AND
                    idestado = 1 AND
                    (usuario_abre =  $usuario  OR usuario_atende = $usuario)
                ORDER BY data_fechamento DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = 3 AND
                    idestado = 1 AND
                    (usuario_abre = $usuario OR
                    usuario_fecha = $usuario)
                ORDER BY data_fechamento DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por estado (1=aberta, 2=atendimento e 3=fechadas)
    public function todasPorArea($idestado, $area, $usuario =NULL, $limite = NULL, $ponteiro = NULL){
        //muda organização
        switch ($idestado) {
            case 1:
                $org = 'data_abertura DESC';
                break;
            case 2:
                $org = 'data_alteracao DESC';
                break;
            case 3:
                $org = 'data_fechamento DESC';
                break;
            default:
                $org = 'data_abertura';
                break;
        }
        if (isset($limite) && (isset($usuario))){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = $idestado AND
                    idestado = 1 AND
                    idarea = $area AND
                    usuario_atende = $usuario
                ORDER BY $org
                LIMIT $ponteiro, $limite");           
        } elseif (isset ($usuario)) {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = $idestado AND
                    idestado = 1 AND
                    idarea = $area AND
                    usuario_atende = $usuario
                ORDER BY $org");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia_estado = $idestado AND
                    idestado = 1 AND
                    idarea = $area
                ORDER BY $org");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por periodo
    public function todasPeriodo($inicio, $fim){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim'"); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por periodo fechados
    public function todasPeriodoFechados($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_fechamento BETWEEN '$inicio' AND
                    '$fim' AND
                    usuario_fecha = $user "); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca chamados por data
    public function todasDataFechado($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_fechamento BETWEEN '$inicio' AND
                    '$fim' AND
                    usuario_fecha = $user
                ORDER BY data_fechamento"); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se contem chamados no periodo especificado e usuario que fechou
    public function contem($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_fechamento BETWEEN '$inicio' AND
                    '$fim' AND
                    usuario_fecha = $user "); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Contar todos registros
    public function contar(){
        return $this->db->count_all('usuario');
    }
    
    //Contar todos registros do administrador
    public function contarTodosAdmin($tipo){
        switch ($tipo) {
            case "aberto":
                $query = $this->db->query(                       
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 1 AND
                        idestado = 1");
                break;
            case "atendimento":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 2 AND
                        idestado = 1");
                break;
            case "fechado":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 3 AND
                        idestado = 1");
                break;            
            default:
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idestado = 1");
                break;
        }
        return $query->num_rows();
    }
    
    //Contar todos registros do tecnico
    public function contarTodosTecn($tipo, $area){
        $usuario = $this->session->userdata("id");
        switch ($tipo) {
            case "aberto":
                $query = $this->db->query(                       
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 1 AND
                        idestado = 1 AND
                        idarea = $area OR
                        usuario_abre = $usuario");
                break;
            case "atendimento":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 2 AND
                        idestado = 1 AND
                        (usuario_abre = $usuario OR
                        usuario_atende = $usuario)");
                break;
            case "fechado":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 3 AND
                        idestado = 1 AND
                        (usuario_abre = $usuario OR
                        usuario_atende = $usuario)");
                break;            
            default:
                $query = $this->db->query(
                     "SELECT *
                    FROM ocorrencia
                    WHERE idestado = 1 AND
                        idarea = $area AND
                        (usuario_abre = $usuario OR
                        usuario_atende = $usuario)");
                break;
        }
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    //Contar todos registros do usuario
    public function contarTodosUsua($tipo, $usuario){
        switch ($tipo) {
            case "aberto":
                $query = $this->db->query(                       
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 1 AND
                        idestado = 1 AND
                        usuario_abre = $usuario");
                break;
            case "atendimento":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 2 AND
                        idestado = 1 AND
                        usuario_abre = $usuario");
                break;
            case "fechado":
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idocorrencia_estado = 3 AND
                        idestado = 1 AND
                        usuario_abre = $usuario");
                break;            
            default:
                $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia
                    WHERE idestado = 1 AND
                        usuario_abre = $usuario");
                break;
        }
        return $query->num_rows();
    }

    /* ------Funções internas-------- */

    //Retorna objeto
    private function getObjByRow($r) {
        //cria novo objeto
        $ocorrencia = new Ocorrencia_model();
        //atribue valores do resultado
        $ocorrencia->setIdocorrencia($r->idocorrencia);
        $ocorrencia->setDescricao($r->descricao);
        $ocorrencia->setVnc($r->vnc);
        $ocorrencia->setRamal($r->ramal);
        $ocorrencia->setData_abertura($r->data_abertura);
        $ocorrencia->setData_fechamento($r->data_fechamento);
        $ocorrencia->setData_alteracao($r->data_alteracao);
        $ocorrencia->setUsuario($r->usuario);
        $ocorrencia->setUsuario_atende($r->usuario_atende);
        $ocorrencia->setUsuario_fecha($r->usuario_fecha);
        $ocorrencia->setUsuario_abre($r->usuario_abre);
        $ocorrencia->setIdunidade($r->idunidade);
        $ocorrencia->setIdarea($r->idarea);
        $ocorrencia->setIdsetor($r->idsetor);
        $ocorrencia->setIdproblema($r->idproblema);
        $ocorrencia->setIdestado($r->idestado);
        $ocorrencia->setIdocorrencia_estado($r->idocorrencia_estado);

        return $ocorrencia;
    }

    //Recuperar um array de objetos sob uma resposta de query
    private function getObjByResult($result) {
        //verifica tamanho do array
        if (count($result) > 1) {
            $objects = array();
            foreach ($result as $k => $v) {
                $objects[$k] = $this->getObjByRow($result[$k]);
            }
            return $objects;
        } else {
            return array($this->getObjByRow($result[0]));
        }
    }

    /* ------Gets e Sets-------- */
    function getIdocorrencia() {
        return $this->idocorrencia;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getVnc() {
        return $this->vnc;
    }

    function getRamal() {
        return $this->ramal;
    }

    function getData_abertura() {
        return $this->data_abertura;
    }

    function getData_fechamento() {
        return $this->data_fechamento;
    }

    function getData_alteracao() {
        return $this->data_alteracao;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getUsuario_atende() {
        return $this->usuario_atende;
    }

    function getUsuario_fecha() {
        return $this->usuario_fecha;
    }

    function getUsuario_abre() {
        return $this->usuario_abre;
    }

    function getIdunidade() {
        return $this->idunidade;
    }

    function getIdarea() {
        return $this->idarea;
    }

    function getIdsetor() {
        return $this->idsetor;
    }

    function getIdproblema() {
        return $this->idproblema;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function getIdocorrencia_estado() {
        return $this->idocorrencia_estado;
    }

    function setIdocorrencia($idocorrencia) {
        $this->idocorrencia = $idocorrencia;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setVnc($vnc) {
        $this->vnc = $vnc;
    }

    function setRamal($ramal) {
        $this->ramal = $ramal;
    }

    function setData_abertura($data_abertura) {
        $this->data_abertura = $data_abertura;
    }

    function setData_fechamento($data_fechamento) {
        $this->data_fechamento = $data_fechamento;
    }

    function setData_alteracao($data_alteracao) {
        $this->data_alteracao = $data_alteracao;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setUsuario_atende($usuario_atende) {
        $this->usuario_atende = $usuario_atende;
    }

    function setUsuario_fecha($usuario_fecha) {
        $this->usuario_fecha = $usuario_fecha;
    }

    function setUsuario_abre($usuario_abre) {
        $this->usuario_abre = $usuario_abre;
    }

    function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }

    function setIdarea($idarea) {
        $this->idarea = $idarea;
    }

    function setIdsetor($idsetor) {
        $this->idsetor = $idsetor;
    }

    function setIdproblema($idproblema) {
        $this->idproblema = $idproblema;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }

    function setIdocorrencia_estado($idocorrencia_estado) {
        $this->idocorrencia_estado = $idocorrencia_estado;
    }

    //reduzir descrição de uma ocorrencia
    public function reduzirDescricao($descricao){
        $tamanho = strlen($descricao);
        if ($tamanho > 20){
            return substr($descricao, 0, 20)."...";
        } else {
            return $descricao;
        }
    }
}
