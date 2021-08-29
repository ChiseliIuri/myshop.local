<?php

	try{
		$db = new PDO("mysql:dbname=car;host=localhost;charset=utf8","root", "");
	}catch(PDOException $PDOerror){
		echo $PDOerror->getMessage();
		exit;
	}

?>