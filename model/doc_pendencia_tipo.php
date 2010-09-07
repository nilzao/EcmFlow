<?php
class knl_model_doc_pendencia_tipo {
     private $id;
     private $descricao;
     private $classe;

     public function __construct($id,$descricao,$classe){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->classe = $classe;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_pendencia_tipo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_pendencia_tipo_'.$k] = $this->$v();
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

     public function get_classe() {
        return $this->classe;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_descricao($descricao) {
        $this->descricao = $descricao;
     }

     public function set_classe($classe) {
        $this->classe = $classe;
     }

}
?>
