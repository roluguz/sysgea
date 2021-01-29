<?php
  if($_POST){
    if(isset($_POST['submit']) AND $_POST['submit']=="pass"){
      $data['accion'] = $_POST['submit'];
      $data['usuario'] = $_POST['user'];
      $data['pass0'] = $_POST['pass0'];
      $data['pass1'] = $_POST['pass1'];
      try{
        include '../modelos/cambiopass.php';
        $cambiopass = new cambiopass($data);
      }
      catch (Exception $Exc){
          echo $Exc->getMessage();
      }
    }
  }

?>