
<?php 
if(isset($_GET['code'])){
  $data['accion'] = 'mostrararchivo';
  $data['codigo'] = $_GET['code'];
}
else{
  $data['codigo'] = $_SESSION['proyecto'];
}
  $objlsar = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'mostrararchivo';
    $objlsar = $objconsulta->setData($data);
}
catch (Exception $Exc){
   echo $Exc->getMessage();
}

	if( empty($objlsar) ){ //agragar ! a empty
    echo "Actualmente existen archivos para este proyecto";
  }else{
?>

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Entregas de proyecto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Semestre</th>
                  <th>Archivo</th>
                  <th>Fecha de entrega</th>
                  <th>Propietario</th>
                  <th>descargar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i=1;
                    while($row = mysqli_fetch_assoc($objlsar)){ ?>
                      <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['semestre_proyecto'] ?></td>  
                      <td><?php echo $row['nombre_archivo'] ?></td>
                      <td><?php echo $row['create_at'] ?></td>  
                      <td><?php echo $row['propietario'] ?></td>
                      <td>
                        <?php 
                          $descarga =$row['ubicacion_archivo'].$row['codigo_entrega'].$row['extencion'];
                          echo "<a href='".$descarga."'>Descarga</a>"
                      ?></td>
                      </tr><?php
                      $i++;
                    }   
                 ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Semestre</th>
                  <th>Archivo</th>
                  <th>Fecha de entrega</th>
                  <th>Propietario</th>
                  <th>descargar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
<?php } ?>

  
