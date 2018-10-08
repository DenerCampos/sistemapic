<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso_model extends CI_Model {

    /**
     * Acesso: Permissão de acesso ao modulos do sistema pic
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idacesso; //identificador
    var $ocorrencia; //acesso ao helpdesk
    var $admin; //acesso a administração
    var $caixa; //acesso ao mapa de caixas
    var $manutencao; //acesso a manutenção de equipamentos
    var $relatorio; //acesso aos relatorios
    var $usuario; //acesso ao menu usuarios
    var $equipamento; //acesso aos equipamentos do pic
    var $avaliacao; //acesso ao sitema de avaliação fisica
    var $utilitario; //acesso a parte de programas e contatos (somento o TI)
    var $patrimonio; //acesso a parte do patrimonio
    var $idusuario; //identificador do usuario

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Novo acesso
    public function novo($ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $patrimonio, $idusuario){
        $this->setOcorrencia($ocorrencia);
        $this->setAdmin($admin);
        $this->setCaixa($caixa);
        $this->setManutencao($manutencao);
        $this->setRelatorio($relatorio);
        $this->setUsuario($usuario);
        $this->setEquipamento($equipamento);
        $this->setAvaliacao($avaliacao);
        $this->setUtilitario($utilitario);
        $this->setPatrimonio($patrimonio);
        $this->setIdusuario($idusuario);
    }
    
    //Adiciona novo acesso
    public function adiciona(){
        $this->db->insert("acesso", $this);
    }
    
    //Atualiza acesso
    public function atualiza($id, $ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $patrimonio, $idusuario){
        $dados = array(
            "ocorrencia" => $ocorrencia,
            "admin" => $admin,
            "caixa" => $caixa,
            "manutencao" => $manutencao,
            "relatorio" => $relatorio,
            "usuario" => $usuario,
            "equipamento" => $equipamento,
            "avaliacao" => $avaliacao,
            "utilitario" => $utilitario,
            "patrimonio" => $patrimonio,
            "idusuario" => $idusuario
        );
        $this->db->set($dados);
        $this->db->where('idacesso', $id);
        $this->db->update('acesso');
    }
    
    //Remove acesso
    public function remove($id){
        $this->db->where('idacesso', $id);
        $this->db->delete('acesso');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM acesso");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //busca por id usuario
    public function buscaIdUsuario($id){
        $query = $this->db->query(
                "SELECT *
                FROM acesso 
                WHERE idusuario = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }


    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $acesso = new Acesso_model();
        //atribue valores do resultado
        $acesso->setIdacesso($r->idacesso);
        $acesso->setOcorrencia($r->ocorrencia);
        $acesso->setAdmin($r->admin);
        $acesso->setCaixa($r->caixa);
        $acesso->setManutencao($r->manutencao);
        $acesso->setRelatorio($r->relatorio);
        $acesso->setUsuario($r->usuario);
        $acesso->setEquipamento($r->equipamento);
        $acesso->setAvaliacao($r->avaliacao);
        $acesso->setUtilitario($r->utilitario);
        $acesso->setPatrimonio($r->patrimonio);
        $acesso->setIdusuario($r->idusuario);
        
        return $acesso;
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
    function getIdacesso() {
        return $this->idacesso;
    }

    function getOcorrencia() {
        return $this->ocorrencia;
    }

    function getAdmin() {
        return $this->admin;
    }

    function getCaixa() {
        return $this->caixa;
    }

    function getManutencao() {
        return $this->manutencao;
    }

    function getRelatorio() {
        return $this->relatorio;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEquipamento() {
        return $this->equipamento;
    }

    function getAvaliacao() {
        return $this->avaliacao;
    }

    function getUtilitario() {
        return $this->utilitario;
    }

    function getPatrimonio() {
        return $this->patrimonio;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setIdacesso($idacesso) {
        $this->idacesso = $idacesso;
    }

    function setOcorrencia($ocorrencia) {
        $this->ocorrencia = $ocorrencia;
    }

    function setAdmin($admin) {
        $this->admin = $admin;
    }

    function setCaixa($caixa) {
        $this->caixa = $caixa;
    }

    function setManutencao($manutencao) {
        $this->manutencao = $manutencao;
    }

    function setRelatorio($relatorio) {
        $this->relatorio = $relatorio;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEquipamento($equipamento) {
        $this->equipamento = $equipamento;
    }

    function setAvaliacao($avaliacao) {
        $this->avaliacao = $avaliacao;
    }

    function setUtilitario($utilitario) {
        $this->utilitario = $utilitario;
    }

    function setPatrimonio($patrimonio) {
        $this->patrimonio = $patrimonio;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }


}
