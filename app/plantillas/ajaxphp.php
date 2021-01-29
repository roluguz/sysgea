<?php
  session_start();
  if (!empty($_POST)) {
    
              

                 
    
  //$op = strtolower($_POST['action']);
    $prg =  strtolower($_REQUEST['prgexecute']);
    switch ($prg) 
    {
      case 'gralasesor': // estoy en formulario frmgralasesor
        $titmodal = "";
        $arrayData = array();

        if (strtolower($_REQUEST['tabla']) == "kras") {
          switch (strtolower($_REQUEST['action'])) {
            case 'all':
              try {
                $data['accion'] = 'fillcbo';
                include_once '../modelos/clscarreras.php';
                $obkra = new clscarreras($data);
                $obkra = $obkra->setData($data);
              } catch (Exception $Exc) {
                $t = "Error fatal->" . $Exc->getMessage();
                $p = "tipodoc";
                $enlace = "../php/sessions.php";
                include('../plantillas/paso.php');
                exit;
                die();
              }
              $cbkra = "";
              $cbkra = generacbokra($obkra);
              $arrayData['cbo'] = $cbkra;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              break;
            case 'emptyfillcbo':            
              $data['accion'] = 'emptyfillcbo';
              $data['token']  = $_REQUEST['token'];
              $data['dato']   = $_REQUEST['datainsert'];
              $data['state']   = $_REQUEST['vrstate'];           
              try {
                // $data['accion'] = 'fillcbo';
                include_once '../modelos/clscarreras.php';
                $obkras = new clscarreras($data);
                // $obcra = $obkra->setData($data);
                $obkra = $obkras->setData($data);
                $data['accion'] = 'traetmp';
                $obtmp = $obkras->setData($data);
                $nro   = mysqli_num_rows($obtmp);
                $cbkra = "";
                $cbkra = generacbokra($obkra);
                $detalleTabla = "";
                $detalleTabla = generatblkras($obtmp);
              } catch (Exception $Exc) {
                  $t = "Error fatal->" . $Exc->getMessage();
                  $p = "tipodoc";
                  $enlace = "../php/sessions.php";
                  include('../plantillas/paso.php');
                  exit;
                  die();
              }
              $cbkra = ($nro > 0) ? $cbkra : "";
              $detalleTabla = ($nro > 0) ? $detalleTabla : "";
              $arrayData['cbo']  = $cbkra;
              $arrayData['tbtmp']= $detalleTabla;
              $arrayData['kkra'] = $nro;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              break;
            case 'erasefillkra' :
              $data['accion'] = 'deltmpkra';
              $data['token']  = $_REQUEST['token'];
              $data['dato']  = $_REQUEST['datainsert'];
              try {
                include_once '../modelos/clscarreras.php';
                $obkras = new clscarreras($data);
                $obtmp = $obkras->setData($data);
                $nro   = mysqli_num_rows($obtmp);
                $data['accion'] = 'cbokras';
                $obkra = $obkras->setData($data);
                $cbkra = "";
                $cbkra = generacbokra($obkra);
                $detalleTabla = "";
                $detalleTabla = generatblkras($obtmp);
              } catch (Exception $Exc) {
                $t = "Error fatal->" . $Exc->getMessage();
                $p = "tipodoc";
                $enlace = "../php/sessions.php";
                include('../plantillas/paso.php');
                exit;
                die();
              }
              if($nro == 0){
                $detalleTabla = "";
                $data['accion'] = 'fillcbo';
                $obkra = $obkras->setData($data);
                $cbkra = generacbokra($obkra);                
              }
              $arrayData['cbo'] = $cbkra;
              $arrayData['tbtmp'] = $detalleTabla;
              $arrayData['kkra'] = $nro;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              //            -------------------------------------------------

              break;
            case 'allasesor':
              echo "<pre>";
              echo "en allasesor"."<br>";
              print_r($_REQUEST);
              echo "</pre>";
              die();
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              break;
          case 'showonly':
            echo "<pre>";
            echo "en showonly" . "<br>";
            print_r($_REQUEST);
            echo "</pre>";
            die();
            break;

            
            default:
              break;
          }        
        }
        if (strtolower($_REQUEST['tabla']) == "spec") {
          switch (strtolower($_REQUEST['action'])) {
            case 'all':
              try {
                $data['accion'] = 'fillcbo';
                include_once '../modelos/clsSpecial.php';
                $objspacial = new clsSpecial($data);
                $obspecial = $objspacial->setData($data);
              } catch (Exception $Exc) {
                $t = "Error fatal->" . $Exc->getMessage();
                $p = "tipodoc";
                $enlace = "../php/sessions.php";
                include('../plantillas/paso.php');
                exit;
                die();
              }
              $cmbSpecial = generacboSpecial($obspecial);
             
              $arrayData['cbo'] = $cmbSpecial;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              break;
            case 'emptyfillcbo':
              //echo "tbl-Regresar..." . "<br>";
              // print_r($detalleTabla);
              //echo "dato obtenido..." . "<br>";
              //  print_r($cbkra);
              $data['accion'] = 'emptyfillcbo';
              $data['token']  = $_REQUEST['token'];
              $data['dato']  = $_REQUEST['datainsert'];
              $data['state']   = $_REQUEST['vrstate'];                         
              try {
                // $data['accion'] = 'fillcbo';
                include_once '../modelos/clsSpecial.php';
                $ob1 = new clsSpecial($data);                
                $objspecial = $ob1->setData($data);
                $cbkra = "";
                $cbkra = generacboSpecial($objspecial);               
                $data['accion'] = 'traetmp';
                $obtmp = $ob1->setData($data);
                $nro   = mysqli_num_rows($obtmp);                
                $detalleTabla = "";
                $detalleTabla = generatblspecial($obtmp);
              } catch (Exception $Exc) {
                $t = "Error fatal->" . $Exc->getMessage();
                $p = "tipodoc";
                $enlace = "../php/sessions.php";
                include('../plantillas/paso.php');
                exit;
                die();
              }
              //$cbkra = ($nro > 0) ? $cbkra : "";
              //$detalleTabla = ($nro > 0) ? $detalleTabla : "";
              $arrayData['cbo']  = $cbkra;
              $arrayData['tbtmp'] = $detalleTabla;
              $arrayData['kkra'] = $nro;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              break;
            case 'erasefillspecial':
              $data['accion'] = 'deltmpspecial';
              $data['token']  = $_REQUEST['token'];
              $data['dato']  = $_REQUEST['datainsert'];
              try {
                include_once '../modelos/clsSpecial.php';
                $obkras = new clsSpecial($data);
                $obtmp = $obkras->setData($data);
                $nro   = mysqli_num_rows($obtmp);
                $data['accion'] = 'cbospecial';
                $obkra = $obkras->setData($data);
                $cbkra = "";
                $cbkra = generacboSpecial($obkra);
                $detalleTabla = "";
                $detalleTabla = generatblspecial($obtmp);
              } catch (Exception $Exc) {
                $t = "Error fatal->" . $Exc->getMessage();
                $p = "tipodoc";
                $enlace = "../php/sessions.php";
                include('../plantillas/paso.php');
                exit;
                die();
              }
              if ($nro == 0) {
                $detalleTabla = "";
                $data['accion'] = 'fillcbo';
                $obkra = $obkras->setData($data);
                $cbkra = generacboSpecial($obkra);
              }
              $arrayData['cbo'] = $cbkra;
              $arrayData['tbtmp'] = $detalleTabla;
              $arrayData['kkra'] = $nro;
              echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
              //            -------------------------------------------------

              break;
            default:
              break;
          }
        } 
      break;
      case 'otroProg': // estoy en formulario frmgralasesor
      break;
    }
  }

  function generacbokra($obkra)
  {    
    $cbkra1 = '<select class="form-control" name="cbokrass"  id="cbokrass"';
    $cbkra1 .= 'required placeholder="Carrera" >';
    $cbkra1 .= '<option value="-1">Seleccione</option>';
    while ($row = mysqli_fetch_assoc($obkra)) {
      $cbkra1 .= '<option value=' . $row['idCarrera'] . '>';
      $cbkra1 .= $row['nCarrera'] . '</option>';
    }
    $cbkra1 .= '</select>';
    return $cbkra1;
  }
  function generacboSpecial($obkra){
    $cmb = '<select class="form-control" name="cboSpecial"  id="cboSpecial"';
    $cmb .= 'required placeholder="Carrera" >';
    $cmb .= '<option value="-1">Seleccione</option>';
    while ($row = mysqli_fetch_assoc($obkra)) {    
      $cmb .= '<option value=' . $row['idSpecial'] . '>';
      $cmb .= $row['nomSpecial'] . '</option>';
    }
    $cmb .= '</select>';
    return $cmb;
  }
  function generatblspecial($obtmp)
  {
    $tblajax = "";
    $tblajax = '
      <table id="tblspec" class="table table-striped table-hover table-condensed table-bordered ">                
      <thead>
      <tr>
        <th>Descripcion</th>
        <th>Accion</th>
      </tr>
      </thead>
      <tbody id="tbrta" style= "border: 1px solid black;" >';
    while ($row = mysqli_fetch_assoc($obtmp)) {
      $tblajax .=
        '<tr>
              <td>' . $row['nomspecial'] . '</td>
              <td>
                <button name="btdeleteSpecial" id="btdeleteSpecial" type="button" class="btn btn-danger btn-flat" 
                  onclick="event.preventDefault();fndeletespecial(' . $row['idtemp'] . ');"
                  title="Quitar esta profesion" fnerase="delline">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>';
    }
    $tblajax .= '
      </tbody>
      </table>';
    return $tblajax;
  }
  function generatblkras($obtmp){
    $tblajax = "";
    $tblajax= '
    <table id="tbkras" class="table table-striped table-hover table-condensed table-bordered ">                
    <thead>
    <tr>
      <th>Descripcion</th>
      <th>Accion</th>
    </tr>
    </thead>
    <tbody id="tbrta" style= "border: 1px solid black;" >';
    while ($row = mysqli_fetch_assoc($obtmp)) 
      {
      $tblajax .=
          '<tr>
            <td>' . $row['ncarrera'] . '</td>
            <td>
              <button name="bterase" id="bterase" type="button" class="btn btn-danger btn-flat" 
                onclick="event.preventDefault();fndeletekra(' . $row['idtemp'] . ');"
                title="Quitar esta profesion" fnerase="delline">
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>';
      }
    $tblajax .= '
    </tbody>
    </table>';
    return $tblajax;
  }
  function xx()
  {
    try {
      include '../modelos/clscarreras.php';
      $obkra = new clscarreras($data);
      $obkra = $obkra->setData($data);
    } catch (Exception $Exc) {
      $t = "Error fatal->" . $Exc->getMessage();
      $p = "tipodoc";
      $enlace = "../php/sessions.php";
      include('../plantillas/paso.php');
      exit;
      die();
    }
  }  
?>