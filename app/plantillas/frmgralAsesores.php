<?php
$opcion = isset($_REQUEST['op']) ? $_REQUEST['op'] : 0;
$p = "tipodoc";
$nnn = 'nada';
$enlace = "../php/sessions.php";
$tit = "";
$strAction = "";
$strb1 = "";
$strb2 = "";
$idbusca = "";
$titModal = "";
$xx = "";
$rs = "";
$idtoken   = md5($_SESSION['usuario']);
//$idtoken = $_SESSION['usuario'];
//$idcod = "";

switch ($opcion) {
  case 1: // listar todos(Incluyendo los descativados-eliminados)
    try {
      include_once '../modelos/clsAsesores.php';
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
    }/*
    echo "<pre>";
    echo "token->".$idtoken."<br>";    
    print_r($_SESSION);
    echo "</pre>";die();
    */
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
              <table id="example2" class="display table table-bordered table-hover">
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
    $nnn = 'erase';
    $strAction = "Borrar";
    $tit   = "Borrar docentes Asesores";
    $strb1 = "Cancelar borrado";
    $strb2 = "Confirmar borrado";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $idtoken);
    break;
  case 3:  // Editar
    $nnn = 'edit';
    $strAction = "Editar";
    $tit   = "Edici&oacute;n docentes Asesores";
    $strb1 = "Cancelar Edici&oacute;n";
    $strb2 = "Confirmar Edici&oacute;n";
    echo generaHTML(1, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $idtoken);
    break;
  case 4: // Nuevo registro, revisar     
    $nnn = 'new';
    $strAction = "Nuevo";
    $tit   = "Adici&oacute;n docentes Asesores";
    $strb1 = "Cancelar adici&oacute;n";
    $strb2 = "Confirmar adici&oacute;n";
    echo generaHTML(2, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $idtoken);
    break;
  default:
    //$p = "tipodoc";
    //$enlace = "../php/sessions.php";
    include('../plantillas/paso.php');
    exit;
    break;
}
function combokra($codcar, $obkra)
{
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
  return $cbkra;
}

function combotipo($tipo,  $objtipo)
{
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
  return $cboTipo;
}
function generaHTML($xx, $tit, $strAction, $strb1, $strb2, $idbusca, $nnn, $idtoken)
{
  $n = 0;
  $tipo   = "";
  $codcar = "";
  $xx = $xx;
  $idbusca = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
  //$idcod   = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
  /*  echo "<pre>";
  print_r($_REQUEST);
  echo "</pre>";
  die();*/
  if ($xx == 1) {
    try {
      include_once '../modelos/clsAsesores.php';
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
    include_once '../modelos/clstipodocumento.php';
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
    include_once '../modelos/clscarreras.php';
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
  /*
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
  */
  /*
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
*/
  //$cbkra  = combokra($codcar, $obkra);
  $cboTipo = combotipo($tipo,  $objtipo);
  //$headform = '<form action="# method="post" onsubmit="verify00()">';
  $headform = '<form action="../Controllers/registerasesorController.php" name = "f" id ="f" method="post">';  
  $strHTML = "";
  $strHTML = '
  <div class="box box-default">
    <div class="box-header with-border">
      <h1>' . $tit . '</h1>
    </div> <!-- box-header with-border -->
    <div class="box-body">
      <div class="row"> <!-- row inicial -->
        <div class="col-md-1">
        </div>
        <div class="col-md-9" id="divdatos">
          '.$headform.'          
            <input type="hidden" id="idaccion" name="idaccion" value="' . $idbusca . '">
            <input type="hidden" id="ckras" name="ckras" value="0">
            <input type="hidden" id="cspec" name="cspec" value="0">
            <input type="hidden" id="usersave" name="usersave" value="'.$idtoken.'">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Numero Identificaci&oacute;n</label>
                  <input type="text" name="nrodoc" id="nrodoc" class="form-control" 
                  placeholder="Numero de Documento" title="Numero de Documento" 
                  value="' . (($xx == 1) ? $rs['numero_documento'] : '') . '" 
                   required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Tipo de documento</label> ' . $cboTipo . '
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Usuario</label>
                  <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario de conexion" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>                            
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Nombre completo</label>
                  <input type="text" name="nomasesor" id="nomasesor" class="form-control" placeholder="Nombres" title="Nombres del asesor" value="' . (($xx == 1) ? $rs['nombres_asesor'] : '') . '" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Apellidos completos</label>
                  <input type="text" name="apeasesor" id="apeasesor" class="form-control" placeholder="Apellidos" title="Apellidos del asesor" value="' . (($xx == 1) ? $rs['apellidos_asesor'] : '') . '" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Telefono</label>
                  <input type="number" name="telasesor" id="telasesor" class="form-control" placeholder="Telefono" title="Telefono" value="' . (($xx == 1) ? $rs['numero_telefono'] : '') . '" required>
                  <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <label>Correo institucional</label>
                  <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo institucional" onblur="fAgrega();" placeholder="Correo personal" title="Correo institucional/Personal" value="' . (($xx == 1) ? $rs['correo_personal'] : '') . '" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback">
                  <label>Correo personal</label>
                  <input type="email" name="correo2" id="correo2" class="form-control" placeholder="Correo personal" title="Correo personal" value="' . (($xx == 1) ? $rs['correo_personal'] : '') . '" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
              </div>              
              <!--
              <div class="col-md-4">
                <div class="form-group has-feedback">
                  <label>Password</label>
                  <input type="password" name="strpsw" id="strpsw" class="form-control" placeholder="Conraseña" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
              </div> -->
            </div>

            <!-- <div class="row">
            </div> -->
            <div class="row"> <!-- aca estan los botones para carreras, especialidades-->
              <div class="col-md-6">
                <button type="button" id="_btnaddcarrera" name="_btnaddcarrera" 
                    class="btn btn-warning btn-block btn-flat"
                    btntipo="kras" tablebtn="' . $nnn . '" btnprg="gralAsesor"
                    datavalue="' . $idbusca . '" value="' . $strAction . '"
                    title="' . $strb2 . '">
                    <i class="fa fa-check-square"></i> Adicionar Carreras
                </button>
              </div>
              <div class="col-md-6">
                <button type="button" id="botonaddSpecial" name="botonaddSpecial" 
                    class="btn btn-warning btn-block btn-flat openbtn"
                    vrbtn="' . $xx . '" datavalue="' . $idbusca . '" value="' . $strAction . '" 
                    title="' . $strb2 . '"  btnprg="gralAsesor" btntipo="spec" 
                    tablebtn="' . $nnn . '" >
                    <i class="fa fa-times-circle"></i> Adicionar Especialidade
                </button>
              </div>
            </div>
             <div class="row">
              <div class="col-md-12"><span style="">&nbsp;</span></div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-danger btn-block btn-flat" title="' . $strb1 . '" type="button" href="?page=frmgralAsesores&op=1">
                  <i class="fa fa-times-circle"></i> Regresar</a>
              </div>
              <div class="col-md-6">
                <button type="submit" name="submit" class="btn btn-info btn-block btn-flat" title="' . $strb2 . '" value="' . $strAction . '">
                  <i class="fa fa-check-square"></i> Registrar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2"></div> <!-- col-md-2 -->
      </div> <!-- row inicial -->
      <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-5">        
          <!-- ************** INICIO DIV CARRERAS***************         -->
          <div class="box-body" id="divCarreras" style="display: none; 
              border: outset red; border-radius: 25px;  background-color: #FBEEE6; text-align: center;">
              <h3 id="titModal">Profesiones del asesor </h3>
            <div class="divAbajo"> <!-- inicio divAbajo -->
              <div class="row"> <!-- inicio row-1 -->
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5" id="cbokras" datasearch="' . $idbusca . '" 
                    datachange="0" data-tipo="' . $nnn . '">                    
                </div>
                <div class="col-md-5">                      
                  <button type="button" id="addCarrera2" name="addCarrera2"                     
                    class="btn btn-success btn-block btn-flat" vrbtn="' . $xx . '" 
                    datavalue="' . $idbusca . '" value="' . $strAction . '" 
                    userToken = "' . $idtoken . '" ctakra = "0"
                    title="' . $strb2 . '"  btnprg="gralAsesor" btntipo="kras" 
                    tablebtn="' . $nnn . '" _accion = "addkras">
                    <i class="fa fa-plus"></i> Agregar Carrera
                  </button>                                        
                </div>  
                <div class="col-md-1">&nbsp;</div>
              </div> <!-- fin row-1 -->	
              <div class="row"> <!-- inicio row-2 -->
                 <div class="col-md-12">&nbsp;</div>
              </div> <!-- fin row-2 -->
              <div class="row">  <!-- inicio row-3 --> 
                <div class="col-md-12 table-responsive" id="tblkra">
                </div>
              </div> <!-- fin row-3 -->
            </div> <!-- fin divAbajo -->
            <div class="modal-footer"> <!-- botones de guardar, cerrar div -->
                <div class="row">
                  <div class="col-md-3">  </div>
                  <div class="col-md-6">
                      <button type="button" class="btn btn-primary btn-block btn-flat closebtnaddSpecial">
                        <span class="glyphicon glyphicon-remove"></span>
                        <span>Cerrar</span>
                      </button>
                  </div>
                  <div class="col-md-3">  </div>
                </div>
            </div> <!--fin div botones de guardar, cerrar div -->
          </div>
          <!-- ************** FIN DIV CARRERAS   ***************         -->
        </div>         
      </div>                 
       <!-- aqui Va lo que pase para el ATOM(se llama parte_xx.html) -->
       <!-- aqui Va lo que pase para el ATOM -->
       <!-- aqui Va lo que pase para el ATOM -->              
      </div> <!-- row -->
    </div> <!-- box-body -->
  </div> <!-- box box-default -->
  ';
  return $strHTML;
}
?>

<!-- ***** *************  *****  ******  ****  -->
<!-- *****    INICIO DEL MODAL  postgrados ****  -->
<!-- ***** *************  *****  ******  ****  -->
<div id="ModalCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="titModal">Estudios de postgrados del asesor </h2>
      </div>
      <!-- ************** ------------------ *** -->
      <!-- ************** INICIO DIV postgrados***************         -->
      <div class="divAbajo">
        <div class="row">
          <!-- inicio row-1 -->
          <div class="col-md-1">&nbsp;</div>
          <div class="col-md-5" name="cbospec" id="cbospec" datasearch="<?php echo $idbusca; ?>" datachange="0" data-tipo="<?php echo $nnn ?>">

          </div>
          <div class="col-md-5">
            <button type="button" id="addSpecial" name="addSpecial" onclick="event.preventDefault();btnaddSpecial()" 
              class="btn btn-success btn-block btn-flat" vrbtn="<?php echo $xx ?> " 
              datavalue="<?php echo $idbusca ?>" value="<?php echo $strAction ?>" 
              userToken="<?php echo $idtoken ?>" ctakra="0" title="<?php echo $strb2 ?>" 
              btnprg="gralAsesor" btntipo="spec" tablebtn="<?php echo $nnn ?>" _accion="addspec">
              <i class="fa fa-plus"></i> Agregar postgrado
            </button>
          </div>
          <div class="col-md-1">&nbsp;</div>
        </div> <!-- fin row-1 -->
        <div class="row">
          <!-- inicio row-2 -->
          <div class="col-md-12">&nbsp;</div>
        </div> <!-- fin row-2 -->
        <div class="row">
          <!-- inicio row-3 -->
          <div class="col-md-12 table-responsive" id="tblspecial">
          </div>
        </div> <!-- fin row-3 -->
      </div>
      <!--fin div botones de guardar, cerrar div -->
      <!-- </div> -->
      <!-- ************** FIN DIV postgrados   ***************         -->
      <!-- ************** ------------------ *** -->
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
<!-- *****       FIN DEL MODAL postgrados  ****  -->
<!-- ***** *************  *****  ******  ****  -->


<div id="ModalCrear2" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <!-- <div class="modal" tabindex="-1" role="dialog"> -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="bodyModal">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Trigger the modal with a button -->
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



<div id="ModalCrear_111" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="titModal">Estudios de postgrados del asesor </h2>
      </div>
      <div class="bodyModal">
        <br>
        <div class="row">
          <div class="col-md-1">&nbsp;</div>
          <div class="col-md-5" id="cbospecial" datasearch="<?php echo $idbusca; ?>" datachange="0" data-tipo="<?php echo $nnn; ?>">

          </div>
          <div class="col-md-4">
            <a class=' btn btn-success btn-block btn-flat' title='Adicionar un Asesor' type='button' id='addCarrera' datacode='new' href='#'>
              <i class="fa fa-plus"></i> Agregar Postgrado</a>
          </div>
        </div>
        <br>
        <table class="tbl_venta">
          <thead>
            <tr>
              <th width="100px">Carrera</th>
              <th> Acción</th>
            </tr>
            <!--  <tr>
              <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
              <td><input type="text" name="txt_can_producto" id="txt_can_producto" value="0" min="1" disabled></td>
              <td> <a href="#" id="add_product_venta" class="link_add"><i class="fas fa-plus"></i> Agregar</a></td>
            </tr> -->
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