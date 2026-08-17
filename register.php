<?php
session_start();


require_once 'php/Database.php';

$db = new Database();


$passwordError = false;
$userError = false;


if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];







    if ($password !== $confirmPassword) {
        $passwordError = true;
    } else {

        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        
        $userExists = $db->registerUser($username, $email, $password);


        if ($userExists == false) {

            $userError = true;
        } else {
            $_SESSION['userId'] = $userExists;
            header("Location: index.php");
            exit();
        }
    }
};






?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <section>
        <div class="register">
            <form action="register.php" method="post">
                <h5 style="color: white;">register</h5>
                <input type="text" name='username' placeholder="user1234">
                <input type="email" name="email" placeholder="@gmail.com">

                <input type="password" name="password" placeholder="Mot de passe">
                <input type="password" name="confirmPassword" placeholder="Confirmez le mot de passe">

                <?php if ($passwordError === true): ?>
                    <p style="color: red;">Mots de passe non identiques</p>
                <?php endif; ?>

                <?php if ($userError === true): ?>
                    <p style="color: yellow;">Cet utilisateur existe déjà</p>
                <?php endif; ?>
                <button type="submit">inscrire</button>





            </form>

            <a href="login.php">Deja inscrit? Se connecter</a>
        </div>


    </section>


</body>

</html>