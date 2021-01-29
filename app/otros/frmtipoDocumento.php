<?php
$objpynp = "";
//$objpyap = "";
try {
  include '../modelos/clstipodocumento.php';
  
  $data['accion'] = 'lista';
  $objtipodoc = new clstipodocumento($data);
  $objtipodoc = $objtipodoc->setData($data);
} catch (Exception $Exc) {
  echo $Exc->getMessage();
}

?>
<div class="box box-default">
  <div class="box-header with-border">
    <h1>Gesti&oacute;n Tipo Documento</h1>
  </div>
  <div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <!--      <button type="button" name="t" id="t" data-toggle="modal" data-target="#modalnuevo" class="btn btn-success">Agregar Tipo documento</button> -->
      <a class='btn btn-success' title='Adicionar un registro' type='button' href='#' datacode='new'>Agregar Tipo documento</a>
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
                $opEdit .= "href='?page=frmEraseTipoDocumento&id=" . $row['idtipoDocumento'];
                $opEdit .= "'><i class='fa fa-pencil fa-fw'></i></a>";
                // $opErase = "<a class='btn btn-danger delTipodocument' title='Borrar este registro' type='button' href='#' datacode=" . $row['idtipoDocumento'];
                $opErase = "";
                if ($row['nro'] == 0){                  
                  $opErase  = "<a class='btn btn-danger' title='Borrar este registro' type='button' ";
                  $opErase .= "href='?page=frmEraseTipoDocumento&id=".$row['idtipoDocumento'];
                  $opErase .= "'><i class='fa fa-trash-o fa-lg'></i></a>";
                }
                //echo $opErase; die();
              ?>
              <tr>
                <td><?php echo $row['Descripcion'] ?></td>
                <td style="text-align: center;"><?php echo $opEdit ;?></td>
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