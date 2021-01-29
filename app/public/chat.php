<?php
	include "db.php";
	///consultamos a la base
	try{
		$consulta = "SELECT * FROM asesoriavirtual ORDER BY id DESC";
		$ejecutar = $conexion->query($consulta); 
		if($ejecutar != null)
		while($fila = $ejecutar->fetch_array()) : 
?>
	<div id="datos-chat">
		<span style="color: #1C62C4;"><?php echo $fila['nombre']; ?></span>
		<span style="color: #848484;"><?php echo $fila['mensaje']; ?></span>
		<span style="float: right;"><?php echo formatearFecha($fila['create_at']); ?></span>
	</div>
	
	<?php endwhile; 
	}
	catch (Exception $exc){
		echo $exc->getMessage();
	}
	?>
