<!-- Left side column. contains the logo and sidebar -->
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../resources/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nombres_usario'] . " " . $_SESSION['apellidos_usuario'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
      </div>
    </div>
    <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color:yellow;">NAVEGACION PRINCIPAL</li>
      <?php
      $dato['accion'] = 'consultar';
      $dato['usuario'] = $_SESSION['usuario'];
      $objmn = "";
      try {
        include '../modelos/menu.php';
        $objmenu = new menu();
        $objmn = $objmenu->setData($dato);
      } catch (Exception $Exc) {
        echo $Exc->getMessage();
      }
      if (!empty($objmn)) {
        $i = 1;
      /*
        echo "<pre>";
        //echo "tipo sql->" . gettype($objmn) . "<br>";
       // echo "orden....->>" . $query . "<br>";
        echo "h1.php, linea-51" . "<br>";
        //print_r($objmn);
        echo "</pre>";
        die();
      */                  
        while ($row = mysqli_fetch_assoc($objmn)) {
          echo "<li>";
          echo "<a href='" . $row['link_menu'] . "'>";
          echo "<i class='" . $row['icono_menu'] . "'></i> <span>" . $row['nombre_menu'] . "</span>";
          echo "</a>";
          echo "</li>";
          $i++;
        }
      }
      ?>
      <li>
        <a href="?page=listaarchivos">
          <i class="fa fa-book"></i> <span>Documentos</span>
        </a>
      </li>
      <li>
        <a href="?page=tbNotas&code=Sis2017213">
          <i class="fa fa-book"></i> <span>test</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<div class="modal fade" id="pass_data_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="POST" action="../Controllers/cambiopascontroller.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Contraseña Actual</label>
            <div class="col-sm-7">
              <input type="text" name="pass0" class="form-control" id="title" required>
              <input type="hidden" name="user" class="form-control" id="title" value='<?php echo $_SESSION['usuario'] ?>'>
            </div>
          </div>
          <div class="form-group">
            <label for="start" class="col-sm-3 control-label">Nueva contraseña</label>
            <div class="col-sm-7">
              <input type="password" name="pass1" class="form-control" id="start" required>
            </div>
          </div>
          <div class="form-group">
            <label for="end" class="col-sm-3 control-label">Repite contraseña</label>
            <div class="col-sm-7">
              <input type="password" name="pass2" class="form-control" id="end" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" name="submit" value="pass">Guardar contraseña</button>
        </div>
      </form>
    </div>
  </div>
</div> <!-- div del wrapper, viene de head.php  -->