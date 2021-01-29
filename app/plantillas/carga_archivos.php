
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Cargar proyecto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
            </div>
          <div class="col-md-8">       
            <form role="form" action="../Controllers/cargaController.php" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_archivo">Código de Proyecto</label>
                  <input type="text" class="form-control" id="proyecto" name="proyecto" readonly value="<?php echo $_SESSION['proyecto']?>" >
                </div>
                <div class="form-group">
                  <label for="nombre_archivo">Nombre del archivo</label>
                  <input type="text" class="form-control" id="nombre_archivo" placeholder="Nombre del archivo" name="nombrearch">
                  <input type="hidden" class="form-control" id="" placeholder="Nombre del archivo" name="usuario" value=<?php echo $_SESSION['nombres_usario'].'-'.$_SESSION['apellidos_usuario'];?>>
				        </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea class="form-control" rows="3" placeholder="Descripción del archivo"  name="descripcion"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Cargar archivo</label>
                  <input name="archivo" type="file" id="archivo">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="complementos"  id="archivo">Guardar</button>
              </div>
            </form>
          </div>
            <div class="col-md-2">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

     