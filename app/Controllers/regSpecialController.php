<?php
    if($_POST){
        if(isset($_POST['submit']) AND (!empty($_POST['submit']))){
        //registro datos login
          /*
          echo "<pre>";          
          echo "regSpecialController.php, linea-7" . "<br>";
          echo "request=>-->->" . "<br>";
          print_r($_REQUEST);
          echo "POST=>, " . "<br>";
          print_r($_POST);          
          echo "</pre>";
          die();
              */
          $data['accion']   = $_REQUEST['submit'];
          $data['idsearch']   = $_REQUEST['idaccion'];
          $data['nomSpecial'] = isset($_REQUEST['nomSpecial']) ? $_REQUEST['nomSpecial'] : "";
            // echo "hola"; die();
          try{
            include '../modelos/clsSpecial.php';
            $registro = new clsSpecial($data);
            $obregistro= $registro->setData($data);
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
      $t =  "Error-> en regSpecialController"."<br>";
      $t .= "Contacte con el administrador"."<br>";      
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');      
    }
?>