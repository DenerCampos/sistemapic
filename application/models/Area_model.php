<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    /**
     * Area model
     * @description: Classe de area de atendimentos no sistema de chamados do PIC
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idarea;
    var $nome;
    var $email;
    var $idestado;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia nova area
    public function newArea($nome, $email, $idestado){
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdestado($idestado);
    }
    
    //Insere area
    public function addArea(){
        $this->db->insert("area", $this);
    }
    
    //Atualiza area
    public function atualizaArea($id, $nome, $email, $idestado){
        $dados = array(
            "nome" => $nome,
            "email" => $email,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idarea', $id);
        $this->db->update('area');
    }
    
    //Remover area
    public function removerArea($id){
        $this->db->where('idarea', $id);
        $this->db->delete('area');
    }
    
    //Busca todas areas
    public function todasAreas($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE idestado = 1
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM area
                    WHERE idestado = 1");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas areas, mesmo as desativadas
    public function todasAreasAdm($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM area
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM area
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se area existe
    public function areaExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se area a ser atualizada ja existe no bd
    public function verificaAreaAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE idarea != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se area esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE idarea = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa area
    public function desativaArea($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idarea', $id);
        $this->db->update('area');
    }
    
    //Ativa area
    public function ativaArea($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idarea', $id);
        $this->db->update('area');
    }
    
    //Verifica se area esta desativa
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE idarea = $id AND
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
        return $this->db->count_all('area');
    }
    
    //Busca area por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE idarea = $id");
        //retorna objeto area
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por nome
    public function buscaPorNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM area 
                WHERE nome = '$nome'");
        //retorna objeto unidade
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
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
                FROM area
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM area
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
        $area = new Area_model();
        //atribue valores do resultado
        $area->setIdarea($r->idarea);
        $area->setNome($r->nome);
        $area->setEmail($r->email);
        $area->setIdestado($r->idestado);
        
        return $area;
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
    function getIdarea() {
        return $this->idarea;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdarea($idarea) {
        $this->idarea = $idarea;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }
}
