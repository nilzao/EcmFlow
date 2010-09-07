<?php
class knl_model_doc_pendencia {
     private $id;
     private $id_doc;
     private $id_knl_usuario;
     private $id_knl_grupo;
     private $id_doc_pendencia_tipo;
     private $ativa;

     public function __construct($id,$id_doc,$id_knl_usuario,$id_knl_grupo,$id_doc_pendencia_tipo,$ativa){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_knl_usuario = $id_knl_usuario;
        $this->id_knl_grupo = $id_knl_grupo;
        $this->id_doc_pendencia_tipo = $id_doc_pendencia_tipo;
        $this->ativa = $ativa;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_pendencia);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_pendencia_'.$k] = $this->$v();
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

     public function get_id_knl_usuario() {
        return $this->id_knl_usuario;
     }

     public function get_id_knl_grupo() {
        return $this->id_knl_grupo;
     }

     public function get_id_doc_pendencia_tipo() {
        return $this->id_doc_pendencia_tipo;
     }

     public function get_ativa() {
        return $this->ativa;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_id_knl_usuario($id_knl_usuario) {
        $this->id_knl_usuario = $id_knl_usuario;
     }

     public function set_id_knl_grupo($id_knl_grupo) {
        $this->id_knl_grupo = $id_knl_grupo;
     }

     public function set_id_doc_pendencia_tipo($id_doc_pendencia_tipo) {
        $this->id_doc_pendencia_tipo = $id_doc_pendencia_tipo;
     }

     public function set_ativa($ativa) {
        $this->ativa = $ativa;
     }

}
?>
