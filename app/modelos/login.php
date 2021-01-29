<?php


class login {
    private $username;
    private $password;
    private $cnx;    
    function __construct($username,$password){
        $this->setData($username,$password);
        $link= $this->connectToDb();
        
        echo "<pre>";
        echo "link->".gettype($link)."<br>";
        echo "login.php"."<br>";
        echo $this->cnx."<br>";
        echo "</pre>";
        die();
        
        $this->getData($this->cnx); 
    }

    function setData($username,$password){
        $this->username=$username;
        $this->password=sha1($password);
    }
    private function connectToDb(){
        //include 'database.php';
        $vars= '../include/variables.php';
        include_once $vars;
        //$obj = new database($vars);   
        
        return mysqli_connect($host, $user, $password, $database);
        //echo $link;
        //die();
        //$this->cnx = $obj->conexion();
        
    }
    
    function getData(){
      include("../include/conectar.php");   
      try { 
        $query="SELECT perfil.codigo_perfil, login.id_login, login.usuario, login.correo, login.token, login.password, login.estado, login.updated_at, login.perfil
                FROM perfil INNER JOIN login ON perfil.id_perfil = login.perfil
                WHERE login.usuario='$this->username' AND login.password ='$this->password'AND login.estado=1";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);        
        $row1 =mysqli_fetch_array($sql);        
        echo "<pre>";
        print_r($query)."<br>";
        print_r($sql)."<br>";
        print_r($row1)."<br>";        
        echo "</pre>";
        die();      
        
        if(mysqli_num_rows($sql)>0){
            $tipo =$row1['codigo_perfil'];
            switch($tipo){
              case "PREST":
                $query="select * from vs_sessionest where login ='$this->username';";
                $query2="select * from tblestudiantes where login ='$this->username';";        
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    $row =mysqli_fetch_array($sql);
                    $this->session($row);
                }
                else
                {
                  $sql = mysqli_query($conection, $query2);
                  mysqli_close($conection);
                  if(mysqli_num_rows($sql)>0){
                      $row =mysqli_fetch_array($sql);
                      $this->session($row);
                  }
                }
                break;
              case "PRASES":
                $query="select * from tblasesores where login ='$this->username';";
                $sql = mysqli_query($conection, $query);
                mysqli_close($conection);
                if(mysqli_num_rows($sql)>0){
                    $row =mysqli_fetch_array($sql);
                    $this->sessionb($row);
                }
                break;
              case "PRADMIN":
                session_start();
                //$_SESSION['']=$row[''];
                $_SESSION['usuario']=$row1['usuario'];
                $_SESSION['nombres_usario']='Administrador';
                $_SESSION['apellidos_usuario']='de Sistema';
                $_SESSION['carrera']='Soporte Local';
                $_SESSION['perfil']="PRADMIN";
                break;
            }
            return TRUE;
        }
        else{
            throw new Exception("Ususario o contraseña incorrectos intente nuevamente");
        }
		  }
      catch (Exception $exc){
        echo $exc->getMessage();
      }
    }

    function session($row){
        session_start();
       //$_SESSION['']=$row[''];
       $_SESSION['usuario']=$row['login'];
       $_SESSION['nombres_usario']=$row['nombres_usario'];
       $_SESSION['apellidos_usuario']=$row['apellidos_usuario'];
       $_SESSION['carrera']=$row['carrera'];
       $_SESSION['semestre']=$row['semestre'];
      if(!isset($row['cod_proy'])){}else{$_SESSION['proyecto']=$row['cod_proy'];};
       $_SESSION['perfil']="PREST";
    }
    function sessionb($row){
        session_start();
       //$_SESSION['']=$row[''];
       $_SESSION['usuario']=$row['login'];
       $_SESSION['nombres_usario']=$row['nombres_asesor'];
       $_SESSION['apellidos_usuario']=$row['apellidos_asesor'];
       $_SESSION['carrera']=$row['carrera'];
       $_SESSION['semestre']=$row['especialidad'];
       $_SESSION['perfil']="PRASES";
    }
    function close(){
        $this->cnx->close();
    }
}

?>


