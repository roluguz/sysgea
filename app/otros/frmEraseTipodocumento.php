<?php
try {
  include '../modelos/clstipodocumento.php';
  $data['accion'] = 'searchborrar';
  $data['iddele'] = $_REQUEST['id'];
  $objtipodoc = new clstipodocumento($data);
  $objtipodoc = $objtipodoc->setData($data);
} catch (Exception $Exc) {
  echo $Exc->getMessage();
  die();
}
$row = mysqli_fetch_assoc($objtipodoc);
/*
echo "<pre>";
echo "en frmEraseTipoDocumento...(3)" . "<br>";
echo "POST..." . "<br>";
print_r($_POST);
echo "REQUEST..." . "<br>";
print_r($_REQUEST);
echo "SESSION..." . "<br>";
print_r($_SESSION);
echo "</pre>";
echo "row..." . "<br>";
print_r($row);
*/
//die();

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
              . ' <div class="col-md-2"><h4><span>Descripcion:</span></h4></div>'
              . ' <div class="col-md-10">'
              . ' <div class="form-group has-feedback">'
              . ' <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>'
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
              . ' <button type="submit" name="submit" class="btn btn-warning btn-block btn-flat" value="erasetipodoc"> Borrar</button>'
              . ' </div>'
              . ' <div class="col-md-6">'
              . '    <a class="btn btn-success btn-block btn-flat" title="Canelar borrado" type="button" href="?page=frmTipoDocumento"><i class="fa fa-times-circle"></i> Cancelar</a>'
              //. ' <button type="button" class="btn btn-success btn-block btn-flat" onclick="colosemodal();"><i class="fa fa-times-circle"></i> Cancelar</button>'
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
        <?php
        $frmdelete =
          '<form action="" method="post">'
          . '<input type="hidden" name="idborrar" id="idborrar" value="' . $row['idtipoDocumento'] . '" required>'
          . '<div class="box-body">'
          . '<div class="row">'
          . '<div class="col-md-4">'
          . ' <h6><i class="fa fa-cubes" style="font-size: 25pt;"></i> </h6>'
          . '</div>'
          . '<div class="col-md-8">'
          . ' <h1 style="font-size: 18pt; color:red;">Borrar tipo documento</h1> '
          . '</div><br>'
          . '</div>'
          . '<div class="row">'
          . ' <div class="col-md-2"><span>Descripcion:</span></div>'
          . ' <div class="col-md-10">'
          . ' <div class="form-group has-feedback">'
          . ' <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>'
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
          . ' <button type="button" class="btn btn-warning btn-block btn-flat" value="1"> Borrar</button>'
          . ' </div>'
          . ' <div class="col-md-6">'
          . ' <button type="button" class="btn btn-success btn-block btn-flat" onclick="colosemodal();"><i class="fa fa-times-circle"></i> Cancelar</button>'
          . ' </div>'
          . '</div>'
          . '</div>'
          . '</form>';
        echo $frmdelete;
        ?>
      </div>
    </div>
  </div>
</div>