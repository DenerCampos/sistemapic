<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentario_model extends CI_Model {

    /**
     * Comentario model
     * 
     * @autor: Dener Junio
     * @desc: Comentarios das ocorrencias 
     */
    
     /*------Atributos--------*/
    var $idcomentario;
    var $descricao;
    var $data;
    var $idocorrencia;
    var $idusuario;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo
    public function newComentario($descricao, $data, $idocorrencia, $idusuario){
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setIdocorrencia($idocorrencia);
        $this->setIdusuario($idusuario);
    }
    
    //Insere
    public function addComentario(){
        $this->db->insert("comentario", $this);
    }
           
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM comentario 
                WHERE idcomentario = $id");
        //retorna objeto
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por id ocorrencia
    public function buscaIdOcorrencia($id){
        $query = $this->db->query(
                "SELECT *
                FROM comentario 
                WHERE idocorrencia = $id 
                ORDER BY data DESC");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca por id ocorrencia fechamento
    public function buscaFechamento($id){
        $query = $this->db->query(
                "SELECT *
                FROM comentario 
                WHERE idocorrencia = $id 
                ORDER BY data DESC
                LIMIT 1");
        //retorna objeto
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $comentario = new Comentario_model();
        //atribue valores do resultado
        $comentario->setIdcomentario($r->idcomentario);
        $comentario->setDescricao($r->descricao);
        $comentario->setData($r->data);
        $comentario->setIdocorrencia($r->idocorrencia);
        $comentario->setIdusuario($r->idusuario);
        
        return $comentario;
    }
    
    //Recuperar um array de objetos sob uma resposta de query
    private function getObjByResult($result){  
        //verifica tamanho do array
        if(count($result)>1){            
            $objects=array();           
            foreach ($result as $k => $v){               
                $objects[$k]=$this->getObjByRow($result[$k]);
            }
            return $objects;
        }
        else{   
            return array($this->getObjByRow($result[0]));
        }
    }
    
    /*------Gets e Sets--------*/ 
    function getIdcomentario() {
        return $this->idcomentario;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData() {
        return $this->data;
    }

    function getIdocorrencia() {
        return $this->idocorrencia;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setIdcomentario($idcomentario) {
        $this->idcomentario = $idcomentario;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setIdocorrencia($idocorrencia) {
        $this->idocorrencia = $idocorrencia;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }
}
