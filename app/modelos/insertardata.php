<?php


class insertardata {
    private $asesor;
    private $semestrepy;
    private $accion;
    
    function __construct($data){
        if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        //$this->connectToDb();
        if ($data['accion']=="ag-asesor"){
            $this->prelasesor();
        }elseif($data['accion']=="ag-proyecto"){
            $this->pregistrousuario();
        }elseif($data['accion']=="ac-proyecto"){
            $this->cambiarestado();
        }
    }
    
    private function setData($data){
           $this->asesor= $data['asesor'];
           $this->semestrepy= $data['semestrepy'];
           $this->accion= $data['accion'];
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function prelasesor(){
      include("../include/conectar.php");          
      $query ="UPDATE tblsemestrepro SET asesor = '$this->asesor' WHERE tblsemestrepro.id_semestrepro = $this->semestrepy;";
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);            
      if($sql){
			  $p ="relacion";
        include('../plantillas/paso.php');
      } 
      else
       throw new Exception ("Error: No es posible registrar");
    }

    function close(){
        $this->cnx->close();
    }
  function pregistrousuario()
  {
    
  }    
    function cambiarestado(){
      include("../include/conectar.php");
      $query ="UPDATE tblproyecto SET estado_proyecto = '$this->asesor' WHERE tblproyecto.cod_proy = '$this->semestrepy';";
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);      
      if($sql){
			  $p ="estadopy";
        include('../plantillas/paso.php');
      } 
      else
        throw new Exception ("Error: No es posible registrar");
    }
}
?>