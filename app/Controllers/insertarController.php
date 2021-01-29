<?php

    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="ag-asesor"){
           echo $data['accion'] = $_POST['submit'];
           echo $data['asesor'] = $_POST['asesor'];
           echo $data['semestrepy'] = $_POST['semestrepy'];
           $data['proyecto']= $_POST['proyecto'];
            try{
               include '../modelos/insertardata.php';
               $insertar = new insertardata($data);
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
        }elseif(isset($_POST['submit']) AND $_POST['submit']=="ac-proyecto"){
            $data['accion'] = $_POST['submit'];
            $data['asesor'] = $_POST['estado'];
            $data['semestrepy'] = $_POST['semestrepy'];
            $data['proyecto']= $_POST['proyecto'];
            try{
               include '../modelos/insertardata.php';
               $insertar = new insertardata($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
        }
    }

?>