<?php
class knl_dao_doc_assinatura {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_doc_assinatura_tipo,id_knl_usuario,data_assinatura,valida
                             FROM doc_assinatura
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_doc_assinatura_tipo,id_knl_usuario,data_assinatura,valida
                             FROM doc_assinatura
                             WHERE 1 = 1 ";

    private function __construct() {
         $this->conn = knl_lib_DataBase::getDataBase();
    }
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }

    public function selectById($id) {
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_doc_assinatura($l['id'],$l['id_doc'],$l['id_doc_assinatura_tipo'],$l['id_knl_usuario'],$l['data_assinatura'],$l['valida']);
       } else {
            throw new Exception("Nenhum doc_assinatura foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $assinaturas = array();

       while($l = $stmt->FetchRow()) {
          $assinaturas[] = new knl_model_doc_assinatura($l['id'],$l['id_doc'],$l['id_doc_assinatura_tipo'],$l['id_knl_usuario'],$l['data_assinatura'],$l['valida']);
       }
       return $assinaturas;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_assinatura $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_assinatura (id_doc,id_doc_assinatura_tipo,id_knl_usuario,data_assinatura,valida)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_doc_assinatura_tipo()."','".$objmodel->get_id_knl_usuario()."','".$objmodel->get_data_assinatura_db()."','".$objmodel->get_valida()."')";
          //echo $query;die();
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_assinatura SET 
                      id_doc='{$objmodel->get_id_doc()}',id_doc_assinatura_tipo='{$objmodel->get_id_doc_assinatura_tipo()}',id_knl_usuario='{$objmodel->get_id_knl_usuario()}',data_assinatura='{$objmodel->get_data_assinatura()}',valida='{$objmodel->get_valida()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
