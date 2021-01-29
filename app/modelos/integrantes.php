<?php


class integrante {

    private $usuario;
    private $proyecto;
    private $correo;
    private $clave;
    private $accion;
    
    
    function __construct($data){
        if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra información");
        }
        //$this->connectToDb();
        if ($data['accion']=="ag-integrante"){
            $this->pregistrousuario();
        }elseif($data['accion']=="ag-proyecto"){
            $this->pregistroproyecto();
        }
       
    }
    
    private function setData($data){
           $this->usuario= $data['usuario'];
           if(!isset($data['correo'])){}else{$this->correo= $data['correo'];}
           if(!isset($data['clave'])){}else{$this->clave= $data['clave'];}
           $this->proyecto= $data['proyecto'];
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    
  function pregistrousuario(){
    include("../include/conectar.php");  
    $query ="SELECT id_usuario from tblestudiantes WHERE login='$this->usuario'";
    $sql = mysqli_query($conection, $query);
    if(mysqli_num_rows($sql)>0){
        $query ="SELECT COUNT(id_usuario) TT FROM vs_matriculaestud 
                WHERE id_usuario = (SELECT id_usuario from tblestudiantes WHERE login='$this->usuario')";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);   
        $row = mysqli_fetch_assoc($sql);
      if($row['TT']<=0)
      {
        $query ="SELECT COUNT(id_proyecto) TT FROM vs_matriculaestud 
          WHERE id_proyecto = (SELECT id_proyecto from tblproyecto WHERE cod_proy='$this->proyecto')";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);             
        $row = mysqli_fetch_assoc($sql);
        if($row['TT']<3){
          $query ="INSERT  INTO proyecto_estudiante (estudiante, proyecto) values 
              ((select id_usuario from tblestudiantes where login ='$this->usuario'),
                (select id_proyecto from tblproyecto where cod_proy= '$this->proyecto'));";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);  
          if($sql){
            $_SESSION['proyecto'] = $this->proyecto;
            $p ="integrantes";
            $M="Se ha agregado el estudiante de manera exitosa.";
            include('../plantillas/paso.php');
          } else throw new Exception ("Error: No es posible registrar");
        }else {
          $p ="integrantes";
          $M="El proyecto cuenta con el máximo numero de integrantes permitidos.";
          include('../plantillas/paso.php');
        }
      }else {
        $p ="integrantes";
        $M="El Estudiante actualmente esta inscrito en otro proyecto";  
        include('../plantillas/paso.php');
      }
    }else{
      $p ="integrantes";
      $M="El Estudiante no se encuentra registrado en la plataforma.";
      include('../plantillas/paso.php');
      //paso usuario no registrado
    }
  }

  function pregistroproyecto(){
    include("../include/conectar.php");
    $query ="SELECT id_proyecto from tblproyecto WHERE cod_proy='$this->proyecto'";
    $sql = mysqli_query($conection, $query);
    mysqli_close($conection);
    if(mysqli_num_rows($sql)>0){
      $query ="SELECT COUNT(id_usuario) TT FROM vs_matriculaestud 
              WHERE id_usuario = (SELECT id_usuario from tblestudiantes WHERE login='$this->usuario')";
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);        
      $row = mysqli_fetch_assoc($sql);
      if($row['TT']<=0){
        $query ="SELECT COUNT(id_proyecto) TT FROM vs_matriculaestud 
                  WHERE id_proyecto = (SELECT id_proyecto from tblproyecto WHERE cod_proy='$this->proyecto')";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        $row = mysqli_fetch_assoc($sql);
        if($row['TT']<3){
          $query ="INSERT  INTO proyecto_estudiante (estudiante, proyecto) values 
                    ((select id_usuario from tblestudiantes where login ='$this->usuario'),
                    (select id_proyecto from tblproyecto where cod_proy= '$this->proyecto'));";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if($sql){
            $_SESSION['proyecto'] = $this->proyecto;
            $p ="integrantes";
            $M="Se ha agregado el estudiante de manera exitosa.";
            include('../plantillas/paso.php');
          } 
          else throw new Exception ("Error: No es posible registrar");
         }else {
          $p ="integrantes";
          $M="El proyecto cuenta con el máximo numero de integrantes permitidos.";
          include('../plantillas/paso.php');
        }
      }else {
        $p ="integrantes";
        $M="El Estudiante actualmente esta inscrito en otro proyecto";  
        include('../plantillas/paso.php');
      }
    }else{
      $p ="integrantes";
      $M="El proyecto no existe en la plataforma.";
      include('../plantillas/paso.php');
          //paso proyecto no registrado
    }
  }
  function close(){
      $this->cnx->close();
  }
}
?>