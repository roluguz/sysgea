
<?php 
  $data['accion'] = 'consultar';
  $data['proyecto'] = $_SESSION['proyecto']; 
  $objnr = "";
  try{
    include '../modelos/notas.php';
    $objnotas = new notas;
    $objnr = $objnotas->setData($data);   
  }
  catch (Exception $Exc){
    echo $Exc->getMessage();
  }
  if( !empty($objnr) ){
   //$usuario = mysql_fetch_assoc($objnr);
   // $usuario = mysql_fetch_assoc($objnr);
?>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Calificación final de proyecto</h3>
  </div>
        <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
        <div class="col-md-1">
        </div>
    <div class="col-md-10">
      <p class="login-box-msg">Nota de entregas</p>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Semestre</th>
            <th>Valoración</th>
            <th>Fecha calificación</th>
            <th>Asesor</th>
          </tr>
          <?php
            $i=1;
              while($row = mysqli_fetch_assoc($objnr)){ ?>
                <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['semestre_proyecto'] ?></td>  
                <td><?php echo $row['valoracion'] ?></td>
                <td><?php echo $row['create_at'] ?></td>  
                <td><?php echo $row['nombres_asesor']." ".$row['apellidos_asesor']  ?></td>
                </tr><?php
                $i++;
              }                    
            ?>          
        </table>
      </div>          
    </div>
    <div class="col-md-1">
    </div>
            <!-- /.col -->
  </div>
        <!-- /.row -->
</div>
<?php
	}
	else{
		echo "No hay notas disponibles para este proyecto";
  }
?>