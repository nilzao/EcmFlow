<?php
class knl_domain_Extension {
	private static $instance;

	private function __construct(){}
  
	public static function getInstance(){
	  	if (!isset(self::$instance)){
	  		self::$instance = new self();
	  	}
	  	return self::$instance; 
	}

	public function handle(){
	  	$request = knl_lib_Registry::getRequestObj()->getInstance();
	  	$metodo = $request->getGet('action');
	  	if (method_exists($this,$metodo)){
	  		$this->$metodo();
	  	}
	}
  
	public function ExtNewForm(){
		$vl = knl_view_Loader::getInstance();
        $vl->display("ExtensionNewForm");
	}
	
	public function ExtUpload(){
		$files = knl_lib_Registry::getFiles();
		$ext_field = $files->getFile('ext_field');
	    if($ext_field['error'] == 0){
	    	//$ext_field['name'];
	    	//$ext_field['size'];
			//$ext_field['tmp_name'];
			$str_to_path = "";
		    $zip_file = zip_open($ext_field['tmp_name']);
		    while ($zip_read = zip_read($zip_file)) {
		    	//echo zip_entry_name($zip_read);echo "<br>";
		    	if (zip_entry_name($zip_read) == "config.xml"){
	    			$buf = zip_entry_read($zip_read, zip_entry_filesize($zip_read));
		    		$xml_cfg = new DOMDocument();
					$xml_cfg->loadXML($buf);
					$conf = $this->xml_read_cfg($xml_cfg);
					$conf_full[] = $conf;
					$str_to_path = $conf['extension'];
					knl_dao_ext_new::getInstance()->createExtension($conf);
		    	}
		    	if (zip_entry_name($zip_read) == "config_aux.xml"){
		    		$buf = zip_entry_read($zip_read, zip_entry_filesize($zip_read));
		    		$xml_cfg = new DOMDocument();
					$xml_cfg->loadXML($buf);
					$conf = $this->xml_read_cfg($xml_cfg);
					$conf_full[] = $conf;
					knl_dao_ext_new::getInstance()->createExtension($conf);
		    	}
		    }
		    if(!empty($str_to_path)){
				$zip_file = zip_open($ext_field['tmp_name']);
			    $this->unzip_extension($zip_file,$str_to_path);
			}
	    }
	    echo "Fim da instalação<br>\n<pre>";
	    print_r($conf_full);
	}
	
	private function xml_read_cfg($xml){
		$conf = array();
		$conf['extension'] = $xml->getElementsByTagName('ecmflow_extension')->item(0)->attributes->getNamedItem("nome")->nodeValue;
		$conf['extension_type'] = $xml->getElementsByTagName('ecmflow_extension')->item(0)->attributes->getNamedItem("type")->nodeValue;
		
		$conf['tabelas'] = $this->getArrayCampos($xml);
		$conf['chaves'] = $this->getArrayChaves($xml);
		$conf['inputs'] = $this->getArrayInputs($xml);
		
		if($conf['extension_type']=='doc'){
			$conf['doc_tipo'] = $xml->getElementsByTagName('doc_tipo')->item(0)->attributes->getNamedItem("nome")->nodeValue;
			$conf['doc_sub_tipo'] = $xml->getElementsByTagName('doc_sub_tipo')->item(0)->attributes->getNamedItem("nome")->nodeValue;
			$conf['doc_sub_tipo_path'] = $xml->getElementsByTagName('doc_sub_tipo')->item(0)->attributes->getNamedItem("path")->nodeValue;
		}
		//print_r($conf);
		return $conf;
	}
	
	private function getArrayCampos($xml){
		$cp_array = array();
		$head_tabela = $xml->getElementsByTagName('head_tabela');
		for ($i=0;$i<$head_tabela->length;$i++){
			$tabela = $head_tabela->item($i)->parentNode->attributes->getNamedItem("nome")->nodeValue;
			$campos = $head_tabela->item($i)->childNodes;
			for($io=0;$io<$campos->length;$io++){
				if($campos->item($io)->hasChildNodes()){
					$cp_key = $campos->item($io)->nodeValue;
					$cp_value = $campos->item($io)->attributes->getNamedItem("type")->nodeValue;
					$cp_array[$tabela][$cp_key] = $cp_value;
				}
			}
		}
		return $cp_array;
	}
	
	private function getArrayChaves($xml){
		$cp_array = array();		
		$key_tabela = $xml->getElementsByTagName('key_tabela');
		for ($i=0;$i<$key_tabela->length;$i++){
			$tabela = $key_tabela->item($i)->parentNode->attributes->getNamedItem("nome")->nodeValue;
			$cp_array[$tabela]=array();
			$campos = $key_tabela->item($i)->childNodes;
			for($io=0;$io<$campos->length;$io++){
				if($campos->item($io)->hasChildNodes()){
					$cp_value = $campos->item($io)->nodeValue;
					$cp_array[$tabela][] = $cp_value;
				}
			}
		}
		return $cp_array;
	}
	
	private function getArrayInputs($xml){
		$cp_array = array();		
		$input_tabela = $xml->getElementsByTagName('input_tabela');
		for ($i=0;$i<$input_tabela->length;$i++){
			$tabela = $input_tabela->item($i)->parentNode->attributes->getNamedItem("nome")->nodeValue;
			$campos = $input_tabela->item($i)->childNodes;
			$inpt_array_tmp = array();
			for($io=0;$io<$campos->length;$io++){
				if($campos->item($io)->hasChildNodes()){
					$cp_name = $campos->item($io)->attributes->getNamedItem("campo")->nodeValue;
					$cp_value = $campos->item($io)->nodeValue;
					$inpt_array_tmp[$cp_name] = $cp_value;
				}
			}
			$cp_array[$tabela][] = $inpt_array_tmp;
		}
		return $cp_array;
	}
	
	private function unzip_extension ($zip_file,$str_to_path){
		$str_to_path = "extensions/".$str_to_path;
    	mkdir($str_to_path);
		while ($zip_read = zip_read($zip_file)) {
			if (zip_entry_name($zip_read) != "config.xml" AND zip_entry_name($zip_read) != "config_aux.xml"){
		    	$fp = fopen($str_to_path."/".zip_entry_name($zip_read), "w");
		    	$buf = zip_entry_read($zip_read, zip_entry_filesize($zip_read));
		    	fwrite($fp,"$buf");
		    	fclose($fp);
			}
	    }
	}
}
?>