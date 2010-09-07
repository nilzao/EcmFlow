<?php
class knl_model_doc_carimbo {
     private $id;
     private $id_doc;
     private $id_carimbo;

     public function __construct($id,$id_doc,$id_carimbo){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_carimbo = $id_carimbo;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_carimbo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_carimbo_'.$k] = $this->$v();
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

     public function get_id_carimbo() {
        return $this->id_carimbo;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_id_carimbo($id_carimbo) {
        $this->id_carimbo = $id_carimbo;
     }

}
?>
