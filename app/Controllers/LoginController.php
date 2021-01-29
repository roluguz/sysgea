<?php
    if($_POST){
        if(isset($_POST['submit']) AND $_POST['submit']=="Login"){
            $usuario=$_POST['usuario'];
            $password=$_POST['password'];
            try{
              //include'../modelos/login.php';              
              include'../modelos/clslogin.php';
              $login = new Login($usuario,$password);
              /* echo "<pre>";
              echo "loginControler"  . "<br>";
              echo "clslogin.php" . "<br>";
              print_r($login);
              echo "</pre>";
              die();*/
                if($login== TRUE){
                    $p="login";                  
                    include('../plantillas/paso.php');
                   //header('Location:public/index2.php');
                }
            }
            catch (Exception $exc){
                echo $exc->getMessage();
            }
        }
    }
?>
