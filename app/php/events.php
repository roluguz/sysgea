<?php
// List of events
include '../include/variables.php';
$con='mysql:host='.$host.';dbname='.$database;
 $json = array(); 

 // Query that retrieves events
 $requete = "SELECT * FROM evenement  where estado = 1 and propietario = 'pub' ORDER BY id";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=bdsisgea', $user, $password);
 } catch(Exception $e) {
  exit('no es posible conectar a la base de datos.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>
