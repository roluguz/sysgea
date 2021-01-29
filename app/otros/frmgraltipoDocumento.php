<?php
$opcion = isset($_REQUEST['op']) ? $_REQUEST['op'] : 0;
$p = "tipodoc";
$enlace = "../php/sessions.php";
switch ($opcion) {
  case 1: // listado general, entra a esta opcion por primera vez
    try {
      include '../modelos/clstipodocumento.php';
      $data['accion'] = 'lista';
      $objtipodoc = new clstipodocumento($data);
      $objtipodoc = $objtipodoc->setData($data);
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
      exit;
      die();
    }
?>
    <div class="box box-default">
      <div class="box-header with-border">
        <h1>Gesti&oacute;n Tipo Documento</h1>
      </div>
      <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
          <?php
          $cod    = "";
          $btnnew  = "<a class='btn btn-success ' title='Adicionar un registro' ";
          $btnnew .= "type='button' datacode='new' href='?page=frmgraltipoDocumento&op=4'";
          $btnnew .= ">Agregar Tipo documento</a>";
          echo $btnnew;
          ?>
        </div>
        <div class="col-xs-4"></div>
      </div>
      <div class=" box-body">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Descripcion</th>
                    <th>Accion-1</th>
                    <th>Accion-2</th>
                  </tr>
                </thead>
                <tbody class="contenidobusqueda">
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($objtipodoc)) {
                    $opEdit =  "<a class='btn btn-success' title='Editar este registro' type='button'";
                    $opEdit .= "href='?page=frmgralTipoDocumento&op=3&id=" . $row['idtipoDocumento'];
                    $opEdit .= "'><i class='fa fa-pencil fa-fw'></i></a>";
                    // $opErase = "<a class='btn btn-danger delTipodocument' title='Borrar este registro' type='button' href='#' datacode=" . $row['idtipoDocumento'];
                    $opErase = "";
                    if ($row['nro'] == 0) {
                      $opErase  = "<a class='btn btn-danger' title='Borrar este registro' type='button' ";
                      $opErase .= "href='?page=frmgralTipoDocumento&op=2&id=" . $row['idtipoDocumento'];
                      $opErase .= "'><i class='fa fa-trash-o fa-lg'></i></a>";
                    }
                    //echo $opErase; die();
                  ?>
                    <tr>
                      <td><?php echo $row['Descripcion'] ?></td>
                      <td style="text-align: center;"><?php echo $opEdit; ?></td>
                      <td style="text-align: center;"><?php echo $opErase; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="col-md-1">
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div>
    </div>
  <?php
    break;
  case 2: // Eliminar 
    /* para cuando es borrar*/
    try {
      include '../modelos/clstipodocumento.php';
      $data['accion'] = 'searchborrar';
      $data['iddele'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
      $objtipodoc = new clstipodocumento($data);
      $objtipodoc = $objtipodoc->setData($data);
      $row = mysqli_fetch_assoc($objtipodoc);
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
    }
  ?>
    <div class="box box-default">
      <div class="box-header with-border">
        <h1>Borrar Tipo Documento</h1>
      </div>
      <div class=" box-body">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="box-body">
              <div class="bodyModal">
                <?php
                $frmdelete =
                  '<form action="../Controllers/registrotipoDocumentoController.php" method="post">'
                  . '<input type="hidden" name="idborrar" id="idborrar" value="' . $row['idtipoDocumento'] . '" required>'
                  . '<div class="box-body">'
                  . '<div class="row">'
                  . '<div class="col-md-12">'
                  . ' <h6><i class="fa fa-cubes" style="font-size: 25pt; color:blue;"></i> </h6>'
                  . '</div>'
                  . '</div><br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-2"><h4><span>Descripcion:</span></h4>'
                  . ' <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>'
                  . ' </div>'
                  . ' <div class="col-md-10">'
                  . ' <div class="form-group has-feedback">'
                  . ' <input type="text" class="form-control" value="' . $row['Descripcion'] . '" placeholder="Descripci&oacute;n" id="descripcion" readonly>'
                  . ' </div>'
                  . ' </div>'
                  . '</div>'
                  . '<br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-12">'
                  . ' </div>'
                  . '</div>'
                  . '<div class="row">'
                  . ' <div class="col-md-6">'
                  . ' <button type="submit" name="submit" class="btn btn-warning btn-block btn-flat"'
                  . ' title="Confirmar borrado" value="erasetipodoc"><i class="fa fa-trash-o fa-lg"></i> Borrar</button>'
                  . ' </div>'
                  . ' <div class="col-md-6">'
                  . '  <a class="btn btn-success btn-block btn-flat" title="Cancelar borrado" '
                  . '     type="button" href="?page=frmgralTipoDocumento&op=1">'
                  . '     <i class="fa fa-times-circle"></i> Cancelar</a>'
                  . ' </div>'
                  . '</div>'
                  . '</div>'
                  . '</form>';
                echo $frmdelete;
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-1">
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div>
    </div>
  <?php
    break;
  case 3: //  Editar
    try {
      include '../modelos/clstipodocumento.php';
      $data['accion'] = 'searchborrar';
      $data['iddele'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
      $objtipodoc = new clstipodocumento($data);
      $objtipodoc = $objtipodoc->setData($data);
      $row = mysqli_fetch_assoc($objtipodoc);
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
    }
  ?>
    <div class="box box-default">
      <div class="box-header with-border">
        <h1>Edici&oacute;n Tipo Documento</h1>
      </div>
      <div class=" box-body">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="box-body">
              <div class="bodyModal">
                <?php
                $frmEdicion =
                  '<form action="../Controllers/registrotipoDocumentoController.php" method="post">'
                  . '<input type="hidden" name="idborrar" id="idborrar" value="' . $row['idtipoDocumento'] . '" required>'
                  . '<div class="box-body">'
                  . '<div class="row">'
                  . '<div class="col-md-12">'
                  . ' <h6><i class="fa fa-cubes" style="font-size: 25pt; color:blue;"></i> </h6>'
                  . '</div>'
                  . '</div><br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-2"><h4><span>Descripcion:</span></h4>'
                  . ' <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>'
                  . ' </div>'
                  . ' <div class="col-md-10">'
                  . ' <div class="form-group has-feedback">'
                  . ' <input type="text" class="form-control" value="' . $row['Descripcion']
                  . ' " placeholder="Descripci&oacute;n" id="descripcion" name="descripcion" required>'
                  . ' </div>'
                  . ' </div>'
                  . '</div>'
                  . '<br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-12">'
                  . ' </div>'
                  . '</div>'
                  . '<div class="row">'
                  . ' <div class="col-md-6">'
                  . ' <button type="submit" name="submit" class="btn btn-warning btn-block btn-flat"'
                  . ' title="Confirmar actualizacion" value="edicion"><i class="fa fa-trash-o fa-lg"></i> Actualizar</button>'
                  . ' </div>'
                  . ' <div class="col-md-6">'
                  . '  <a class="btn btn-success btn-block btn-flat" title="Cancelar Edicion" '
                  . '     type="button" href="?page=frmgralTipoDocumento&op=1">'
                  . '     <i class="fa fa-times-circle"></i> Cancelar</a>'
                  . ' </div>'
                  . '</div>'
                  . '</div>'
                  . '</form>';
                echo $frmEdicion;
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-1">
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div>
    </div>
  <?php
    break;
  case 4: //  Nuevo
  ?>
    <div class="box box-default">
      <div class="box-header with-border">
        <h1>Adici&oacute;n Tipo Documento</h1>
      </div>
      <div class=" box-body">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="box-body">
              <div class="bodyModal">
                <?php
                $frmnuevo =
                  '<form action="../Controllers/registrotipoDocumentoController.php" method="post">'
                  . '<input type="hidden" name="idborrar" id="idborrar" value="new" required>'
                  . '<div class="box-body">'
                  . '<div class="row">'
                  . '<div class="col-md-12">'
                  . ' <h6><i class="fa fa-cubes" style="font-size: 25pt; color:blue;"></i> </h6>'
                  . '</div>'
                  . '</div><br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-2"><h4><span>Descripcion:</span></h4>'
                  . ' <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>'
                  . ' </div>'
                  . ' <div class="col-md-10">'
                  . ' <div class="form-group has-feedback">'
                  . ' <input type="text" class="form-control" '
                  . ' placeholder="Descripci&oacute;n" id="descripcion" name="descripcion" required>'
                  . ' </div>'
                  . ' </div>'
                  . '</div>'
                  . '<br><br><br>'
                  . '<div class="row">'
                  . ' <div class="col-md-12">'
                  . ' </div>'
                  . '</div>'
                  . '<div class="row">'
                  . ' <div class="col-md-6">'
                  . ' <button type="submit" name="submit" class="btn btn-warning btn-block btn-flat"'
                  . ' title="Confirmar guardar" value="nuevo"><i class="fa fa-trash-o fa-lg"></i> Registrar</button>'
                  . ' </div>'
                  . ' <div class="col-md-6">'
                  . '  <a class="btn btn-success btn-block btn-flat" title="Cancelar Nuevo" '
                  . '     type="button" href="?page=frmgralTipoDocumento&op=1">'
                  . '     <i class="fa fa-times-circle"></i> Cancelar</a>'
                  . ' </div>'
                  . '</div>'
                  . '</div>'
                  . '</form>';
                echo $frmnuevo;
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-1">
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div>
    </div>
<?php
    break;
  default:
    $p = "tipodoc";
    $enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    break;
}
?>










<!-- Formulario Modal  -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--				<form class="form-horizontal" method="POST" action="addEvent.php"> -->
      <form role="form" action="../Controllers/registrotipoDocumentoController.php" method="post">
        <!--				<form class="form-horizontal" method="POST" action="#"> -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Adici&oacute;n: Tipo documento</h4>
        </div>
        <div class="modal-body">
          <div class="form-group has-feedback">
            <input type="hidden" class="form-control" id="accion" name="acion" value="nuevo">
          </div>
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Descripci&oacute;n</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" placeholder="Descripci&oacute;n" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="modaltipodoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="bodyModal">
      </div>
    </div>
  </div>
</div>