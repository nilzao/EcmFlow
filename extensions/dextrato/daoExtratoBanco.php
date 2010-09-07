<?php
class knl_extensions_dextrato_daoExtratoBanco {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,numero,nome
                             FROM d_extrato_banco
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,numero,nome
                             FROM d_extrato_banco
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
       $id = (empty($id)) ? -1 :$id;
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dextrato_modelExtratoBanco($l['id'],$l['numero'],$l['nome']);
       } else {
            throw new Exception("Nenhum d_extrato_banco foi encontrado!");
         }
       return $objmodel;
    }

	public function selectAll() {
	   $query = $this->SELECT_BY_CRITERIA." AND id != -1 ORDER BY nome";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt);
       $bancos = array();
       
       while($l = $stmt->FetchRow()) {
          $bancos[] = new knl_extensions_dextrato_modelExtratoBanco($l['id'],$l['numero'],$l['nome']);
       } 
       return $bancos;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dextrato_modelExtratoBanco $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_extrato_banco (numero,nome)
                    VALUES ('".$objmodel->get_numero()."','".$objmodel->get_nome()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_extrato_banco SET 
                      numero='{$objmodel->get_numero()}',nome='{$objmodel->get_nome()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
