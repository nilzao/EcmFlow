<?php
class knl_view_hlp_Lista extends knl_view_hlp_ListaJs {
	private static $instance;
	private $Lista = "";
	private $onclick = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /*
     * caractere ; ativa chamada de view helper especifico
     * caractere # anula o evento onclick do <td>
     * caractere / serve para que o array $valores possa ter chaves com mesmo nome
     */
    
    private function monta_onClick($String,$Var){
    	$onclick = str_replace("***",$Var,$String);
    	$onclick = " onclick=\"$onclick\"";
    	return $onclick;  	
    }

    public function monta_Lista ($obj,$cab,$valores,$arrOnclick = 0) {
    	if (!empty($obj)){
            $this->Lista = "\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"gridtable\"><tr>\n";
	        foreach($cab as $c){
		        $this->Lista .= "<td class=\"gridh\">$c</td>\n";
		    }
    	    $this->Lista .= "</tr>\n";
			$alterna = 0;
		    foreach($obj as $o){
				if ($alterna == 0){
					$this->Lista .= "<tr class=\"gridtr0\">\n";
					$alterna = 1;
				} else {
					$this->Lista .= "<tr class=\"gridtr1\">\n";
					$alterna = 0;
				}
		        foreach($valores as $k=>$v){
		        	if(substr_count($k,"#") == 0){
		        	    if($arrOnclick != 0){
		        	    	foreach($arrOnclick as $key => $valor){
		        	    		if ($key == "***"){
		        	    			$String = $valor;
		        	    		} else{
		        	    			$oZclick = $this->objZ($o,$valor);
		        	    			$Var = $oZclick->$key();
		        	    		}
		        	    	}
		        	    } else {
		        	        $String = "abreM('index.php?domain=Doc&action=DocShow&id=***','');";
		        		    $Var = $o['doc']->get_id();	
		        	      }
		        		$onclick = $this->monta_onClick($String,$Var);
		        	}else {
		        		$onclick = "";
		        	}
		        	$k = str_replace("#","",$k);
		        	
		        	$oZ = $this->objZ($o,$v);
			        if (substr_count($k,";") == 0){
			        	$k = str_replace("/","",$k);
			            $strZ = $oZ->$k();
				    }
				      else {
				      	  $k = str_replace(";","",$k);
				      	  $func = "knl_view_hlp_".$k."::getInstance";
				      	  $obj_hlp = call_user_func($func);
				      	  $metodo = "monta_".$k;
				      	  $obj_hlp->$metodo($oZ);
				      	  $metodo = "html_".$k;
				      	  $strZ = $obj_hlp->$metodo();
				      }
				    $this->Lista .= "<td{$onclick} class=\"gridtd\">{$strZ}</td>\n";
			    }
			    $this->Lista .= "</tr>\n";
		    }
            $this->Lista .= "</table>";
    	} else {
    		  $this->Lista = "\nNenhum registro encontrado\n";
    	  }
    	
    }
    
    private function objZ ($o,$v){
    	$v = explode (",",$v);
		$oZ = $o;
		foreach ($v as $n=>$m){
			$oZ = $oZ[$m];
		}
		return $oZ;
    }
    
    public function html_Lista(){
	    return $this->Lista;
    }
}
?>