<?php
class knl_extensions_cadastronf_cotModel {
     private $id;
     private $nome;

     public function __construct($id,$nome){
        $this->id = $id;
        $this->nome = $nome;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_cotacao_cli);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_cotacao_cli_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_nome() {
        return $this->nome;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_nome($nome) {
        $this->nome = $nome;
     }

}
?>
