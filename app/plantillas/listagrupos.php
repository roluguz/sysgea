<?php 
  $objlsar = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'listaproyectos';
    $data['codigo']=$_SESSION['usuario'];
    $objlsgr = $objconsulta->setData($data);
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
    <h3 class="box-title">Proyectos asignados</h3>
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
              <th>Proyecto</th>
              <th>Semestre</th>
              <th>Archivos</th>
              <th>Actualizacion</th>
              <th>Perfil</th>
              <th>Nota Final</th>
            </tr>
            </thead>
            <tbody  class="contenidobusqueda">
              <?php
                $i=1;
                while($row = mysqli_fetch_assoc($objlsgr)){ ?>
                  <tr>
                  <td><?php echo $row['nombre_proyecto'] ?></td>
                  <td><?php echo $row['semestre_proyecto'] ?></td>
                  <td><?php echo "<a href='?page=archivos&code=".$row['cod_proy']."'>Ver</a>" ?></td>   
                  <td><?php echo $row['create_at'] ?></td>
                  <td><?php echo "<a href='?page=perfil&code=".$row['cod_proy']."'>Ver</a>" ?></td>
                  <td><?php echo "<a href='?page=calificar&code=".$row['cod_proy']."'>Asignar</a>"?></td>
                  </tr><?php
                }                    
              ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Proyecto</th>
              <th>Semestre</th>
              <th>Archivos</th>
              <th>Actualizacion</th>
              <th>Perfil</th>
              <th>Nota Final</th>
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

     