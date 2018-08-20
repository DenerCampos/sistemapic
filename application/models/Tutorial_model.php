<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial_model extends CI_Model {

    /**
     * Tutorial model
     * Tutoriais uteis para o PIC.
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idtutorial; //identificados
    var $nome; //nome do tutorial
    var $descricao; //descrição do tutorial
    var $link; //link para download

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo 
    public function novo($nome, $descricao, $link){
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setLink($link);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("tutorial", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $descricao, $link){
        $dados = array(
            "nome" => $nome,
            "descricao" => $descricao,
            "link" => $link
        );
        $this->db->set($dados);
        $this->db->where('idtutorial', $id);
        $this->db->update('tutorial');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idtutorial', $id);
        $this->db->delete('tutorial');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM tutorial");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe tutotial cadastrado.
    public function verificaExiste($nome){
        $query = $this->db->query(
                "SELECT * "
                . "FROM tutorial "
                . "WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Buscar por id
    public function buscaId($id){
         $query = $this->db->query(
                "SELECT *
                FROM tutorial 
                WHERE idtutorial = $id");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe nome cadastrado ao atualizar.
    public function verificaExisteAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT * "
                . "FROM tutorial "
                . "WHERE nome = '$nome' AND "
                . "idtutorial <> $id");
        if ($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Buscar todos
    public function busca($nome){
         $query = $this->db->query(
                "SELECT *
                FROM tutorial 
                WHERE nome LIKE '%$nome%'");
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
        $tutorial = new Tutorial_model();
        //atribue valores do resultado
        $tutorial->setIdtutorial($r->idtutorial);
        $tutorial->setNome($r->nome);
        $tutorial->setDescricao($r->descricao);
        $tutorial->setLink($r->link);
        
        return $tutorial;
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
    function getIdtutorial() {
        return $this->idtutorial;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLink() {
        return $this->link;
    }

    function setIdtutorial($idtutorial) {
        $this->idtutorial = $idtutorial;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLink($link) {
        $this->link = $link;
    }
}
