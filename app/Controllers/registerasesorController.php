<?php
  if($_POST){
    if(isset($_POST['submit']) AND (!empty($_POST['submit'])))
    {
      //registro datos login
      $data['accion']  = $_REQUEST['submit'];
      $data['iddele']  = $_REQUEST['idaccion'];          
      $data['usuario'] = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : "";
      $data['correo']  = isset($_REQUEST['correo'])  ? $_REQUEST['correo']  : "";
      $data['tkuser']  = isset($_REQUEST['usersave'])? $_REQUEST['usersave']: "";
      $data['password']= sha1($data['usuario']); // sha1($_REQUEST['strpsw']);
      //registro datos asesor
      $data['nomasesor']   = $_REQUEST['nomasesor'];
      $data['apeasesor']   = $_REQUEST['apeasesor'];
      $data['tpdocumento'] = $_REQUEST['tpdocumento'];
      $data['nrodoc']      = $_REQUEST['nrodoc'];
      //$data['carrera']             = $_REQUEST['codcarrera'];
      //$data['especialidad']        = $_REQUEST['especialidad'];
      $data['correo']      = $_REQUEST['correo'];
      $data['correo2']     = $_REQUEST['correo2'];
      $data['telasesor']   = $_REQUEST['telasesor'];
      /*
      echo "<pre>";
      echo "registerAsesorController.php, linea-23" . "<br>";
      echo "sesioen=>, linea-24" . "<br>";
      print_r($_SESSION);
      echo "request=>, linea-26" . "<br>";
      print_r($_REQUEST);
      echo "POST=>, linea-28" . "<br>";
      print_r($_POST);
      echo "</pre>";*/
      try {
        //include '../modelos/registroasesores.php';
        include '../modelos/clsAsesores.php';            
        $objdata = new clsAsesores($data);
        $registro = $objdata->setdata($data);
      } catch (Exception $Exc) {
        //echo $Exc->getMessage();
        $t = "Error-> ".$Exc->getMessage();
        $p = "tipodoc";
        $enlace = "../php/sessions.php";
        include('../plantillas/paso.php');            
      } /*
      try{
        include '../modelos/clscarreras.php';
        $registro = new clscarreras($data);
      }
      catch (Exception $Exc){
      }*/
    }
  } else {
    $p = "tipodoc";
    $t =  "Error-> en registerAsesorController"."<br>";
    $t .= "Contacte con el administrador"."<br>";      
    $enlace = "../php/sessions.php";
    include('../plantillas/paso.php');      
  }
?>