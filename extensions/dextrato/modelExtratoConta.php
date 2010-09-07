<?php
class knl_extensions_dextrato_modelExtratoConta {
     private $id;
     private $id_agencia;
     private $numero;
     private $obs;
     private $id_empresa;

     public function __construct($id,$id_agencia,$numero,$obs,$id_empresa){
        $this->id = $id;
        $this->id_agencia = $id_agencia;
        $this->numero = $numero;
        $this->obs = $obs;
        $this->id_empresa = $id_empresa;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_extrato_conta);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_extrato_conta_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_agencia() {
        return $this->id_agencia;
     }

     public function get_numero() {
        return $this->numero;
     }

     public function get_obs() {
        return $this->obs;
     }

     public function get_id_empresa() {
        return $this->id_empresa;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_agencia($id_agencia) {
        $this->id_agencia = $id_agencia;
     }

     public function set_numero($numero) {
        $this->numero = $numero;
     }

     public function set_obs($obs) {
        $this->obs = $obs;
     }

     public function set_id_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
     }

}
?>
