<?php
class knl_dao_doc_marca_texto {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,x,y,width,height,pag
                             FROM doc_marca_texto
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,x,y,width,height,pag
                             FROM doc_marca_texto
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
          $objmodel = new knl_model_doc_marca_texto($l['id'],$l['id_doc'],$l['x'],$l['y'],$l['width'],$l['height'],$l['pag']);
       } else {
            throw new Exception("Nenhum doc_marca_texto foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $lista = array();

       while($l = $stmt->FetchRow()) {
          $lista[] = $objmodel = new knl_model_doc_marca_texto($l['id'],$l['id_doc'],$l['x'],$l['y'],$l['width'],$l['height'],$l['pag']);
       }
       return $lista;
    }
    
	public function selectByIdDocPag($id_doc,$pag) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ? AND pag = ?";
       $ArrayBind = array($id_doc,$pag);
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$ArrayBind);
       $lista = array();

       while($l = $stmt->FetchRow()) {
          $lista[] = $objmodel = new knl_model_doc_marca_texto($l['id'],$l['id_doc'],$l['x'],$l['y'],$l['width'],$l['height'],$l['pag']);
       }
       return $lista;
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

    public function upsert(knl_model_doc_marca_texto $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_marca_texto (id_doc,x,y,width,height,pag)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_x()."','".$objmodel->get_y()."','".$objmodel->get_width()."','".$objmodel->get_height()."','".$objmodel->get_pag()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_marca_texto SET 
                      id_doc='{$objmodel->get_id_doc()}',
                      x='{$objmodel->get_x()}',y='{$objmodel->get_y()}',
                      width='{$objmodel->get_width()}',height='{$objmodel->get_height()}',
                      pag='{$objmodel->get_pag()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
    
    public function deleteById($id){
       $query = "DELETE FROM doc_marca_texto WHERE id = ? LIMIT 1";
       $ArrayBind = array($id);
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$ArrayBind);
    }
}
?>
