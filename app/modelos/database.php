<?php

class database{
    private $host;
    private $user;
    private $password;
    private $database;
 
    function __construct($filename){      
        if(is_file($filename))
        include $filename;
        else throw new Exception ("Error! no se encuentra el archivo. ");
        
        $this->host =$host;
        $this->user =$user;
        $this->password =$password;
        $this->database =$database;               
        //$this->conexion();
        //$this->open();
    }

     function conexion(){
      
       
    //    $link = false;
       
        $elink = mysqli_connect($this->host, $this->user, $this->password, $this->database);
       
        echo "<pre>";
        echo "link->".$elink."<br>";
        echo "gettype->".gettype($elink)."<br>";       
        echo "this->host->".$this->host."<br>";
        echo "this->user->".$this->user."<br>";           
        echo "this->password->".$this->password."<br>";      
        echo "this->database->".$this->database."<br>";  
        
        echo "database.php"."<br>";
        echo "</pre>";
        die();       
        
        
        
        return $elink;
        //conexion al servidor        

        /*if(!mysqli_connect($this->host, $this->user, $this->password, $this->database))
            throw new Exception("Error: no es posible conectar al aservidor");        */
        //conexion a la base de datos
        /*
        echo "<pre>";
        echo "database.php"."<br>";
        print_r($this->database);
        echo "</pre>";
        */
      /*    die();    */ 
        //$db = mysqli_select_db( $link,  $this->database);
        
/*        if(!mysqli_select_db($link, $this->database ))
            throw new Exception("Error: no es posible conectar la base de datos"); 
  */        
    }

    function close(){
        mysqli_close();
    }
	function open(){
		$this->conexion();
	}
}
?>