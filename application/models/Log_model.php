<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

    /**
     * Log
     * 
     * @autor: Dener Junio
     * @desc: Manupula os logs do sistema PIC
     */
    
     /*------Atributos--------*/
    var $idlog;
    var $nome;
    var $descricao;
    var $data;
    var $ip;
    var $idusuario;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo log
    public function newLog($nome, $descricao, $data, $ip, $idusuario){
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setIp($ip);
        $this->setIdusuario($idusuario);
    }
    
    //Insere log
    public function addLog(){
        $this->db->insert("log", $this);
    }
    
    //Recupera ultimos logs por limite
    public function recuperaLogs($limite){
        //Seleção
        $query = $this->db->query(
                "SELECT *
                FROM log
                WHERE nome != 'acesso'
                ORDER BY idlog DESC
                LIMIT $limite");
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca por logs
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM log
                WHERE nome LIKE '%$texto%' OR
                    descricao LIKE '%$texto%' OR
                    ip LIKE '%$texto%'
                ORDER BY idlog DESC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM log
                WHERE nome LIKE '%$texto%' OR
                    descricao LIKE '%$texto%' OR
                    ip LIKE '%$texto%'
                    ORDER BY idlog DESC");
        }
        
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }



    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $log = new Log_model();
        //atribue valores do resultado
        $log->setIdlog($r->idlog);
        $log->setNome($r->nome);
        $log->setDescricao($r->descricao);
        $log->setData($r->data);
        $log->setIp($r->ip);
        $log->setIdusuario($r->idusuario);
        
        return $log;
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
    function getIdlog() {
        return $this->idlog;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData() {
        return $this->data;
    }

    function getIp() {
        return $this->ip;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setIdlog($idlog) {
        $this->idlog = $idlog;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }
}
