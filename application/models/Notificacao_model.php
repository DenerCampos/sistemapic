<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacao_model extends CI_Model {

    /**
     * Notificação model
     * Modelo para acesso ao banco de dados notificacao. Notificações dos usuarios no helpdesk do sistema PIC
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idnotificacao; //id
    var $remetente; //id do usuario que enviou a notificação
    var $destinatario; //id do usuario que recebe a notificação
    var $data_envio; //data de envio
    var $data_lida; //data que o usuario leu a notificação
    var $titulo; //titulo da mensagem
    var $mensagem; //mensagem que o usuario ira receber
    var $entregue; //boolean - 0 não entregue e 1 entregue
    var $lida; //boolean - 0 não lida e 1 lida
    var $link; //link para acesso ao helpdesk

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Novo
    public function novo($remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link){
        $this->setRemetente($remetente); 
        $this->setDestinatario($destinatario);
        $this->setData_envio($data_envio);
        $this->setData_lida($data_lida); //permite null
        $this->setTitulo($titulo);
        $this->setMensagem($mensagem);
        $this->setEntregue($entregue); //permite null
        $this->setLida($lida); //permite null
        $this->setLink($link); //permite null
    }
    
    //Adiciona novo
    public function adiciona(){
        $this->db->insert("notificacao", $this);
    }
    
    //Atualiza
    public function atualiza($id, $remetente, $destinatario, $data_envio, $data_lida, $titulo, $mensagem, $entregue, $lida, $link){
        $dados = array(
            "remetente" => $remetente, 
            "destinatario" => $destinatario,
            "data_envio" => $data_envio,
            "data_lida" => $data_lida,
            "titulo" => $titulo,
            "mensagem" => $mensagem,
            "entregue" => $entregue,
            "lida" => $lida,
            "link" => $link
        );
        $this->db->set($dados);
        $this->db->where('idnotificacao', $id);
        $this->db->update('notificacao');
    }
    
    //Lida - atualização lida
    public function lida($destinatario){
        $dados = array(
            "destinatario" => $destinatario,
            "data_lida" => date('Y-m-d H:i:s'),
            "lida" => TRUE
        );
        $this->db->set($dados);
        $this->db->where('destinatario', $destinatario);
        $this->db->update('notificacao');
    }
    
    //Entregue - atualização entregue
    public function entregue($destinatario){
        $dados = array(
            "destinatario" => $destinatario,
            "entregue" => TRUE
        );
        $this->db->set($dados);
        $this->db->where('destinatario', $destinatario);
        $this->db->update('notificacao');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idnotificacao', $id);
        $this->db->delete('notificacao');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM notificacao");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos novos (não lidos)
    public function todosNaoLidos($destinatario){
         $query = $this->db->query(
                "SELECT *
                FROM notificacao 
                WHERE destinatario = $destinatario AND
                    lida = false 
                ORDER BY data_envio DESC");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos já lidos (lidos)
    public function todosLidos($destinatario){
         $query = $this->db->query(
                "SELECT *
                FROM notificacao 
                WHERE destinatario = $destinatario AND
                    lida = true 
                ORDER BY data_envio DESC
                LIMIT 0,15");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar por usuario (id) (destinatario) não lida
    public function contarPorIdDestinatario($id){
         $query = $this->db->query(
                "SELECT *
                FROM notificacao
                WHERE destinatario = $id AND 
                    lida = false");
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    //Contar por usuario (id) (remetente)
    public function contarPorIdRemetente($id){
         $query = $this->db->query(
                "SELECT *
                FROM notificacao
                WHERE remetente = $id");
        //$total = $query->num_rows();
        return $query->num_rows();
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $notificacao = new Notificacao_model();
        //atribue valores do resultado
        $notificacao->setIdnotificacao($r->idnotificacao);
        $notificacao->setRemetente($r->remetente);
        $notificacao->setDestinatario($r->destinatario);
        $notificacao->setData_envio($r->data_envio);
        $notificacao->setData_lida($r->data_lida);
        $notificacao->setMensagem($r->mensagem);
        $notificacao->setTitulo($r->titulo);
        $notificacao->setEntregue($r->entregue);
        $notificacao->setLida($r->lida);
        $notificacao->setLink($r->link);
        
        return $notificacao;
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
    function getIdnotificacao() {
        return $this->idnotificacao;
    }

    function getRemetente() {
        return $this->remetente;
    }

    function getDestinatario() {
        return $this->destinatario;
    }

    function getData_envio() {
        return $this->data_envio;
    }

    function getData_lida() {
        return $this->data_lida;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function getEntregue() {
        return $this->entregue;
    }

    function getLida() {
        return $this->lida;
    }

    function getLink() {
        return $this->link;
    }

    function setIdnotificacao($idnotificacao) {
        $this->idnotificacao = $idnotificacao;
    }

    function setRemetente($remetente) {
        $this->remetente = $remetente;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    function setData_envio($data_envio) {
        $this->data_envio = $data_envio;
    }

    function setData_lida($data_lida) {
        $this->data_lida = $data_lida;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function setEntregue($entregue) {
        $this->entregue = $entregue;
    }

    function setLida($lida) {
        $this->lida = $lida;
    }

    function setLink($link) {
        $this->link = $link;
    }

 
}
