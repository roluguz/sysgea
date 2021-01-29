<?php
$objca = "";
    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="entregable"){
            $data['nombre_archivo'] = $_POST['nombrearch'];
            $data['accion'] = "consultar";
            $data['descripcion_archivo'] = $_POST['descripcion'];
            $data['proyecto'] = $_POST['proyecto'];
            $data['archivo'] = isset($_POST['archivo']);
            $data['usuario'] = $_POST['usuario'];            
            try{
                include '../modelos/archivosproyecto.php';
                $objarchivo = new archivosproyecto;
                $objca = $objarchivo->setData($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
            $data['tipo']="ent"; 
            if( !empty($objca) ){  
                carga($objca,$data);
            }
        }elseif(isset($_POST['submit']) AND $_POST['submit']=="correccion"){
            $data['nombre_archivo'] = $_POST['nombrearch'];
            $data['accion'] = "consultar";
            $data['descripcion_archivo'] = $_POST['descripcion'];
            $data['proyecto'] = $_POST['proyecto'];
            $data['archivo'] = isset($_POST['archivo']);
            $data['usuario'] = $_POST['usuario'];            
            try{
                include '../modelos/archivosproyecto.php';
                $objarchivo = new archivosproyecto;
                $objca = $objarchivo->setData($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            }
            $data['tipo']="crr"; 
            if( !empty($objca) ){  
                carga($objca,$data);
            }
        }elseif(isset($_POST['submit']) AND $_POST['submit']=="complementos"){   
            $data['nombre_archivo'] = $_POST['nombrearch'];
            $data['accion'] = "consultar";
            $data['descripcion_archivo'] = $_POST['descripcion'];
            $data['proyecto'] = $_POST['proyecto'];
            $data['archivo'] = isset($_POST['archivo']);
            $data['usuario'] = $_POST['usuario'];            
            try{
                include '../modelos/archivosproyecto.php';
                $objarchivo = new archivosproyecto;
                $objca = $objarchivo->setData($data);
            }
            catch (Exception $Exc){
                echo $Exc->getMessage();
            } 
            if( !empty($objca) ){  
                complementos($objca,$data);
            }
        }
    }

    function carga($objca, $data){
        $row = mysqli_fetch_assoc($objca);
        $tipo_entrega  = date("mHis");
        $tipo_entrega = "1". $tipo_entrega."7";
        $dir_subida ="../../../proyectos/".$row['cod_proy']."/".$row['codigo_semestre']."/"."entregas/";//$row['ublucacion'];
        if (isset($_FILES['archivo']) )
        {
            // application/msword ======> Word 2003,
            // application/vnd.openxmlformats-officedocument.wordprocessingml.document ===========> Word 2007 and 2010
            // application/vnd.ms-excel =======> Excel 2003
            // application/vnd.openxmlformats-officedocument.spreadsheetml.sheet  =========> Excel 2007 and 2010
            // Cargar en un arreglo los formatos de archivos permitidos
            //http://www.lawebdelprogramador.com/foros/PHP/1498400-hola-necesito-descargar-y-ver-documentos-BLOB-desde-una-base-de-datos-sql.html
             
            $tipos = array("application/pdf","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.ms-word.document.macroEnabled.12");
            $maximo = 9890204000;        
            if (in_array($_FILES['archivo']['type'],$tipos)) 
            { 
                if($_FILES['archivo']['size'] <= $maximo)
                {
                  $archivo = $_FILES["archivo"]["tmp_name"];
                  $tamanio=array();
                  $tamanio = $_FILES["archivo"]["size"];
                  $tipo = $_FILES["archivo"]["type"];
                  $nombre_archivo = $_FILES["archivo"]["name"];
                  /*  */
                  switch($tipo){
                  case "application/msword":
                    $ext =".doc";
                    break;
                  case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    $ext =".docx";
                    break;
                  case "application/pdf":
                    $ext =".pdf";
                    break;
                  }
                  extract($_REQUEST);
                    if ( $archivo != "none" )
                        { 
                           $origen=$_FILES["archivo"]["tmp_name"];
                           $destino = $dir_subida . $_FILES['archivo']['name'];
                            
                            if(move_uploaded_file($origen, $destino))
                            {
                                $name = $dir_subida.$row['codigo_semestre']."-".$tipo_entrega.$data['tipo'];
                                $destino;
                                rename ($destino, $name.$ext);
                                $_FILES["archivo"]["name"]." archivo cargado correctamente.";
                                $codigo = $row['cod_proy']."-".$tipo_entrega.$data['tipo'];
                                //$sql = "INSERT INTO archivos (codigo, extension, nombre_real, tamanio, directorio) VALUES ('$codigo', '$ext', '$nombre_archivo', $tamanio,'$dir_subida')";
                                $data['codigo_entrega']=$row['codigo_semestre']."-".$tipo_entrega.$data['tipo'];
                                $data['nombre_carga']= $_FILES['archivo']['name'];
                                $data['accion'] = "insertar";
                                $data['ubicacion_archivo']=$dir_subida;
                                $data['extencion']= $ext;
                                $data['tamano']=$tamanio;
                                $data['semestre']=$row['codigo_semestre'];
 
                             try{
                                    $objarchivo = new archivosproyecto;
                                     $objca = $objarchivo->setData($data);
                                }
                                catch (Exception $Exc){
                                    echo $Exc->getMessage();
                                }
                            }
                            else{
                                echo "error: no es posible registrar el archivo"; 
                                echo '	<meta http-equiv="refresh" content="2; url=../public/index2.php?page=perfil"> ';
                            }
                        }
                        else
                        {
                            echo "No fue posible subir el archivo";
                            // echo '	<meta http-equiv="refresh" content="2; url=../public/index2.php?page=perfil> ';
                        }
                }
                else
                {
                    echo "Tamaño de Archivo demasiado grande";
                    echo '	<meta http-equiv="refresh" content="3; url=../public/index2.php?page=perfil">';
                }               
            }
            else
            {
                echo "El formato del archivo no es correcto Solo Word y PDF";
                echo '	<meta http-equiv="refresh" content="3; url=../public/index2.php?page=perfil">';
            }
        }
        else 
        { 
            echo "No Ha seleccionado ningún archivo";
        }    

    }


    function complementos($objca, $data){
        $row = mysqli_fetch_assoc($objca);
        $tipo_entrega  = date("mHis");
        $tipo_entrega = "1". $tipo_entrega."comp";
        $ext = end(explode(".", $_FILES['archivo']['name']));
         $dir_subida ="../../../proyectos/".$row['cod_proy']."/".$row['codigo_semestre']."/"."complementos/";//$row['ublucacion'];
        if (isset($_FILES['archivo']) )
        {
            // application/msword ======> Word 2003,
            // application/vnd.openxmlformats-officedocument.wordprocessingml.document ===========> Word 2007 and 2010
            // application/vnd.ms-excel =======> Excel 2003
            // application/vnd.openxmlformats-officedocument.spreadsheetml.sheet  =========> Excel 2007 and 2010
            // Cargar en un arreglo los formatos de archivos permitidos
            //http://www.lawebdelprogramador.com/foros/PHP/1498400-hola-necesito-descargar-y-ver-documentos-BLOB-desde-una-base-de-datos-sql.html
             
            //$tipos = array("application/pdf","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.ms-word.document.macroEnabled.12");
            $maximo = 9890204000;        
            //if (in_array($_FILES['archivo']['type'],$tipos)) 
            //{ 
                if($_FILES['archivo']['size'] <= $maximo)
                {
                    $archivo = $_FILES["archivo"]["tmp_name"];
                    $tamanio=array();
                    $tamanio = $_FILES["archivo"]["size"];
                    $tipo = $_FILES["archivo"]["type"];
                    $nombre_archivo = $_FILES["archivo"]["name"];
                    /*  */
                        extract($_REQUEST);
                        if ( $archivo != "none" )
                        { 
                           $origen=$_FILES["archivo"]["tmp_name"];
                           $destino = $dir_subida . $_FILES['archivo']['name'];
                            
                            if(move_uploaded_file($origen, $destino))
                            {
                                $name = $dir_subida.$row['cod_proy']."-".$tipo_entrega;
                                $destino;
                                rename ($destino, $name.".".$ext);
                                $data['codigo_entrega']=$row['codigo_semestre']."-".$tipo_entrega;
                                $_FILES["archivo"]["name"]." archivo cargado correctamente.";
                                $codigo = $row['cod_proy']."-".$tipo_entrega;
                                $data['nombre_carga']= $_FILES['archivo']['name'];
                                $data['accion'] = "complemento";
                                $data['ubicacion_archivo']=$dir_subida;
                                $data['tamano']=$tamanio;
                                $data['semestre']=$row['codigo_semestre'];
                             try{
                                    $objarchivo = new archivosproyecto;
                                     $objca = $objarchivo->setData($data);
                                }
                                catch (Exception $Exc){
                                    echo $Exc->getMessage();
                                }
                            }
                            else{
                                echo "error: no es posible registrar el archivo"; 
                                echo '	<meta http-equiv="refresh" content="2; url=../public/index2.php?page=perfil"> ';
                            }
                        }
                        else
                        {
                            echo "No fue posible subir el archivo";
                            // echo '	<meta http-equiv="refresh" content="2; url=../public/index2.php?page=perfil> ';
                        }
                }
                else
                {
                    echo "Tamaño de Archivo demasiado grande";
                    echo '	<meta http-equiv="refresh" content="3; url=../public/index2.php?page=perfil">';
                }               
            /*}
            else
            {
                echo "El formato del archivo no es correcto Solo Word y PDF";
                echo '	<meta http-equiv="refresh" content="3; url=../public/index2.php?page=perfil">';
            }*/
        }
        else 
        { 
            echo "No Ha seleccionado ningún archivo";
        }    

    }

?>