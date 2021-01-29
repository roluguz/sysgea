<?php


class archivosproyecto {
    private $proyecto;
    private $accion;
    private $cnx;
    private $resultado;
    private $consulta;
    private $codigo_entrega ;
    private $nombre_carga ;
    private $nombre_archivo ;
    private $descripcion_archivo ;
    private $ubicacion_archivo ;
    private $extencion ;
    private $tamano ;
    private $tipo ;
    private $semestre;
    private $propietario;

    
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
        elseif($data['accion']=='insertar') {
            $this->codigo_entrega =$data['codigo_entrega'];
            $this->nombre_carga =$data['nombre_carga'];
            $this->nombre_archivo =$data['nombre_archivo'];
            $this->descripcion_archivo =$data['descripcion_archivo'];
            $this->ubicacion_archivo =$data['ubicacion_archivo'];
            $this->extencion =$data['extencion'];
            $this->tamano = $data['tamano'];
            $this->tipo = $data['tipo'];
            $this->semestre=$data['semestre'];
            $this->propietario=$data['usuario'];
            //$vars= '../include/variables.php';
            //new database($vars);
            $sw_Ok=$this->registroarchivo();
        }elseif($data['accion']=='complemento') {
            $this->codigo_entrega =$data['codigo_entrega'];
            $this->nombre_carga =$data['nombre_carga'];
            $this->nombre_archivo =$data['nombre_archivo'];
            $this->descripcion_archivo =$data['descripcion_archivo'];
            $this->ubicacion_archivo =$data['ubicacion_archivo'];
            $this->tamano = $data['tamano'];
            $this->semestre=$data['semestre'];
            $this->propietario=$data['usuario'];
            //$vars= '../include/variables.php';
            //new database($vars);
            $sw_Ok=$this->registrocomp();
        }
        return $sw_Ok;
    }
    private function connectToDb(){
      include 'database.php';
      $vars= '../include/variables.php';
      new database($vars);
    }
    
    function getData(){
       include("../include/conectar.php"); 
       $query= " SELECT tblsemestrepro.codigo_semestre, tblproyecto.cod_proy, tblproyecto.semestre_proyecto 
               FROM tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto 
               WHERE tblproyecto.cod_proy = '$this->proyecto';";
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

  function registroarchivo(){
    include("../include/conectar.php");
    $query ="INSERT INTO archivos (codigo_entrega, nombre_carga, nombre_archivo, descripcion_archivo, 
                          ubicacion_archivo, extencion, tamano,propietario, semestre)
              values ('$this->codigo_entrega', '$this->nombre_carga', '$this->nombre_archivo', 
                      '$this->descripcion_archivo', '$this->ubicacion_archivo', '$this->extencion', 
                      $this->tamano,'$this->propietario', '$this->semestre');";
    $sql = mysqli_query($conection, $query);
    mysqli_close($conection);
    if($sql){
      if($this->tipo=="crr"){
        $p ="regarchi";
        include('../plantillas/paso.php');
      }else{
        $p ="regarch";
        include('../plantillas/paso.php');
      }
    } 
    else
        throw new Exception ("Error: No es posible registrar");
  }

  function registrocomp(){
    include("../include/conectar.php");
    $query ="INSERT INTO archivoscompl (codigo_entrega, nombre_carga, nombre_archivo, 
                                        descripcion_archivo, ubicacion_archivo, tamano,propietario, semestre)
            values ('$this->codigo_entrega', '$this->nombre_carga', '$this->nombre_archivo', 
                    '$this->descripcion_archivo', '$this->ubicacion_archivo', $this->tamano,
                    '$this->propietario', '$this->semestre'); ";
    $sql = mysqli_query($conection, $query);
    mysqli_close($conection);
    if($sql){
      $p ="regarch";
      include('../plantillas/paso.php');
    } 
    else
        throw new Exception ("Error: No es posible registrar");
  }
}
?>