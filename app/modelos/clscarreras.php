<?php
  class clsCarreras
  {
    private $ncarrera;
    private $param;
    Private $codigo;
    private $enlace;
    private $codinsertar;
    private $tkeninsertar;
    private $estado;  
  
    
    function __construct($data){
      if (is_array($data)) {
        //$this->setData($data);
      } else {
        throw new Exception("Error: no se encuentra informacion");
      }
    }
    function setData($data){
      $sw_Ok="";
      $this->param  = $data['accion'];
      $this->enlace = "../public/index2.php?page=frmgralCarreras&op=1";  
      $this->ncarrera    = isset($data['nCarrera']) ? $data['nCarrera'] : "";
      $this->codigo      = isset($data['idsearch']) ? $data['idsearch'] : "";
      $this->codinsertar = isset($data['dato'])     ? $data['dato']     : "";
      $this->tkeninsertar= isset($data['token'])    ? $data['token']    : "";
      $this->estado      = isset($data['state'])    ? $data['state'] : 0;
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
          $query.="as nro FROM tbcarreras a where 1=1";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          if(mysqli_num_rows($sql)>0){
              return $sql;   
          }
          break;
        case "Nuevo":
          $query= "Insert into tbcarreras(ncarrera, estado) values('$this->ncarrera', 1);";
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
        case "Borrar":  // borrar(desactivar) el registro
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
           
          break;
        case "searchone":  // buscar el registro a eliminar-editar
          $sql = "";
          $query  = "Select idCarrera, nCarrera From tbcarreras ";
          $query .= "Where 1=1 and estado = 1 and idCarrera = $this->codigo;";
          $sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          return $sql;          
          break;
        case "Editar":  // Actualizar registro(ediciom)
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
        $sql = "";
        $query =  "Select a.idCarrera, a.nCarrera FROM tbcarreras a where a.estado=1;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        //if (mysqli_num_rows($sql) > 0) {
          return $sql;
        //}
        break;
      case 'emptyfillcbo':
          $sql = "";
          /*
          echo "<pre>";
          //echo "tipo sql->" . gettype($objmn) . "<br>";
          // echo "orden....->>" . $query . "<br>";
          echo "clsCarrera.php, linea-125" . "<br>";
          echo "regqurst=>, linea-38" . "<br>";
          print_r($_REQUEST);
          echo "POST=>, linea-40" . "<br>";
          print_r($data);
          //echo $this->codinsertar."<br>";
          //echo $this->tkeninsertar;
          echo "</pre>";
          die();
          */
        $sql = mysqli_query($conection, "CALL grabaTmpcarrera($this->codinsertar,'$this->tkeninsertar', $this->estado)");
        //$sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        //if (mysqli_num_rows($sql) > 0) {
          return $sql;
        //}
        break;
        /*
      case 'inserttmp':
        //$sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if (mysqli_num_rows($sql) > 0) {
          return $sql;
        }
        break;*/
      case 'traetmp':
        $sql = "";
        $qry =  "select a.idtemp, a.idcarrera, b.ncarrera from tbtmpcarreras a, ";
        $qry .= "tbcarreras b where a.tokenuser = '$this->tkeninsertar' and  ";
        $qry .= " a.estado = 1 and a.idcarrera = b.idcarrera";
        $sql = "";
        $sql = mysqli_query($conection, $qry);        
        mysqli_close($conection);
        //if (mysqli_num_rows($sql) > 0) {
          return $sql;
        // }
        break;        
        case 'deltmpkra':
          $sql = "";
          $sql = mysqli_query($conection, "CALL borraTmpcarrera($this->codinsertar,'$this->tkeninsertar')");
          //$sql = mysqli_query($conection, $query);
          mysqli_close($conection);
          //if (mysqli_num_rows($sql) > 0) {
            return $sql;
         // }
          break;
        case 'cbokras':
          $sql = "";
          $sqy="Select a.idCarrera, a.nCarrera FROM tbcarreras a where (a.estado=1 and a.idcarrera not in 
                (select b.idcarrera from tbtmpcarreras b where b.tokenuser = '$this->tkeninsertar' and b.estado =1));";
          $sql = mysqli_query($conection, $sqy);
          //$sql = mysqli_query($conection, $query);
          mysqli_close($conection);
         //if (mysqli_num_rows($sql) > 0) {
            return $sql;
         // }
          break;
      
      }
    }	
  }
?>