<?php

class knl_lib_DataBase {
	public static function getDataBase() {
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "ecmflow";
	$conn = NewADOConnection('mysqli');
	$conn->Connect($dbhost,$dbuser,$dbpassword,$dbname);
	$conn->EXECUTE("set names 'utf8'");
	return $conn;
	}
}
?>
