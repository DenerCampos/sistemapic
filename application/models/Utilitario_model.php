<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Utilitario_model extends CI_Model {

    /**
     * Utilitario model
     * Programas uteis para o PIC, para acesso facil e atualizado.
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idutilitario; //identificados
    var $nome; //nome do programa
    var $descricao; //descrição do programa
    var $link; //link para download

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($nome, $descricao, $link){
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setLink($link);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("utilitario", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $descricao, $link){
        $dados = array(
            "nome" => $nome,
            "descricao" => $descricao,
            "link" => $link
        );
        $this->db->set($dados);
        $this->db->where('idutilitario', $id);
        $this->db->update('utilitario');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idutilitario', $id);
        $this->db->delete('utilitario');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM utilitario");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe programa cadastrado.
    public function verificaExiste($nome){
        $query = $this->db->query(
                "SELECT * "
                . "FROM utilitario "
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
                FROM utilitario 
                WHERE idutilitario = $id");
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
                . "FROM utilitario "
                . "WHERE nome = '$nome' AND "
                . "idutilitario <> $id");
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
                FROM utilitario 
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
        $utilitario = new Utilitario_model();
        //atribue valores do resultado
        $utilitario->setIdutilitario($r->idutilitario);
        $utilitario->setNome($r->nome);
        $utilitario->setDescricao($r->descricao);
        $utilitario->setLink($r->link);
        
        return $utilitario;
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
    function getIdutilitario() {
        return $this->idutilitario;
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

    function setIdutilitario($idutilitario) {
        $this->idutilitario = $idutilitario;
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
