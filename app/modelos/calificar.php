<?php


class calificar {
    private $accion;
    private $valoracion;
    private $comentarios;
    private $usuario;
    private $codigo_semestre;
    private $cnx;
    private $resultado;
    private $promover;
    private $semestre_proyecto;
    private $directoriop;
    
    function __construct($data){
        if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        //$this->connectToDb();
        if ($data['accion']=="ag-calificar"){
            $this->registronota();
        }elseif($data['accion']=="up-calificar"){
            $this->actualizanota();
        } 
    }
    
    private function setData($data){
        $this->accion= $data['accion'];
        $this->valoracion=$data['valoracion'];
        $this->comentarios=$data['comentarios'];
        $this->usuario=$data['usuario'];
        $this->codigo_semestre=$data['codigo_semestre'];
        $this->promover=$data['promover'];  
        $this->semestre_proyecto  = $data['semestre_proyecto'];        
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function registronota(){
        include("../include/conectar.php");
        $query ="INSERT INTO calificaciones (semestre, valoracion, comentarios) 
                values ('$this->codigo_semestre','$this->valoracion','$this->comentarios');";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if($sql){
           if($this->promover =="si")
           {
                $this->promover();
                $p ="valoracion";
                include('../plantillas/paso.php');
           }else{
                $p ="valoracion";
                include('../plantillas/paso.php');
           }	
        } 
        else
            throw new Exception ("Error: No es posible registrar");
    }
    
    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
    function actualizanota(){
        include("../include/conectar.php");
        $query ="UPDATE calificaciones SET valoracion = '$this->valoracion' 
                    WHERE calificaciones.semestre = '$this->codigo_semestre';";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if($sql) {
            if($sql){
                if($this->promover =="si")
                {
                    $this->promover();
                    $p ="valoracion";
                    include('../plantillas/paso.php');
                }else{
                    $p ="valoracion";
                    include('../plantillas/paso.php');
                }	
		    } 
        }
        else
            throw new Exception ("Error: No es posible registrar");
    }

    function close(){
        $this->cnx->close();
    }

    function promover(){
        $semestre="";
        switch($this->semestre_proyecto){
                case "Primero":
                    $semestre='Segundo';
                    $cod="sem2";
                    break;
                case "Segundo":
                    $semestre="Tercero";
                     $cod="sem3";
                    break;
                case "Tercero":
                    $semestre="Cuarto";
                     $cod="sem4";
                    break;
                case "Cuarto":
                    $semestre="Quinto";
                     $cod="sem5";
                    break;
                case "Quinto":
                    $semestre="Sexto";
                     $cod="sem6";
                    break;
                case "Sexto":
                    $semestre="Septimo";
                     $cod="sem7";
                    break;
                case "Septimo":
                    $semestre="Finalizado";
                     $cod="Publicar";
                    break;
        }
        include("../include/conectar.php");
        $query ="UPDATE tblproyecto SET semestre_proyecto = '$semestre'
                        WHERE tblproyecto.cod_proy = (SELECT proyecto from tblsemestrepro 
                                                       where codigo_semestre = '$this->codigo_semestre'); ";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);  
        if($sql){
          semestrepro($cod, $this->codigo_semestre);
          $query ="UPDATE tblsemestrepro SET estado = 'finalizado' WHERE codigo_semestre = '$this->codigo_semestre'; ";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if($sql){
                
            }
        }
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
 
  function semestrepro($cod, $codigo_semestre){
    include("../include/conectar.php");
    $semestre=$cod.date('mhss');
    $query = "SELECT proyecto from tblsemestrepro where codigo_semestre = '$codigo_semestre';";
    $sql = mysqli_query($conection, $query);    
    if($sql){
      $row = mysqli_fetch_assoc($sql);
      $proyecto=$row['proyecto'];
      $query =" INSERT INTO tblsemestrepro (codigo_semestre,proyecto)VALUES('$semestre','$proyecto');";
      $sql = mysqli_query($conection, $query);
      if($sql){
        $ruta ="../../../proyectos/".$proyecto;
        $directoriop = $ruta."/".$semestre;
        if(!is_dir($directoriop))
        {
          $crear =mkdir($directoriop, 0777, true);
          if($crear)
          {
            $ruta =$directoriop;
            $directoriop =  $ruta."/complementos";
            $crear =mkdir($directoriop, 0777, true);
            $directoriop= $ruta."/entregas";
            $crear =mkdir($directoriop, 0777, true);
          }
        }
      }
    }
    mysqli_close($conection);
  }
?>