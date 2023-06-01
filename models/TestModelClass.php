<?php
class TestModelClass {
	public $var = "Aoutoload from model works motherfuckers";
	function get_var2 () {
		// die("testScring");
		echo $this->var;
	}
}