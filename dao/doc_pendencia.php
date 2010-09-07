<?php
class knl_dao_doc_pendencia {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_knl_usuario,id_knl_grupo,id_doc_pendencia_tipo,ativa
                             FROM doc_pendencia
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_knl_usuario,id_knl_grupo,id_doc_pendencia_tipo,ativa
                             FROM doc_pendencia
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.id_doc,tb.id_knl_usuario,tb.id_knl_grupo,tb.id_doc_pendencia_tipo,tb.ativa
                             FROM doc_pendencia tb ";
    
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
          $objmodel = new knl_model_doc_pendencia($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_pendencia_tipo'],$l['ativa']);
       } else {
            throw new Exception("Nenhum doc_pendencia foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $pendencia = array();

       while($l = $stmt->FetchRow()) {
          $pendencia[] = new knl_model_doc_pendencia($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_pendencia_tipo'],$l['ativa']);
       }
       return $pendencia;
    }
    
    public function selectByUserGroupIdDoc($id_usuario,$id_grupo,$arrayGrupos,$id_doc) {
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlPendencias($id_usuario,$id_grupo,$arrayGrupos,$id_doc);
       $query = $this->SELECT_BY_CRITERIA.$criteriaObj->get_sql();
       //echo $query;die();
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$criteriaObj->get_arrayBind());
       $pendencia = array();

       while($l = $stmt->FetchRow()) {
          $pendencia[] = new knl_model_doc_pendencia($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_pendencia_tipo'],$l['ativa']);
       }
       return $pendencia;
    }
    
    public function deleteById($id){
       $stmt = $this->conn->prepare("DELETE FROM doc_pendencia WHERE id = ? ");
       $stmt = $this->conn->execute($stmt,$id);
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_pendencia $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_pendencia (id_doc,id_knl_usuario,id_knl_grupo,id_doc_pendencia_tipo,ativa)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_knl_usuario()."','".$objmodel->get_id_knl_grupo()."','".$objmodel->get_id_doc_pendencia_tipo()."','".$objmodel->get_ativa()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_pendencia SET 
                      id_doc='{$objmodel->get_id_doc()}',id_knl_usuario='{$objmodel->get_id_knl_usuario()}',id_knl_grupo='{$objmodel->get_id_knl_grupo()}',id_doc_pendencia_tipo='{$objmodel->get_id_doc_pendencia_tipo()}',ativa='{$objmodel->get_ativa()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
