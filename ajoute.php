<?php
require_once 'conn.php';
if(
    isset($_POST['ajoute']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['age']) &&
    !empty($_POST['mail'])
)
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $email = $_POST['mail'];

    $sql = "INSERT INTO etudiants(nom,prenom,age,email)
            VALUES(?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom,$prenom,$age,$email]);

    echo "<p>Etudiant ajouté avec succès</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des étudiants</title>
  <link rel="stylesheet" href="design.css">
</head>
<body>

<fieldset>
<legend>Ajouter un étudiant</legend>

<form method="POST">

    Nom :
    <input type="text" name="nom">
    <br><br><br>

    Prenom :
    <input type="text" name="prenom">
    <br><br><br>

    Age :
    <input type="number" name="age">
    <br><br><br>

    Email :
    <input type="email" name="mail">
    <br><br><br>

    <button type="submit" name="ajoute" class="ajoute">
        Envoyer
    </button>

    <a href="ajoute.php?show=1&page=1" class="btn">
        Afficher les étudiants
</a><br><br>

</form>
</fieldset>

<br><br>

<?php
require_once 'conn.php';
$show = isset($_GET['show']) ? $_GET['show'] : 0;
if($show == 1){
    $limit = 2;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM etudiants LIMIT $limit OFFSET $offset";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>

<table border="1" >

    <tr class="nom">
        <th class="id">ID</th>
        <th class="nom">Nom</th>
        <th>Prenom</th>
        <th>Age</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>

    <tr >
        <td class="prenom"><?=$row['id'];?></td>
        <td><?=$row['nom'];?></td>
        <td><?=$row['prenom'];?></td>
        <td><?=$row['age'];?></td>
        <td><?=$row['email'];?></td>
        <td>
             <a href="modifier.php?id=<?=$row['id'];?> "class="mod">Modifier</a>
            <a href="suprimmer.php?id=<?=$row['id'];?>"class="sup">Supprimer</a>
        </td>
    </tr>

    <?php } ?>

</table>


<?php
$total ="SELECT count(*) as total_etudiant from etudiants ";
$res=$pdo->prepare($total);
$res->execute();
$data=$res->fetch(PDO::FETCH_ASSOC);
$total_etudiant=$data['total_etudiant'];
$total_page = ceil($total_etudiant/$limit);

for($i = 1; $i <= $total_page; $i++){
    if($i == $page){
    echo "<b class='pag'>$i</b> ";
} else {
    echo "<a href='ajoute.php?show=1&page=$i' class='pagi'>$i</a> ";
}
}
}
?>
</div>
</body>
</html>