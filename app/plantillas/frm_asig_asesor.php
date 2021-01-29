<?php

$data['accion'] = 'asesor';
$objas = "";
$objpys = "";
$objpyas = "";
try {
  include '../modelos/asignarasesor.php';
  $objasesor = new asignarasesor;
  $objas = $objasesor->setData($data);
  $data['accion'] = 'proyectossin';
  $objpys = $objasesor->setData($data);
  $data['accion'] = 'proyasignado';
  $objpyas = $objasesor->setData($data);
} catch (Exception $Exc) {
  echo $Exc->getMessage();
}

if (!empty($objnr)) {
  //$usuario = mysql_fetch_assoc($objnr);
  // $usuario = mysql_fetch_assoc($objnr);
}
?>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Registro de docentes Asesores</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <form method="post" action="../Controllers/insertarController.php">
        <div class="col-md-5">
          <div class="form-group">
            <label>Asesores</label>
            <select class="form-control select2" style="width: 100%;" name="asesor" required>
              <?php
              $i = 1;
              while ($row = mysqli_fetch_assoc($objas)) {
                echo "<option value='" . $row['id_asesor'] . "'>" . $row['nombres_asesor'] . " " . $row['apellidos_asesor'] . "</option>";
              }
              ?>
            </select>
          </div>
          <!--
                  <div class="form-group">
                  </div>
                -->
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Proyectos sin asesor</label>
            <select class="form-control select2" style="width: 100%;" name="semestrepy" required>
              <?php
              $i = 1;
              while ($row = mysqli_fetch_assoc($objpys)) {
                echo "<option value='" . $row['id_semestrepro'] . "'>" . $row['nombre_proyecto'] . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>&nbsp;&nbsp;</label><br />
            <button name="submit" type="submit" class="btn btn-primary" value="ag-asesor">Relacionar</button>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div class="box-body">
          <div class="input-group"> <span class="input-group-addon">Filtrado</span>
            <input id="entradafilter" type="text" class="form-control">
          </div>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Proyecto</th>
                <th>Semestre</th>
                <th>Asesor</th>
                <th>Perfil</th>
              </tr>
            </thead>
            <tbody class="contenidobusqueda">
              <?php
              $i = 1;
              while ($row = mysqli_fetch_assoc($objpyas)) { ?>
                <tr>
                  <td><?php echo $row['cod_proy'] ?></td>
                  <td><?php echo $row['nombre_proyecto'] ?></td>
                  <td><?php echo $row['semestre_proyecto'] ?></td>
                  <td><?php echo $row['nombres_asesor'] . " " . $row['apellidos_asesor'] ?></td>
                  <td><?php echo "<a href='?page=perfil&code=" . $row['cod_proy'] . "'>Ver</a>" ?></td>
                </tr><?php
                    }
                      ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Codigo</th>
                <th>Proyecto</th>
                <th>Semestre</th>
                <th>Asesor</th>
                <th>Perfil</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="col-md-1">
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>