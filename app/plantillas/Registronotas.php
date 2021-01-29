<?php
  $data['accion'] = 'asesor';
  $objas = "";
  $objpys = "";
  $objpyas = "";
  try{
    include '../modelos/asignarasesor.php';
    $objasesor = new asignarasesor;
    $objas = $objasesor->setData($data);
    $data['accion'] = 'proyectossin';
    $objpys = $objasesor->setData($data);
    $data['accion'] = 'proyasignado';
    $objpyas = $objasesor->setData($data); 
}
catch (Exception $Exc){
   echo $Exc->getMessage();
}

	if( !empty($objnr) ){
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
      <div class="col-md-1">
    </div>
    <div class="col-md-10">
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Proyecto</th>
            <th>Semestre</th>
            <th>Semestre</th>
            <th>Asesor</th>
            <th>Perfil</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $i=1;
            while($row = mysqlI_fetch_assoc($objpyas)){ ?>
              <tr>
              <td><?php echo $row['nombre_proyecto'] ?></td>  
              <td><?php echo $row['semestre_proyecto'] ?></td>
              <td><?php echo $row['semestre_proyecto'] ?></td>  
              <td><?php echo $row['nombres_asesor'] ." ".$row['apellidos_asesor']?></td>
              <td><?php echo "<a href='?page=perfil&code=".$row['cod_proy']."'>Ver</a>" ?></td>
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

     