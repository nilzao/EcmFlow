<?php
class knl_model_doc_sub_tipo_regra_pend {
     private $id;
     private $id_doc_pendencia_tipo;
     private $id_doc_pendencia_tipo2;
     private $id_doc_sub_tipo;
     private $id_knl_usuario;
     private $id_knl_grupo;

     public function __construct($id,$id_doc_pendencia_tipo,$id_doc_pendencia_tipo2,$id_doc_sub_tipo,$id_knl_usuario,$id_knl_grupo){
        $this->id = $id;
        $this->id_doc_pendencia_tipo = $id_doc_pendencia_tipo;
        $this->id_doc_pendencia_tipo2 = $id_doc_pendencia_tipo2;
        $this->id_doc_sub_tipo = $id_doc_sub_tipo;
        $this->id_knl_usuario = $id_knl_usuario;
        $this->id_knl_grupo = $id_knl_grupo;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_sub_tipo_regra_pend);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_sub_tipo_regra_pend_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc_pendencia_tipo() {
        return $this->id_doc_pendencia_tipo;
     }

     public function get_id_doc_pendencia_tipo2() {
        return $this->id_doc_pendencia_tipo2;
     }

     public function get_id_doc_sub_tipo() {
        return $this->id_doc_sub_tipo;
     }

     public function get_id_knl_usuario() {
        return $this->id_knl_usuario;
     }

     public function get_id_knl_grupo() {
        return $this->id_knl_grupo;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc_pendencia_tipo($id_doc_pendencia_tipo) {
        $this->id_doc_pendencia_tipo = $id_doc_pendencia_tipo;
     }

     public function set_id_doc_pendencia_tipo2($id_doc_pendencia_tipo2) {
        $this->id_doc_pendencia_tipo2 = $id_doc_pendencia_tipo2;
     }

     public function set_id_doc_sub_tipo($id_doc_sub_tipo) {
        $this->id_doc_sub_tipo = $id_doc_sub_tipo;
     }

     public function set_id_knl_usuario($id_knl_usuario) {
        $this->id_knl_usuario = $id_knl_usuario;
     }

     public function set_id_knl_grupo($id_knl_grupo) {
        $this->id_knl_grupo = $id_knl_grupo;
     }

}
?>
