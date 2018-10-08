<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao_model extends CI_Model {

    /**
     * Alaviação
     * Registro das avaliações da academia do pic
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idavaliacao; //identificados
    var $data; //data da avaliação
    var $tabagista; //fuma
    var $etilista; //bebe
    var $atividade_fisica; //exercicios que pratica
    var $idaluno; //identificador do aluno

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($data, $tabagista, $etilista, $atividade_fisica, $idaluno){
        $this->setData($data);
        $this->setTabagista($tabagista);
        $this->setEtilista($etilista);
        $this->setAtividade_fisica($atividade_fisica);
        $this->setIdaluno($idaluno);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("avaliacao", $this);
        return 	$this->db->insert_id();
    }
    
    //Atualiza
    public function atualiza($id, $data, $tabagista, $etilista, $atividade_fisica){
        $dados = array(
            "data" => $data,
            "tabagista" => $tabagista,
            "etilista" => $etilista,
            "atividade_fisica" => $atividade_fisica
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $id);
        $this->db->update('avaliacao');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idavaliacao', $id);
        $this->db->delete('avaliacao');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar ultimos 10
    public function buscaUltimos($limite = 10, $ponteiro = 0){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao
                ORDER BY idavaliacao DESC
                LIMIT $ponteiro, $limite"); 
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar ultima avaliacão do aluno
    public function buscaUltimaAvaliacaoAluno($idaluno){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao
                WHERE idaluno = $idaluno
                ORDER BY idavaliacao DESC
                LIMIT 0, 1"); 
        //retorna objeto 
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos por aluno
    public function buscaTodasPorAluno($idaluno){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao
                WHERE idaluno = $idaluno
                ORDER BY data"); 
        //retorna objeto 
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar por id
    public function buscaPorId($idavaliacao){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao
                WHERE idavaliacao = $idavaliacao"); 
        //retorna objeto 
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Buscar por id
    public function existeAvaliacao($idavaliacao){
         $query = $this->db->query(
                "SELECT *
                FROM avaliacao
                WHERE idavaliacao = $idavaliacao"); 
        //retorna objeto 
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca
//    public function busca($texto, $limite = null){
//        //Seleção
//        if (isset($limite)){
//            $query = $this->db->query(
//                "SELECT *
//                FROM avaliacao
//                WHERE equipamento LIKE '%$texto%' OR
//                    modelo LIKE '%$texto%' OR
//                    patrimonio LIKE '%$texto%' OR
//                    serie LIKE '%$texto%'
//                ORDER BY idpatrimonio ASC
//                LIMIT $limite");
//        } else {
//            $query = $this->db->query(
//                "SELECT *
//                FROM patrimonio
//                WHERE equipamento LIKE '%$texto%' OR
//                    modelo LIKE '%$texto%' OR
//                    patrimonio LIKE '%$texto%' OR
//                    serie LIKE '%$texto%'
//                ORDER BY idpatrimonio ASC");
//        }
//        
//        if ($query->num_rows() > 0){
//            return $this->getObjByResult($query->result());
//        } else{
//            return NULL;
//        }
//    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $avaliacao = new Avaliacao_model();
        //atribue valores do resultado
        $avaliacao->setIdavaliacao($r->idavaliacao);
        $avaliacao->setData($r->data);
        $avaliacao->setTabagista($r->tabagista);
        $avaliacao->setEtilista($r->etilista);
        $avaliacao->setAtividade_fisica($r->atividade_fisica);
        $avaliacao->setIdaluno($r->idaluno);
        
        return $avaliacao;
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
    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function getData() {
        return $this->data;
    }

    function getTabagista() {
        return $this->tabagista;
    }

    function getEtilista() {
        return $this->etilista;
    }

    function getAtividade_fisica() {
        return $this->atividade_fisica;
    }

    function getIdaluno() {
        return $this->idaluno;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setTabagista($tabagista) {
        $this->tabagista = $tabagista;
    }

    function setEtilista($etilista) {
        $this->etilista = $etilista;
    }

    function setAtividade_fisica($atividade_fisica) {
        $this->atividade_fisica = $atividade_fisica;
    }

    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
    }


}
