<?php


class cambiopass {

    private $usuario;
    private $accion;
    private $pass0;
    private $pass1;
    private $nombre_proyecto;
    private $cnx;
    
  function __construct($data){
    session_start();
    if(is_array($data)){
      $this->setData($data);
    }
    else{
      throw new Exception("Error: no se encuentra informacion");
    }
    //$this->connectToDb();
    $this->act_pass();       
  }
    
  private function setData($data){
    $this->usuario= $data['usuario'];
    echo $data['pass1']."<br>";
    echo $this->pass0= sha1($data['pass0'])."<br>";
    echo $this->pass1= sha1($data['pass1'])."<br>";
  }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
    function act_pass(){
      include("../include/conectar.php");                     
      $query1 ="UPDATE login SET password = '$this->pass1'
        WHERE password ='$this->pass0' and usuario = '$this->usuario';";
        $sql = mysqli_query($conection, $query1);
        mysqli_close($conection);
        if($sql) {
          $p="fnal";
          include('../plantillas/paso.php');
          //echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=http://www.desarrolloweb.com'>"
        }
        else throw new Exception ("Error: No es posible registrar");    
    }

    function close(){
        $this->cnx->close();
    }
}

?>