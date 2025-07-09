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
    <hr>
    <a ></a>
        <?php
        $sql = "SELECT * FROM vehicule";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultsAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultsAll as $key => $value) {
            $idASupprimer = $value['id_vehicule'];
            echo "<form method='POST'>";
            echo "<input type=\"hidden\" name=\"idDelete\" value='$idASupprimer'><br>";
            foreach ($value as $key2 => $value2) {
                echo $value2 . " ";
            }
            echo '<a href="index.php?id=' . $idASupprimer . '">Modifier</a>';
            echo "<input type=\"submit\" name=\"submitDelete\" value=\"supprimer\"><br>";
            echo "</form>";
        }
        if(isset($_POST['submitDelete'])){
            $idToDelete = $_POST['idDelete'];
            $sqlDelete = "DELETE FROM `vehicule` WHERE id_vehicule = '$idToDelete'";
            $stmt = $pdo->prepare($sqlDelete);
            $stmt->execute();
        }
        ?>
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
    <hr>
    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sqlId = "SELECT * FROM Vehicule WHERE id_vehicule = '$id'";

            $stmtId = $pdo->prepare($sqlId);
            $stmtId->execute();
            
            $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);
            
            echo '<form method="POST">
            <label for="">ID</label>
            <input type="text" name="idUpdate" value="' . $resultsId[0]['id_vehicule'] . '">
            <br>
            <label for="">Immatriculation</label>
            <input type="text" name="immatriculationUpdate" value="' . $resultsId[0]['Immatriculation'] . '">
            <br>
            <label for="">Type de véhicule</label>
            <input type="text" name="typeUpdate" value="' . $resultsId[0]['Type'] . '">
            <br>
            <label for="">Couleur</label>
            <input type="text" name="couleurUpdate" value="' . $resultsId[0]['Couleur'] . '">
            <br>
            <input type="submit" name="submitUpdate" Value="Mettre à jour la BDD">
            </form>';
        }
        if (isset($_POST['submitUpdate'])){

            $idUpdate = $_POST['idUpdate'];
            $immatriculationUpdate = $_POST['immatriculationUpdate'];
            $typeUpdate = $_POST['typeUpdate'];
            $couleurUpdate = $_POST['couleurUpdate'];
            
            $sqlUpdate = "UPDATE `vehicule` SET `Immatriculation`='$immatriculationUpdate',`Type`='$typeUpdate',`Couleur`='$couleurUpdate' WHERE `id_vehicule` = '$idUpdate'";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute();
        }
    ?>