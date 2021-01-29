<?php


class consulta {
    private $consulta;
    private $cnx;
    private $resultado;
    Private $codigo;
    function __construct(){
     
    }

    function setData($data){
        $sw_Ok="";
        $this->consulta = $data['accion'];
       if(isset($data['codigo'])){ $this->codigo = $data['codigo'];};
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
       switch($this->consulta){
            case "proyectosinap":
                $query="SELECT tblproyecto.nombre_proyecto, tblproyecto.cod_proy, tblproyecto.estado_proyecto, 
                        tblproyecto.semestre_proyecto, tblproyecto.update_at FROM tblproyecto;";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break;
            case "proyectoap":
                $query="SELECT * FROM tblproyecto WHERE estado_proyecto <>0;";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;
                }
                break;
            case "proyasignado":
                $query="SELECT tblsemestrepro.asesor, tblproyecto.nombre_proyecto, 
                        tblproyecto.semestre_proyecto,tblproyecto.cod_proy, 
                        tblasesores.nombres_asesor, tblasesores.apellidos_asesor, tblsemestrepro.estado
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
            case "integrantespy":
                $query="SELECT tblestudiantes.nombres_usario, tblestudiantes.apellidos_usuario, tblestudiantes.carrera, tblestudiantes.correo_personal, tblestudiantes.semestre, tblproyecto.cod_proy
                        FROM tblproyecto INNER JOIN (tblestudiantes INNER JOIN proyecto_estudiante ON tblestudiantes.id_usuario = proyecto_estudiante.estudiante) ON tblproyecto.id_proyecto = proyecto_estudiante.proyecto
                        WHERE (((tblproyecto.cod_proy)='$this->codigo')); ";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break;
            case "mostrararchivo":
                $query="SELECT tblproyecto.cod_proy, tblproyecto.semestre_proyecto, tblproyecto.nombre_proyecto, 
                                tblsemestrepro.codigo_semestre, archivos.extencion, archivos.ubicacion_archivo, archivos.propietario,  archivos.nombre_archivo,archivos.create_at,archivos.tipo,archivos.codigo_entrega
                        FROM (tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto) 
                        INNER JOIN archivos ON tblsemestrepro.codigo_semestre = archivos.semestre
                        WHERE (((tblproyecto.cod_proy)='$this->codigo'));";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break;
            case "docuemntos":
                $query="SELECT nombre_formato, actualizaciom, direccion, descripcion,nombre_archivo
                        FROM tbformatos where estado = 'vigente';";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break;
            case "listaproyectos":
                $query="SELECT tblproyecto.semestre_proyecto, tblsemestrepro.create_at, tblsemestrepro.codigo_semestre, tblsemestrepro.asesor, tblsemestrepro.proyecto, tblasesores.login, tblproyecto.cod_proy, tblproyecto.nombre_proyecto
                FROM tblproyecto INNER JOIN (tblasesores INNER JOIN tblsemestrepro ON tblasesores.id_asesor = tblsemestrepro.asesor)
                ON tblproyecto.cod_proy = tblsemestrepro.proyecto
                WHERE (((tblasesores.login)='$this->codigo') AND ((tblsemestrepro.estado)='en curso'));";                        
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break;
            case "consultapy":
                $query="SELECT tblproyecto.semestre_proyecto, tblproyecto.nombre_proyecto, 
                               tblsemestrepro.codigo_semestre, tblsemestrepro.asesor, 
                               tblsemestrepro.proyecto, tblsemestrepro.estado
                        FROM tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto
                        WHERE tblsemestrepro.proyecto='$this->codigo' and tblsemestrepro.estado='en curso';";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    return $sql;   
                }
                break; 
            case "proyectosg":
                $query="SELECT tblproyecto.semestre_proyecto, tblproyecto.cod_proy, 
                               tblproyecto.nombre_proyecto, tblasesores.nombres_asesor, 
                               tblasesores.apellidos_asesor, calificaciones.valoracion, calificaciones.create_at
                        FROM (tblproyecto INNER JOIN (tblasesores INNER JOIN tblsemestrepro 
                        ON tblasesores.id_asesor = tblsemestrepro.asesor)
                        ON tblproyecto.cod_proy = tblsemestrepro.proyecto) INNER JOIN calificaciones 
                        ON tblsemestrepro.codigo_semestre = calificaciones.semestre;";
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