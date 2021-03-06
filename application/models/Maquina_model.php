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
    var $sistema; //sistema operacional da maquina, puxado via arquivo em \\jaguar\Inventario ou adicionado manualmente
    var $idlocal; //local aonda a maquina se encontra no map pic
    var $idtipo; //tipo de maquina, ex: CAIXAS, SERVIDORES, USUARIO, IMPRESSORA.
    var $idunidade; //unidade em que se encontra a maquina

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //instancia novo ip
    public function newMaquina($nome, $ip, $idlocal, $idtipo, $idunidade, $login = NULL, $descricao = NULL, $sistema = NULL){
        $this->setNome($nome);
        $this->setIp($ip);
        if (isset($login)){
            $this->setLogin($login);
        }
        if (isset($descricao)){
            $this->setDescricao($descricao);
        }
        if (isset($sistema)){
            $this->setSistema($sistema);
        }
        $this->setIdlocal($idlocal);
        $this->setIdtipo($idtipo);
        $this->setIdunidade($idunidade);
    }
    
    //Insere maquina
    public function addMaquina(){
        $this->db->insert("maquina", $this);
    }

    //atualiza maquina
    public function atualizaMaquina($id, $nome, $login, $descricao, $sistema, $idlocal, $idtipo, $idunidade){
        $dados = array(
            "nome" => $nome,
            "login"=> $login,
            "descricao" => $descricao,
            "sistema" => $sistema,
            "idlocal" => $idlocal,
            "idtipo" => $idtipo,
            "idunidade" => $idunidade,
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmaquina', $id);
        $this->db->update('maquina');
    }
    
    //atualiza maquina arquivo txt (somente IP dos caixas)
    public function atualizaMaquinaArquivo($id, $nome, $login, $descricao){
        $dados = array(
            "nome" => $nome,
            "login"=> $login,
            "descricao" => $descricao,
            "idtipo" => 2,
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmaquina', $id);
        $this->db->update('maquina');
    }
    
    //atualiza sistema operacional da maquina (via arquivo)
    public function atualizaSoftware($id, $sistema){
        $dados = array(
            "sistema" => $sistema
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmaquina', $id);
        $this->db->update('maquina');
    }
    
    //cria maquina
    public function criaMaquina($ip, $nome, $login, $descricao, $sistema, $idlocal, $idtipo, $idunidade){
        $dados = array(
            "nome" => $nome,
            "login"=> $login,
            "descricao" => $descricao,
            "sistema" => $sistema,
            "idlocal" => $idlocal,
            "idtipo" => $idtipo,
            "idunidade" => $idunidade,
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('ip', $ip);
        $this->db->update('maquina');
    }
    
    //liberar maquina
    public function LiberaMaquina($id, $idlocal, $idtipo){
        $dados = array(
            "nome" => "LIVRE",
            "login" => NULL,
            "descricao" => NULL,
            "sistema" => NULL,
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
    
    //Busca maquina por ip -- arquito txt
    public function buscaMaquinaIpArquivo($ip){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE ip = '$ip'");
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
                "SELECT maquina.idmaquina, maquina.nome, maquina.ip, maquina.login, maquina.descricao, maquina.sistema, maquina.idlocal, maquina.idtipo, maquina.idunidade
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
                ORDER BY ip 
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM maquina 
                    ORDER BY ip ");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas maquinas
    public function buscaTodasPorUnidade($unidade, $limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE idunidade = $unidade
                ORDER BY nome 
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM maquina
                    WHERE idunidade = $unidade
                    ORDER BY nome ");
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
    
    //verifica se IP exite -- Arquivo TXT
    public function existeIpArquivo($ip){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE ip = '$ip'");
        if ($query->num_rows() == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //verifica se ip esta livre
    public function verificaMaquinaLivre($ip){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE ip = '$ip' AND 
                    nome = 'LIVRE'");
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
    
    //Busca maquinas
    public function buscaPorUnidade($unidade, $texto){
        $query = $this->db->query(
                "SELECT *
                FROM (SELECT * 
                        FROM maquina
                        WHERE idunidade = $unidade) AS m 
                WHERE m.nome LIKE '%$texto%' OR 
                    m.ip LIKE '%$texto%'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca maquinas
    public function buscaNovoIp(){
        $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome = 'LIVRE'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca
    public function buscar($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome LIKE '%$texto%' OR 
                    ip LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM maquina 
                WHERE nome LIKE '%$texto%' OR 
                    ip LIKE '%$texto%'
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
        $maquina = new Maquina_model();
        //atribue valores do resultado
        $maquina->setIdmaquina($r->idmaquina);
        $maquina->setNome($r->nome);
        $maquina->setIp($r->ip);
        $maquina->setLogin($r->login);
        $maquina->setDescricao($r->descricao);
        $maquina->setSistema($r->sistema);
        $maquina->setIdlocal($r->idlocal);
        $maquina->setIdtipo($r->idtipo);
        $maquina->setIdunidade($r->idunidade);
        
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

    function getSistema() {
        return $this->sistema;
    }

    function getIdlocal() {
        return $this->idlocal;
    }

    function getIdtipo() {
        return $this->idtipo;
    }

    function getIdunidade() {
        return $this->idunidade;
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

    function setSistema($sistema) {
        $this->sistema = $sistema;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }

    function setIdtipo($idtipo) {
        $this->idtipo = $idtipo;
    }

    function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }


}

