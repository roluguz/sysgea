<?php
  class clscarreras 
  {
    private $ncarrera;
    private $param;
    Private $codigo;
    private $enlace;
    function __construct($data){
      /*if(is_array($data)){
        $this->setData($data);
      }
      else{
        throw new Exception("Error: no se encuentra informacion");
      } */    
    }
    function setData($data){
      $sw_Ok="";
      $this->param  = $data['accion'];
      $this->enlace = "../public/index2.php?page=frmgralCarreras&op=1";
      /*
      if ($this->param != "lista" ){
        echo "<pre>";
        //echo "tipo sql->" . gettype($objmn) . "<br>";
        // echo "orden....->>" . $query . "<br>";
        echo "clstipoDocumento.php, linea-37" . "<br>";
        echo "regqurst=>, linea-38" . "<br>";
        print_r($_REQUEST);
        echo "POST=>, linea-40" . "<br>";
        print_r($data);
        echo "</pre>";
        die();      
      }
      */
      $this->ncarrera = isset($data['nCarrera']) ? $data['nCarrera'] : "";
      $this->codigo   = isset($data['iddele'])   ? $data['iddele']   : "";      
      $sw_Ok=$this->getData();        
      return $sw_Ok;
    }
      
    function getData()
    {
      include("../include/conectar.php");  
      switch($this->param)
      {
        case "lista":
          $query=  "SELECT a.*, (select count(*) from tblestudiantes b where b.carrera = a.idCarrera) ";
          $query.="as nro FROM tbcarreras a where a.estado=1;";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if(mysqli_num_rows($sql)>0){
              return $sql;   
          }
          break;
        case "nuevo":
          $query= "Insert into tbcarreras(ncarrera, estado) values('$this->ncarrera', 1);";
          /*
          echo "<pre>";       
          echo "clscarreras.php(NUEVO), linea-62" . "<br>";
          echo "request=>" . "<br>";
          print_r($_REQUEST);
          echo "query=>, linea-40".$query . "<br>";
          echo "</pre>";
          die(); 
          */
          //echo "query(NUEVO)-->(clstipoDocumento.php, linea-64)" . "<br>";
          //echo $query . "<br>";
          //die();        
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if ($sql) {
            $p = "tipodoc";
            $t = "Registro Guardado correctamente";
            $enlace = $this->enlace;
            include('../plantillas/paso.php');
          } else
            throw new Exception("Error: No es posible Registrar");
          break;
        case "erasetipodoc":  // borrar(desactivar) el registro
          $sql ="";      
          $query = "Update tbcarreras set estado = 0 Where 1=1 and idCarrera = $this->codigo;";
          //echo "query(erasetipodoc)-->(clstipoDocumento.php, linea-68)" . "<br>";
          //echo $query . "<br>";        
          //die();
          // echo $query; die();
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if ($sql) {
            $p = "tipodoc";
            $t = "Registro eliminado correctamente";
            $enlace = $this->enlace;
            include('../plantillas/paso.php');
          } else
          throw new Exception("Error: No es posible Borrar");
          /*
          echo "<pre>";
          //echo "tipo sql->" . gettype($objmn) . "<br>";
          // echo "orden....->>" . $query . "<br>";
          echo "clstipoDocumento.php, linea-77" . "<br>";
          echo "query->" .$query. "<br>";
          echo "sql" . "<br>";        
          print_r($sql);
          //echo "registro=>, linea-8" . "<br>";
          //print_r($registro);
          echo "</pre>";
          die();
          */            
          break;
        case "searchborrar":  // buscar el registro a eliminar-editar
          $sql = "";
          $query  = "Select idCarrera, nCarrera From tbcarreras ";
          $query .= "Where 1=1 and estado = 1 and idCarrera = $this->codigo;";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          return $sql;          
          break;
        case "edicion":  // Actualizar registro(ediciom)
          $sql = "";
          $query  = "Update tbcarreras set ncarrera = '$this->ncarrera' Where 1=1";
          $query .= " and idCarrera = $this->codigo;";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if ($sql) {
            $p = "tipodoc";
            $t = "Registro Actualizado correctamente";
            $enlace = $this->enlace;
            include('../plantillas/paso.php');
          } else
          throw new Exception("Error: No es posible Actualizar");  
          // echo "query(edicion)-->(clstipoDocumento.php, linea-118)--" . "<br>";
          // echo $query . "<br>";        
          // die();    
        break;
      case "fillcbo":
        $query =  "Select a.idCarrera, a.nCarrera FROM tbcarreras a where a.estado=1;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if (mysqli_num_rows($sql) > 0) {
          return $sql;
        }
        break;
      }
    }	
  }
?>