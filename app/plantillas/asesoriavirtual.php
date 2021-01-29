<?php
include "db.php";
?>
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Asesorias Virtuales</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
            </div>
          <div class="col-md-8">       
            <p class="login-box-msg">Chat de asesorias</p>
            <form id="formChat" role="form" method="POST" action="../Controllers/ChasesoriasController.php">
               <div class="form-group">
                  <?php if($_SESSION['perfil']=='PRASES'){
                    echo '<label for="nombre_archivo">Nombre de Proyecto</label>';
                     $objlsar = "";
                      try{
                        include '../modelos/consulta.php';
                        $objconsulta = new consulta;
                        $data['accion'] = 'listaproyectos';
                        $data['codigo']=$_SESSION['usuario'];
                        $objlsgr = $objconsulta->setData($data);
                      }
                        catch (Exception $Exc){
                        echo $Exc->getMessage();
                      }
                      echo '<select class="form-control select2" style="width: 100%;"id="proyecto"  name="proyecto" required>';
                      $i=1;
                      while($row = mysqli_fetch_assoc($objlsgr)){ 
                        echo "<option value='".$row['cod_proy'] ."'>".$row['nombre_proyecto'] ."</option>";
                      }
                      echo "</select>";
                  }else {
                    echo '<label for="nombre_archivo">Código de Proyecto</label>';
                    echo '<input type="text" class="form-control" id="proyecto" name="proyecto" readonly value="'. $_SESSION['proyecto'].'" >';
                  }
                  ?>
                </div>
              <div class="form-group has-feedback">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $_SESSION['usuario']; ?>" readonly>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
              <div id="chat" style="height:250px; border: 1px solid #CCCCCC; padding: 12px;  border-radius: 5px; overflow-x: hidden;">                    
                <span class="glyphicon  form-control-feedback"></span>      
              </div>
              <div class="form-group has-feedback">
              </div>
                <div class="form-group has-feedback">
                  <label for="message">Mensaje</label>
                  <textarea id="mensaje" name="mensaje" placeholder="Enter Message"  class="form-control" rows="3"></textarea>
                </div>
              <div class="row">
                <div class="col-xs-8">
                </div>
      
                <div class="col-xs-12">
                  <div class="col-xs-4">
                    <button id="enviar" class="btn btn-primary" name="enviar" >Enviar</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
            <div class="col-md-2">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

      <script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
      var proy = document.getElementById('proyecto').value;

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', '../php/chat.php?code=' + proy, true);
      //req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
   