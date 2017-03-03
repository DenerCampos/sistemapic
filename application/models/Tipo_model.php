<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_model extends CI_Model {

    /**
     * Tipo
     * 
     * @autor: Dener Junio
     * @descripiton: Tipo de maquina do PIC (Ex: CAIXAS, USUARIOS, SERVIDORES, IMPRESSORA) 
     */
    
     /*------Atributos--------*/
    var $idtipo; //id do tipo de maquina
    var $nome; //nome do tipo
    var $idestado; //ativo ou desativo

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    //Novo
    public function newTipo($nome){
        $this->setNome($nome);
        $this->setIdestado(1); //ativo
    }
    
    //Inseri 
    public function addTipo(){
        $this->db->insert("tipo", $this);
    }

    //Atualiza
    public function atualizaTipo($id, $nome, $idestado){
        $dados = array(
            "nome" => $nome,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idtipo', $id);
        $this->db->update('tipo');
    }
    
    //Busca todas areas
    public function todosTipos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM tipo 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM tipo");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca tipo por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM tipo
                WHERE idtipo = $id");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca tipo por nome
    public function buscaTipoNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM tipo
                WHERE nome = '$nome'");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe
    public function tipoExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM tipo 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se a ser atualizada ja existe no bd
    public function verificaTipoAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM tipo 
                WHERE idtipo != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM tipo 
                WHERE idtipo = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa
    public function desativaTipo($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idtipo', $id);
        $this->db->update('tipo');
    }
    
    //Ativa area
    public function ativaTipo($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idtipo', $id);
        $this->db->update('tipo');
    }
    
    //Verifica se esta desativa
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM tipo 
                WHERE idtipo = $id AND
                    idestado = 2");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('tipo');
    }


    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $tipo = new Tipo_model();
        //atribue valores do resultado
        $tipo->setIdtipo($r->idtipo);
        $tipo->setNome($r->nome);
        $tipo->setIdestado($r->idestado);
        
        return $tipo;
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
    function getIdtipo() {
        return $this->idtipo;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdtipo($idtipo) {
        $this->idtipo = $idtipo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }


}
