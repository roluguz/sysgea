
<?php 
if(isset($_GET['code'])){
  $data['accion'] = 'consultapy';
  $data['codigo'] = $_GET['code'];
}
else{
  $data['codigo'] = $_SESSION['proyecto'];
}
  $objpy = "";
  try{
    include '../modelos/consulta.php';
    $objconsulta = new consulta;
    $data['accion'] = 'consultapy';
    $objpy = $objconsulta->setData($data);
}
catch (Exception $Exc){
   echo $Exc->getMessage();
}$row = mysql_fetch_assoc($objpy);
    if( empty($objpy) ){ //agragar ! a empty
        $row = mysql_fetch_assoc($objpy);
  }
?>
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Valorar proyecto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
            </div>
          <div class="col-md-8">       
            <p class="login-box-msg">Asignar nota final a proyecto</p>
            <div class="box box-info">
                <form role="form" action="../Controllers/calificarController.php" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Numero de Documento" id="usuario" name="usuario" readonly value=<?php echo $_SESSION['usuario']; ?> >  
                        </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Nombre de proyecto</label>
                                <textarea class="form-control" rows="2" placeholder="Nombre del proyecto" id="nombre_proyecto" name="nombre_proyecto" required/><?php echo $row['nombre_proyecto'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Semestre proyecto</label>
                            <input type="text" class="form-control" id="clave" placeholder="Semestre Proyecto" name="semestre_proyecto" required value=<?php echo $row['semestre_proyecto'] ?>>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Semestre proyecto</label>
                            <input type="hidden" class="form-control" id="clave" placeholder="Semestre Proyecto" name="codigo_semestre" required value=<?php echo $row['codigo_semestre'] ?>>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Valoracion final</label>
                            <input type="text" class="form-control" id="clave" placeholder="Nota final" name="valoracion" required>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputEmail1">Comentarios</label>
                                <textarea class="form-control" rows="2" placeholder="Comentarios sobre la valoracion" id="comentarios" name="comentarios" required/></textarea>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Promover semestre</label>
                            <select class="form-control" name="promover" required placeholder="Actualizar semestre" >
                                <option></option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button name="submit" type="submit" class="btn btn-primary"
                            <?php if($_SESSION['perfil']=='PRASES'){
                                echo 'value="ag-calificar">Registrar</button>';
                            }elseif($_SESSION['perfil']=='PRADMIN'){
                                echo 'value="up_calificar">Modificar</button>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

          </div>
            <div class="col-md-2">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>