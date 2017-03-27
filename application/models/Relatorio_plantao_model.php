<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio_plantao_model extends CI_Model {

    /**
     * Area model
     * @description: Armazena informações dos relatorios emitidos nos plantãos
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idrelatorio_plantao;
    var $data;
    var $usuario;
    var $data_inicio;
    var $data_fim;
    var $ocorrencias;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia nova
    public function newPlantao($data, $usuario, $inicio, $fim, $ocorrencias){
        $this->setData($data);
        $this->setUsuario($usuario);
        $this->setData_inicio($inicio);
        $this->setData_fim($fim);
        $this->setOcorrencias($ocorrencias);
    }
    
    //Insere 
    public function addPlantao(){
        $this->db->insert("relatorio_plantao", $this);
        return $this->db->insert_id();
    }
       
    //Remover
    public function removerPlantao($id){
        $this->db->where('idrelatorio_plantao', $id);
        $this->db->delete('relatorio_plantao');
    }
    
    //Busca todas
    public function todasPlantoes($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM relatorio_plantao 
                ORDER BY idrelatorio_plantao DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM relatorio_plantao 
                    ORDER BY idrelatorio_plantao DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
            "SELECT *
            FROM relatorio_plantao
            WHERE idrelatorio_plantao = $id");
        //retorna objeto plantao
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por id
    public function existe($id){
        $query = $this->db->query(
            "SELECT *
            FROM relatorio_plantao
            WHERE idrelatorio_plantao = $id");
        //retorna objeto plantao
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca todos por data (data de emissão)
    public function todasPorBuscaData($data, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  relatorio_plantao
                WHERE date(data) = '$data'
                ORDER BY data DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  relatorio_plantao
                WHERE date(data) = '$data'
                ORDER BY data DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por usuário (nome)
    public function todasPorBuscaUsuario($usuario, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  relatorio_plantao
                WHERE usuario LIKE '%$usuario%'
                ORDER BY data DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  relatorio_plantao
                WHERE usuario LIKE '%$usuario%'
                ORDER BY data DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('relatorio_plantao');
    }    
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $plantao = new Relatorio_plantao_model();
        //atribue valores do resultado
        $plantao->setIdrelatorio_plantao($r->idrelatorio_plantao);
        $plantao->setData($r->data);
        $plantao->setUsuario($r->usuario);
        $plantao->setData_inicio($r->data_inicio);
        $plantao->setData_fim($r->data_fim);
        $plantao->setOcorrencias($r->ocorrencias);
        
        return $plantao;
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
    function getIdrelatorio_plantao() {
        return $this->idrelatorio_plantao;
    }

    function getData() {
        return $this->data;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getData_inicio() {
        return $this->data_inicio;
    }

    function getData_fim() {
        return $this->data_fim;
    }

    function getOcorrencias() {
        return $this->ocorrencias;
    }

    function setIdrelatorio_plantao($idrelatorio_plantao) {
        $this->idrelatorio_plantao = $idrelatorio_plantao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setData_inicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    function setData_fim($data_fim) {
        $this->data_fim = $data_fim;
    }

    function setOcorrencias($ocorrencias) {
        $this->ocorrencias = $ocorrencias;
    }
    
     //reduzir descrição de um plantão
    public function reduzirDescricao($descricao){
        $tamanho = strlen($descricao);
        if ($tamanho > 30){
            return substr($descricao, 0, 30)."...";
        } else {
            return $descricao;
        }
    }

}
