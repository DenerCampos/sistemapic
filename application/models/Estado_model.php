<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends CI_Model {

    /**
     * Estado model
     * @description: Classe de estado das tuplas das tebelas
     *               Ex: Ativo, desativo
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idestado;
    var $nome;
    var $descricao;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo estado
    public function newEstado($nome, $descricao){
        $this->setNome($nome);
        $this->setLogin($descricao);
    }
    
    //Insere estado
    public function addEstado(){
        $this->db->insert("estado", $this);
    }
    
    //Atualiza estado
    public function atualizaEstado($id, $nome, $descricao){
        $dados = array(
            "nome" => $nome,
            "login" => $descricao
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idestado', $id);
        $this->db->update('estado');
    }
    
    //Remover estado
    public function removerEstado($id){
        $this->db->where('idestado', $id);
        $this->db->delete('estado');
    }
    
    //Busca estado por nome
    public function buscaNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM estado 
                WHERE nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca estado por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM estado 
                WHERE idestado = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca todos estados
    public function todosEstados(){
        $query = $this->db->query(
                "SELECT *
                FROM estado");
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
        $estado = new Estado_model();
        //atribue valores do resultado
        $estado->setIdestado($r->idestado);
        $estado->setNome($r->nome);
        $estado->setDescricao($r->descricao);
        
        return $estado;
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
    function getIdestado() {
        return $this->idestado;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descicao;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descicao) {
        $this->descicao = $descicao;
    }


}
