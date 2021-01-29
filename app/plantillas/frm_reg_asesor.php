<?php
    try {
      include '../modelos/clstipodocumento.php';
      $data['accion'] = 'lista';
      $objtipo = new clstipodocumento($data);
      $objtipo = $objtipo->setData($data);
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
      exit;
      die();
    }
    try {
      include '../modelos/clscarreras.php';
      $data['accion'] = 'lista';
      $obkra = new clscarreras($data);
      $obkra = $obkra->setData($data);
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
      exit;
      die();
    }    
        
?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Registro de docentes Asesores</h3>
  </div>
        <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">       
        <form action="../Controllers/registroasesorController.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario de conexion" id="usuario" required> 
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="correo" class="form-control" placeholder="Correo institucional"id="correo" onblur="fAgrega();" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Conraseña" id="strPassword" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
            <label>Tipo de documento</label>
              <?php
              $cboTipo = "";
              $cboTipo = '<select class="form-control" name="t_documento_usuario" required placeholder="Tipo de Documento" >';
              $cboTipo.= '<option value="-1">Seleccione</option>';
              while ($row = mysqli_fetch_assoc($objtipo)) {
                $cboTipo.= '<option value='.$row['idtipoDocumento'].'>';
                $cboTipo.= $row['Descripcion'].'</option>';
              }
              $cboTipo.='</select>';
              echo $cboTipo;
              ?>
          </div>
          <div class="form-group has-feedback">
            <input type=number class="form-control" placeholder="Numero de Documento" id="nombre" name="documento_usuario" required> 
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Carrera</label>
              <?php
              $cbkra = "";
              $cbkra = '<select class="form-control" name="codcarrera" ';
              $cbkra.= 'required placeholder="Carrera" >';
              $cbkra.= '<option value="-1">Seleccione</option>';
              while ($row = mysqli_fetch_assoc($obkra)) {
                $cbkra.= '<option value='.$row['idCarrera'].'>';
                $cbkra.= $row['nCarrera'].'</option>';
              }
              $cbkra.='</select>';
              echo $cbkra;
              ?>            
          </div>
          <div class="form-group has-feedback"> 
            <input type=text class="form-control" placeholder="Especialidad" id="nombre" name="especialidad" required> 
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
            <div class="col-xs-8"> </div>
          </div>
          <div class="col-xs-3">
              <button type ="submit" name="submit" class="btn btn-primary btn-block btn-flat" value ="registro"> Registrar</button>
          </div>
        </form>
      </div>
      <div class="col-md-2">
      </div> <!-- /.col -->
    </div>   <!-- /.row -->        
  </div>
</div>  

     