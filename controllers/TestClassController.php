<?php
class TestClassController {
	public $var = "testScring";
	function get_var () {
		$test = new TestModelClass;
		echo $test->get_var2() . "\n";
		die("testScring");
	}
}