<?php


class asignarasesor {
    private $proyecto;
    private $asesor;
    private $accion;
    private $cnx;
    private $resultado;
    
    function __construct(){
        /*if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        $this->connectToDb();
        $this->getData(); */
    }

    function setData($data){
        $sw_Ok="";
        $this->accion= $data['accion'];
        //$this->connectToDb();
        $sw_Ok=$this->getData();
        return $sw_Ok;
    }
    private function connectToDb(){
        //include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    
    function getData(){
      include("../include/conectar.php");    
      switch($this->accion){
          case "asesor":
              $query="select id_asesor, nombres_asesor, apellidos_asesor from tblasesores where estado =1;";
              $sql = mysqli_query($conection, $query);
              mysqli_close($conection);
              if(mysqli_num_rows($sql)>0){
                  return $sql;   
              }
              break;
          case "proyectossin":
              $query="SELECT tblproyecto.nombre_proyecto, tblproyecto.semestre_proyecto, 
                          tblproyecto.cod_proy, tblsemestrepro.id_semestrepro
                      FROM tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto
                      WHERE (((tblsemestrepro.asesor) Is Null))AND ((tblsemestrepro.estado)='en curso');";
              $sql = mysqli_query($conection, $query);
              mysqli_close($conection);
              if(mysqli_num_rows($sql)>0){
                  return $sql;
              }
              break;
          case "proyasignado":
              $query="SELECT tblsemestrepro.asesor, tblproyecto.nombre_proyecto, tblproyecto.semestre_proyecto, 
                        tblproyecto.cod_proy, tblasesores.nombres_asesor, tblasesores.apellidos_asesor,
                        tblsemestrepro.estado
                      FROM tblasesores INNER JOIN (tblproyecto INNER JOIN tblsemestrepro 
                      ON tblproyecto.cod_proy = tblsemestrepro.proyecto) 
                      ON tblasesores.id_asesor = tblsemestrepro.asesor
                      WHERE (((tblsemestrepro.asesor) Is Not Null) AND ((tblsemestrepro.estado)='en curso'));";
              $sql = mysqli_query($conection, $query);
              mysqli_close($conection);
              if(mysqli_num_rows($sql)>0){
                  return $sql;   
              }
              break;
          }
  }
    function close(){
        $this->cnx->close();
    }
}

?>