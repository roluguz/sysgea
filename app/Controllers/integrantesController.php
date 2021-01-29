<?php

    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="ag-integrante"){
           $data['accion'] = $_POST['submit'];
           $data['correo'] = $_POST['correo'];
           $data['usuario'] = $_POST['usuario'];
           $data['proyecto']= $_POST['proyecto'];
            try{
                include '../modelos/integrantes.php';
                $integrantes = new integrante($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
        }
        elseif(isset($_POST['submit']) AND $_POST['submit']=="ag-proyecto"){
            $data['accion']= $_POST['submit'];
            $data['proyecto']= $_POST['proyecto'];
            $data['clave']= $_POST['clave'];
            $data['usuario']= $_POST['usuario'];;
            try{
                include '../modelos/integrantes.php';
                $integrantes = new integrante($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }

        }
    }

?>