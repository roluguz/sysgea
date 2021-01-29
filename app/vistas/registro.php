<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sys Gestion | Registro</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../resources/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../resources/Ionicons/css/ionicons.min.css">
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
      <a href="login.php"><b>Sys Gesti&oacute;n</b></a>
    </div>
    <div class="register-box-body">
      <p class="login-box-msg">Nuevo registro</p>
      <form action="../Controllers/registroController.php" autocomplete="off" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="nrodoc1" class="form-control" placeholder="Numero documento" id="nrodoc1" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="nrodoc2" class="form-control" placeholder="repita numero documento" id="nrodoc2" onblur="fncompara()" required>
          <span class=" glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" name="correo" class="form-control" placeholder="Correo registrado" id="correo" onblur="fAgrega();" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>

              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="p.registro"> Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.php" class="text-center">Ya estoy registrado</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery 3 -->
  <script src="../resources/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../resources/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="../resources/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>

  <script language="javascript">
    function fAgrega() {
      // if (compara() ) {
      var str = document.getElementById("correo").value;
      var dominio = str.substring(str.indexOf("@") + 1, str.indexOf("@") + 23);
      var res = str.substring(0, str.indexOf("@"));
      /*if (dominio =="coruniamericana.edu.co" || dominio=="americana.edu.co"){
        document.getElementById("usuario").value = res;
      }
      else{
        alert("La dirección de email no es correcta.");
        res ="";
        document.getElementById("correo").value=res;
      }*/
      //}
    }

    function fncompara() {
      var pw = document.getElementById("nrodoc1").value;
      var pw1 = document.getElementById("nrodoc2").value;
      if (pw != pw1) {
        alert('Numero documento no son identicas, por favor reintente.');        
        return false;
      } else {
        document.forms.submit;
        return true;
      }
    }

    function compara() {
      var pw = document.getElementById("strPassword").value;
      var pw1 = document.getElementById("strPassword2").value;
      if (pw != pw1) {
        alert('Las contraseña no son identicas, por favor reintente.');
        return false;
      } else {
        document.forms.submit;
        return true;
      }
    }
  </script>
</body>

</html>