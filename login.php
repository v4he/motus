<?php 
session_start();
 
require_once 'php/Database.php';

$userError = false;

$db = new Database();



if(isset($_POST['email'], $_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    
    

    $userExists = $db->loginUser($email, $password);

   
    
   if($userExists === false){
    $userError = true;

    
   }
   else{
    
    header('Location: index.php');
   }

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <section>
        <div class="login">
            <form action="login.php" method="post">
                <h5 style="color: white;">login</h5>
                <input type="email" name="email" placeholder="@gmail.com">
                <input type="password" name="password" placeholder="123456">

                <?php if($userError === true): ?>
                    <p style="color: yellow;">Cet utilisateur n'existe pas</p>

                <?php endif ?>

                <button type="submit">se conecter</button>





            </form>

            <a class="creeCompte" href="register.php">Vous n'avez pas de compte ? <br> Creez-en un</a>
        </div>


    </section>


</body>

</html>