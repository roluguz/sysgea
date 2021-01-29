<?php
    if($_POST){
        if(isset($_POST['submit']) AND (!empty($_POST['submit']))){
    //registro datos login
    

              
          $data['accion']   = $_REQUEST['submit'];
          $data['idsearch'] = $_REQUEST['idaccion'];
          $data['nCarrera'] = isset($_REQUEST['nCarrera']) ? $_REQUEST['nCarrera'] : "";  

          try{
      /*
      echo "<pre>";
      echo "registroCarrera.php, linea-9" . "<br>";
      echo "request=>, linea-8" . "<br>";
      print_r($_REQUEST);
      echo "POST=>, linea-8" . "<br>";
      print_r($_POST);
      echo "</pre>";
      die();*/            
            include '../modelos/clscarreras.php';
            $registro = new clsCarreras($data);
          }
          catch (Exception $Exc){
            //echo $Exc->getMessage();
            $t = "Error-> ".$Exc->getMessage();
            $p = "tipodoc";
            $enlace = "../php/sessions.php";
            include('../plantillas/paso.php');
          }
        }
    } else {
      $p = "tipodoc";
      $t =  "Error-> en registroCarreraController"."<br>";
      $t .= "Contacte con el administrador"."<br>";      
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');      
    }
?>