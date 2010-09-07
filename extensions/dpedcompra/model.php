<?php
class knl_extensions_dpedcompra_model {
     private $id;
     private $id_doc;
     private $id_fornecedor;

     public function __construct($id,$id_doc,$id_fornecedor){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_fornecedor = $id_fornecedor;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_ped_compra);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_ped_compra_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc() {
        return $this->id_doc;
     }

     public function get_id_fornecedor() {
        return $this->id_fornecedor;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_id_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
     }

}
?>
