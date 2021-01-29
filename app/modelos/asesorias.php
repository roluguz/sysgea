<?php


class asesoria {

    private $usuario;
    private $mensaje;
    private $sesion;
    private $proyecto;
  
    function __construct($data){
        if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        //$this->connectToDb();
        $this->registrarmensaje();
    }

    private function setData($data){
        $this->usuario = $data['nombre'];
        $this->mensaje = $data['mensaje'];
        $this->sesion = $data['sesion'];
        $this->proyecto = $data['proyecto'];
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

  function registrarmensaje(){
    include("../include/conectar.php");         
    $query ="INSERT INTO asesoriavirtual (nombre, mensaje, proyecto) 
              values ('$this->usuario','$this->mensaje','$this->proyecto');";
    $sql = mysqli_query($conection, $query);
    mysqli_close($conection);
    if($sql){
      header('Location: ../public/index2.php?page=asesoriavirtual');
    }
    else{
      throw new Exception ("Error: No es posible registrar");
    }
  }
}
?>