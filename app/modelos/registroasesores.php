<?php


class registroasesores {
    private $accion;
    private $usuario;
    private $correo;
    private $token;
    private $password;
    private $nombre_usuario;
    private $apellido_usuario;
    private $t_documento_usuario;
    private $documento_usuario;
    private $carrera;
    private $especialidad;
    private $correo_usuario;
    private $Telefono_usuario;
    
    function __construct($data){
        if(is_array($data)){
           // $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        //$this->connectToDb();
       /* if ($data['accion']=="registro"){
            $this->pregistrousuario();
        }*/       
    }
    
     function setData($data){
        $this->accion   = $data['accion'];
        $this->usuario  = $data['usuario'];
        $this->correo   = $data['correo'];
        $this->token    = $data['token'];
        $this->password = $data['password'];
        $this->nombre_usuario = $data['nombre_usuario'];
        $this->apellido_usuario = $data['apellido_usuario'];
        $this->t_documento_usuario = $data['t_documento_usuario'];
        $this->documento_usuario = $data['documento_usuario'];
        $this->carrera  = $data['carrera'];
        $this->especialidad = $data['especialidad'];
        $this->correo_usuario = $data['correo_usuario'];
        $this->Telefono_usuario = $data['Telefono_usuario'];
             
    }

    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }

    //esta funcion realiza el preregistro de los usuarios en la paltaforma y gestiona el envio de correo de validacion
    function pregistrousuario(){
        include("../include/conectar.php");    
        $query ="Insert Into login(usuario, correo, token, password, estado, perfil)";
        $query.=" values('$this->usuario','$this->correo','$this->token','$this->password',1, 2);";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);        
        if($sql){
            $this->cregistrousuario(); 
        } 
        else
            throw new Exception ("Error: No es posible registrar");
    }    
    //esta funcion completa el registro del usuario en la plataforma y actualiza el estado a "activo"
    function cregistrousuario(){
        include("../include/conectar.php");       
        $query1  ="Insert Into tblasesores(nombres_asesor, apellidos_asesor, tipo_documento,";
        $query1 .="numero_documento, carrera, especialidad, correo_personal, numero_telefono, login)";
        $query1 .=" Values('$this->nombre_usuario',      '$this->apellido_usuario',
                           '$this->t_documento_usuario', '$this->documento_usuario',
                           '$this->carrera'            , '$this->especialidad',
                           '$this->correo_usuario'     , '$this->Telefono_usuario',
                           '$this->usuario');";                         
        $sql = mysqli_query($conection, $query1);        
        mysqli_close($conection);
        if($sql) {
            $p ="reguser2";
            /* echo "<pre>";
            echo "resgistroasesores, linea-95"."<br>";
            print_r($query1);
            echo "REQUEST"."<br>";
            print_r($_REQUEST);
            echo "</pre>";
            die(); */
            include('../plantillas/paso.php');
             //echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=http://www.desarrolloweb.com'>"   
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
        $cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
        //mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
        }
}

?>