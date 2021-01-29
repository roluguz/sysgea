<?php
$p = "tipodoc";
$nnn = 'nada';
$enlace = "../php/sessions.php";
$tit = "";
$strAction = "";
$strb1 = "";
$strb2 = "";
$titModal = "";
$xx = "";
$rs = "";
$onlyread = '';
$obSpecial = "";
$opcion = isset($_REQUEST['op']) ? $_REQUEST['op'] : 0;
$idbusca = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
switch ($opcion) {
  case 1: // listar todos(Incluyendo los descativados-eliminados)
    $data['accion'] = 'lista';
    $obSpecial = fnread($data);
?>
    <div class="box box-default">
      <div class="box-header with-border">
        <h1>Gesti&oacute;n Profesiones</h1>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php
          $cod    = "";
          $btnnew  = "<a class='btn btn-success btn-block btn-flat' title='Adicionar una Profesi&oacute;n' ";
          $btnnew .= "type='button' datacode='new' href='?page=frmgralCarreras&op=4'";
          $btnnew .= ">Agregar Profesi&oacute;n</a>";
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
              <table id="example2" class="display table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nombre Profesioni&oacute;n</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody class="contenidobusqueda">
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($obSpecial)) {
                    $iniref  = '<a ';
                    $finref  = '</a>';
                    $figedit = '<i class="fa fa-pencil fa-fw"></i> ';
                    $figdel  = '<i class="fa fa-trash-o fa-lg"></i> ';
                    $figact  = '<i class="fa fa-calendar-check-o fa-lg"></i> ';
                    $opEdit  = ' class="btn btn-primary" title="Editar este registro"';
                    $opErase = ' class="btn btn-danger"  title="Borrar este registro"';
                    $opActive = " class='btn btn-success' title='Activar este asesor'  ";
                    //          $openlace = ' type="button" data-toggle ="modal" data-target="#ModalCrear" >';
                    $openlace = ' type="button" href="?page=frmgralCarreras';
                    $inispan = '<span ';
                    $finspan = '</span>';
                    if ($row['estado'] == 1) { // esta activo   
                      $opActive = ' class="btn btn-warning"  title="Registro esta ACTIVO"';
                      $opActive = $inispan . $opActive . '">' . $figact . $finspan;
                      $opEdit =  $iniref . $opEdit;
                      $opEdit .= $openlace . '&op=3&id=' . $row['idCarrera'] . '">';
                      $opEdit .= $figedit . $finref;
                      if ($row['nro'] == 0) {
                        $opErase  = $iniref . $opErase;
                        $opErase .= $openlace . '&op=2&id=' . $row['idCarrera'] . '">';
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
                      $opActive  = "<a class='btn btn-success' title='Activar este Registro'  ";
                      $opActive .= $openlace . '&op=2&id=' . $row['idCarrera'] . '">';
                      $opActive .= $figact . $finref;
                    }
                    $btn = $opEdit . ' ' . $opErase . ' ' . $opActive
                  ?>
                    <tr>
                      <td><?php echo trim($row['nCarrera']); ?></td>
                      <td style="text-align: center;"><?php echo $btn; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
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
  case 2: // Borrar
    $onlyread = 'readonly';
    $nnn = 'erase';
    $strAction = "Borrar";
    $tit   = "Borrar Profesiones Asesores";
    $strb1 = "Cancelar borrado";
    $strb2 = "Confirmar borrado";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $onlyread);
    break;
  case 3:  // Editar
    $nnn = 'edita';
    $strAction = "Editar";
    $tit   = "Edici&oacute;n Profesiones Asesores";
    $strb1 = "Cancelar Edici&oacute;n";
    $strb2 = "Confirmar Edici&oacute;n";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $onlyread);
    break;
  case 4: // Nuevo registro, revisar     
    $nnn = 'new';
    $strAction = "Nuevo";
    $tit   = "Adici&oacute;n Profesiones Asesores";
    $strb1 = "Cancelar adici&oacute;n";
    $strb2 = "Confirmar adici&oacute;n";
    echo generaHTML(2, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $onlyread);
    break;
  default:
    include('../plantillas/paso.php');
    exit;
    break;
}

function fnread($data)
{
  try {
    include '../modelos/clsCarreras.php';
    $obdata = new clsCarreras($data);
    $obdata = $obdata->setData($data);
  } catch (Exception $Exc) {
    $t = $Exc->getMessage();
    $p = "tipodoc";
    $enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    die();
  }
  return $obdata;
}
function generaHTML($xx, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $onlyread)
{
  $n = 0;
  //$xx = $xx;
  //$idbusca = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
  //$idcod   = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
  /*echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
    die();*/
  if ($xx != 2) { //cuando no es un nuevo registro    
    $data['idsearch'] = $idbusca;
    $data['accion']   = 'searchone';
    $obfn = fnread($data);
    //echo "idBusca-->" .$idbusca. "<br>";
    /*if (isset($data)){
        echo "entre....";
        //echo "datos del vector->".$data1;
        print_r($data);
      }*/
    //echo "regrese de fnread-->" . "<br>";
    /*
      print_r($obfn);
      //die();    
      echo "<pre>";
      echo "frmgralSpecial, linea-209, REGRESEEEEEE" . "<br>";
      print_r($obfn);
      echo "REQUEST" . "<br>";
      print_r($_REQUEST);
      echo "</pre>";
      die();      
      */
    $n = mysqli_num_rows($obfn);
    if ($n == 0) { // no se encuentra el registro
      $p = "tipodoc";
      $enlace = "?page=frmgralcarreras&op=1";
      include('../plantillas/paso.php');
    } else $rs = mysqli_fetch_assoc($obfn);    
  }
  $headform = '<form autocomplete="off" action="../Controllers/registroCarreraController.php" method="post">';
  $strHTML = "";
  $strHTML =
    '<div class="box box-default">
      <div class="box-header with-border">
        <h1>' . $tit . '</h1>
      </div> 
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"></div>        
          <div class="col-md-10">
            <h4 ><i class="fa fa-cubes" style="font-size: 25pt; color:blue;"></i> </h4>
          </div>
        </div><br><br><br>
        <div class="row">
          <div class="col-md-1"> </div>
          <div class="col-md-10">
          ' . $headform . '
              <input type="hidden" id="idaccion" name="idaccion" value="' . $idbusca . '">
              <div class="row">
                <div class="col-md-2"> </div>              
                <div class="col-md-8">
                  <div class="form-group has-feedback">
                    <label>Descripci&oacute;n profesi&oacute;n</label>
                    <input type="text" name="nCarrera" id="nCarrera" class="form-control" 
                    placeholder="Descripcion" title = "Descripci&oacute;n profesi&oacute;n"
                    value="' . (($xx == 1) ? $rs['nCarrera'] : '') . '" required
                    ' . $onlyread . '>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>
                <div class="col-md-2"> </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-2"></div>              
                <div class="col-md-5">
                  <a class="btn btn-danger btn-block btn-flat" title="' . $strb1 . '"
                      type="button" href="?page=frmgralSpecial&op=1">
                    <i class="fa fa-times-circle"></i> Regresar</a>
                </div>
                <div class="col-md-5">
                  <button type="submit" name="submit" class="btn btn-info btn-block btn-flat"
                      title="' . $strb2 . '" value="' . $strAction . '">
                    <i class="fa fa-check-square"></i> Registrar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div> <!-- col-md-2 -->
        </div> <!-- row -->
      </div> <!-- box-body -->
    </div> <!-- box box-default --> ';
  return $strHTML;
}
?>

<!-- ***** *************  *****  ******  ****  -->
<!-- ***** INICIO DEL MODAL ESPECIALIZACIONES **-->
<!-- ***** *************  *****  ******  ****  -->

<div id="ModalCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="titModal">Profesiones del asesor </h2>
      </div>
      <div class="bodyModal">
        <br>
        <div class="row">
          <div class="col-md-1">&nbsp;</div>
          <div class="col-md-5" id="cbomodal" datasearch="<?php echo $idbusca; ?>" datachange="0" data-tipo="<?php echo $nnn; ?>">

          </div>
          <div class="col-md-4">
            <a class='btn btn-success btn-block btn-flat' title='Adicionar un Asesor' type='button' id='addCarrera' datacode='new' href='#'><i class="fa fa-plus"></i> Agregar Carrera</a>
          </div>
        </div>
        <br>
        <table class="tbl_venta">
          <thead>
            <tr>
              <th width="100px">Carrera</th>
              <th> Acción</th>
            </tr>

          </thead>
          <tbody id="detalle_venta">
            <!-- Contenido detalle llega desde ajax-->
          </tbody>
          <tfoot id="detalle_totales">
            <!-- Contenido totales llega desde ajax-->
          </tfoot>
        </table>
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
        <!--      </form>  -->
      </div>
    </div>
  </div>
</div>

<!-- ***** *************  *****  ******  ****  -->
<!-- ***** FIN DEL MODAL ESPECIALIZACIONES **  -->
<!-- ***** *************  *****  ******  ****  -->