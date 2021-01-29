drop database if exists bdsisgea0;
create database bdsisgea0;
use bdsisgea0;

CREATE TABLE login (
id_login int(11) NOT NULL,
 usuario varchar(70) NOT NULL,
 correo varchar(200) NOT NULL,
 token text,
 password varchar(250) NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 estado int(11) NOT NULL DEFAULT '0',
perfil int NOT NULL DEFAULT '1'
);

CREATE TABLE perfil (
id_perfil int(11) NOT NULL,
  codigo_perfil varchar(7) NOT NULL,
  nombre_perfil varchar(255) NOT NULL,
  descripcion_perfil text NOT NULL,
  estado_perfil int(11) NOT NULL DEFAULT '1',
 updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE menu (
id_menu int(11) NOT NULL,
 codigo_menu varchar(7) NOT NULL,
 nombre_menu varchar(70) NOT NULL,
 link_menu varchar(200) NOT NULL,
 icono_menu varchar(200) NOT NULL,
 descripcion_menu text NOT NULL,
 updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE menu_perfil (
idm_P int(11) NOT NULL,
  perfil int(11) NOT NULL,
  menu int(11) NOT NULL,
  update_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tblproyecto (
id_proyecto int(11) NOT NULL,
 cod_proy varchar(20) NOT NULL,
 semestre_proyecto varchar(30) NOT NULL,
 nombre_proyecto text NOT NULL,
 tema_proyecto text NOT NULL,
 problema_proyecto text NOT NULL,
 descripcion_proyecto text NOT NULL,
 objetivoG_proyecto text NOT NULL,
 objetivoE_proyecto text NOT NULL,
 justificacion_proyecto text NOT NULL,
 estado_proyecto int(11) DEFAULT '1',
 update_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tblestudiantes (
id_usuario int(11) NOT NULL,
 nombres_usario varchar(100) NOT NULL,
 apellidos_usuario varchar(100) NOT NULL,
  tipo_documento varchar(100) NOT NULL,
 numero_documento int(11) NOT NULL,
 carrera varchar(100) NOT NULL,
 semestre int(11) NOT NULL DEFAULT '1',
 correo_personal varchar(150) NOT NULL,
  numero_telefono bigint(11) NOT NULL,
 update_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  login varchar(70) NOT NULL
);

CREATE TABLE proyecto_estudiante (
id int(11) NOT NULL,
 estudiante int(11) NOT NULL,
 proyecto int(11) NOT NULL,
 update_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE evenement (
id int(11) NOT NULL,
 title varchar(255) NOT NULL,
 start datetime NOT NULL,
 end datetime DEFAULT NULL,
backgroundColor varchar(10) NOT NULL,
 propietario varchar(20) NOT NULL DEFAULT 'pub',
  estado int(11) NOT NULL DEFAULT '1'
);

CREATE TABLE asesoriavirtual (
id int(11) NOT NULL,
 nombre varchar(100) NOT NULL,
 mensaje text NOT NULL,
 proyecto varchar(20)not null,
 create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE calificaciones (
 id_calificacion int(11) NOT NULL,
 semestre varchar(20) NOT NULL,
 valoracion varchar(4) NOT NULL,
 comentarios text not null,
 create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE archivos (
 id_archivo int(11) NOT NULL,
 codigo_entrega varchar(20) NOT NULL,
 nombre_carga varchar(200) not null,
 nombre_archivo varchar(300) not null,
 descripcion_archivo text not null,
 ubicacion_archivo varchar(200) not null,
 extencion varchar(10) not null,
 tamano int(11) not null,
 semestre varchar(20) NOT NULL,
 create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tblsemestrepro (
 id_semestrepro int(11) NOT NULL,
 codigo_semestre varchar(20) NOT NULL,
 asesor int NOT NULL,
 proyecto varchar(20)not null,
 create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tblasesores (
id_asesor int(11) NOT NULL,
nombres_asesor varchar(100) NOT NULL,
apellidos_asesor varchar(100) NOT NULL,
tipo_documento varchar(100) NOT NULL,
numero_documento int(11) NOT NULL,
carrera varchar(100) NOT NULL,
especialidad varchar(110) NOT NULL,
correo_personal varchar(150) NOT NULL,
numero_telefono bigint(11) NOT NULL,
update_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
login varchar(70) NOT NULL
);


ALTER TABLE tblsemestrepro ADD PRIMARY KEY (id_semestrepro),ADD UNIQUE key codigosemesres(codigo_semestre);

ALTER TABLE tblasesores ADD PRIMARY KEY (id_asesor);

ALTER TABLE archivos ADD PRIMARY KEY (id_archivo);

ALTER TABLE calificaciones ADD PRIMARY KEY (id_calificacion);

ALTER TABLE asesoriavirtual ADD PRIMARY KEY (id);

ALTER TABLE perfil ADD PRIMARY KEY (id_perfil);

ALTER TABLE evenement  ADD PRIMARY KEY (id);

ALTER TABLE login ADD PRIMARY KEY (id_login), ADD UNIQUE KEY login_user (usuario), ADD UNIQUE KEY correo_usuario (correo);

ALTER TABLE menu_perfil ADD PRIMARY KEY (idm_p), ADD KEY perfil_menu_idx (perfil), ADD KEY menu_perfil_idx (menu);

ALTER TABLE menu ADD PRIMARY KEY (id_menu);

ALTER TABLE tblproyecto ADD PRIMARY KEY (id_proyecto), ADD UNIQUE KEY codigo_proyecto (cod_proy);

ALTER TABLE tblestudiantes ADD PRIMARY KEY (id_usuario), ADD UNIQUE KEY numero_documento (numero_documento), ADD UNIQUE KEY correo_personal (correo_personal), ADD KEY login_usuario_idx (login);

ALTER TABLE proyecto_estudiante  ADD PRIMARY KEY (id), ADD KEY proyecto_estudiante_idx (proyecto), ADD KEY estudiante_proyecto_idx (estudiante);

ALTER TABLE perfil MODIFY id_perfil int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE calificaciones MODIFY id_calificacion int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tblsemestrepro  MODIFY id_semestrepro int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tblasesores  MODIFY id_asesor int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE archivos  MODIFY id_archivo int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE asesoriavirtual MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE evenement MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE login  MODIFY id_login int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE menu_perfil MODIFY idm_P int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE menu MODIFY id_menu int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE proyecto_estudiante MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tblproyecto MODIFY id_proyecto int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tblestudiantes MODIFY id_usuario int(11) NOT NULL AUTO_INCREMENT;

-- ---CLAVES FORANEAS---

ALTER TABLE calificaciones ADD CONSTRAINT calificacion_semestre FOREIGN KEY (semestre) REFERENCES tblsemestrepro (codigo_semestre) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE tblsemestrepro ADD CONSTRAINT semestre_proyecto FOREIGN KEY (proyecto) REFERENCES tblproyecto (cod_proy) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE tblsemestrepro ADD CONSTRAINT semestre_asesor FOREIGN KEY (asesor) REFERENCES tblasesores (id_asesor) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE archivos ADD CONSTRAINT archivo_semestre FOREIGN KEY (semestre) REFERENCES tblsemestrepro (codigo_semestre) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE menu_perfil ADD CONSTRAINT login_perfil FOREIGN KEY (perfil) REFERENCES perfil (id_perfil) ON DELETE CASCADE ON UPDATE CASCADE, 
ADD CONSTRAINT perfil_menu FOREIGN KEY (menu) REFERENCES menu (id_menu) ON DELETE CASCADE ON UPDATE CASCADE;

-- ALTER TABLE tblusuarios ADD CONSTRAINT login_usuario FOREIGN KEY (login) REFERENCES login (usuario) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE proyecto_estudiante
  ADD CONSTRAINT proyecto_estudiante FOREIGN KEY (estudiante) REFERENCES tblestudiantes (id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT estudiante_proyecto FOREIGN KEY (proyecto) REFERENCES tblproyecto (id_proyecto) ON DELETE CASCADE ON UPDATE CASCADE;




-- --INSERTAR DATOS ---
INSERT INTO perfil (id_perfil, codigo_perfil, nombre_perfil, descripcion_perfil, estado_perfil) VALUES
(1, 'PREST', 'Estudiante', 'Perfil asiganado a estudiantes, perfil estandar de la base de datos', 1),
(2, 'PRASES','ASESORES', 'Perfil asignado a los asesores deproyectos integrdores', '1'),
(3, 'PRAdAMIN','aDMINISTRADOR', 'Perfil asignado a los administradores del sistema', '1');




-- -vistas
CREATE VIEW vs_estudianteproyecto AS SELECT tblestudiantes.nombres_usario, tblestudiantes.apellidos_usuario, tblestudiantes.carrera, tblestudiantes.semestre, tblproyecto.cod_proy, tblestudiantes.login
FROM tblestudiantes INNER JOIN (tblproyecto INNER JOIN proyecto_estudiante ON tblproyecto.id_proyecto = proyecto_estudiante.proyecto) ON tblestudiantes.id_usuario = proyecto_estudiante.estudiante;

CREATE VIEW c AS SELECT tblsemestrepro.estado, proyecto_estudiante.proyecto, proyecto_estudiante.estudiante, tblestudiantes.id_usuario, tblproyecto.id_proyecto, tblsemestrepro.codigo_semestre
FROM (tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto) INNER JOIN (tblestudiantes INNER JOIN proyecto_estudiante ON tblestudiantes.id_usuario = proyecto_estudiante.estudiante) ON tblproyecto.id_proyecto = proyecto_estudiante.proyecto
WHERE (((tblsemestrepro.estado)="en curso"));



SELECT tblproyecto.cod_proy, tblusuarios.nombres_usario, tblusuarios.apellidos_usuario, tblusuarios.carrera, tblusuarios.semestre, login.usuario, perfil.codigo_perfil
FROM ((tblusuarios INNER JOIN (tblproyecto INNER JOIN proyecto_estudiante ON tblproyecto.id_proyecto = proyecto_estudiante.proyecto) ON tblusuarios.id_usuario = proyecto_estudiante.estudiante) 
INNER JOIN login ON tblusuarios.id_usuario = login.usuario) INNER JOIN (perfil INNER JOIN login_perfil ON perfil.id_perfil = login_perfil.perfil) ON login.id_login = login_perfil.login;


SELECT tblproyecto.cod_proy, tblproyecto.semestre_proyecto, tblproyecto.nombre_proyecto, tblsemestrepro.codigo_semestre, archivos.extencion, archivos.ubicacion_archivo, archivos.nombre_archivo
FROM (tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto) INNER JOIN archivos ON tblsemestrepro.codigo_semestre = archivos.semestre
WHERE (((tblproyecto.cod_proy)="Sis2017211"));


SELECT tblsemestrepro.id_semestrepro, tblsemestrepro.estado, proyecto_estudiante.proyecto, proyecto_estudiante.estudiante, tblestudiantes.id_usuario, tblproyecto.id_proyecto
FROM (tblproyecto INNER JOIN tblsemestrepro ON tblproyecto.cod_proy = tblsemestrepro.proyecto) INNER JOIN (tblestudiantes INNER JOIN proyecto_estudiante ON tblestudiantes.id_usuario = proyecto_estudiante.estudiante) ON tblproyecto.id_proyecto = proyecto_estudiante.proyecto;




