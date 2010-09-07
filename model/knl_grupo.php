<?php
class knl_model_knl_grupo {
     private $id;
     private $id_knl_depto;
     private $id_knl_perm_bin;
     private $nome;
     private $usuarios;

     public function __construct($id,$id_knl_depto,$id_knl_perm_bin,$nome,$usuarios){
        $this->id = $id;
        $this->id_knl_depto = $id_knl_depto;
        $this->id_knl_perm_bin = $id_knl_perm_bin;
        $this->nome = $nome;
        $this->usuarios = $usuarios;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_knl_grupo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['knl_grupo_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }
     
     public function get_id_knl_depto() {
        return $this->id_knl_depto;
     }
     
     public function get_id_knl_perm_bin() {
        return $this->id_knl_perm_bin;
     }

     public function get_nome() {
        return $this->nome;
     }

     public function get_usuarios() {
        return $this->usuarios;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }
     
     public function set_id_knl_depto($id_knl_depto) {
        $this->id_knl_depto = $id_knl_depto;
     }
     
     public function set_id_knl_perm_bin($id_knl_perm_bin) {
        $this->id_knl_perm_bin = $id_knl_perm_bin;
     }

     public function set_nome($nome) {
        $this->nome = $nome;
     }

     public function set_usuarios($usuarios) {
        $this->usuarios = $usuarios;
     }

}
?>
