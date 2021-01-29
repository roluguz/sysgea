<?php
function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}

if (isset($_POST['enviar'])) {
    $data['nombre'] = $_POST['nombre'];
    $data['mensaje'] = $_POST['mensaje'];
    $data['proyecto'] = $_POST['proyecto'];
    try{
        include '../modelos/asesorias.php';
        $asesoria = new asesoria($data);
    }
    catch (Exception $Exc){
        echo $Exc->getMessage();
    }
}

?>