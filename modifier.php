<?php 
require_once 'conn.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    die("Aucun ID trouvé");
}

if(isset($_POST['update'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "UPDATE etudiants 
            SET nom=?, prenom=?, age=?, email=? 
            WHERE id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $age, $email, $id]);
    echo"modification effectue !";
    header("Location: ajoute.php");
    exit();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <fieldset>
<form action="#" method="POST">
Nom:
<input type="text" name="nom"><br><br>
Prenom:
<input type="text" name="prenom"><br><br>
Age:
<input type="text" name="age"><br><br>
Email:
<input type="text" name="email"><br><br>
<button type="submit" name="update" class="mod">Modifier</button>
</form>

    </fieldset>

</body>
</html>