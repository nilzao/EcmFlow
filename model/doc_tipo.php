<?php
class knl_model_doc_tipo {
     private $id;
     private $descricao;
     private $classe;
     private $ordem;

     public function __construct($id,$descricao,$classe,$ordem){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->classe = $classe;
        $this->ordem = $ordem;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_tipo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_tipo_'.$k] = $this->$v();
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

     public function get_ordem() {
        return $this->ordem;
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

     public function set_ordem($ordem) {
        $this->ordem = $ordem;
     }

}
?>
