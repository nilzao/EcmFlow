<?php
class knl_extensions_cadastronf_cadmodel {
     private $id;
     private $cnpj;
     private $razao;
     private $estado;
     private $ie;

     public function __construct($id,$cnpj,$razao,$estado,$ie){
        $this->id = $id;
        $this->cnpj = $cnpj;
        $this->razao = $razao;
        $this->estado = $estado;
        $this->ie = $ie;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_nf_fornecedor);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_nf_fornecedor_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_cnpj() {
        return $this->cnpj;
     }

     public function get_razao() {
        return $this->razao;
     }

     public function get_estado() {
        return $this->estado;
     }

     public function get_ie() {
        return $this->ie;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_cnpj($cnpj) {
        $this->cnpj = $cnpj;
     }

     public function set_razao($razao) {
        $this->razao = strtoupper($razao);
        $this->razao = strtr($this->razao, "áàäâãçñéèëêíìïîóòöôõúùüû", "ÁÀÄÂÃÇÑÉÈËÊÍÌÏÎÓÒÖÔÕÚÙÜÛ");
     }

     public function set_estado($estado) {
        $this->estado = $estado;
     }

     public function set_ie($ie) {
        $this->ie = $ie;
     }

}
?>
