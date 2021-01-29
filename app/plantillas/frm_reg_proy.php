<?php 


if (!isset($_SESSION['proyecto'])){
}else{
  $data['accion'] = 'consultar';
  $data['proyecto'] = $_SESSION['proyecto']; 
  $objpr = "";
  try{
    include '../modelos/perfil.php';
    $objperfil = new perfil;
    $objpr = $objperfil->setData($data);   
    $row = mysqli_fetch_assoc($objpr);
    }
    catch (Exception $Exc){
      echo $Exc->getMessage();
    }
    
}
?>
<p class="login-box-msg"><h2 align="center">Pre-registro de Proyecto</h2></p>   
    <form action="../Controllers/registroproyectoController.php" method="post">        
      <div class="form-group has-feedback">
           <!-- <div class="radio"><center>
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                Proyecto Nuevo
              </label>
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Buscar proyecto
              </label></center>
            </div>-->
      </div>
      <div class="form-group has-feedback"><?php  if(isset($_SESSION['perfil'])){}else {session_start();} ?>
        <input type=hidden class="form-control" placeholder="Código de Proyecto" id="Id_proyecto" name="Id_proyecto" value=<?php if(!isset($_SESSION['proyecto'])){ }else {echo $_SESSION['proyecto'];} ?>> 
       <!-- <span class="glyphicon glyphicon-log-in form-control-feedback"></span-->
      </div>
      <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Numero de Documento" id="Docuemnto" name="docuemnto" readonly value=<?php if(!isset($_SESSION['usuario'])){}else{echo $_SESSION['usuario'];} ?> >  
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Numero de Documento" id="semestre" name="semestre" readonly value="Primero" >  
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea class="form-control" rows="3" placeholder="Nombre del proyecto" id="nombre_proyecto" name="nombre_proyecto" required <?php if(!isset($row['nombre_proyecto'])){echo "/>";}else{echo "readonly/>"; echo$row['nombre_proyecto'];} ?></textarea>
        <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea class="form-control" rows="3" placeholder="Tema del proyecto" id="tema_proyecto" name="tema_proyecto" required/><?php if(!isset($row['tema_proyecto'])){}else{echo $row['tema_proyecto'];}?></textarea>
        <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <textarea class="form-control" rows="5" placeholder="Problema a resolver" id="Descripcion_proyecto" name="Problema_proyecto" required/><?php if(!isset($row['problema_proyecto'])){}else{echo $row['problema_proyecto'];} ?></textarea>
          <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <textarea class="form-control" rows="5" placeholder="Descripción de proyecto " id="Descripcion_proyecto" name="Descripcion_proyecto" required/><?php if(!isset($row['descripcion_proyecto'])){}else{echo $row['descripcion_proyecto'];} ?></textarea>
          <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea class="form-control" rows="3" placeholder="Objetivo general" id="nombre_proyecto" name="ObjetivoG_proyecto" required><?php if(!isset($row['objetivoG_proyecto'])){}else{echo $row['objetivoG_proyecto'];} ?></textarea>
        <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <textarea class="form-control" rows="5" placeholder="Objetivos específicos (máximo 3, separados por '#')" id="Descripcion_proyecto" name="ObjetivoE_proyecto" required/><?php if(!isset($row['objetivoE_proyecto'])){}else{echo$row['objetivoE_proyecto'];} ?></textarea>
          <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <textarea class="form-control" rows="5" placeholder="Justificación" id="Descripcion_proyecto" name="justificacion_proyecto" required/><?php if(!isset($row['justificacion_proyecto'])){}else{echo $row['justificacion_proyecto'];} ?></textarea>
          <span class="glyphicon  form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-12">  <?php if(!isset($_SESSION['proyecto'])){ ?>
            <div class="col-xs-4">
              <button type="submit" name ="submit" class="btn btn-primary btn-block btn-flat"value ="crea_proyecto">Crear Proyecto</button>
            </div>
          
              <div class="col-xs-4">
              <?php if(isset($_SESSION['perfil'])){ ?>
				      <a href="../public/index2.php?page=perfil">
              <?php }else{echo '<a href="../vistas/login.php">';} ?>
				  <span class="btn btn-success btn-block btn-flat"> Definir mas tarde</span></a>
              </div><?php
            }else { ?>
            <div class="col-xs-4">
              <button type="submit" name ="submit" class="btn btn-primary btn-block btn-flat"value ="act_proyecto">Actualizar Proyecto</button>
            </div><?php
            }
            ?>
        </div>
        <!-- /.col -->
      </div>
    </form>
    