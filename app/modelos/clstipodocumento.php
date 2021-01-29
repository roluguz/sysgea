<?php

class clstipodocumento {
    private $descripcion;
    private $param;
    Private $codigo;
    function __construct($data){
      if(is_array($data)){
        //$this->setData($data);
      }
      else{
        throw new Exception("Error: no se encuentra informacion");
      }

/*
      if ($data['accion']=="nuevo"){
          $this->pregistrousuario();
        }
      if ($data['accion'] == "erasetipodoc") {
          $this->getData();
      } 
*/      
    }

    function setData($data){
      $sw_Ok = "";
      $this->param  = $data['accion'];
      $this->enlace = "../public/index2.php?page=frmgraltipoDocumento&op=1";        
      $this->descripcion = isset($data['descripcion']) ? $data['descripcion'] : "" ;
      $this->codigo      = isset($data['idsearch'])   ? $data['idsearch']   : "";
      //if(isset($data['codigo'])){ $this->codigo = $data['codigo'];};
      
      
            
      /*  echo "<pre>";
        //echo "tipo sql->" . gettype($objmn) . "<br>";
        // echo "orden....->>" . $query . "<br>";
        echo "clstipoDocumento.php, linea-37" . "<br>";
        echo "regqurst=>, linea-38" . "<br>";
        print_r($_REQUEST);
        echo "POST=>, linea-40" . "<br>";
        print_r($data);
        echo "</pre>";
        die();      */


      
      
      $sw_Ok=$this->getData();        
      return $sw_Ok;
    }
    
  function getData()
  {
    include("../include/conectar.php");  
    switch($this->param){
      case "lista":
        $query=  "SELECT a.*, (select count(*) from tblestudiantes b where b.tipo_documento = a.idtipodocumento) ";
        $query.="as nro FROM tbtipodocumento a where 1=1";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if(mysqli_num_rows($sql)>0){
            return $sql;   
        }
        break;
      case "Nuevo":
        $query= "Insert into tbtipodocumento(descripcion, estado) values('$this->descripcion', 1);";
        //echo "query(NUEVO)-->(clstipoDocumento.php, linea-64)" . "<br>";
        //echo $query . "<br>";
        //die();        
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if ($sql) {
          $p = "tipodoc";
          $t = "Registro Guardado correctamente";
          $enlace = "../public/index2.php?page=frmgraltipoDocumento&op=1";
          include('../plantillas/paso.php');
        } else
          throw new Exception("Error: No es posible Registrar");
        break;
      case "Borrar":  // borrar(desactivar) el registro
        $sql ="";      
        $query = "Update tbtipodocumento set estado = 0 Where 1=1 and idtipoDocumento = $this->codigo;";
        //echo "query(erasetipodoc)-->(clstipoDocumento.php, linea-68)" . "<br>";
        //echo $query . "<br>";        
        //die();
        // echo $query; die();
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if ($sql) {
          $p = "tipodoc";
          $t = "Registro eliminado correctamente";
          $enlace = "../public/index2.php?page=frmgraltipoDocumento&op=1";
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
      case "searchone":  // buscar el registro a eliminar-editar
        $sql = "";
        $query  = "Select idtipoDocumento, Descripcion From tbtipodocumento ";
        $query .= "Where 1=1 and estado = 1 and idtipoDocumento = $this->codigo;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        return $sql;
        break;
      case "Editar":  // Actualizar registro(ediciom)
        //echo "hola";die();
        $sql = "";
        $query  = "Update tbtipodocumento set Descripcion = '$this->descripcion' Where 1=1";
        $query .= " and idtipoDocumento = $this->codigo;";
        
        //echo $query; die();
        
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if ($sql) {
          $p = "tipodoc";
          $t = "Registro Actualizado correctamente";
          $enlace = "../public/index2.php?page=frmgraltipoDocumento&op=1";
          include('../plantillas/paso.php');
        } else
          throw new Exception("Error: No es posible Actualizar");     
        break;            
      case "fillcbo":
        $query =  "Select a.idtipoDocumento, a.Descripcion FROM tbtipodocumento a where 1=1 and a.estado=1;";
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