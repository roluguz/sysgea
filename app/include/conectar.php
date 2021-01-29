<?php 	
	$host = 'localhost';
	$usr = 'root';
	$psw = '';
	$db = 'bdsisgea';
	$conection = @mysqli_connect($host,$usr,$psw,$db);
	//$cnx = @mysqli_connect($host,$usr,$psw,$db);
	if(!$conection){
		echo "Error en la conexión,(bdsisgea) no existe....";
		exit();
	}

?>