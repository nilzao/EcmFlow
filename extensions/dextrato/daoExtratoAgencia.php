<?php
class knl_extensions_dextrato_daoExtratoAgencia {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_banco,numero,descricao,telefone
                             FROM d_extrato_agencia
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_banco,numero,descricao,telefone
                             FROM d_extrato_agencia
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
          $objmodel = new knl_extensions_dextrato_modelExtratoAgencia($l['id'],$l['id_banco'],$l['numero'],$l['descricao'],$l['telefone']);
       } else {
            throw new Exception("Nenhum d_extrato_agencia foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectAll() {
	   $query = $this->SELECT_BY_CRITERIA." AND id != -1 ORDER BY numero";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt);
       $agencias = array();
       
       while($l = $stmt->FetchRow()) {
          $agencias[] = new knl_extensions_dextrato_modelExtratoAgencia($l['id'],$l['id_banco'],$l['numero'],$l['descricao'],$l['telefone']);
       } 
       return $agencias;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dextrato_modelExtratoAgencia $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_extrato_agencia (id_banco,numero,descricao,telefone)
                    VALUES ('".$objmodel->get_id_banco()."','".$objmodel->get_numero()."','".$objmodel->get_descricao()."','".$objmodel->get_telefone()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_extrato_agencia SET 
                      id_banco='{$objmodel->get_id_banco()}',numero='{$objmodel->get_numero()}',descricao='{$objmodel->get_descricao()}',telefone='{$objmodel->get_telefone()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
