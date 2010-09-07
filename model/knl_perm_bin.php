<?php
class knl_model_knl_perm_bin {
     private $id;
     private $permbin;
     private $descricao;

     public function __construct($id,$permbin,$descricao){
        $this->id = $id;
        $this->permbin = $permbin;
        $this->descricao = $descricao;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_knl_perm_bin);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['knl_perm_bin_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_permbin() {
        return $this->permbin;
     }

     public function get_descricao() {
        return $this->descricao;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_permbin($permbin) {
        $this->permbin = $permbin;
     }

     public function set_descricao($descricao) {
        $this->descricao = $descricao;
     }

}
?>
