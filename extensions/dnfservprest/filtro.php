<?php
class knl_extensions_dnfservprest_filtro extends knl_extensions_cadastronf_cadfiltro{
	private static $instance;
	
    private function __construct() {}
    public static function getInstance() {
       if (!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }
}
?>