<?php
class knl_dao_doc_sub_tipo_regra_pend {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc_pendencia_tipo,id_doc_pendencia_tipo2,id_doc_sub_tipo,id_knl_usuario,id_knl_grupo
                             FROM doc_sub_tipo_regra_pend
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc_pendencia_tipo,id_doc_pendencia_tipo2,id_doc_sub_tipo,id_knl_usuario,id_knl_grupo
                             FROM doc_sub_tipo_regra_pend
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
          $objmodel = new knl_model_doc_sub_tipo_regra_pend($l['id'],$l['id_doc_pendencia_tipo'],$l['id_doc_pendencia_tipo2'],$l['id_doc_sub_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo']);
       } else {
            throw new Exception("Nenhum doc_sub_tipo_regra_pend foi encontrado!");
         }
       return $objmodel;
    }
    
	public function deleteById($id) {
       $query = "DELETE FROM doc_sub_tipo_regra_pend WHERE id = ?";
	   $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id);
    }
    
	public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." ORDER BY id_doc_sub_tipo,id_doc_pendencia_tipo,id_knl_grupo";
       $stmt = $this->conn->execute($stmt);
       $regrapend = array();

       while($l = $stmt->FetchRow()) {
          $regrapend[] = new knl_model_doc_sub_tipo_regra_pend($l['id'],$l['id_doc_pendencia_tipo'],$l['id_doc_pendencia_tipo2'],$l['id_doc_sub_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo']);
       }
       return $regrapend;
    }

    public function selectBySubTipoPendTipo($id_doc_sub_tipo,$id_doc_pendencia_tipo) {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." AND id_doc_sub_tipo = ? AND id_doc_pendencia_tipo = ? ");
       $stmt = $this->conn->execute($stmt,array($id_doc_sub_tipo,$id_doc_pendencia_tipo));
       $regras = array();

       while($l = $stmt->FetchRow()) {
          $regras[] = new knl_model_doc_sub_tipo_regra_pend($l['id'],$l['id_doc_pendencia_tipo'],$l['id_doc_pendencia_tipo2'],$l['id_doc_sub_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo']);
       }
       return $regras;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_sub_tipo_regra_pend $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_sub_tipo_regra_pend (id_doc_pendencia_tipo,id_doc_pendencia_tipo2,id_doc_sub_tipo,id_knl_usuario,id_knl_grupo)
                    VALUES ('".$objmodel->get_id_doc_pendencia_tipo()."','".$objmodel->get_id_doc_pendencia_tipo2()."','".$objmodel->get_id_doc_sub_tipo()."','".$objmodel->get_id_knl_usuario()."','".$objmodel->get_id_knl_grupo()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_sub_tipo_regra_pend SET 
                      id_doc_pendencia_tipo='{$objmodel->get_id_doc_pendencia_tipo()}',id_doc_pendencia_tipo2='{$objmodel->get_id_doc_pendencia_tipo2()}',id_doc_sub_tipo='{$objmodel->get_id_doc_sub_tipo()}',id_knl_usuario='{$objmodel->get_id_knl_usuario()}',id_knl_grupo='{$objmodel->get_id_knl_grupo()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
