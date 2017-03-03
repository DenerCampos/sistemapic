<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidade_model extends CI_Model {

    /**
     * Unidade model
     * 
     * @autor: Dener Junio
     * @desc: Unidades do PIC (pic pampulha e cidade) CRUD
     */
    
     /*------Atributos--------*/
    var $idunidade;
    var $nome;
    var $idestado;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo unidade
    public function newUnidade($nome, $idestado){
        $this->setNome($nome);
        $this->setIdestado($idestado);
    }
    
    //Insere unidade
    public function addUnidade(){
        $this->db->insert("unidade", $this);
    }
    
    //Atualiza unidade
    public function atualizaUnidade($id, $nome, $idestado){
        $dados = array(
            "nome" => $nome,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idunidade', $id);
        $this->db->update('unidade');
    }
    
    //Verifica se unidade existe
    public function unidadeExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Remover unidade
    public function removerUnidade($id){
        $this->db->where('idunidade', $id);
        $this->db->delete('unidade');
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('unidade');
    }
    
    //Busca unidade por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE idunidade = $id");
        //retorna objeto unidade
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca unidade por nome
    public function buscaPorNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE nome = '$nome'");
        //retorna objeto unidade
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se unidade a ser atualizado ja existe no bd
    public function verificaUnidadeAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE idunidade != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se unidade esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE idunidade = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa unidade
    public function desativaUnidade($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idunidade', $id);
        $this->db->update('unidade');
    }
    
    //Ativa unidade
    public function ativaUnidade($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idunidade', $id);
        $this->db->update('unidade');
    }
    
    //Verifica se unidade esta desativo
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM unidade 
                WHERE idunidade = $id AND
                    idestado = 2");
        //retorna objeto unidade
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca todas areas
    public function todasUnidades($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM unidade 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM unidade");
        }
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
        $unidade = new Unidade_model();
        //atribue valores do resultado
        $unidade->setIdunidade($r->idunidade);
        $unidade->setNome($r->nome);
        $unidade->setIdestado($r->idestado);
        
        return $unidade;
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
    function getIdunidade() {
        return $this->idunidade;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }



}
