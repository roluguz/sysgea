<?php



  $data['accion']  = 'com_registro';
  $data['usuario'] = $_GET['idusuario'];
  $data['token']   =$_GET['token']; 
  
  
  $objr = "";
  try{
    include '../modelos/validar.php';
    $objvalidar = new validar;
    $objr = $objvalidar->setData($data);
  }
  catch (Exception $Exc){
    echo $Exc->getMessage();
  }
if( !empty($objr) ){
  $usuario = mysqli_fetch_array($objr);
	if( sha1($usuario['usuario']) == $data['usuario'] ){
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISGEA | Registro</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../resources/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../resources/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../resources/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../resources/plugins/iCheck/square/blue.css">
  <script src="http://code.jquery.com/jquery-1.0.4.js"></script> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Sys Gesti&oacute;n</b></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Completar registro</p>   
    <form action="../Controllers/registroController.php" method="post">
      <div class="form-group has-feedback">
        <input type="text"name="usuario" class="form-control" placeholder="Usuario de conexion" id="usuario" readonly value='<?php echo $usuario['usuario']; ?>'> 
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nombres" id="nombre" name="nombre_usuario" required> 
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Apellidos" id="nombre" name="apellido_usuario" required> 
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select class="form-control" name="t_documento_usuario" required>
          <option>Tipo de Documento</option>
          <option value="Registro Civil">Registro Civil</option>
          <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
          <option value="Cedula de Cuidadania">Cedula de Cuidadania</option>
          <option value="Pasaporte">Pasaporte</option>
          <option value="Cedula Extranjera">Cedula Extranjera</option>
        </select>
      </div>
      <div class="form-group has-feedback">
        <input type=number class="form-control" placeholder="Numero de Documento" id="nombre" name="documento_usuario" required> 
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select class="form-control" name="carrera" required>
          <option>Carrera</option>
          <option value="Ingenieria Sistemas">Ingenieria Sistemas</option>
          <option value="Ingenieria industrial">Ingenieria industrial</option>
        </select>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Correo institucional"id="correoUni" readonly name="correoUni" value='<?php echo $usuario['correo']; ?>'>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Correo personal" id="correo_usuario" name="correo_usuario" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="Telefono" name="Telefono_usuario" required>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name ="submit" class="btn btn-primary btn-block btn-flat"value ="c.registro"> Continuar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

 <script language="javascript">
  function fAgrega(){
    var str =  document.getElementById("correo").value;
    var dominio =  str.substring(str.indexOf("@")+1,str.indexOf("@")+23);
    var res = str.substring(0, str.indexOf("@"));
    if (dominio =="coruniamericana.edu.co" || dominio=="americana.edu.co"){
      document.getElementById("usuario").value = res;
    }
    else{
      alert("La dirección de email no es correcta.");
      res ="";
      document.getElementById("correo").value=res;
    }
  }
</script>

</body>
</html>
<?php
}
		else{
		//	header('Location:index.html');
		}
	}
	else{
		//header('Location:index.html');
  }

?>