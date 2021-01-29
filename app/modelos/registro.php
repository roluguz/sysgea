<?php


class registro {
  private $usuario;
  private $correo;
  private $password;
  private $accion;
  private $token;
  private $cnx;
  private $nombres_usuario;
  private $apellidos_usuario; 
  private $tipo_documento;
  private $numero_documento;
  private $semestre;
  private $carrera;
  private $numero_telefono; 
  private $pswNormal;
    
  function __construct($data){
      if(is_array($data)){
        $this->setData($data);
      }
      else{
          throw new Exception("Error: no se encuentra informacion");
      }
      //$this->connectToDb();        
      if ($data['accion']=="p.registro"){  
          if ($this->verificadata($data)) 
          {
            //echo "regrese...";die();
            $this->pregistrousuario();            
            /*
            echo "<pre>";
            echo  "Passw->"       . $this->password . "<br>";
            echo  "Pass-Normal->" . $this->pswNormal. "<br>";
            echo  "usuario->"     . $this->usuario  . "<br>";
            echo  "correo->"      . $this->correo   . "<br>";
            echo  "token->"       . $this->token    . "<br>";
            //    print_r($row);
            echo "***--- linea-34  ---***" . "<br>";
            //    print_r($sql);
            echo "***--- REQUEST  ---***" . "<br>";
            print_r($_REQUEST);
            echo "***--- DATA  ---***" . "<br>";
            print_r($data);
            echo "</pre>";
            die(); */
          }else {
            echo '<h1 align="center">NO es estudiante REGISTRADO</h1>';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../vistas/login.php'>";               
          }
      }elseif($data['accion']=="c.registro"){
          $this->cregistrousuario();
      }       
  }
    
  private function setData($data){    
    if("c.registro"             ==$data['accion']){
      $this->nombres_usuario  = $data['nombre_usuario'];
      $this->apellidos_usuario= $data['apellido_usuario'];
      $this->tipo_documento   = $data['t_documento_usuario'];
      $this->numero_documento = $data['documento_usuario'];
      $this->carrera          = $data['carrera'];
      $this->correo_personal  = $data['correo_usuario'];
      $this->numero_telefono  = $data['Telefono_usuario'];
      $this->usuario          = $data['usuario'];

    }elseif("p.registro"==$data['accion']){
      $this->usuario = $data['usuario'];
      $this->correo  = $data['correo'];
      $this->token   = $data['token'];
      //$this->password= $data['password'];
    } 
  }

  private function connectToDb(){
      include 'database.php';
      $vars= '../include/variables.php';
      new database($vars);
  }
  function verificadata($data)
  {
    include("../include/conectar.php"); 
    $query  = "Select nroDocumento, apeGeneral, nomGeneral ";
    $query .= "From tbdatosgenerales where 1=1 and estadoGral = 1 ";
    $query .= "and nrodocumento = $this->usuario and correogeneral = '$this->correo'";
    $qrylogin = "Select usuario from login where 2=2 and estado = 1";
    $sqllogin = mysqli_query($conection, $qrylogin);    
    $sql      = mysqli_query($conection, $query);
    //$veclogin = mysqli_fetch_assoc($sqllogin);
    /*echo "tipo veclogin ->".gettype($veclogin)."<br>";
    echo "count veclogin ->" . count($veclogin) . "<br>";
    echo "tipo sqllogin ->" . gettype($sqllogin) . "<br>";    
    */
    //echo "count sqllogin ->" . count($sqllogin) . "<br>";    
    //echo "tipo sql ->" . gettype($sql)."<br>";
    //echo "tipo row ->" . gettype($row) . "<br>";
    //$veclogin = mysqli_fetch_array($rowlogin);
    //echo "ciclo-1"."<br>";
    // while ($rr = mysqli_fetch_array($sqllogin, MYSQLI_ASSOC)) {
    //  echo $rr['usuario'] ."<br>";
    //}      
    if (mysqli_num_rows($sql) > 0) {
     /* echo "<pre>";
      echo "veclogin" . "<br>";      
      print_r($veclogin);
      echo "rowlogin"."<br>";
      //print_r($rowlogin);
      echo "Comienza ciclo---" . "<br>";
      echo "</pre>";*/ 
      $row      = mysqli_fetch_assoc($sql);
      $struser = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; // cadena para el usuario
      $largo1  = strlen($struser);
      $strpsw  = "*@!#" . trim($row['nomGeneral']) . trim($row['apeGeneral']); // cadena para el password
      $strpsw  = str_replace(" ", "", $strpsw);
      //echo "cadena a de donde generar psw->".$strpsw; die();
      $largo2  = strlen($strpsw);
      $nomusuario = "";
      $pswusuario = "";
      $lnuser =  rand(6, 12);  // longitud para generar el usuario      
      $xx = true;
      while ($xx){
        $nomusuario = "";
        for ($i = 0; $i < $lnuser; $i++) {    //Se crea el usuario segun la longitud(10)      
          $nomusuario .= substr($struser, rand(0, $largo1), 1);//obtenemos un caracter aleatorio escogido de la cadena de caracteres
        }
        //$esta = in_array($nomusuario, $sqllogin);
        $nn = false;
        while (!$nn and $rr = mysqli_fetch_array($sqllogin, MYSQLI_ASSOC)) {
          $nn = ($nomusuario ==  $rr['usuario']);
        }
        $xx = $nn;
      }
      $pswusuario = strtolower($nomusuario);
      /*
      $lnpas  =  rand(6, 10); //  longitud para generar el password
      for ($i = 0; $i < $lnpas; $i++) {        
        $pswusuario .= substr($strpsw, rand(0, $largo2), 1);//obtenemos un caracter aleatorio escogido de la cadena de caracteres
      }*/
      
      $this->usuario = strtolower($nomusuario);
      $this->pswNormal = $pswusuario;
      $this->password  = sha1($pswusuario);      
      //Mostramos la contraseña generada
      //echo 'nomUsuario generado: ' . strtolower($nomusuario) . "<br>";
      //echo 'pswUsuario generado: ' . $pswusuario . "<br>";      
    }
    mysqli_close($conection);
    return (mysqli_num_rows($sql) > 0);     
  }
  
  function otracosa() {
    /*
    $query  = "Select nroDocumento, apeGeneral, nomGeneral ";
    // if (strlen(trim($row['nomGeneral'])) + strlen(trim($row['nomGeneral'])) > 10 ) 
    //$vecnom =  explode(" ", $row['nomGeneral']);
    //$vecape =  explode(" ", $row['apeGeneral']);
    //mysqli_close($conection);
    $iniuser = "";
    $finuser = "";
    $nuser   = "";
    $auser   = "";
    $str0    = "";
    $str1    = "";
    $signo   = "";
    $inipsw  = "";    
    if (count($vecnom) > 1) {        
      $str0 = $vecnom[0];
      $str1 = $vecnom[1];
      $nro0 = rand(1, strlen($str0));
      $nro1 = rand(1, strlen($str1));      
      $iniuser = substr($str0, 0, (strlen($str0) - $nro0));
      $finuser = substr($str1, 0, (strlen($str1) - $nro1));          
      $nuser =  (rand(1, 2) == 1 ) ?  $iniuser . $finuser : $finuser. $iniuser ;         
       echo "Inicio-" . $iniuser . "<br>";
      echo "Final->"  . $finuser . "<br>";
      echo "nuser->"  . $nuser . "<br>";
      echo "NRO0 GENERADO->" . $nro0 . "<br>";
      echo "NRO1 GENERADO->" . $nro1 . "<br>";
      echo "registro en modelos, linea-82" . "<br>";
      echo "--- STR0  ---". $str0 . "<br>";
      echo "--- STR1  ---" . $str1 . "<br>";
      echo "largo-STR0->".strlen($str0) . "<br>";
      echo "largo-STR1->" . strlen($str1) . "<br>"; 
    } else {
      $str0 = $vecnom[0];
      $nro0 = rand(1, strlen($str0));
      $nuser = substr($str0, 0, (strlen($str0) - $nro0));
      //echo "nuser->"  . $nuser . "<br>";
    }
    if (count($vecape) > 1) {
      $str0 = $vecape[0];
      $str1 = $vecape[1];
      $nro0 = rand(1, strlen($str0));
      $nro1 = rand(1, strlen($str1));
      //$iniuser= $str0[strlen($str0) - rand(1, strlen($str0))];
      $iniuser = substr($str0, 0, (strlen($str0) - $nro0));
      $finuser = substr($str1, 0, (strlen($str1) - $nro1));
      $auser =  (rand(1, 2) == 1) ?  $iniuser . $finuser : $finuser . $iniuser;
       echo "Inicio-" . $iniuser . "<br>";
        echo "Final->"  . $finuser . "<br>";
        echo "nuser->"  . $nuser . "<br>";
        echo "NRO0 GENERADO->" . $nro0 . "<br>";
        echo "NRO1 GENERADO->" . $nro1 . "<br>";
        echo "registro en modelos, linea-82" . "<br>";
        echo "--- STR0  ---". $str0 . "<br>";
        echo "--- STR1  ---" . $str1 . "<br>";
        echo "largo-STR0->".strlen($str0) . "<br>";
        echo "largo-STR1->" . strlen($str1) . "<br>";  
    } else {
      $str0 = $vecape[0];
      $nro0 = rand(1, strlen($str0));
      $auser = substr($str0, 0, (strlen($str0) - $nro0));     
    }  
    switch (rand(1, 3)) {
      case 1 : $signo = "*"; break;
      case 2 : $signo = "@"; break;
      case 3 : $signo = "!"; break;
    }
    switch (rand(1, 3)) {
      case 1:
        $nmuser =  (rand(1, 2) == 1) ?  $nuser . $signo . $auser : $auser . $signo . $nuser;
        break;
      case 2:
        $nmuser =  (rand(1, 2) == 1) ?  $nuser . $signo . $auser : $auser . $signo . $nuser;
        break;
      case 3:
        $nmuser =  (rand(1, 2) == 1) ?  $signo . $nuser .  $auser : $auser  . $nuser . $signo;
        break;
    }    
    $nmuser = strtolower( (rand(1, 2) == 1) ?  $nuser .$signo. $auser : $auser .$signo. $nuser);
    $inipsw = substr($data['correo'], 0, stripos($data['correo'], '@')+1 ).$_REQUEST['nrodoc1'];
    //$psw    = (rand(1, 2) == 1)  ? $inipsw
    echo "nuser->"  . $nuser . "<br>";
    echo "auser->"  . $auser . "<br>";
    echo "nmuser->"  . $nmuser . "<br>";
    echo "inipsw->"  . $inipsw . "<br>";    
    //$data['usuario'] = strtolower($nmuser);
    $this->usuario = strtolower($nmuser);
    $this->pswNormal = $inipsw;
    $this->password  = sha1($inipsw);
    //sha1($_POST['password'])
    //$this->usuario = $data['usuario'];
    //$cadena = $idusuario . $username . rand(1, 9999999) . date("d-M-Y") . (3082 * rand(1, 9));
    //$token = sha1($cadena);
    //echo "registro en modelos, linea-82" . "<br>";
    //echo "***--- CUAL  ---***" . "<br>";
    //echo "***--- VECAPE  ---***" . "<br>";
    //print_r($vecape);     
    //echo "***--- VECNOM  ---***" . "<br>";
    //print_r($vecnom);    
    //echo "***--- ROW  ---***" . "<br>";

    //die();        
    return (mysqli_num_rows($sql) > 0) ;  */  
    //Si se quiere generar una contraseña  
    //Carácteres el usuario
  /*
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nroDocumento` int  not NULL,
  `apeGeneral` varchar(30) COLLATE utf8_spanish_ci not NULL,
  `nomGeneral` varchar(30) COLLATE utf8_spanish_ci not NULL,
  `fecNacido` date not NULL,
  `dirGeneral` varchar(30) COLLATE utf8_spanish_ci not NULL,
  `correoGeneral` varchar(30) COLLATE utf8_spanish_ci not NULL,
  `telGeneral` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celGeneral` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoGral` int(11) not null DEFAULT 1,
  */
  }
    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function pregistrousuario(){
        include("../include/conectar.php");  
        $query ="Insert into login (usuario, correo, token, password, estado) 
            values ('$this->usuario','$this->correo','$this->token','$this->password',0);";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);            
        if($sql){
            $enlace ='../vistas/completar_registro.php?idusuario='.sha1($this->usuario).'&token='.$this->token;
            $this->enviarEmail($enlace);
            $p ="reguser1";    
                /*echo "<pre>";
                echo "Data->"."<br>";
                print_r($data)."<br>";
                echo "Sesiones->"."<br>";
                print_r($_SESSION)."<br>";
                echo "Request->"."<br>";
                print_r($_REQUEST)."<br>";
                echo "</pre>";
                die();*/
            include('../plantillas/paso.php');        } 
        else
            echo'<h1 align="center"> No es posible registrar el usuario</h1>';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../vistas/login.php'>";            
    }    
    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
  function cregistrousuario(){
    include("../include/conectar.php");
    $query1  = "Insert Into tblestudiantes (nombres_usario, apellidos_usuario, tipo_documento,";
    $query1 .=" numero_documento, carrera, correo_personal, numero_telefono,login) ";
    $query1 .=" Value ('$this->nombres_usuario', '$this->apellidos_usuario', '$this->tipo_documento',";
    $query1 .=" '$this->numero_documento', '$this->carrera', '$this->correo_personal',";
    $query1 .=" '$this->numero_telefono', '$this->usuario');";
    $sql = mysqli_query($conection, $query1);
    if($sql) {
      $query2 ="Update login SET estado = 1 Where login.usuario = '$this->usuario'; ";
      $sql = mysqli_query($conection, $query2);
      //mysqli_close($conection);
      if($sql){
        session_start();
        $_SESSION['usuario']=$this->usuario;
        $_SESSION['carrera']=$this->carrera;
        $p ="reguser";
        include('../plantillas/paso.php');
      } 
    }
    else throw new Exception ("Error: No es posible registrar");  
    mysqli_close($conection);
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
        <strong>usuario asignado->"' . $this->usuario. '"</strong><br>
        <strong>password asignado->"' . $this->pswNormal . '"</strong><br>        
        <strong>Enlace para completar registro</strong><br>
        <a href="'.$link.'"> Completar registro </a>
        </p>
    </body>
    </html>';     
    echo $mensaje;
    die();   
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= 'From: roluguz@gmail.com' . "\r\n";
    if (mail($this->correo, "Recuperar contraseña", $mensaje, $cabeceras) ) {
        echo "<script>alert('Funcion \"mail()\" ejecutada, por favor verifique su bandeja de correo.');</script>";
    }else{
      echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    }        
  }
}


?>