<?php 
require_once'conn.php';
if(isset($_GET['id'])){
    $num_etu=$_GET['id'];
    $sql="DELETE from etudiants where id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$num_etu]);
    echo" etudiant suprimmer avec succes !";
    header("Location:ajoute.php");
    exit();
}else{
     echo"Aucun ID trouvé";
}

?>