<?php


class notas {
    private $proyecto;
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
      if($data['accion']=='consultar'){
        $this->proyecto= $data['proyecto'];
        //$this->connectToDb();
        $sw_Ok=$this->getData();
      }
      return $sw_Ok;
    }
    private function connectToDb(){
      //include 'database.php';
      $vars= '../include/variables.php';
      new database($vars);
    }
    
    function getData(){
      include("../include/conectar.php");
      $query="SELECT tblproyecto.nombre_proyecto, tblproyecto.semestre_proyecto, 
                     tblasesores.nombres_asesor, calificaciones.valoracion, 
                     calificaciones.create_at, tblproyecto.cod_proy, tblasesores.apellidos_asesor
                FROM (tblproyecto INNER JOIN (tblasesores INNER JOIN tblsemestrepro ON tblasesores.id_asesor = tblsemestrepro.asesor)
                      ON tblproyecto.cod_proy = tblsemestrepro.proyecto) 
                INNER JOIN calificaciones ON tblsemestrepro.codigo_semestre = calificaciones.semestre
                WHERE tblproyecto.cod_proy ='$this->proyecto' order by id desc;";        
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);
      if(mysqli_num_rows($sql)>0){
            return $sql;
      }
      else{ 
        throw new Exception("");
        //return '';
      }
    }
    function close(){
        $this->cnx->close();
    }
}

?>