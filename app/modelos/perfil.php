<?php


class perfil {
    private $proyecto;
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
        $sw_Ok="";
        if($data['accion']=='consultar'){
            $this->proyecto= $data['proyecto'];
            /*
            if ($this->proyecto<>"")
                $this->connectToDb();
            else {
                $this->connectToDbx();
            }*/
            $sw_Ok=$this->getData();
        }
        return $sw_Ok;
    }
    private function connectToDb(){
        //include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    private function connectToDbx(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    function getData(){
        include("../include/conectar.php");
        $query=" SELECT * FROM tblproyecto WHERE cod_proy  = '$this->proyecto'";        
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);
        if(mysqli_num_rows($sql)>0){
            return $sql;
        }
        else{
            throw new Exception("");
            //return '';
        }
    }
    function close(){
        $this->cnx->close();
    }
}

?>