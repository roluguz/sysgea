<?php                  
  include('../plantillas/head.php');    
  include('../plantillas/h1.php');
?> 
  <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">  
        <?php        
				/*echo "<pre>";
          echo "---INDEX2-LINEA-12----"."<br>";
          //echo "se cumple. p->".$p."<br>";
          echo "REQUEST->"."<br>";
          print_r($_REQUEST)."<br>";
          echo "SESSION"."<br>";
          print_r($_SESSION)."<br>";        
          echo "</pre>";
          die();   */        
        if(isset($_GET['page'])){          
          $url= "../plantillas/".$_GET['page'].".php";          
          if(is_file($url)){
            include $url;
          }
          else{
            echo "no se ha encontrado el archivo";
          }
        }else { 

          echo "<br><br>"; 
          echo "<h1>Pagina de inicio </h1>";
          echo '<img src="../imgpublicas/imginicial.jpg" class="img-circle" alt="User Image">';
          // implementar que traer al inicio

        }      

        ?>
    </section>
  </div>
  <?php
  if(isset($_GET['page'])){
    if($_GET['page']=="calendario2"){
      include('../plantillas/foot1.php');
    }else
      include('../plantillas/foot.php'); 
  }
?>