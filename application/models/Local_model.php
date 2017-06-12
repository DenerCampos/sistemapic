<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_model extends CI_Model {

    /**
     * Local
     * 
     * @autor: Dener Junio
     * @descripiton: Locais do PIC 
     */
    
     /*------Atributos--------*/
    var $idlocal; //id do local dos caixas
    var $nome; //nome do local
    var $shape; //tipo de desenho
    var $coords; //pontos do desenho
    var $caixa; //0 para caixa e 1 para não caixa
    var $idestado; //ativo ou desativo

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    //Novo local
    public function newLocal($nome, $shape, $coords, $caixa){
        $this->setNome($nome);
        $this->setShape($shape);
        $this->setCoords($coords);
        $this->setCaixa($caixa); //0 para caixa e 1 para não caixa
        $this->setIdestado(1); //1=ativo, 2=desativo
    }
    
    //Inseri local
    public function addLocal(){
        $this->db->insert("local", $this);
    }
    
    //Atualiza
    public function atualizaLocal($id, $nome, $shape, $coords, $caixa, $idestado){
        $dados = array(
            "nome" => $nome,
            "shape" => $shape,
            "coords" => $coords,
            "caixa" => $caixa,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idlocal', $id);
        $this->db->update('local');
    }
    
    //Busca todas locais
    public function todosLocais($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM local 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM local");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos locais de caixas
    public function todosLocaisCaixas(){
        $query = $this->db->query(
                    "SELECT *
                    FROM local
                    WHERE idestado = 1 AND
                        caixa = 0");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca local por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM local
                WHERE idlocal = $id");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca local por nome
    public function buscaLocalNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM local
                WHERE nome = '$nome'");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe
    public function localExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM local 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se a ser atualizada ja existe no bd
    public function verificaLocalAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM local 
                WHERE idlocal != $id AND
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
                FROM local 
                WHERE idlocal = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa
    public function desativaLocal($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idlocal', $id);
        $this->db->update('local');
    }
    
    //Ativa area
    public function ativaLocal($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idlocal', $id);
        $this->db->update('local');
    }
    
    //Verifica se esta desativa
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM local 
                WHERE idlocal = $id AND
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
        return $this->db->count_all('local');
    }
    
    //Busca
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM local
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM local
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
        $local = new Local_model();
        //atribue valores do resultado
        $local->setIdlocal($r->idlocal);
        $local->setNome($r->nome);
        $local->setShape($r->shape);
        $local->setCoords($r->coords);
        $local->setCaixa($r->caixa);
        $local->setIdestado($r->idestado);
        
        return $local;
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
    function getIdlocal() {
        return $this->idlocal;
    }

    function getNome() {
        return $this->nome;
    }

    function getShape() {
        return $this->shape;
    }

    function getCoords() {
        return $this->coords;
    }

    function getCaixa() {
        return $this->caixa;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setShape($shape) {
        $this->shape = $shape;
    }

    function setCoords($coords) {
        $this->coords = $coords;
    }

    function setCaixa($caixa) {
        $this->caixa = $caixa;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }


}
