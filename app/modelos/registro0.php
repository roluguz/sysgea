<?php


class registro {
    private $usuario;
    private $correo;
    private $password;
    private $accion;
    private $token;
    private $cnx;
    private $nombres_usuario;
    private $apellidos_usuario; 
    private $tipo_documento;
    private $numero_documento;
    private $semestre;
    private $carrera;
    private $numero_telefono; 
    
    function __construct($data){
        if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        //$this->connectToDb();
        if ($data['accion']=="p.registro"){
            $this->pregistrousuario();
        }elseif($data['accion']=="c.registro"){
            $this->cregistrousuario();
        }       
    }
    
    private function setData($data){
        if("c.registro"             ==$data['accion']){
            $this->nombres_usuario  = $data['nombre_usuario'];
            $this->apellidos_usuario= $data['apellido_usuario'];
            $this->tipo_documento   = $data['t_documento_usuario'];
            $this->numero_documento = $data['documento_usuario'];
            $this->carrera          = $data['carrera'];
            $this->correo_personal  = $data['correo_usuario'];
            $this->numero_telefono  = $data['Telefono_usuario'];
            $this->usuario          = $data['usuario'];
        }elseif("p.registro"==$data['accion']){
           $this->usuario = $data['usuario'];
           $this->correo  = $data['correo'];
           $this->token   = $data['token'];
           $this->password= $data['password'];
        } 
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function pregistrousuario(){
        include("../include/conectar.php");    
        $query ="Insert into login (usuario, correo, token, password, estado) 
            values ('$this->usuario','$this->correo','$this->token','$this->password',0);";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);            
        if($sql){
            $enlace ='../vistas/completar_registro.php?idusuario='.sha1($this->usuario).'&token='.$this->token;
            $this->enviarEmail($enlace);
            $p ="reguser1";    
                /*echo "<pre>";
                echo "Data->"."<br>";
                print_r($data)."<br>";
                echo "Sesiones->"."<br>";
                print_r($_SESSION)."<br>";
                echo "Request->"."<br>";
                print_r($_REQUEST)."<br>";
                echo "</pre>";
                die();*/
            include('../plantillas/paso.php');        } 
        else
            echo'<h1 align="center"> No es posible registrar el usuario</h1>';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../vistas/login.php'>";            
    }    
    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
    function cregistrousuario(){
        include("../include/conectar.php");
         $query1 ="Insert Into tblestudiantes (nombres_usario, apellidos_usuario, tipo_documento, numero_documento, carrera, correo_personal, numero_telefono,login) 
         Value ('$this->nombres_usuario', '$this->apellidos_usuario',
                '$this->tipo_documento',  '$this->numero_documento',
                '$this->carrera',         '$this->correo_personal',
                '$this->numero_telefono', '$this->usuario');";		
        $sql = mysqli_query($conection, $query1);
        mysqli_close($conection);     
        if($sql) {
            $query2 ="Update login SET estado = '1' WHERE login.usuario = '$this->usuario'; ";
            $sql = mysqli_query($conection, $query2);
            mysqli_close($conection);  
            if($sql){
                session_start();
                $_SESSION['usuario']=$this->usuario;
                $_SESSION['carrera']=$this->carrera;
                $p ="reguser";
                include('../plantillas/paso.php');
            } 
        }
        else
            throw new Exception ("Error: No es posible registrar");        
    }

    function close(){
        $this->cnx->close();
    }


    function enviarEmail($link){
        $mensaje = '<html>
        <head>
            <title>Completar registro</title>
        </head>
        <body>
            <p>Hemos recibido una petición para el ingreso a la plataforma de proyectos.</p>
            <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
            <p>
            <strong>Enlace para completar registro</strong><br>
            <a href="'.$link.'"> Completar registro </a>
            </p>
        </body>
        </html>';        
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: roluguz@gmail.com' . "\r\n";
        if (mail($this->correo, "Recuperar contraseña", $mensaje, $cabeceras) ) {
            echo "<script>alert('Funcion \"mail()\" ejecutada, por favor verifique su bandeja de correo.');</script>";
        }else{
    		  echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
        }

        
    }
}



?>