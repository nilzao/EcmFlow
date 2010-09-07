<?php
class knl_model_doc_cred {
     private $id;
     private $id_doc;
     private $id_knl_usuario;
     private $id_knl_grupo;
     private $perm_usuario;
     private $perm_grupo;
     private $perm_outros;

     public function __construct($id,$id_doc,$id_knl_usuario,$id_knl_grupo,$perm_usuario,$perm_grupo,$perm_outros){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_knl_usuario = $id_knl_usuario;
        $this->id_knl_grupo = $id_knl_grupo;
        $this->perm_usuario = $perm_usuario;
        $this->perm_grupo = $perm_grupo;
        $this->perm_outros = $perm_outros;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_cred);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_cred_'.$k] = $this->$v();
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

     public function get_perm_usuario() {
        settype($this->perm_usuario,"int");
     	return $this->perm_usuario;
     }

     public function get_perm_grupo() {
     	settype($this->perm_grupo,"int");
        return $this->perm_grupo;
     }

     public function get_perm_outros() {
        settype($this->perm_outros,"int");
     	return $this->perm_outros;
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
