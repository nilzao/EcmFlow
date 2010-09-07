<?php
class knl_dao_doc_obs {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,obs,x,y,pag
                             FROM doc_obs
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,obs,x,y,pag
                             FROM doc_obs
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
          $objmodel = new knl_model_doc_obs($l['id'],$l['id_doc'],$l['obs'],$l['x'],$l['y'],$l['pag']);
       } else {
            throw new Exception("Nenhum doc_obs foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $obs = array();

       while($l = $stmt->FetchRow()) {
          $obs[] = new knl_model_doc_obs($l['id'],$l['id_doc'],$l['obs'],$l['x'],$l['y'],$l['pag']);
       }
       return $obs;
    }
    
    public function CountByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $count = $stmt->RecordCount();
       return $count;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_obs $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_obs (id_doc,obs,x,y,pag)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_obs()."','".$objmodel->get_x()."','".$objmodel->get_y()."','".$objmodel->get_pag()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_obs SET 
                      id_doc='{$objmodel->get_id_doc()}',obs='{$objmodel->get_obs()}',
                      x='{$objmodel->get_x()}',y='{$objmodel->get_y()}',pag='{$objmodel->get_pag()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
