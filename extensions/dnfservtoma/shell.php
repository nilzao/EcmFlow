<?php
class knl_extensions_dnfservtoma_shell extends knl_extensions_cadastronf_cadNfShell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>