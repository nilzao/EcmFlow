<?php
class knl_extensions_cadastronf_cotDao {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,nome
                             FROM d_cotacao_cli
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,nome
                             FROM d_cotacao_cli
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
          $objmodel = new knl_extensions_cadastronf_cotModel($l['id'],$l['nome']);
       } else {
            throw new Exception("Nenhum d_cotacao_cli foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function selectByParteNome($nome) {
        $nome = str_replace("'", "", $nome);
        $nome = str_replace('"', '', $nome);
       $query = $this->SELECT_BY_CRITERIA." AND nome LIKE '%{$nome}%'".
        " ORDER BY nome LIMIT 0,10";
       $stmt = $this->conn->query($query);

       $cotacao_cli = array();

       while($l = $stmt->FetchRow()) {
          $cotacao_cli[] = new knl_extensions_cadastronf_cotModel($l['id'],$l['nome']);
       }
       return $cotacao_cli;
    }

    public function selectByNome($nome) {
        $nome = str_replace("'", "", $nome);
        $nome = str_replace('"', '', $nome);
       $query = $this->SELECT_BY_CRITERIA." AND nome LIKE '{$nome}'".
        " ORDER BY nome LIMIT 0,10";
       $stmt = $this->conn->query($query);

       $cotacao_cli = array();

       while($l = $stmt->FetchRow()) {
          $cotacao_cli[] = new knl_extensions_cadastronf_cotModel($l['id'],$l['nome']);
       }
       return $cotacao_cli;
    }

    public function upsert(knl_extensions_cadastronf_cotModel $objmodel){
       $objmodel->set_nome(str_replace("'", "", $objmodel->get_nome()));
       $objmodel->set_nome(str_replace('"', "", $objmodel->get_nome()));
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_cotacao_cli (nome)
                    VALUES ('".$objmodel->get_nome()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_cotacao_cli SET 
                      nome='{$objmodel->get_nome()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
