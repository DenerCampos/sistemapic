<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquina_model extends CI_Model {

    /**
     * Maquina: Informações sobre o ip, nome e local dos caixas
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idmaquina; //id da maquina
    var $nome; //nome da maquina
    var $ip; //ip da maquina
    var $login; //ultimo usuario logado na maquina
    var $descricao; //descrição, se necessario.
    var $idlocal; //local aonda a maquina se encontra no map pic
    var $idtipo; //tipo de maquina, ex: CAIXAS, SERVIDORES, USUARIO, IMPRESSORA.

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //instancia novo ip
    public function newMaquina($nome, $ip, $idlocal, $idtipo, $login = NULL, $descricao = NULL){
        $this->setNome($nome);
        $this->setIp($ip);
        if (isset($login)){
            $this->setLogin($login);
        }
        if (isset($descricao)){
            $this->setDescricao($descricao);
        }
        $this->setIdlocal($idlocal);
        $this->setIdtipo($idtipo);
    }
    
    //Insere maquina
    public function addMaquina(){
        $this->db->insert("maquina", $this);
    }

    //atualiza maquina
    public function atualizaMaquina($id, $nome, $ip, $login, $descricao, $idlocal, $idtipo){
        $dados = array(
            "nome" => $nome,
            "ip" => $ip,
            "login"=> $login,
            "descricao" => $descricao,
            "idlocal" => $idlocal,
            "idtipo" => $idtipo,
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmaquina', $id);
        $this->db->update('maquina');
    }
    
    //Remover maquina
    public function removerMaquina($id){
        $this->db->where('idmaquina', $id);
        $this->db->delete('maquina');
    }

    //Busca maquina por nome
    public function buscaMaquinaNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome = '$nome'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca maquina por caracter (CAIXA)
    public function buscaMaquinaTermo($termo){
        $query = $this->db->query(
                "SELECT maquina.idmaquina, maquina.nome, maquina.ip, maquina.login, maquina.descricao, maquina.idlocal, maquina.idtipo
                FROM maquina 
                INNER JOIN tipo
                ON maquina.idtipo = tipo.idtipo
                WHERE tipo.nome = 'Caixas' AND 
                        (maquina.nome like '%$termo%' OR maquina.ip like '%$termo%')
                ORDER BY maquina.nome, maquina.ip");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca maquina por id
    public function buscaMaquinaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE idmaquina = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca maquina por id
    public function existe($id){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE idmaquina = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return NULL;
        }
    }
    
    //Busca todos caixas
    public function buscaCaixas(){
        $query = $this->db->query(
                    "SELECT *
                    FROM maquina
                    WHERE idtipo = 2");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
       
    //Busca todas maquinas
    public function buscaTodas($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM maquina 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM maquina");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //verifica se maquina exite
    public function existeMaquina($nome){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome = '$nome'");
        if ($query->num_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('maquina');
    }
    
    //Verifica a ser atualizada ja existe no bd
    public function verificaMaquinaAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE idmaquina != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca maquinas
    public function busca($texto){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome LIKE '%$texto%' OR 
                    ip LIKE '%$texto%'");
        //retorna objeto usuario
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
        $maquina = new Maquina_model();
        //atribue valores do resultado
        $maquina->setIdmaquina($r->idmaquina);
        $maquina->setNome($r->nome);
        $maquina->setIp($r->ip);
        $maquina->setLogin($r->login);
        $maquina->setDescricao($r->descricao);
        $maquina->setIdlocal($r->idlocal);
        $maquina->setIdtipo($r->idtipo);
        
        return $maquina;
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
    function getIdmaquina() {
        return $this->idmaquina;
    }

    function getNome() {
        return $this->nome;
    }

    function getIp() {
        return $this->ip;
    }

    function getLogin() {
        return $this->login;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdlocal() {
        return $this->idlocal;
    }

    function getIdtipo() {
        return $this->idtipo;
    }

    function setIdmaquina($idmaquina) {
        $this->idmaquina = $idmaquina;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }

    function setIdtipo($idtipo) {
        $this->idtipo = $idtipo;
    }


}

