<?php

if (isset($_GET['code'])) {
  $data['accion'] = 'consultar';
  $data['proyecto'] = $_GET['code'];
} else {
  $data['accion'] = 'consultar';
  if (!isset($_SESSION['proyecto'])) {
    $data['proyecto'] = "nuevo";
  } else {
    $data['proyecto'] = $_SESSION['proyecto'];
  }
}
$objpr = "";
try {
  include '../modelos/perfil.php';
  $objperfil = new perfil;
  $objpr = $objperfil->setData($data);
  $row = mysqli_fetch_assoc($objpr);
} catch (Exception $Exc) {
  echo $Exc->getMessage();
}
/*
echo "<pre>";
echo "perfil, linea-30 , Data->" . "<br>";
print_r($data) . "<br>";
echo "Sesiones->" . "<br>";
print_r($_SESSION) . "<br>";
echo "Request->" . "<br>";
print_r($_REQUEST) . "<br>";
echo "</pre>";
die();
 */

$objinpy = "";
try {
  include '../modelos/consulta.php';
  $objconsulta = new consulta;
  $data['accion'] = 'integrantespy';
  $data['codigo'] = $data['proyecto'];
  $objinpy = $objconsulta->setData($data);
} catch (Exception $Exc) {
  echo $Exc->getMessage();
}

if (!empty($objpr)) {
  //$usuario = mysql_fetch_assoc($objnr);
  // $usuario = mysql_fetch_assoc($objnr);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="../resources/img_perfil/logo.jpg" alt="User profile picture">
            <h3 class="profile-username text-center">Proyecto Integrador</h3>
            <p class="text-muted text-center"><?php echo $_SESSION['carrera']; ?></p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Semestre</b> <a class="pull-right"><?php echo $row['semestre_proyecto']  ?></a>
              </li>
              <li class="list-group-item">
                <b>Integrantes</b> <a class="pull-right"><?php echo "3";  ?></a>
              </li>
            </ul>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php
        if (isset($_GET['code']) and $_SESSION['perfil'] == "PRADMIN") { ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Administración</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
              <p class="text-muted">Malibu, California</p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>
              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- About Me Box -->
        <?php } ?>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Principal</a></li>
            <!--<li><a href="#timeline" data-toggle="tab">Hitorial</a></li>-->
            <li><a href="#settings" data-toggle="tab">Integrantes</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Titulo.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['nombre_proyecto'] ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Tema.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['tema_proyecto'] ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Problema Proyecto.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['problema_proyecto'] ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Descripcion del proyecto.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['descripcion_proyecto'] ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Problema a resolver.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['problema_proyecto'] ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Objetivo General.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['objetivoG_proyecto'] ?>
                </p>
              </div>

              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Objetivos Especificos.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo str_replace("#", "<br>", $row['objetivoE_proyecto']) ?>
                </p>
              </div>
              <div class="post">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Justificacion proyecto.</a>
                    <a href="#" class="pull-right btn-box-tool"></a>
                  </span>
                </div>
                <p>
                  <?php echo $row['justificacion_proyecto'] ?>
                </p>
              </div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                    10 Feb. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                    </h3>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments bg-yellow"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                    <div class="timeline-body">
                      Take me to your leader!
                      Switzerland is small and neutral!
                      We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-camera bg-purple"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                    <div class="timeline-body">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            <!-- /.tab-pane 
                  <div class="post">
                    <div class="user-block">
                    </div>
                  </div>-->
            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <?php
                while ($row1 = mysqli_fetch_assoc($objinpy)) { ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <label for="inputName" class="form-control"><?php echo $row1['nombres_usario'] . " " . $row1['apellidos_usuario'] ?></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Correo electronico</label>
                    <div class="col-sm-10">
                      <label for="inputName" class="form-control"><?php echo $row1['correo_personal'] ?></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Semestre</label>
                    <div class="col-sm-10">
                      <label for="inputName" class="form-control"><?php echo $row1['semestre'] ?></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Carrera</label>
                    <div class="col-sm-10">
                      <label for="inputName" class="form-control"><?php echo $row1['carrera'] ?></label>
                    </div>
                  </div>
                <?php   } ?>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
<?php
} else {
  echo "Actualmente no te encuentras inscrito en ningun proyecto";
}

?>