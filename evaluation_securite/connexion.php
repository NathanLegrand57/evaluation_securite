<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <title>Connexion</title>
</head>
<body>
<form action="connecte.php" method="post">
<?php
include("header.php");
?>


    <div class="container1">
        <h1>Connexion</h1>
        <div class="container2">
            <label id="lab_email" for="email">Adresse mail</label>
            <input placeholder="Adresse mail" id="email" type="text" name="email">

            <div class="mdp">
                <label id="lab_mdp" for="mdp">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe" id="mdp" name="mdp">
            </div>
            <input type="submit" name="envoyer">
        </div>
    </div>

 <?php
    if(isset($_POST['envoyer'])) {
        die(strlen(password_hash($_POST['mdp'])));
    $dbname = "role_user";
    $dbuser = "root";
    $dbip = "localhost";

    $bdd = new PDO("mysql:host=".$dbip.";dbname=".$dbname.";charset=utf8",$dbuser);

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $sql = $bdd->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $sql->execute(array($email));
    $result = $sql->fetch();

    if($result && password_verify($mdp, $result['mdp'])) {
        echo "Vous êtes connecté !";
    } else {
        echo "Email ou mot de passe incorrect";
    }
    }
?>
</form>
</body>
</html>