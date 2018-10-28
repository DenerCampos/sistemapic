<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item_checklist_model extends CI_Model {

    /**
     * Item_checklist model
     * Item_checklist são os itens que compoem os checklis, é a lista de equipamentos do checklist
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $iditem_checklist; //identificador
    var $concluido; //se foi feito ou não
    var $observacao; //alguma observação sobre o item
    var $idequipamento_checklist; //identificador do equipamento
    var $idchecklist; //identificador do checklist

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($concluido, $observacao, $idequipamento_checklist, $idchecklist){
        $this->setConcluido($concluido);
        $this->setObservacao($observacao);
        $this->setIdequipamento_checklist($idequipamento_checklist);
        $this->setIdchecklist($idchecklist);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("item_checklist", $this);
    }
    
    //Atualiza
    public function atualiza($id, $concluido, $observacao, $idequipamento_checklist, $idchecklist){
        $dados = array(
            "concluido" => $concluido,
            "observacao" => $observacao,
            "idequipamento_checklist" => $idequipamento_checklist,
            "idchecklist" => $idchecklist
        );
        $this->db->set($dados);
        $this->db->where('iditem_checklist', $id);
        $this->db->update('item_checklist');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('iditem_checklist', $id);
        $this->db->delete('item_checklist');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM item_checklist");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos por checklist
    public function todosPorChecklist($idchecklist){
         $query = $this->db->query(
                "SELECT *
                FROM item_checklist
                WHERE idchecklist = $idchecklist");
        //retorna objeto
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
        $obj = new Item_checklist_model();
        //atribue valores do resultado
        $obj->setIditem_checklist($r->iditem_checklist);
        $obj->setConcluido($r->concluido);
        $obj->setObservacao($r->observacao);
        $obj->setIdequipamento_checklist($r->idequipamento_checklist);
        $obj->setIdchecklist($r->idchecklist);
        
        return $obj;
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
    function getIditem_checklist() {
        return $this->iditem_checklist;
    }

    function getConcluido() {
        return $this->concluido;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getIdequipamento_checklist() {
        return $this->idequipamento_checklist;
    }

    function getIdchecklist() {
        return $this->idchecklist;
    }

    function setIditem_checklist($iditem_checklist) {
        $this->iditem_checklist = $iditem_checklist;
    }

    function setConcluido($concluido) {
        $this->concluido = $concluido;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setIdequipamento_checklist($idequipamento_checklist) {
        $this->idequipamento_checklist = $idequipamento_checklist;
    }

    function setIdchecklist($idchecklist) {
        $this->idchecklist = $idchecklist;
    }


}
