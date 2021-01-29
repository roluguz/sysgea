<?php
include '../include/variables.php';
try
{
	$bdd = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8', $user, $password);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
