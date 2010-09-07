<?php
class knl_extensions_dextrato_daoExtratoContaVw {
    private $conn;
    private static $instance;
    
    private function __construct() {
         $this->conn = knl_lib_DataBase::getDataBase();
    }
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }

    public function selectAll2Form(){
       $query = "SELECT ec.id, ec.numero as num_conta,
       			 ea.numero as num_agencia , eb.nome as nome_banco,
       			 e.fantasia as nome_empresa
				 FROM d_extrato_conta ec
				 LEFT JOIN d_extrato_agencia ea ON ( ea.id = ec.id_agencia )
				 LEFT JOIN d_extrato_banco eb ON ( eb.id = ea.id_banco )
				 LEFT JOIN empresa e ON (e.id = ec.id_empresa)
				 WHERE 1
				 ORDER BY eb.nome,ea.numero,e.fantasia";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt);
       
       $contas = array();
       
	   while($l = $stmt->FetchRow()) {
		 $contas[] = new knl_extensions_dextrato_modelExtratoContaVw($l['id'],$l['num_conta'],$l['num_agencia'],$l['nome_banco'],$l['nome_empresa']);
       }
       return $contas;
    }
    
}
?>
