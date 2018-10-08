<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aerobica_recuperacao_model extends CI_Model {

    /**
     * Aerobica_recuperacao_model
     * aerobica recuperacao faz parte da aerobica da avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idaerobica_recuperacao; //identificador (INT)
    var $recuperacao; // (TEXT)
    var $velocidade; // (FLOAT)
    var $bpm; //(INT)
    var $idaerobica; // identificador da aerobica (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($recuperacao, $velocidade, $bpm, $idaerobica){
        $this->setRecuperacao($recuperacao);
        $this->setVelocidade($velocidade);
        $this->setBpm($bpm);
        $this->setIdaerobica($idaerobica);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("aerobica_recuperacao", $this);
    }
    
    //Atualiza
    public function atualiza($id, $recuperacao, $velocidade, $bpm, $idaerobica){
        $dados = array(
            "recuperacao" => $recuperacao,
            "velocidade" => $velocidade,
            "bpm" => $bpm,
            "idaerobica" => $idaerobica
        );
        $this->db->set($dados);
        $this->db->where('idaerobica_recuperacao', $id);
        $this->db->update('aerobica_recuperacao');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idaerobica_recuperacao', $id);
        $this->db->delete('aerobica_recuperacao');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica_recuperacao");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar por id aerobica
    public function BuscarPorIdaerobica($idaerobica){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica_recuperacao
                WHERE idaerobica = $idaerobica");
        //retorna objeto ip
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
        $base = new Aerobica_recuperacao_model();
        //atribue valores do resultado
        $base->setIdaerobica_recuperacao($r->idaerobica_recuperacao);
        $base->setRecuperacao($r->recuperacao);
        $base->setVelocidade($r->velocidade);
        $base->setBpm($r->bpm);
        $base->setIdaerobica($r->idaerobica);
        
        return $base;
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
    function getIdaerobica_recuperacao() {
        return $this->idaerobica_recuperacao;
    }

    function getRecuperacao() {
        return $this->recuperacao;
    }

    function getVelocidade() {
        return $this->velocidade;
    }

    function getBpm() {
        return $this->bpm;
    }

    function getIdaerobica() {
        return $this->idaerobica;
    }

    function setIdaerobica_recuperacao($idaerobica_recuperacao) {
        $this->idaerobica_recuperacao = $idaerobica_recuperacao;
    }

    function setRecuperacao($recuperacao) {
        $this->recuperacao = $recuperacao;
    }

    function setVelocidade($velocidade) {
        $this->velocidade = $velocidade;
    }

    function setBpm($bpm) {
        $this->bpm = $bpm;
    }

    function setIdaerobica($idaerobica) {
        $this->idaerobica = $idaerobica;
    }


}
