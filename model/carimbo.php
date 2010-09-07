<?php
class knl_model_carimbo {
     private $id;
     private $descricao;
     private $cfop;

     public function __construct($id,$descricao,$cfop){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->cfop = $cfop;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_carimbo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['carimbo_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_descricao() {
        return $this->descricao;
     }

     public function get_cfop() {
        return $this->cfop;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_descricao($descricao) {
        $this->descricao = $descricao;
     }

     public function set_cfop($cfop) {
        $this->cfop = $cfop;
     }

}
?>
