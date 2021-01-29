<?php
include '../include/variables.php';

$conexion = new mysqli($host, $user, $password, $database);

function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}


?>