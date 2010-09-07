<?php
class knl_extensions_dextrato_modelExtratoBanco {
     private $id;
     private $numero;
     private $nome;

     public function __construct($id,$numero,$nome){
        $this->id = $id;
        $this->numero = $numero;
        $this->nome = $nome;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_extrato_banco);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_extrato_banco_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_numero() {
        return $this->numero;
     }

     public function get_nome() {
        return $this->nome;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_numero($numero) {
        $this->numero = $numero;
     }

     public function set_nome($nome) {
        $this->nome = $nome;
     }

}
?>
