<?php
session_start();
if ($_SESSION['usuario'] == "") {
  header('Location:../vistas/login.php');
  exit;
}
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sisgea | <?php echo "panel de trabajo" ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../resources/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../resources/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../resources/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../resources/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../resources/plugins/iCheck/all.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- fullCalendar -->

  <link rel="stylesheet" href="../resources/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../resources/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- <link rel="stylesheet" href="../resources/bower_components/fullcalendar-5.3.0/lib/locale-all.css">
  <link rel="stylesheet" href="../resources/bower_components/fullcalendar-5.3.0/lib/main.css">  -->


  <!-- Bootstrap Color Picker 
   <link rel="stylesheet" href="../resources/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
   <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../resources/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../resources/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../resources/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    .srcmodal {
      position: fixed;
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: none;
    }

    .bodyModal {
      width: 100%;
      height: 30%;
      /*
      display: -webkit-flex;
      display: -moz-flex;
      display: -ms-flex;
      display: -o-flex; */
      /* display: inline-flex; */
      justify-content: center;
      align-items: center;
      background-color: #F4F6F6;
    }
    .divAbajo {
      width: 100%;
      height: 25%;
      /*
      display: -webkit-flex;
      display: -moz-flex;
      display: -ms-flex;
      display: -o-flex; */
      /* display: inline-flex; */
      justify-content: center;
      align-items: center;
      /*background-color: #F4F6F6;*/
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini"> <!-- onload="ajax();"> -->
  <div class="wrapper">
    <header class="main-header">
      <a href="index2.php" class="logo">
        <!-- Logo -->
        <span class="logo-mini"><b>S</b>GA</span> <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-lg"><b>SISGEA </b>CUA</span> <!-- logo for regular state and mobile devices -->
      </a>
      <nav class="navbar navbar-static-top">
        <!-- Header Navbar: style can be found in header.less -->
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">****navegacion****</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../resources/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['nombres_usario'] . " " . $_SESSION['apellidos_usuario'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image ?php echo "logo proyecto" ?>-->
                <li class="user-header">
                  <img src="../resources/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['nombres_usario'] . " " . $_SESSION['apellidos_usuario'] . "<br>" ?> <?php echo $_SESSION['carrera'] ?>
                    <small><?php //echo $_SESSION['Semestre'] ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="https://www.q10academico.com/login?ReturnUrl=%2F&aplentId=f4b9612a-4ee6-4a83-83ee-8b4ea1971d59" target=”_blank”>***Q10***</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#" name="age" id="age" data-toggle="modal" data-target="#pass_data_Modal">Cambio contraseña</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="http://ava.americanavirtual.edu.co/" target=”_blank”>***Ava***</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="../php/sessions.php" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!--</div>  ojo, de ser necesaroi elimiar -->