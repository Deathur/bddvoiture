<?php
$host = 'localhost';
$dbname = 'voiture';
$user = 'root';
$password = '';

//Connexion BDD
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Active les erreurs PDO en exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Connexion réussi !');</script>";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="colorName">
        <input type="submit" name="submitColor" value="Envoyé couleur dans la BDD">
        <br>
        <input type="text" name="typeName">
        <input type="submit" name="submitType" value="Envoyé Type Vehicule dans la BDD">
    </form>
</body>
</html>
    <?php

//Exploitation
    //Requête SQL
    if(isset($_POST['submitColor'])){
        $color = $_POST['colorName'];
        $sql = "INSERT INTO `Couleur`(`nom_couleur`) VALUES ('$color')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "data couleur envoyées en bdd";
    }  
    if(isset($_POST['submitType'])){
        $type = $_POST['typeName'];
        $sql = "INSERT INTO `typevehicule`(`nom_type`) VALUES ('$type')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "data type vehicule envoyées en bdd";
    }  
    ?>