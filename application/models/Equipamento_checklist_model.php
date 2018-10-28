<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamento_checklist_model extends CI_Model {

    /**
     * Equipamento_checklis model
     * Equipamentos que pertencem a um determinado grupo que fazem parte da verificação para o checklist
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idequipamento_checklist; //identificador
    var $nome; //nome equipamento
    var $idgrupo_checklist; // id do grupo
    var $idestado; //id do estado (ativo/desativo)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($nome, $idgrupo_checklist, $idestado){
        $this->setNome($nome);
        $this->setIdgrupo_checklist($idgrupo_checklist);
        $this->setIdestado($idestado);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("equipamento_checklist", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $idgrupo_checklist, $idestado){
        $dados = array(
            "nome" => $nome,
            "idgrupo_checklist" => $idgrupo_checklist,
            "idestado" => $idestado
        );
        $this->db->set($dados);
        $this->db->where('idequipamento_checklist', $id);
        $this->db->update('equipamento_checklist');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idequipamento_checklist', $id);
        $this->db->delete('equipamento_checklist');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('equipamento_checklist');
    }
    
    //Busca todos com limete e order alfabetica
    public function todosEquipamentoAdmin($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM equipamento_checklist
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
    public function todosEquipamento($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist
                WHERE idestado = 1
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM equipamento_checklist
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
    
    //Busca todos com limete e order alfabetica
    public function todosEquipamentoPorGrupo($idGrupo, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist
                WHERE idestado = 1 AND
                    idgrupo_checklist = $idGrupo
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM equipamento_checklist
                    WHERE idestado = 1 AND
                        idgrupo_checklist = $idGrupo
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe 
    public function existe($nome){
        $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist 
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
                FROM equipamento_checklist 
                WHERE idequipamento_checklist = $id");
        //retorna objeto setor
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se equiapemto a ser atualizado ja existe no bd
    public function verificaAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist 
                WHERE idequipamento_checklist != $id AND
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
                FROM equipamento_checklist 
                WHERE idequipamento_checklist = $id AND
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
        $this->db->where('idequipamento_checklist', $id);
        $this->db->update('equipamento_checklist');
    }
    
    //Verifica se esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist 
                WHERE idequipamento_checklist = $id AND
                    idestado = 1");
        //retorna objeto 
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
                FROM equipamento_checklist AS e
                INNER JOIN item_checklist AS i
                    ON e.idequipamento_checklist = i.idequipamento_checklist
                WHERE e.idequipamento_checklist = $id");
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
                FROM equipamento_checklist
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM equipamento_checklist
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
        $obj = new Equipamento_checklist_model();
        //atribue valores do resultado
        $obj->setIdequipamento_checklist($r->idequipamento_checklist);
        $obj->setNome($r->nome);
        $obj->setIdgrupo_checklist($r->idgrupo_checklist);
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
    function getIdequipamento_checklist() {
        return $this->idequipamento_checklist;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdgrupo_checklist() {
        return $this->idgrupo_checklist;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdequipamento_checklist($idequipamento_checklist) {
        $this->idequipamento_checklist = $idequipamento_checklist;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdgrupo_checklist($idgrupo_checklist) {
        $this->idgrupo_checklist = $idgrupo_checklist;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }


}
