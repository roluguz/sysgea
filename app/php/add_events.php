<?php
// Values received via ajax
$title = "ttt".$_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// connection to the database
try {
$bdd = new PDO('mysql:host=localhost;dbname=bdsisgea', 'sisgea', 'S15G34-u');
} catch(Exception $e) {
exit('no es posible conetar con la base de datos.');
}

// insert the records
$sql = "INSERT    INTO evenement (title, start, end) VALUES (:title, :start, :end )";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));
?>
>