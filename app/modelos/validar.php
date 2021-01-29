<?php


class validar {
    private $usuario;
    private $token;
    private $accion;
    private $cnx;
    private $resultado;
    
    function __construct(){
        /*if(is_array($data)){
            $this->setData($data);
        }
        else{
            throw new Exception("Error: no se encuentra informacion");
        }
        $this->connectToDb();
        $this->getData(); */
    }

    function setData($data){
        $swOk="";
        if($data['accion']=='com_registro'){
          $this->usuario= $data['usuario'];
            $this->token= $data['token'];
            //$this->connectToDb();
            $swOk=$this->getData();
        }
        return $swOk;
    }
    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    
    function getData(){
        include("../include/conectar.php"); 
        $query="SELECT * FROM Login WHERE token ='$this->token'";
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if(mysqli_num_rows($sql)>0){
           return $sql;
          // $resultado=mysql_fetch_array($sql);
          //  echo $sql['usuario'];
        }
        else{
            throw new Exception("El enlace proporcionado no es valido para completar el registro.");
            //return '';
        }
    }

    function close(){
        $this->cnx->close();
    }
}

?>