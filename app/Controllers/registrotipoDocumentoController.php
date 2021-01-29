<?php
    if($_POST){
        if(isset($_POST['submit']) AND (!empty($_POST['submit']))){
        //registro datos login
          /*
          echo "<pre>";          
          echo "registroDocumentoController.php, linea-9" . "<br>";
          echo "regqurst=>, linea-8" . "<br>";
          print_r($_REQUEST);
          echo "POST=>, linea-8" . "<br>";
          print_r($_POST);          
          echo "</pre>";
          //die();
              */
          $data['accion']      = $_REQUEST['submit'];
          $data['idsearch'] = $_REQUEST['idaccion'];
          $data['descripcion'] = isset($_REQUEST['Descripcion']) ? $_REQUEST['Descripcion'] : "";
          try{
            include '../modelos/clstipodocumento.php';
            $registro = new clstipodocumento($data);
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
      $t =  "Error-> en registroDocumentoController"."<br>";
      $t .= "Contacte con el administrado"."<br>";      
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');      
    }
?>