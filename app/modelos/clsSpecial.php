<?php
class clsSpecial
{
  private $ncarrera;
  private $nomSpecial;
  private $param;
  private $codigo;
  private $enlace;
  private $codinsertar;
  private $tkeninsertar;
  private $estado;  

  function __construct($data)
  {
    if (is_array($data)) {
      // $this->setData($data);
    } else {
      throw new Exception("Error: no se encuentra informacion");
    }
  }
  function setData($data)
  {
    $sw_Ok = "";
    $this->param  = $data['accion'];
    $this->enlace = "../public/index2.php?page=frmgralSpecial&op=1";
    //if ($this->param != "lista" ){
    /*
        echo "<pre>";
        //echo "tipo sql->" . gettype($objmn) . "<br>";
        // echo "orden....->>" . $query . "<br>";
        echo "clsSpecial.php, linea-26" . "<br>";
        echo "regquest=>" . "<br>";
        print_r($_REQUEST);
        echo "POST=>" . "<br>";
        print_r($data);
        echo "</pre>";
        die();      
      */
    $this->nomSpecial  = isset($data['nomSpecial']) ? $data['nomSpecial'] : "";
    $this->codigo      = isset($data['idsearch'])   ? $data['idsearch']  : "";
    $this->codinsertar = isset($data['dato'])       ? $data['dato']      : "";
    $this->tkeninsertar = isset($data['token'])      ? $data['token']     : "";
    $this->estado      = isset($data['state'])    ? $data['state'] : 0;    
    $sw_Ok = $this->getData();
    return $sw_Ok;
    // }
  }
  function getData()
  {
    include("../include/conectar.php");
    switch ($this->param) {
      case "lista":
        $query =  "SELECT a.*";
        $query .= ",(select count(*) from tblasesores b where b.estado = 1 and b.especialidad = a.idSpecial) as nro ";
        $query .= "FROM tbSpecial a order by nro;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if (mysqli_num_rows($sql) > 0) {
          return $sql;
        }
        break;
      case "Nuevo":
        $query = "Insert into tbSpecial(nomSpecial, estado) values('$this->nomSpecial', 1);";
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
      case "Borrar":  // borrar(desactivar) el registro
        $sql = "";
        $query = "Update tbSpecial set estado = 0 Where 1=1 and idSpecial = $this->codigo;";
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
          
          //echo "registro=>, linea-8" . "<br>";
          //print_r($registro);
          echo "</pre>";
          die();
          */
        break;
      case "searchone":  // buscar el registro a eliminar-editar
        //echo "codigo a buscar->".$this->codigo;
        $sql = "";
        $query  = "Select idSpecial, nomSpecial From tbSpecial ";
        $query .= "Where 1=1 and estado = 1 and idSpecial = $this->codigo;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);

        //echo "Saliendo de la clase"."<br>"; 
        //print_r($sql);
        return $sql;
        break;
      case "Editar":  // Actualizar registro(ediciom)          
        $sql = "";
        $query  = "Update tbSpecial set nomSpecial = '$this->nomSpecial' Where 1=1";
        $query .= " and idSpecial = $this->codigo;";

        /*echo "query(edicion)-->(clstipoDocumento.php, linea-118)--" . "<br>";
          echo $query . "<br>";        
          die();    */
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if ($sql) {
          $p = "tipodoc";
          $t = "Registro Actualizado correctamente";
          $enlace = $this->enlace;
          include('../plantillas/paso.php');
        } else
          throw new Exception("Error: No es posible Actualizar");
        break;
      case "fillcbo":
        $query =  "Select a.idSpecial, a.nomSpecial FROM tbSpecial a where a.estado=1;";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if (mysqli_num_rows($sql) > 0) {
          return $sql;
        }
        break;
      case 'emptyfillcbo':
        $sql = "";
        /*
        echo "<pre>";
        echo "clsSpecial.php, linea-164" . "<br>";
        echo "regquest=>, linea-38" . "<br>";
        echo print_r($_REQUEST);
        echo  "POST=>, linea-40" . "<br>";
        echo  $this->codinsertar."<br>";
        echo  $this->tkeninsertar;
        echo "</pre>";
        die();
        */
        $sql = mysqli_query($conection, "CALL grabaTmpspecial($this->codinsertar,'$this->tkeninsertar', $this->estado)");
        mysqli_close($conection);
        return $sql;
        break;
      case 'traetmp':
        $sql = "";
        $qry =  "select a.idtemp, a.idspecial, b.nomspecial from tbtmpspecial a, ";
        $qry .= "tbspecial b where a.tokenuser = '$this->tkeninsertar' and  ";
        $qry .= " a.estado = 1 and a.idspecial = b.idspecial";
        $sql = mysqli_query($conection, $qry);
        mysqli_close($conection);
        //if (mysqli_num_rows($sql) > 0) {
        return $sql;
        // }
        break;
      case 'deltmpspecial':
        $sql = "";
        $sql = mysqli_query($conection, "CALL borraTmpspecial($this->codinsertar,'$this->tkeninsertar' )");
        //$sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        //if (mysqli_num_rows($sql) > 0) {
        return $sql;
        // }
        break;
      case 'cbospecial':
        $sql = "";
        $sqy = "Select a.idSpecial, a.nomSpecial FROM tbSpecial a where (a.estado=1 and a.idSpecial not in 
                (select b.idSpecial from tbtmpspecial b where b.tokenuser = '$this->tkeninsertar' and b.estado =1));";
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
