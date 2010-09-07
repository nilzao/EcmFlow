<?php
class knl_extensions_dextrato_modelExtratoContaVw {
     private $id;
     private $num_conta;
     private $num_agencia;
     private $nome_banco;
     private $nome_empresa;

     public function __construct($id,$num_conta,$num_agencia,$nome_banco,$nome_empresa){
        $this->id = $id;
        $this->num_conta = $num_conta;
        $this->num_agencia = $num_agencia;
        $this->nome_banco = $nome_banco;
        $this->nome_empresa = $nome_empresa;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_vw_conta);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['vw_conta_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_num_conta() {
        return $this->num_conta;
     }

     public function get_num_agencia() {
        return $this->num_agencia;
     }

     public function get_nome_banco() {
        return $this->nome_banco;
     }

     public function get_nome_empresa() {
        return $this->nome_empresa;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_num_conta($num_conta) {
        $this->num_conta = $num_conta;
     }

     public function set_num_agencia($num_agencia) {
        $this->num_agencia = $num_agencia;
     }

     public function set_nome_banco($nome_banco) {
        $this->nome_banco = $nome_banco;
     }

     public function set_nome_empresa($nome_empresa) {
        $this->nome_empresa = $nome_empresa;
     }

}
?>
