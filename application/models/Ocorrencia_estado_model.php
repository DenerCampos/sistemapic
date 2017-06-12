<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_estado_model extends CI_Model {

    /**
     * Ocorrencia estado model
     * 
     * @autor: Dener Junio
     * @desc: Estado da ocorrencia. em aberto, em atendimento e fechada
     */
    
     /*------Atributos--------*/
    var $idocorrencia_estado;
    var $nome;
    var $descricao;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo ocorrencia_estado
    public function newEstado($nome, $descricao){
        $this->setNome($nome);
        $this->setDescricao($descricao);
    }
    
    //Insere ocorrencia_estado
    public function addEstado(){
        $this->db->insert("ocorrencia_estado", $this);
    }
    
    //Atualiza ocorrencia_estado
    public function atualizaEstado($id, $nome, $descricao){
        $dados = array(
            "nome" => $nome,
            "descricao" => $descricao
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idocorrencia_estado', $id);
        $this->db->update('ocorrencia_estado');
    }
    
    //Verifica se ocorrencia_estado existe
    public function estadoExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Remover ocorrencia_estado
    public function removerEstado($id){
        $this->db->where('idocorrencia_estado', $id);
        $this->db->delete('ocorrencia_estado');
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('ocorrencia_estado');
    }
    
    //Busca ocorrencia_estado por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado 
                WHERE idocorrencia_estado = $id");
        //retorna objeto setor
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se ocorrencia_estado a ser atualizado ja existe no bd
    public function verificaEstadoAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado 
                WHERE idocorrencia_estado != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca todos problemas
    public function todosEstados($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM ocorrencia_estado");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM ocorrencia_estado
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC");
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
        $ocorrencia_estado = new Ocorrencia_estado_model();
        //atribue valores do resultado
        $ocorrencia_estado->setIdocorrencia_estado($r->idocorrencia_estado);
        $ocorrencia_estado->setNome($r->nome);
        $ocorrencia_estado->setDescricao($r->descricao);
        
        return $ocorrencia_estado;
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
    function getIdocorrencia_estado() {
        return $this->idocorrencia_estado;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdocorrencia_estado($idocorrencia_estado) {
        $this->idocorrencia_estado = $idocorrencia_estado;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }



}
