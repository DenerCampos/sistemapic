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
    var $sla;
    var $data_sla;
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
    public function newOcorrencia($descricao, $vnc, $ramal, $data_abertura, $sla, $data_sla, $usuario, $usuario_abre, $idunidade, $idarea, $idsetor, $idproblema, $idocorrencia_estado){
        $this->setDescricao($descricao);
        $this->setVnc($vnc);
        $this->setRamal($ramal);
        $this->setData_abertura($data_abertura);
        $this->setSla($sla);
        $this->setData_sla($data_sla);
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
    
    //Reabre ocorrencia
    public function reabre($id, $usuario, $dalteracao){
        $dados = array(
            "data_alteracao" => $dalteracao,
            "usuario_atende" => $usuario,
            "usuario_fecha" => null,
            "data_fechamento" => null,
            "idocorrencia_estado" => 2,
            
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia', $id);
        $this->db->update('ocorrencia');
    }
    
    //Atualiza ocorrencia $descricao, $vnc, $ramal, $data_abertura, $usuario, $usuario_abre, $idunidade, $idarea, $idsetor, $idproblema, $idocorrencia_estado
    public function atualiza($id, $vnc, $ramal, $usuario, $dalteracao, $sla, $data_sla, $idunidade, $idarea, $idsetor, $idproblema){
        $dados = array(
            "vnc" => $vnc,
            "ramal" => $ramal,
            "data_alteracao" => $dalteracao,
            "sla" => $sla,
            "data_sla" => $data_sla,
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
                    idocorrencia_estado = 3 AND
                    idestado = 1");
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
                    idocorrencia_estado = 2 AND
                    idestado = 1");
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
                    idocorrencia_estado = 1 AND
                    idestado = 1");
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
    
    //BUSCAR - Usuario
    //Busca todos por busca (numero do chamado)
    public function todasPorBuscaNumeroUsuario($palavra, $estado, $usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
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
    public function todasPorBuscaProblemaUsuario($palavra, $estado, $usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        ocorrencia.usuario_abre = $usuario AND
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        ocorrencia.usuario_abre = $usuario AND
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
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
    public function todasPorBuscaDescricaoUsuario($palavra, $estado,  $usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        usuario_abre = $usuario AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC");
        }
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (Comentario)
    public function todasPorBuscaComentarioUsuario($palavra, $estado,  $usuario, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia
                WHERE ocorrencia.idestado = 1 AND
                    ocorrencia.idocorrencia_estado = $estado AND
                    usuario_abre = $usuario AND
                    comentario.descricao LIKE '%$palavra%'
                ORDER BY ocorrencia.data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia
                WHERE ocorrencia.idestado = 1 AND
                    ocorrencia.idocorrencia_estado = $estado AND
                    usuario_abre = $usuario AND
                    comentario.descricao LIKE '%$palavra%'
                ORDER BY ocorrencia.data_abertura DESC");
        }
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //BUSCAR - Tecnico    
    //Busca todos por busca (numero do chamado)
    public function todasPorBuscaNumeroTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        }else {
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
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
    public function todasPorBuscaProblemaTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
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
    public function todasPorBuscaDescricaoTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC");
        }
        //retorna objeto 
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (Comentario)
    public function todasPorBuscaComentarioTecnico($palavra, $estado, $usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite) && isset($usuario)){
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia 
                WHERE comentario.descricao LIKE '%$palavra%' AND
                        ocorrencia.idestado = 1 AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY ocorrencia.data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia 
                WHERE comentario.descricao LIKE '%$palavra%' AND
                        ocorrencia.idestado = 1 AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY data_abertura DESC");
        }
        //retorna objeto 
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //BUSCAR - Admin 
    //Busca todos por busca (numero do chamado)
    public function todasPorBuscaNumeroAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE idocorrencia LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
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
    public function todasPorBuscaProblemaAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT ocorrencia.*
                FROM ocorrencia
                INNER JOIN problema
                ON ocorrencia.idproblema = problema.idproblema
                WHERE ocorrencia.idestado = 1 AND 
                        problema.nome LIKE '%$palavra%' AND
                        ocorrencia.idocorrencia_estado = $estado
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
    public function todasPorBuscaDescricaoAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia
                WHERE descricao LIKE '%$palavra%' AND
                        idestado = 1 AND
                        idocorrencia_estado = $estado
                ORDER BY data_abertura DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por busca (Comentario)
    public function todasPorBuscaComentarioAdmin($palavra, $estado, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia
                WHERE comentario.descricao LIKE '%$palavra%' AND
                        ocorrencia.idestado = 1 AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY ocorrencia.data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT DISTINCT ocorrencia.*
                FROM ocorrencia
                INNER JOIN comentario
                    ON ocorrencia.idocorrencia = comentario.idocorrencia
                WHERE comentario.descricao LIKE '%$palavra%' AND
                        ocorrencia.idestado = 1 AND
                        ocorrencia.idocorrencia_estado = $estado
                ORDER BY ocorrencia.data_abertura DESC");
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
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 1 AND
                    idestado = 1
                ORDER BY data_abertura DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area  OR
                            usuario_abre = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 1 AND
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
    
    //Busca todos em atendimento por area de atendimento do tecnico
    public function todasAtendimentoPorArea($usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area OR
                            usuario_abre = $usuario OR
                            usuario_atende = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 2 AND
                    idestado = 1 
                ORDER BY data_alteracao DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area OR
                            usuario_abre = $usuario OR
                            usuario_atende = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 2 AND
                    idestado = 1
                ORDER BY data_alteracao DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos em atendimento por area de atendimento do tecnico
    public function todasFechadosPorArea($usuario, $area, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area OR
                            usuario_abre = $usuario OR
                            usuario_fecha = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 3 AND
                    idestado = 1
                ORDER BY data_fechamento DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                      FROM ocorrencia
                      WHERE idarea = $area OR
                            usuario_abre = $usuario OR
                            usuario_fecha = $usuario) AS ocorrencia
                WHERE idocorrencia_estado = 3 AND
                    idestado = 1 
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
    
    //Relatório de plantão
    //Busca chamados por data de abertura
    public function todasDataAberto($inicio, $fim){
        //chamados em aberto
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 1 AND
                    idestado = 1
                ORDER BY idocorrencia");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return array();
        }
    }

    //Relatório de plantão
    //Busca chamados por data - atendimento
    public function todasDataAtendimento($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 2 AND
                    idestado = 1 AND
                    usuario_atende = $user
                ORDER BY idocorrencia"); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return array();
        }
    }
    
    //Relatório de plantão
    //Busca chamados por data - fechado
    public function todasDataFechado($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 3 AND
                    idestado = 1 AND
                    usuario_fecha = $user
                ORDER BY idocorrencia"); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return array();
        }
    }
    
    //Relatório de plantão
    //Verifica se contem chamados abertos no periodo especificado
    public function contemAberto($inicio, $fim){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 1 AND
                    idestado = 1
                ORDER BY idocorrencia");
        return $query->num_rows();
    }
    
    //Verifica se contem chamados atendimento no periodo especificado
    public function contemAtendimento($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 2 AND
                    idestado = 1 AND
                    usuario_atende = $user
                ORDER BY idocorrencia");
        return $query->num_rows();
    }
    
    //Verifica se contem chamados fechado no periodo especificado
    public function contemFechado($inicio, $fim, $user){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia 
                WHERE data_abertura BETWEEN '$inicio' AND
                    '$fim' AND
                    idocorrencia_estado = 3 AND
                    idestado = 1 AND
                    usuario_fecha = $user
                ORDER BY idocorrencia");
        return $query->num_rows();
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
    
    //Contar todos registros de ocorrencias do tecnico
    public function contarTodosTecn($tipo, $area, $tecnico){
        switch ($tipo) {
            case "aberto":
                $query = $this->db->query(                       
                    "SELECT *
                    FROM (SELECT * 
                         FROM ocorrencia
                         WHERE idarea = $area  OR
                                usuario_abre = $tecnico) as ocorrencia
                    WHERE idocorrencia_estado = 1 AND
                        idestado = 1");
                break;
            case "atendimento":
                $query = $this->db->query(
                    "SELECT *
                    FROM (SELECT * 
                          FROM ocorrencia
                          WHERE idarea = $area OR
                                usuario_abre = $tecnico OR
                                usuario_atende = $tecnico) AS ocorrencia
                    WHERE idocorrencia_estado = 2 AND
                        idestado = 1");
                break;
            case "fechado":
                $query = $this->db->query(
                    "SELECT *
                    FROM (SELECT * 
                          FROM ocorrencia
                          WHERE idarea = $area OR
                                usuario_abre = $tecnico OR
                                usuario_fecha = $tecnico) AS ocorrencia
                    WHERE idocorrencia_estado = 3 AND
                        idestado = 1");
                break;            
            default:
                $query = $this->db->query(
                     "SELECT *
                    FROM (SELECT * 
                         FROM ocorrencia
                         WHERE idarea = $area  OR
                                usuario_abre = $tecnico) as ocorrencia
                    WHERE idestado = 1");
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
    
    //Relatorios
    //Relatorio Geral - contar todos os abertos
    public function contarAbertosPorData($inicio, $fim){
        //Busca
        $query = $this->db->query(
                "SELECT * 
                FROM ocorrencia
                WHERE data_abertura >= '$inicio' AND 
                    data_abertura <= '$fim'");
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    //Relatorio Geral - contar todos os atendimentos
    public function contarAtendimentosPorData($inicio, $fim){
        //Busca
        $query = $this->db->query(
                "SELECT * 
                FROM ocorrencia
                WHERE data_alteracao >= '$inicio' AND 
                    data_alteracao <= '$fim'");
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    //Relatorio Geral - contar todos os fechados
    public function contarFechadosPorData($inicio, $fim){
        //Busca
        $query = $this->db->query(
                "SELECT * 
                FROM ocorrencia
                WHERE data_fechamento >= '$inicio' AND 
                    data_fechamento <= '$fim'");
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    //Relatorio Geral - retorna todos fechados no periodo
    public function retornaFechadosPorData($inicio, $fim){
        //Busca
        $query = $this->db->query(
                "SELECT * 
                FROM ocorrencia
                WHERE data_fechamento >= '$inicio' AND 
                    data_fechamento <= '$fim'");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Relatorio Geral - retorna todos abertos no periodo
    public function retornaAbertosPorData($inicio, $fim){
        //Busca
        $query = $this->db->query(
                "SELECT * 
                FROM ocorrencia
                WHERE data_abertura >= '$inicio' AND 
                    data_abertura <= '$fim'");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
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
        $ocorrencia->setSla($r->sla);
        $ocorrencia->setData_sla($r->data_sla);
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

    function getSla() {
        return $this->sla;
    }

    function getData_sla() {
        return $this->data_sla;
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

    function setSla($sla) {
        $this->sla = $sla;
    }

    function setData_sla($data_sla) {
        $this->data_sla = $data_sla;
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
