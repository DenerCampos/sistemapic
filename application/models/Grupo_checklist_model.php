<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_checklist_model extends CI_Model {

    /**
     * Grupo Checklis model
     * Grupo Checklist é o grupo que pertence cada equipamento do checklist
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idgrupo_checklist; //identificador
    var $nome; //nome do grupo
    var $idestado; // id do estado (ativo ou desativo)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($nome, $idestado){
        $this->setNome($nome);
        $this->setIdestado($idestado);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("grupo_checklist", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $idestado){
        $dados = array(
            "nome" => $nome,
            "idestado" => $idestado
        );
        $this->db->set($dados);
        $this->db->where('idgrupo_checklist', $id);
        $this->db->update('grupo_checklist');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idgrupo_checklist', $id);
        $this->db->delete('grupo_checklist');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('grupo_checklist');
    }
    
    //Busca todos com limete e order alfabetica
    public function todosGruposAdmin($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM grupo_checklist
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos com limete e order alfabetica
    public function todosGrupos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist
                WHERE idestado = 1
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM grupo_checklist
                    WHERE idestado = 1
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe grupo
    public function existe($nome){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE idgrupo_checklist = $id");
        //retorna objeto setor
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por nome
    public function buscaNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE nome = '$nome'");
        //retorna objeto setor
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se grupo a ser atualizado ja existe no bd
    public function verificaAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE idgrupo_checklist != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se esta desativo
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE idgrupo_checklist = $id AND
                    idestado = 2");
        //retorna objeto setor
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Ativa setor
    public function ativa($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idgrupo_checklist', $id);
        $this->db->update('grupo_checklist');
    }
    
    //Verifica se esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist 
                WHERE idgrupo_checklist = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se esta pode apagar do BD (dependencia)
    public function verificaRemover($id){
        $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist AS g
                INNER JOIN equipamento_checklist AS e
                    ON g.idgrupo_checklist = e.idgrupo_checklist
                WHERE g.idgrupo_checklist = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM grupo_checklist
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
        $obj = new Grupo_checklist_model();
        //atribue valores do resultado
        $obj->setIdgrupo_checklist($r->idgrupo_checklist);
        $obj->setNome($r->nome);
        $obj->setIdestado($r->idestado);
        
        return $obj;
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
    function getIdgrupo_checklist() {
        return $this->idgrupo_checklist;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdgrupo_checklist($idgrupo_checklist) {
        $this->idgrupo_checklist = $idgrupo_checklist;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }
}
