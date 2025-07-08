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
        <label>Ajouter une couleur</label>
        <input type="text" name="colorName">
        <input type="submit" name="submitColor" value="Envoyé couleur dans la BDD">
        <br>
        <label>Ajouter un type de véhicule</label>
        <input type="text" name="typeName">
        <input type="submit" name="submitType" value="Envoyé Type Vehicule dans la BDD">
    </form>

    <?php
    $sqlColor = "SELECT * FROM Couleur";
    $stmtColor = $pdo->prepare($sqlColor);
    $stmtColor->execute();
    $resultsColor = $stmtColor->fetchAll(PDO::FETCH_ASSOC);

    $sqlType = "SELECT * FROM `typevehicule`";
    $stmtType = $pdo->prepare($sqlType);
    $stmtType->execute();
    $resultsType = $stmtType->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <form method="POST">
        <label>Ajouter un véhicule</label>
        <input type="text" name="immatriculation">
        <select name="CouleurVehicule">
            <?php
            foreach ($resultsColor as $key => $value) {
                echo "<option value=\"$value[id_couleur]\">$value[nom_couleur]</option>";
            }
            ?>
        </select>
        <select name="typeVehicule">
            <?php
            foreach ($resultsType as $key => $value) {
                echo "<option value=\"$value[id_type]\">$value[nom_type]</option>";
            }
            ?>
        </select>
        <input type="submit" name="submitVehicule" value="Envoyé Type Vehicule dans la BDD">
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
    
    if(isset($_POST['submitVehicule'])){
        $immatriculation = $_POST['immatriculation'];
        $colorVehicule = $_POST['CouleurVehicule'];
        $typeVehicule = $_POST['typeVehicule'];
        $sql = "INSERT INTO `vehicule`(`Immatriculation`, `Type`, `Couleur`) VALUES ('$immatriculation','$typeVehicule','$colorVehicule')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
    ?>