<?php
$opcion = isset($_REQUEST['op']) ? $_REQUEST['op'] : 0;
$p = "tipodoc";
$enlace = "../php/sessions.php";
$tit = "";
$strAction = "";
$strb1 = "";
$strb2 = "";
switch ($opcion) {
  case 1: // listar todos(Incluyendo los descativados-eliminados)
    try {
      include '../modelos/clsAsesores.php';
      $data['accion'] = 'lista';
      $obAsesor = new clsAsesores($data);
      $obAsesor = $obAsesor->setData($data);
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
        <h1>Gesti&oacute;n Asesores</h1>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php
          $cod    = "";
          $btnnew  = "<a class='btn btn-success btn-block btn-flat' title='Adicionar un Asesor' ";
          $btnnew .= "type='button' datacode='new' href='?page=frmgralAsesores&op=4'";
          $btnnew .= ">Agregar Asesor</a>";
          echo $btnnew;
          /*echo "<pre>";
          echo "frmgralAsesores, linea-37" . "<br>";
          print_r($obAsesor);
          echo "REQUEST" . "<br>";
          print_r($_REQUEST);
          echo "</pre>";
          die();*/
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
              <table id="example1" class="display table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nombre Asesor</th>
                    <th>Apellido Asesor</th>
                    <th>Nro Documento</th>
                    <th>Telefono</th>
                    <th>Correo personal</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody class="contenidobusqueda">
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($obAsesor)) {
                    $iniref  = '<a ';
                    $finref  = '</a>';
                    $figedit = '<i class="fa fa-pencil fa-fw"></i> ';
                    $figdel  = '<i class="fa fa-trash-o fa-lg"></i> ';
                    $figact  = '<i class="fa fa-calendar-check-o fa-lg"></i> ';
                    $opEdit  = ' class="btn btn-primary" title="Editar este registro"';
                    $opErase = ' class="btn btn-danger"  title="Borrar este registro"';
                    $opActive = " class='btn btn-success' title='Activar este asesor'  ";
                    $inispan = '<span ';
                    $finspan = '</span>';
                    if ($row['estado'] == 1) { // esta activo   
                      $opActive = ' class="btn btn-warning"  title="Registro esta ACTIVO"';
                      $opActive = $inispan . $opActive . '">' . $figact . $finspan;
                      $opEdit =  $iniref . $opEdit;
                      $opEdit .= ' type="button" href="?page=frmgralAsesores&op=3&id=' . $row['id_asesor'] . '">';
                      $opEdit .= $figedit . $finref;
                      if ($row['nro'] == 0) {
                        $opErase  = $iniref . $opErase;
                        $opErase .= ' type="button" href="?page=frmgralAsesores&op=2&id=' . $row['id_asesor'] . '">';
                        $opErase .= $figdel . $finref;
                      } else {
                        $opErase = ' class="btn btn-warning"  title="NO SE PÚEDE Borrar este registro"';
                        $opErase = $inispan . $opErase . '">' . $figdel . $finspan;
                      }
                    } else {
                      $opEdit  = ' class="btn btn-warning" title="Registro Inactivo, NO SE PUEDE Editar"';
                      $opErase = ' class="btn btn-warning" title="Registro Inactivo, NO SE PÚEDE Borrar"';
                      $opEdit  = $inispan . $opEdit   . '">' . $figedit . $finspan;
                      $opErase = $inispan . $opErase . '">' . $figdel  . $finspan;
                      $opActive  = "<a class='btn btn-success' title='Activar este asesor'  ";
                      $opActive .= 'type="button" href="?page=frmgralAsesores&op=5&id=' . $row['id_asesor'] . '">';
                      $opActive .= $figact . $finref;
                    }
                    $btn = $opEdit . ' ' . $opErase . ' ' . $opActive
                  ?>
                    <tr>
                      <td><?php echo trim($row['nombres_asesor']); ?></td>
                      <td><?php echo trim($row['apellidos_asesor']); ?></td>
                      <td><?php echo trim($row['numero_documento']); ?></td>
                      <td><?php echo trim($row['numero_telefono']); ?></td>
                      <td><?php echo trim($row['correo_personal']); ?></td>
                      <td style="text-align: center;"><?php echo $btn; ?></td>
                      <!--
                      <td style="text-align: center;"><?php echo $opEdit; ?></td>
                      <td style="text-align: center;"><?php echo $opErase; ?></td>
                      <td style="text-align: center;"><?php echo $opActive; ?></td> -->
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
  case 2: // Borrra
    $strAction = "Borrrar";
    $tit   = "Borrar docentes Asesores";
    $strb1 = "Cancelar borrado";
    $strb2 = "Confirmar borrado";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2);
    break;
  case 3:  // Editar
    $strAction = "Editar";
    $tit   = "Edici&oacute;n docentes Asesores";
    $strb1 = "Cancelar Edici&oacute;n";
    $strb2 = "Confirmar Edici&oacute;n";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2);
    break;
  case 4: // Nuevo registro, revisar 
    $strAction = "Nuevo";
    $tit   = "Adici&oacute;n docentes Asesores";
    $strb1 = "Cancelar adici&oacute;n";
    $strb2 = "Confirmar adici&oacute;n";
    echo generaHTML(2, $tit, $strAction, $strb1, $strb2);
    break;
  default:
    //$p = "tipodoc";
    //$enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    break;
}
function generaHTML($xx, $tit, $strAction, $strb1, $strb2)
{
  $n = 0;
  $tipo    = "";
  $codcar  = "";
  $idbusca = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
  if ($xx == 1) {
    try {
      include '../modelos/clsAsesores.php';
      $data['idsearch'] = $idbusca;
      $data['accion']   = 'searchone';
      $obAsesor = new clsAsesores($data);
      $obAsesor = $obAsesor->setData($data);
      $n = mysqli_num_rows($obAsesor);
      if ($n == 0) {
        $p = "tipodoc";
        $enlace = "?page=frmgralAsesores&op=1";
        include('../plantillas/paso.php');
      } else {
        $rs = mysqli_fetch_assoc($obAsesor);
        $tipo   = $rs['tipo_documento'];
        $codcar = $rs['carrera'];
        /*
                echo "<pre>";
                echo "frmgralAsesores, linea-175" . "<br>";
                echo "obAsesor->"."<br>";
                print_r($row);
                
                echo "<br>". "codigo carrera->". $codcar;
                echo "<br>". "codigo tipo->"   . $tipo;
                echo "</pre>";
                die();*/
      }
    } catch (Exception $Exc) {
      $t = $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
      exit;
      die();
    }
  }
  try {
    include '../modelos/clstipodocumento.php';
    $data['accion'] = 'lista';
    $objtipo = new clstipodocumento($data);
    $objtipo = $objtipo->setData($data);
  } catch (Exception $Exc) {
    $t = $Exc->getMessage();
    $p = "tipodoc";
    $enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    die();
  }
  try {
    include '../modelos/clscarreras.php';
    $data['accion'] = 'lista';
    $obkra = new clscarreras($data);
    $obkra = $obkra->setData($data);
  } catch (Exception $Exc) {
    $t = $Exc->getMessage();
    $p = "tipodoc";
    $enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    die();
  }
  $cboTipo = "";
  $cboTipo = '<select class="form-control" name="tpdocumento" required placeholder="Tipo de Documento" >';
  $cboTipo .= '<option value="-1">Seleccione tipo documento</option>';
  while ($row = mysqli_fetch_assoc($objtipo)) {
    $sele = ($tipo == $row['idtipoDocumento']) ? ' selected>' : '>';
    $cboTipo .= '<option value=' . $row['idtipoDocumento'] . $sele;
    //$cboTipo .= '<option value=' . $row['idtipoDocumento'] . '>';
    $cboTipo .= $row['Descripcion'] . '</option>';
  }
  $cboTipo .= '</select>';
  $cbkra = "";
  $cbkra = '<select class="form-control" name="codcarrera" ';
  $cbkra .= 'required placeholder="Carrera" >';
  $cbkra .= '<option value="-1">Seleccione</option>';
  while ($row = mysqli_fetch_assoc($obkra)) {
    $sele = ($codcar == $row['idCarrera']) ? ' selected>' : '>';
    $cbkra .= '<option value=' . $row['idCarrera'] . $sele;
    $cbkra .= $row['nCarrera'] . '</option>';
  }
  $cbkra .= '</select>';
  $headform = '<form action="../Controllers/registerasesorController.php" method="post">';
  $strHTML = "";
  $strHTML =
    '<div class="box box-default">
    <div class="box-header with-border">
      <h1>' . $tit . '</h1>
    </div> <!-- box-header with-border -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        ' . $headform . '
            <input type="hidden" id="idaccion" name="idaccion" value="' . $idbusca . '">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario de conexion" 
                    required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="email" name="correo" id="correo" class="form-control"
                  placeholder="Correo institucional" onblur="fAgrega();"
                  placeholder="Correo personal" title = "Correo institucional/Personal"                  
                  value="' . (($xx == 1) ? $rs['correo_personal'] : '') . '" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="password" name="strpsw" id="strpsw" class="form-control" placeholder="Conraseña" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="text" name="nomasesor" id="nomasesor" class="form-control" 
                  placeholder="Nombres" title = "Nombres del asesor"
                  value="' . (($xx == 1) ? $rs['nombres_asesor'] : '') . '" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="text" name="apeasesor" id="apeasesor" class="form-control" 
                  placeholder="Apellidos" title = "Apellidos del asesor"
                   value="' . (($xx == 1) ? $rs['apellidos_asesor'] : '') . '" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <label>Tipo de documento</label> ' . $cboTipo . '
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="number" name="nrodoc" id="nrodoc" class="form-control" 
                  placeholder="Numero de Documento" 
                  title = "Numero de Documento"
                  value="' . (($xx == 1) ? $rs['numero_documento'] : '') . '" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <span>Carrera</span>' . $cbkra . '
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="text" name="codspecial" id="codspecial" class="form-control" placeholder="Especialidad" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="email" name="correo2" id="correo2" class="form-control" 
                  placeholder="Correo personal" title = "Correo personal"                  
                  value="' . (($xx == 1) ? $rs['correo_personal'] : '') . '" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <input type="number" name="telasesor" id="telasesor" class="form-control" 
                    placeholder="Telefono" title = "Telefono"                  
                    value="' . (($xx == 1) ? $rs['numero_telefono'] : '') . '" required>
                  <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
              <button type="button" class="btn btn-success btn-block btn-flat openBtn">
              <i class="fa fa-times-circle"></i> Adicionar Carreras</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-danger btn-block btn-flat" title="' . $strb1 . '"
                    type="button" href="?page=frmgralAsesores&op=1">
                  <i class="fa fa-times-circle"></i> Regresar</a>
              </div>
              <div class="col-md-6">
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"
                    title="' . $strb2 . '" value="' . $strAction . '">
                  <i class="fa fa-check-square"></i> Registrar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2">
        </div> <!-- col-md-2 -->
      </div> <!-- row -->
    </div> <!-- box-body -->
  </div> <!-- box box-default --> ';
  return $strHTML;
}

?>




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Modal with Dynamic Content</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal" id="modaltipodoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> -->
<div class="modal fade" tabindex="-1" role="dialog" id="modaltipodoc" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="bodyModal">
      </div>
    </div>
  </div>
</div>

<div id="ModalCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" id="form-crear">
        <div class="bodyModal">
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-6">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove"></span>
                <span class="hidden-xs">Cerrar</span>
              </button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove"></span>
                <span class="hidden-xs">Cerrar</span>
              </button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>