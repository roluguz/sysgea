<?php 
  $objpynp = "";
  $objpyap = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'proyectosinap';
    $objpynp = $objconsulta->setData($data);
    $data['accion'] = 'proyectoap';
    $objpyap = $objconsulta->setData($data);
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
    <h3 class="box-title">Aprobación de Proyectos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <form method="post" action="../Controllers/insertarController.php">
        <div class="col-md-5">
          <div class="form-group">
            <label>Proyectos Pendientes</label>
            <select class="form-control select2" style="width: 100%;" name="semestrepy">
              <?php
              $i=1;
                while($row = mysqli_fetch_assoc($objpynp)){ 
                  if($row['estado_proyecto'] ==1){
                    echo "<option value='".$row['cod_proy']."'>".$row['nombre_proyecto']."</option>";
                    }
                }                        
              ?> 
            </select>
          </div>
          <div class="form-group">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Seleccione una opción</label>
            <select class="form-control select2" style="width: 100%;" name="estado">
              <option value='2'>Aprobado</option>
              <option value='0'>Rechazado</option>
              <option value='6'>Archivar</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label></label>
            <button name="submit" type="submit" class="btn btn-primary" value="ac-proyecto">Relacionar</button>              
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
              <th>Proyecto</th>
              <th>Semestre</th>
              <th>Estado</th>
              <th>Actualización</th>
              <th>Perfil</th>
            </tr>
            </thead>
            <tbody class="contenidobusqueda">
              <?php
                $i=1;
                while($row= mysqli_fetch_assoc($objpyap)){
                  if($row['estado_proyecto'] <> 0){
                  ?>
                  <tr>
                  <td><?php echo $row['nombre_proyecto'] ?></td>
                  <td><?php echo $row['semestre_proyecto'] ?></td>
                  <td><?php if ($row['estado_proyecto'] =='1') echo"Pendiente"; elseif ($row['estado_proyecto'] =='2') echo"Aprobado"; ?></td>   
                  <td><?php echo $row['update_at'] ?></td>
                  <td><?php echo "<a href='?page=perfil&code=".$row['cod_proy']."'>Ver</a>" ?></td>
                  </tr><?php
                  }
                }                    
              ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Proyecto</th>
              <th>Semestre</th>
              <th>Estado</th>
              <th>Actualización</th>
              <th>Perfil</th>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="col-md-1">
      </div>
    </div>
</div>

     