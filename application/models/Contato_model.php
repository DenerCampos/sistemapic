<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_model extends CI_Model {

    /**
     * Contato model
     * Contatos importantes para o PIC, fornecedores e prestadores de serviços.
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idcontato; //identificados
    var $empresa; //nome da empresa
    var $contato; //nome de algum contato
    var $tel; //telefone de contato
    var $obs; //informações adicionais.

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($empresa, $contato, $tel, $obs){
        $this->setEmpresa($empresa);
        $this->setContato($contato);
        $this->setTel($tel);
        $this->setObs($obs);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("contato", $this);
    }
    
    //Atualiza
    public function atualiza($id, $empresa, $contato, $tel, $obs){
        $dados = array(
            "empresa" => $empresa,
            "contato" => $contato,
            "tel" => $tel,
            "obs" => $obs
        );
        $this->db->set($dados);
        $this->db->where('idcontato', $id);
        $this->db->update('contato');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idcontato', $id);
        $this->db->delete('contato');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM contato 
                ORDER BY empresa");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe empresa cadastrada.
    public function verificaExiste($empresa){
        $query = $this->db->query(
                "SELECT * "
                . "FROM contato "
                . "WHERE empresa = '$empresa'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Verifica se existe empresa cadastrada ao atualizar.
    public function verificaExisteAtualiza($id, $empresa){
        $query = $this->db->query(
                "SELECT * "
                . "FROM contato "
                . "WHERE empresa = '$empresa' AND "
                . "idcontato <> $id");
        if ($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Buscar todos
    public function buscaId($id){
         $query = $this->db->query(
                "SELECT *
                FROM contato 
                WHERE idcontato = $id");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos
    public function busca($empresa){
         $query = $this->db->query(
                "SELECT *
                FROM contato 
                WHERE empresa LIKE '%$empresa%'");
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
        $contato = new Contato_model();
        //atribue valores do resultado
        $contato->setIdcontato($r->idcontato);
        $contato->setEmpresa($r->empresa);
        $contato->setContato($r->contato);
        $contato->setTel($r->tel);
        $contato->setObs($r->obs);
        
        return $contato;
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
    function getIdcontato() {
        return $this->idcontato;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getContato() {
        return $this->contato;
    }

    function getTel() {
        return $this->tel;
    }

    function getObs() {
        return $this->obs;
    }

    function setIdcontato($idcontato) {
        $this->idcontato = $idcontato;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }


}
