<?php
class knl_extensions_dextrato_modelExtratoAgencia {
     private $id;
     private $id_banco;
     private $numero;
     private $descricao;
     private $telefone;

     public function __construct($id,$id_banco,$numero,$descricao,$telefone){
        $this->id = $id;
        $this->id_banco = $id_banco;
        $this->numero = $numero;
        $this->descricao = $descricao;
        $this->telefone = $telefone;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_extrato_agencia);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_extrato_agencia_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_banco() {
        return $this->id_banco;
     }

     public function get_numero() {
        return $this->numero;
     }

     public function get_descricao() {
        return $this->descricao;
     }

     public function get_telefone() {
        return $this->telefone;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_banco($id_banco) {
        $this->id_banco = $id_banco;
     }

     public function set_numero($numero) {
        $this->numero = $numero;
     }

     public function set_descricao($descricao) {
        $this->descricao = $descricao;
     }

     public function set_telefone($telefone) {
        $this->telefone = $telefone;
     }

}
?>
