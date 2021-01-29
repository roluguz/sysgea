<?php 
  $objlsar = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'docuemntos';
    $data['codigo']="general";
    $objlsar = $objconsulta->setData($data);
}
catch (Exception $Exc){
   echo $Exc->getMessage();
}

	if( !empty($objlsar) ){
   //$usuario = mysql_fetch_assoc($objnr);
   // $usuario = mysql_fetch_assoc($objnr);
  }
?>

<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Aprobacion de Proyectos</h3>
        </div>
        <div class="box-body">
         
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
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Actualización</th>
                  <th>Descripción</th>
                  <th>Descarga</th>
                </tr>
                </thead>
                <tbody  class="contenidobusqueda">
                  <?php
                    $i=1;
                    while($row = mysqli_fetch_assoc($objlsar)){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['nombre_formato'] ?></td>
                      <td><?php echo $row['actualizaciom'] ?></td>
                      <td><?php echo$row['descripcion'] ?></td>
                      <td><?php echo "<a href='".$row['direccion'].$row['nombre_archivo']."'>Bajar</a>" ?></td>
                      </tr><?php
                      $i++;
                    }                    
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Actualización</th>
                  <th>Descripción</th>
                  <th>Descarga</th>
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

     