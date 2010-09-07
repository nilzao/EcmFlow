<?php
class knl_model_doc_sub_tipo {
     private $id;
     private $id_doc_tipo;
     private $descricao;
     private $str_shell;
     private $path;

     public function __construct($id,$id_doc_tipo,$descricao,$str_shell,$path){
        $this->id = $id;
        $this->id_doc_tipo = $id_doc_tipo;
        $this->descricao = $descricao;
        $this->str_shell = $str_shell;
        $this->path = $path;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_sub_tipo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_sub_tipo_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc_tipo() {
        return $this->id_doc_tipo;
     }

     public function get_descricao() {
        return $this->descricao;
     }

     public function get_str_shell() {
        return $this->str_shell;
     }

     public function get_path() {
        return $this->path;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc_tipo($id_doc_tipo) {
        $this->id_doc_tipo = $id_doc_tipo;
     }

     public function set_descricao($descricao) {
        $this->descricao = $descricao;
     }

     public function set_str_shell($str_shell) {
        $this->str_shell = $str_shell;
     }

     public function set_path($path) {
        $this->path = $path;
     }

}
?>
