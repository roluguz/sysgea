<?php
    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="crea_proyecto"){
            $data['accion'] = $_POST['submit'];
           // $data['Id_proyecto'] = $_POST['Id_proyecto'];
            $data['docuemnto'] = $_POST['docuemnto'];
            $data['semestre'] = $_POST['semestre'];
            $data['nombre_proyecto'] = $_POST['nombre_proyecto'];
            $data['tema_proyecto'] = $_POST['tema_proyecto'];
            $data['Problema_proyecto'] = $_POST['Problema_proyecto'];
            $data['Descripcion_proyecto'] = $_POST['Descripcion_proyecto'];
            $data['ObjetivoG_proyecto'] = $_POST['ObjetivoG_proyecto'];
            $data['ObjetivoE_proyecto'] = $_POST['ObjetivoE_proyecto'];
            $data['justificacion_proyecto'] = $_POST['justificacion_proyecto'];           

            
            try{
                include '../modelos/registroproyecto.php';
                $registroproyecto = new registroproyecto($data);
                echo "registroproyectocontroller, linea-24" . "<br>";
                echo "<pre>";
                echo "REQUEST-->" . "<br>";
                print_r($_REQUEST);
                echo "SESIONES-->" . "<br>";
                print_r($_SESSION);
                echo "</pre>";
                die();
            }
            catch (Exception $Exc){
               echo $Exc->getMessage();
            }
        }
        elseif(isset($_POST['submit']) AND $_POST['submit']=="act_proyecto"){
            $data['accion'] = $_POST['submit'];
            $data['Id_proyecto'] = $_POST['Id_proyecto'];
            $data['docuemnto'] = $_POST['docuemnto'];
            $data['semestre'] = $_POST['semestre'];
            $data['nombre_proyecto'] = $_POST['nombre_proyecto'];
            $data['tema_proyecto'] = $_POST['tema_proyecto'];
            $data['Problema_proyecto'] = $_POST['Problema_proyecto'];
            $data['Descripcion_proyecto'] = $_POST['Descripcion_proyecto'];
            $data['ObjetivoG_proyecto'] = $_POST['ObjetivoG_proyecto'];
            $data['ObjetivoE_proyecto'] = $_POST['ObjetivoE_proyecto'];
            $data['justificacion_proyecto'] = $_POST['justificacion_proyecto'];
           try{
                include '../modelos/registroproyecto.php';
                $registroproyecto = new registroproyecto($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
        }
        elseif(isset($_POST['submit']) AND $_POST['submit']=="Cancelar"){
            session_destroy();
            header('Location: ..vistas/login.php');
        }
    }


?>