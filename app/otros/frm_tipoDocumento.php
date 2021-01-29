<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Gestion Tipo Documentos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <form action="../Controllers/registrotipoDocumentoController.php" method="post">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Descripci&oacute;n del tipo" id="nombre" name="nombre_usuario" required>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="col-xs-3">
              <button type="submit" name="submit" class="btn btn-success btn-block btn-flat" value="registro"> Otro</button>
            </div>
            <div class="col-xs-3">
              <button type="submit" name="submit" class="btn btn-warning btn-block btn-flat" value="registro"> otro Registrar</button>
            </div>
            <div class="col-xs-3">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="registro"> Registrar</button>
            </div>
          </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>