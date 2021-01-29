
<?php
    if($p=="reguser"){
        echo '<h1 align="center"> Espere mientras completamos el registro</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=../vistas/registro_proyecto.php'>";        
    }elseif($p=="reguser1"){
        echo '<h1 align="center"> Espere mientras completamos el registro</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=".$enlace."'>";
	}elseif ($p=="regproy"){
            echo '<h1 align="center"> Has registrado el proyecto. esta en fase de aprobación. <br> espere un momento</h1>';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=../vistas/login.php'>";
            session_destroy();
    }elseif($p=="login"){
        //echo '<h1 align="center">Ha ingresado al sistema; estamos cargando sus datos.</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php'>";
       // header('Location:../public/index2.php');
    }elseif($p=="integrantes"){;
        echo '<h1 align="center">'.$M.'</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=perfil'>";
        header('Location:../public/index2.php');
    }elseif($p=="actproy"){;
        echo '<h1 align="center">Proyecto Actualizado correctamente</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=perfil'>";
        header('Location:../public/index2.php');
    }elseif($p=="regarch"){;
        echo '<h1 align="center">archivo cargado de manera exitosa</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=perfil'>";
        // header('Location:public/index2.php');
    }elseif($p=="regarchi"){;
        echo '<h1 align="center">archivo cargado de manera exitosa</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=listagrupos'>";
        header('Location:../public/index2.php');
    }elseif($p=="reguser2"){;
        echo '<h1 align="center">Se ha registrado y habilitado el acceso al nuevo asesor</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php'>";
        header('Location:../public/index2.php');
    }elseif($p=="relacion"){;
        echo '<h1 align="center">Asesor asignado satisfactoriamente.</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=frm_asig_asesor'>";
        header('Location:../public/index2.php');
    }elseif($p=="estadopy"){;
        echo '<h1 align="center">El proyecto se ha actualizado exitosamente.</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=Activarproyecto'>";
        header('Location:../public/index2.php');
    }elseif($p=="fnal"){;
        echo '<h1 align="center">Acción completada con éxito</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=perfil'>";
        // header('Location:public/index2.php');
    }elseif($p=="valoracion"){;
        echo '<h1 align="center">Acción completada con éxito</h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../public/index2.php?page=calificar'>";
        // header('Location:public/index2.php');
    }elseif($p=="tipodoc"){
        echo '<h1 align="center">'.(isset($t)? $t:'').' </h1>';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=".$enlace."'>"; 
    }else{
        header('Location:../vistas/login.php');
    }
?>