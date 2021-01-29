<?php


class menu {
    private $usuario;
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
            $this->usuario= $data['usuario'];
            //$this->connectToDb();
            $sw_Ok=$this->getData();
        }
        return $sw_Ok;
    }
    private function connectToDb(){
        include 'database.php';
        $vars= '../include/variables.php';
        new database($vars);
    }
    
    function getData(){
      include("../include/conectar.php");
       $query="SELECT menu.nombre_menu, menu.link_menu, menu.icono_menu, login.usuario
                FROM (perfil INNER JOIN (menu INNER JOIN menu_perfil ON menu.id_menu = menu_perfil.menu) 
                    ON perfil.id_perfil = menu_perfil.perfil) INNER JOIN login ON perfil.id_perfil = login.perfil
                WHERE (((login.usuario)='$this->usuario'));";        
        $sql = mysqli_query($conection, $query);
        mysqli_close($conection);

        //$sql = mysqli_query($query);
        if(mysqli_num_rows($sql)>0){
/*            echo "<pre>";
            echo "tipo sql->".gettype($sql)."<br>";
            echo "orden....->>".$query . "<br>";
            echo "menu.php, linea-48"."<br>";
            //print_r($sql);
            echo "</pre>";
            //die();

                SELECT menu.nombre_menu, menu.link_menu, menu.icono_menu, login.usuario
                FROM (perfil INNER JOIN (menu INNER JOIN menu_perfil ON menu.id_menu = menu_perfil.menu) 
                    ON perfil.id_perfil = menu_perfil.perfil) INNER JOIN login ON perfil.id_perfil = login.perfil
                WHERE (((login.usuario)='admincua'));
*/
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