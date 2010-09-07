<?php
class knl_model_doc_sub_tipo_cred {
     private $id;
     private $id_doc_sub_tipo;
     private $id_knl_usuario;
     private $id_knl_grupo;
     private $perm_usuario;
     private $perm_grupo;
     private $perm_outros;

     public function __construct($id,$id_doc_sub_tipo,$id_knl_usuario,$id_knl_grupo,$perm_usuario,$perm_grupo,$perm_outros){
        $this->id = $id;
        $this->id_doc_sub_tipo = $id_doc_sub_tipo;
        $this->id_knl_usuario = $id_knl_usuario;
        $this->id_knl_grupo = $id_knl_grupo;
        $this->perm_usuario = $perm_usuario;
        $this->perm_grupo = $perm_grupo;
        $this->perm_outros = $perm_outros;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_sub_tipo_cred);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_sub_tipo_cred_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
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

     public function get_perm_usuario() {
        return $this->perm_usuario;
     }

     public function get_perm_grupo() {
        return $this->perm_grupo;
     }

     public function get_perm_outros() {
        return $this->perm_outros;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
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

     public function set_perm_usuario($perm_usuario) {
        $this->perm_usuario = $perm_usuario;
     }

     public function set_perm_grupo($perm_grupo) {
        $this->perm_grupo = $perm_grupo;
     }

     public function set_perm_outros($perm_outros) {
        $this->perm_outros = $perm_outros;
     }

}
?>
