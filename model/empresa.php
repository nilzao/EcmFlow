<?php
class knl_model_empresa {
     private $id;
     private $fantasia;
     private $cnpj;

     public function __construct($id,$fantasia,$cnpj){
        $this->id = $id;
        $this->fantasia = $fantasia;
        $this->cnpj = $cnpj;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_empresa);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['empresa_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_fantasia() {
        return $this->fantasia;
     }

     public function get_cnpj() {
        return $this->cnpj;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_fantasia($fantasia) {
        $this->fantasia = $fantasia;
     }

     public function set_cnpj($cnpj) {
        $this->cnpj = $cnpj;
     }

}
?>
