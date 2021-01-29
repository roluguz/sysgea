<?php


class clsAsesores {
  
  private $enlace;
  private $param;
  private $codigo;    
  private $usuario;
  private $correo;
  private $token;
  private $tkgraba;
  private $strpsw;
  private $nomasesor;
  private $apeasesor;
  private $tpdocumento;
  private $nrodoc;
  private $codcarrera;
  private $codspecial;
  private $correo2;
  private $telasesor;
    
  function __construct($data){
    if(!is_array($data)){
        throw new Exception("Error: no se encuentra informacion");
    }
    //$this->connectToDb();
    //if ($data['accion']=="registro"){
    //    $this->pregistrousuario();
    //}       
  }

  function setData($data){
    $this->enlace = "../public/index2.php?page=frmgralAsesores&op=1";
    /*echo "<pre>";
    echo "clsAsesores.php, linea-35" . "<br>";
    //echo "regquest=>, linea-79" . "<br>";
    print_r($data);
    echo "</pre>";
    die();
      */
    $this->param      = isset($data['accion'])     ? $data['accion']  : "";
    $this->usuario    = isset($data['usuario'])    ? $data['usuario'] : "";
    $this->correo     = isset($data['correo'])     ? $data['correo']  : "";
    $this->tkgraba    = isset($data['tkuser'])     ? $data['tkuser']  : "";       
    $this->token      = $this->generartoken($this->usuario, $this->correo);
    $this->strpsw     = isset($data['strpsw'])     ? $data['strpsw']  : "";
    $this->nomasesor  = isset($data['nomasesor'])  ? $data['nomasesor']  : "";
    $this->apeasesor  = isset($data['apeasesor'])  ? $data['apeasesor']  : "";
    $this->tpdocumento= isset($data['tpdocumento'])? $data['tpdocumento']: "";
    $this->nrodoc     = isset($data['nrodoc'])     ? $data['nrodoc']     : "";
    //$this->codcarrera = isset($data['codcarrera']) ? $data['codcarrera'] : "";
    //$this->codspecial = isset($data['codspecial']) ? $data['codspecial'] : "";
    $this->correo2    = isset($data['correo2'])    ? $data['correo2']    : "";
    $this->telasesor  = isset($data['telasesor'])  ? $data['telasesor']  : "";
    $this->codigo     = isset($data['idsearch'])   ? $data['idsearch']   : "";
    if ($this->param== "Nuevo"){
      echo "<pre>";
      echo "clsAsesores.php, linea-59" . "<br>";
      //echo "regquest=>, linea-79" . "<br>";      
      echo "DATA=>, linea-40" . "<br>";
      print_r($data);
      echo "</pre>";
      die();      
    }
    $sw_Ok = $this->getData();
    return $sw_Ok;             
  }

  function getData()
  {
    include("../include/conectar.php");  
    switch($this->param){
    case "Nuevo":
        echo "esto en la clase clsAsesores(Linea-64)"."<br>";
      break;
    case "lista":
      $query  = "Select a.id_asesor, a.nombres_asesor,  a.apellidos_asesor, ";
      $query .= "a.numero_documento, a.correo_personal, a.numero_telefono, a.estado,";
      $query .= " (select count(*) from tblsemestrepro b where b.estado = 'en curso' and b.asesor = a.id_asesor) ";
      $query .= "as nro FROM tblasesores a where 1=1 order by nro;";          
          /* echo "<pre>";
          echo "clsAsesores, linea-62" . "<br>";
          echo "query->".$query."<br>";
          //print_r($data);
          echo "REQUEST" . "<br>";
          print_r($_REQUEST);
          echo "</pre>";
          die(); */          
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);
      if (mysqli_num_rows($sql) > 0) {
          return $sql;
      }
      break;
    case "searchone":  // buscar el registro a eliminar-editar      
      $sql = "";
      $query  = "Select a.id_asesor, a.nombres_asesor,  a.apellidos_asesor, ";
      $query .= "a.numero_documento, a.correo_personal, a.numero_telefono, a.estado, ";
      $query .= "a.carrera, a.tipo_documento from tblasesores a where 1=1 and a.id_asesor = $this->codigo;";       
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);
      /*
      echo "<pre>";
      echo "tipo sql->" . gettype($sql) . "<br>";
        echo "orden....->>" . $query . "<br>";
      echo "clsAsesores.php, linea-78" . "<br>";
      //echo "regquest=>, linea-79" . "<br>";
      print_r($sql);
      //echo "POST=>, linea-40" . "<br>";
      //print_r($data);
      echo "</pre>";
      die();      
      */    
      //if (mysqli_num_rows($sql) > 0) {
      //  return $sql;
      //}        
      return $sql;
      break;
    }
  }

  function generartoken($idusuario, $username)
  {
    $cadena = $idusuario . $username . rand(1, 9999999) . "25-09-2062" . (3082 * rand(1, 9));
    $token = sha1($cadena);
    return $token;
  }
  private function connectToDb(){
      include 'database.php';
      $vars= '../include/variables.php';
      new database($vars);
  }

  //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
  function pregistrousuario(){
      include("../include/conectar.php");    
      $query ="Insert Into login(usuario, correo, token, password, estado, perfil)";
      $query.=" values('$this->usuario','$this->correo','$this->token','$this->password',1, 2);";
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);        
      if($sql){
          $this->cregistrousuario(); 
      } 
      else
          throw new Exception ("Error: No es posible registrar");
  }    
  //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
  function cregistrousuario(){
      include("../include/conectar.php");       
      $query1  ="Insert Into tblasesores(nombres_asesor, apellidos_asesor, tipo_documento,";
      $query1 .="numero_documento, carrera, especialidad, correo_personal, numero_telefono, login)";
      $query1 .=" Values('$this->nombre_usuario',      '$this->apellido_usuario',
                          '$this->t_documento_usuario', '$this->documento_usuario',
                          '$this->carrera'            , '$this->especialidad',
                          '$this->correo_usuario'     , '$this->Telefono_usuario',
                          '$this->usuario');";                         
      $sql = mysqli_query($conection, $query1);        
      mysqli_close($conection);
      if($sql) {
          $p ="reguser2";
          include('../plantillas/paso.php');
            //echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=http://www.desarrolloweb.com'>"   
      }
      else
          throw new Exception ("Error: No es posible registrar");         
  }

  function close(){
      $this->cnx->close();
  }


  function enviarEmail($link){
    $mensaje = '<html>
    <head>
        <title>Completar registro</title>
    </head>
    <body>
        <p>Hemos recibido una petición para el ingreso a la plataforma de proyectos.</p>
        <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
        <p>
        <strong>Enlace para completar registro</strong><br>
        <a href="'.$link.'"> Completar registro </a>
        </p>
    </body>
    </html>';        
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
    //mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
  }
}

?>