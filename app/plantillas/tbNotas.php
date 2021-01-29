
<?php 
  $objpyap = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'proyectosg';
    $objpyap = $objconsulta->setData($data);
  }
  catch (Exception $Exc){
   echo $Exc->getMessage();
  }
	if( empty($objpyap) ){ //agragar ! a empty
    echo "Actualmente existen archivos para este proyecto";
  }else{
    echo sha1("admincua");
?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Revision de proyecto</h3>
    </div><!-- /.box-header -->            
    <div class="box-body">
      <div class="input-group"> <span class="input-group-addon">Filtrado</span>
        <input id="entradafilter" type="text" class="form-control">
      </div>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>#</th>
          <th>Proyecto</th>
          <th>Semestre</th>
          <th>Asesor</th>
          <th>Calificación</th>
          <th>Actualización</th>
        </tr>
        </thead>
        <tbody class="contenidobusqueda">
        <?php
          $i=1;
          while($row = mysqli_fetch_assoc($objpyap)){ ?>
            <tr>
            <td><?php echo $i ?></td>
            <td><?php echo"<a href='#' name='age' id='age' data-toggle='modal' data-target='#pass_data_Modal'>". $row['nombre_proyecto'] ."</a>"?></td>  
            <td><?php echo"<a href='#' name='age' id='age' data-toggle='modal' data-target='#pass_data_Modal'>". $row['semestre_proyecto'] ."</a>"?></td>
            <td><?php echo"<a href='#' name='age' id='age' data-toggle='modal' data-target='#pass_data_Modal'>". $row['nombres_asesor']." ".$row['apellidos_asesor'] ."</a>"?></td>  
            <td><?php echo"<a href='#' name='age' id='age' data-toggle='modal' data-target='#pass_data_Modal'>". $row['valoracion'] ."</a>"?></td>
            <td><?php echo"<a href='#' name='age' id='age' data-toggle='modal' data-target='#pass_data_Modal'>". $row['create_at'] ."</a>"?></td>
            </tr><?php
            $i++;
          }   
        ?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Proyecto</th>
            <th>Semestre</th>
            <th>aAsesor</th>
            <th>Calificación</th>
            <th>Actualización</th>
          </tr>
        </tfoot>
      </table>
    </div><!-- /.box-body -->      
  </div>
<?php } ?>

  
