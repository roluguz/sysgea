<?php


class registroproyecto {
	private $Id;
	private $Id_proyecto;
	private $docuemnto;
	private $semestre;
	private $nombre_proyecto;
	private $cnx;
	private $tema_proyecto;
	private $Problema_proyecto; 
	private $Descripcion_proyecto;
	private $ObjetivoG_proyecto;
	private $ObjetivoE_proyecto;
	private $justificacion_proyecto;
	private $codigoproyecto;
	private $directoriop;  
  
    
  function __construct($data){
		session_start();
		if(is_array($data)){
			$this->setData($data);
		}
		else{
			throw new Exception("Error: no se encuentra informacion");
		}

    echo "registroproyecto-modelos, linea-30" . "<br>";
    echo "<pre>";
    echo "REQUEST-->" . "<br>";
    print_r($_REQUEST);
    echo "SESIONES-->" . "<br>";
    print_r($_SESSION);
    echo "</pre>";
    die();
    
    
		//$this->connectToDb();
		if ($data['accion']=="crea_proyecto"){
			$this->crea_proyecto();
		}elseif($data['accion']=="act_proyecto"){
			$this->act_proyecto();
		}       
  }
    
    private function setData($data){
        if($data['accion']=="act_proyecto"){
           $this->id = $data['id'];
           $this->codigoproyecto = $data['codigoproyecto'];
        }else{
           $this->docuemnto= $data['docuemnto'];
           $this->semestre= $data['semestre'];
           $this->nombre_proyecto= $data['nombre_proyecto'];
           $this->tema_proyecto= $data['tema_proyecto'];
           $this->Problema_proyecto= $data['Problema_proyecto'];
           $this->Descripcion_proyecto= $data['Descripcion_proyecto'];
           $this->ObjetivoG_proyecto= $data['ObjetivoG_proyecto'];
           $this->ObjetivoE_proyecto= $data['ObjetivoE_proyecto'];
           $this->justificacion_proyecto= $data['justificacion_proyecto'];
        }
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function crea_proyecto(){
	    include("../include/conectar.php");
      $query ="SELECT COUNT(id_usuario) TT FROM vs_matriculaestud WHERE";
      $query.=" id_usuario= (SELECT id_usuario from tblestudiantes WHERE login='$this->docuemnto')";
      $sql = mysqli_query($conection, $query);
      //mysqli_close($conection);      
      if(!$sql){
      }
      else
        {
					$this->clavep();
					$this->directorio();
					$query ="INSERT INTO tblproyecto (id_proyecto,cod_proy, semestre_proyecto, nombre_proyecto,";
          $query.="tema_proyecto, problema_proyecto, descripcion_proyecto, objetivoG_proyecto,";
          $query.="objetivoE_proyecto, justificacion_proyecto, estado_proyecto) VALUES";
          $query.="($this->Id_proyecto,'$this->codigoproyecto','$this->semestre',
                   '$this->nombre_proyecto',' $this->tema_proyecto','$this->Problema_proyecto',
                   '$this->Descripcion_proyecto','$this->ObjetivoG_proyecto','$this->ObjetivoE_proyecto',
                   '$this->justificacion_proyecto',1);";
          $sql = mysqli_query($conection, $query);
          //mysqli_close($conection);       
					if($sql){
            $query ="INSERT INTO proyecto_estudiante ( estudiante, proyecto) ";
            $query.=" VALUES((SELECT ID_usuario FROM tblestudiantes WHERE ";
            $query.="login='$this->docuemnto'), (select id_proyecto from tblproyecto where cod_proy";
            $query.="='$this->codigoproyecto'));";
            $sql = mysqli_query($conection, $query);
            //mysqli_close($conection);
						if($sql){
              $this->semestre1();
              if($_GET){											
              }else{
                if($_SESSION['apellidos_usuario']==""){
                  $p="regproy";
                  include('../plantillas/paso.php');
                }   
                else{
                  $_SESSION['proyecto']=$this->codigoproyecto;
                  $p="fnal";
                  include('../plantillas/paso.php');
                }
              }											
						}
					} 
          else
            throw new Exception ("Error: No es posible registrar");
      }
      mysqli_close($conection);
    }
    
    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
    function act_proyecto(){  
			include("../include/conectar.php");
      $query1 ="UPDATE tblproyecto SET tema_proyecto = ' $this->tema_proyecto', ";
      $query1.="problema_proyecto = '$this->Problema_proyecto', descripcion_proyecto = '$this->Descripcion_proyecto', objetivoG_proyecto = '$this->ObjetivoG_proyecto', objetivoE_proyecto = '$this->ObjetivoE_proyecto', justificacion_proyecto = '$this->justificacion_proyecto'
        WHERE nombre_proyecto ='$this->nombre_proyecto';";
      $sql = mysqli_query($conection, $query1);
      mysqli_close($conection);
      if($sql) {
        $p="actproy";
        include('../plantillas/paso.php');
        //echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=http://www.desarrolloweb.com'>"
      }
      else throw new Exception ("Error: No es posible registrar");    
    }

    function close(){
        $this->cnx->close();
    }


  function directorio(){
	  $carpeta = htmlspecialchars ($this->codigoproyecto); //(
	  $rura    = htmlspecialchars("../../../proyectos/".$this->codigoproyecto); //cambiar ruta de guardado
	  $this->directoriop = "../../../proyectos/".$carpeta; //cambiar ruta de guardado
	
	  if(!is_dir($this->directoriop))
	  {
		 	$crear =mkdir($this->directoriop, 0777, true);
			if($crear)
			{
               
			}
		}  
  	}
    
    function semestre1(){
			include("../include/conectar.php");
      $semestre="sem1".date('mhss');
      $query =" INSERT INTO tblsemestrepro (codigo_semestre,proyecto)VALUES('$semestre','$this->codigoproyecto');";
      $sql = mysqli_query($conection, $query);
      mysqli_close($conection);
      if($sql){
				$ruta = $this->directoriop;
				$this->directoriop = $ruta."/".$semestre;
				 if(!is_dir($this->directoriop))
				{
					$crear =mkdir($this->directoriop, 0777, true);
					if($crear)
					{
						$ruta =$this->directoriop;
						$this->directoriop =  $ruta."/complementos";
						$crear =mkdir($this->directoriop, 0777, true);
						$this->directoriop= $ruta."/entregas";
						$crear =mkdir($this->directoriop, 0777, true);								
					}
				}
      }
    }
	function clavep(){
		include("../include/conectar.php");
		$query="SELECT max(Id_proyecto) v from tblproyecto";
    $sql = mysqli_query($conection, $query);
    mysqli_close($conection);
    if(mysqli_num_rows($sql)>0){
      $row = mysqli_fetch_assoc($sql);
			$this->Id_proyecto = $row['v']+1;
			//año+semestre+carrera+id
			if (date('m')>=1 and date('m')<=6){ $semestre= "1";
			}	else	{		$semestre= "2";	}
			if($_SESSION['carrera']=='Ingenieria Sistemas')      { $carrera='Sis'; }
			elseif($_SESSION['carrera']=='Ingenieria Industrial'){ $carrera='Ind'; }
      else{ 
        session_destroy();
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../vistas/login.php'>";
      }
			$this->codigoproyecto=$carrera.date('o').$semestre.$this->Id_proyecto;
		}
	}
}

?>