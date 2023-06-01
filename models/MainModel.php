<?
class MainModel {
	protected $db;
	function __construct($name) {
    	$this->db = new Db;
 	}
}