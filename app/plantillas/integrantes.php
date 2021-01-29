
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de integrantes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
            </div>
          <div class="col-md-8">       
            <p class="login-box-msg">Agregar integrantes</p>
            <div class="box box-primary">
                <form role="form" action="../Controllers/integrantesController.php" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Poyecto" id="proyecto" name="proyecto" readonly value=<?php if(!isset($_SESSION['proyecto'])){}else{echo $_SESSION['proyecto']; }?> > 
                        </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Correo Estudiante</label>
                                <input type="email" class="form-control" id="correo" placeholder="Ingrese Correo Institucional"  name="correo">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Ususraio Estudiante</label>
                                <input type="text" class="form-control" id="usuario" placeholder="Ingrese Usuario" name="usuario">
                        </div>
                        <div class="box-footer">
                            <button name="submit" type="submit" class="btn btn-primary" value="ag-integrante">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="login-box-msg">Inscribirse a proyecto</p>
            <div class="box box-info">
                <form role="form" action="../Controllers/integrantesController.php" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Numero de Documento" id="usuario" name="usuario" readonly value=<?php echo $_SESSION['usuario']; ?> >  
                        </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Codigo de proyecto</label>
                                <input type="text" class="form-control" id="proyecto" placeholder="Ingrese Codigo de Proyecto"  name="proyecto">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputPassword1">Clave de registro</label>
                                <input type="text" class="form-control" id="clave" placeholder="Ingrese Clave de registro" name="clave">
                        </div>-->
                        <div class="box-footer">
                            <button name="submit" type="submit" class="btn btn-primary" value="ag-proyecto">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if(!isset($_SESSION['proyecto']) or 2 == 2){}
            else{ ?>

            <p class="login-box-msg">Generar clave de registro</p>
            <div class="box box-primary">
                <form role="form" action="../Controllers/.php" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Poyecto" id="proyecto" name="proyecto" readonly value=<?php echo $_SESSION['proyecto']; ?> > 
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Clave</label>
                                <input type="text" class="form-control" id="usuario" placeholder="Clave de registro" name="clave" readonly>
                        </div>
                        <div class="box-footer">
                            <button name="submit" type="submit" class="btn btn-primary" value="ag-integrante">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
          </div>
         
            <div class="col-md-2">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
   