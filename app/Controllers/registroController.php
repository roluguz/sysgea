<?php   
  if($_POST){
    if(isset($_POST['submit']) AND $_POST['submit']=="p.registro"){
      $data['token']   = generartoken($_POST['nrodoc1'],$_POST['correo']);
      $data['accion']  = $_POST['submit'];
      $data['correo']  = $_POST['correo'];
      $data['usuario'] = $_POST['nrodoc1'];
      //$data['token']   = generartoken($_POST['usuario'],$_POST['correo']);
      //$data['password']= sha1($_POST['password']);
      try{
        include '../modelos/registro.php';
        $registro = new registro($data);
      }
      catch (Exception $Exc){
        echo $Exc->getMessage();
      }
    }
    elseif(isset($_POST['submit']) AND $_POST['submit']=="c.registro"){
      $data['accion']             = $_POST['submit'];
      $data['usuario']            = $_POST['usuario'];
      $data['nombre_usuario']     = $_POST['nombre_usuario'];
      $data['apellido_usuario']   = $_POST['apellido_usuario'];
      $data['t_documento_usuario']= $_POST['t_documento_usuario'];
      $data['documento_usuario']  = $_POST['documento_usuario'];
      $data['carrera']            = $_POST['carrera'];
      $data['Telefono_usuario']   = $_POST['Telefono_usuario'];
      //$data['semestre']= $_POST['semestre']."<br>";
      $data['correo_usuario']= $_POST['correo_usuario'];
      try{
        include '../modelos/registro.php';
        $registro = new registro($data);
      }
      catch (Exception $Exc){
        echo $Exc->getMessage();
      }
    }
  }

  //esta funcion genera la clave de validacion para el envio del link validacion por correo
  function generartoken($idusuario, $username){
    $cadena = $idusuario . $username . rand(1, 9999999) . "25-09-2062" . (3082 * rand(1, 9));                                                                                                     
//    $cadena = $idusuario.$username.rand(1,9999999).date("d-M-Y").(3082*rand(1,9));
    $token = sha1($cadena);
    return $token ;
  }

?>