<?php

    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="ag-calificar"){
            $data['accion'] = $_POST['submit'];
            $data['valoracion'] = $_POST['valoracion'];
            $data['comentarios'] = $_POST['comentarios'];
            $data['usuario'] = $_POST['usuario'];
            $data['codigo_semestre']= $_POST['codigo_semestre'];
            $data['semestre_proyecto']= $_POST['semestre_proyecto'];
            $data['promover']= $_POST['promover'];
            try{
                include '../modelos/calificar.php';
                $valoracion = new calificar($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
        }
        elseif(isset($_POST['submit']) AND $_POST['submit']=="up_calificar"){
            $data['accion'] = $_POST['submit'];
            $data['valoracion'] = $_POST['valoracion'];
            $data['comentarios'] = $_POST['comentarios'];
            $data['usuario'] = $_POST['usuario'];
            $data['codigo_semestre']= $_POST['codigo_semestre'];
            $data['promover']= $_POST['promover'];
            $data['semestre_proyecto']= $_POST['semestre_proyecto'];
            try{
                include '../modelos/calificar.php';
                $calificar = new calificar($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }

        }
    }

?>