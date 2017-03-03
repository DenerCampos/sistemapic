<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_conf_model extends CI_Model {

    /**
     * Email configuração model
     * 
     * @autor: Dener Junio
     * @desc: Configuração do envio de e-mails
     */
    
     /*------Atributos--------*/
    var $idemail_conf;
    var $useragent; //Usuario
    var $protocol; //tipo do protocolo: mail, sendmail, or smtp
    var $smtp_host; //Endereço do servidor SMTP.
    var $smtp_user; //SMTP usuário.
    var $smtp_pass; //Senha SMTP
    var $smtp_port; //Porta SMTP.
    var $smtp_crypto; //Encryption SMTP TLS ou SSL
    var $idestado;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo
    public function newEmailConf($useragent, $protocol, $smtp_host, $smtp_user, $smtp_pass, $smtp_port, $smtp_crypto, $idestado){
        $this->setUseragent($useragent);
        $this->setProtocol($protocol);
        $this->setSmtp_host($smtp_host);
        $this->setSmtp_user($smtp_user);
        $this->setSmtp_pass($smtp_pass);
        $this->setSmtp_port($smtp_port);
        $this->setSmtp_crypto($smtp_crypto);
        $this->setIdestado($idestado);
    }
    
    //Insere
    public function addEmailConf(){
        $this->db->insert("email_conf", $this);
    }
    
    //Atualiza
    public function atualizaEmailConf($id, $useragent, $protocol, $smtp_host, $smtp_user, $smtp_pass, $smtp_port, $smtp_crypto, $idestado){
        $dados = array(
            "useragent" => $useragent,
            "protocol" => $protocol,
            "smtp_host" => $smtp_host,
            "smtp_user" => $smtp_user,
            "smtp_pass" => $smtp_pass,
            "smtp_port" => $smtp_port,
            "smtp_crypto" => $smtp_crypto,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idemail_conf', $id);
        $this->db->update('email_conf');
    }
    
    //Verifica se existe
    public function emailConfExiste($useragent){
        $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                WHERE useragent = '$useragent'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Remover
    public function removerEmailConf($id){
        $this->db->where('email_conf', $id);
        $this->db->delete('email_conf');
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('email_conf');
    }
    
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                WHERE idemail_conf = $id");
        //retorna objeto setor
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se atualizado ja existe no bd
    public function verificaEmailConfAtualiza($id, $useragent){
        $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                WHERE idemail_conf != $id AND
                    useragent = '$useragent'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca todos
    public function todosEmailConf($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                ORDER BY useragent
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM email_conf");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                WHERE idemail_conf = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa
    public function desativaEmailConf($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idemail_conf', $id);
        $this->db->update('email_conf');
    }
    
    //Ativa
    public function ativaEmailConf($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idemail_conf', $id);
        $this->db->update('email_conf');
    }
    
    //Verifica se esta desativa
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM email_conf 
                WHERE idemail_conf = $id AND
                    idestado = 2");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $email = new Email_conf_model();
        //atribue valores do resultado
        $email->setIdemail_conf($r->idemail_conf);
        $email->setUseragent($r->useragent);
        $email->setProtocol($r->protocol);
        $email->setSmtp_host($r->smtp_host);
        $email->setSmtp_user($r->smtp_user);
        $email->setSmtp_pass($r->smtp_pass);
        $email->setSmtp_port($r->smtp_port);
        $email->setSmtp_crypto($r->smtp_crypto);
        $email->setIdestado($r->idestado);
        
        return $email;
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
    function getIdemail_conf() {
        return $this->idemail_conf;
    }

    function getUseragent() {
        return $this->useragent;
    }

    function getProtocol() {
        return $this->protocol;
    }

    function getSmtp_host() {
        return $this->smtp_host;
    }

    function getSmtp_user() {
        return $this->smtp_user;
    }

    function getSmtp_pass() {
        return $this->smtp_pass;
    }

    function getSmtp_port() {
        return $this->smtp_port;
    }

    function getSmtp_crypto() {
        return $this->smtp_crypto;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdemail_conf($idemail_conf) {
        $this->idemail_conf = $idemail_conf;
    }

    function setUseragent($useragent) {
        $this->useragent = $useragent;
    }

    function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    function setSmtp_host($smtp_host) {
        $this->smtp_host = $smtp_host;
    }

    function setSmtp_user($smtp_user) {
        $this->smtp_user = $smtp_user;
    }

    function setSmtp_pass($smtp_pass) {
        $this->smtp_pass = $smtp_pass;
    }

    function setSmtp_port($smtp_port) {
        $this->smtp_port = $smtp_port;
    }

    function setSmtp_crypto($smtp_crypto) {
        $this->smtp_crypto = $smtp_crypto;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }



}
