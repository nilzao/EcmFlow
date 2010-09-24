<?php
class knl_dao_ext_new {
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
    
    public function createExtension($conf){
    	$array_table = $conf['tabelas'];
    	$array_keys = $conf['chaves'];
    	$array_inputs = $conf['inputs'];
    	$array_bind=array();

    	foreach($array_table as $k=>$v){
    		$query = 'CREATE TABLE IF NOT EXISTS';
    		//$query .= ' ? (';
    		//$array_bind[]=$k;
    		$query .= " $k ("; //fixme @adodbphp sqlinjection
    		foreach($v as $cp=>$tp){
    			//$query .= ' ? ? NOT NULL,';
    			//$array_bind[]=$cp;
    			//$array_bind[]=$tp;
    			$query .= " $cp $tp NOT NULL,";//fixme @adodbphp sqlinjection
    		}
    		$query .= " id int(11) NOT NULL auto_increment, ";
    		foreach($array_keys[$k] as $vkey){
    			//$array_bind[]=$vkey;
    			//$array_bind[]=$vkey;
    			//$query .= " KEY ? (?), ";
    			$query .= " KEY $vkey ($vkey), ";//fixme @adodbphp sqlinjection
    		}
    		$query .= " PRIMARY KEY (id))
    		ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";
    		$stmt = $this->conn->prepare($query);
	        //$stmt = $this->conn->execute($stmt,$array_bind);
        	$stmt = $this->conn->execute($stmt); //fixme @adodbphp sqlinjection
        	if (!empty($array_inputs[$k])){
        		foreach($array_inputs[$k] as $array_inp){
		        	$query_ins = "INSERT INTO $k (";
		        	$query_ins .= implode(",",array_keys($array_inp));
		        	$query_ins .= ") VALUES ('";
		        	$query_ins .= implode("','",$array_inp);
		        	$query_ins .= "')";
		        	$stmt = $this->conn->prepare($query_ins);
	        		$stmt = $this->conn->execute($stmt); //fixme @adodbphp sqlinjection
        		}
        	}
        	
        	
    	}
        
        if($conf['extension_type']=='doc'){
	        $this->createDocExtension($conf);
    	}
    }
    
    private function createDocExtension($conf){
    	$m_doc_tipo = new knl_model_doc_tipo(0,$conf['doc_tipo'],$conf['extension'],"0");
        knl_dao_doc_tipo::getInstance()->upsert($m_doc_tipo);
        
        $m_doc_tipo_cred = new knl_model_doc_tipo_cred(0,$m_doc_tipo->get_id(),1,0,1,0,0);
        knl_dao_doc_tipo_cred::getInstance()->upsert($m_doc_tipo_cred);
        $m_doc_tipo_cred = new knl_model_doc_tipo_cred(0,$m_doc_tipo->get_id(),2,0,1,0,0);
        knl_dao_doc_tipo_cred::getInstance()->upsert($m_doc_tipo_cred);
        
        $m_doc_sub_tipo = new knl_model_doc_sub_tipo(0,
        											 $m_doc_tipo->get_id(),
        											 $conf['doc_sub_tipo'],
        											 '',
        											 $conf['doc_sub_tipo_path']);
		knl_dao_doc_sub_tipo::getInstance()->upsert($m_doc_sub_tipo);
		
		$m_doc_sub_tipo_regra_cred = 
			new knl_model_doc_sub_tipo_regra_cred(0,'A',-1,
											     1,
											     0,
											     $m_doc_sub_tipo->get_id(),
											     511,
											     0,
											     0);
		knl_dao_doc_sub_tipo_regra_cred::getInstance()->upsert($m_doc_sub_tipo_regra_cred);
		$m_doc_sub_tipo_regra_cred = 
			new knl_model_doc_sub_tipo_regra_cred(0,'A',-1,
											     2,
											     0,
											     $m_doc_sub_tipo->get_id(),
											     287,
											     0,
											     0);
		knl_dao_doc_sub_tipo_regra_cred::getInstance()->upsert($m_doc_sub_tipo_regra_cred);
		$m_doc_sub_tipo_regra_cred = 
			new knl_model_doc_sub_tipo_regra_cred(0,'A',4,
											     2,
											     0,
											     $m_doc_sub_tipo->get_id(),
											     224,
											     0,
											     0);
		knl_dao_doc_sub_tipo_regra_cred::getInstance()->upsert($m_doc_sub_tipo_regra_cred);
		$m_doc_sub_tipo_regra_cred = 
			new knl_model_doc_sub_tipo_regra_cred(0,'R',4,
											     2,
											     0,
											     $m_doc_sub_tipo->get_id(),
											     8,
											     0,
											     0);
		knl_dao_doc_sub_tipo_regra_cred::getInstance()->upsert($m_doc_sub_tipo_regra_cred);
		
		$m_doc_sub_tipo_regra_pend = 
			new knl_model_doc_sub_tipo_regra_pend(0,-1,4,$m_doc_sub_tipo->get_id(),2,0);
		knl_dao_doc_sub_tipo_regra_pend::getInstance()->upsert($m_doc_sub_tipo_regra_pend);
		$m_doc_sub_tipo_regra_pend = 
			new knl_model_doc_sub_tipo_regra_pend(0,4,5,$m_doc_sub_tipo->get_id(),2,0);
		knl_dao_doc_sub_tipo_regra_pend::getInstance()->upsert($m_doc_sub_tipo_regra_pend);
		$m_doc_sub_tipo_regra_pend = 
			new knl_model_doc_sub_tipo_regra_pend(0,4,1,$m_doc_sub_tipo->get_id(),2,0);
		knl_dao_doc_sub_tipo_regra_pend::getInstance()->upsert($m_doc_sub_tipo_regra_pend);
    }
}
?>