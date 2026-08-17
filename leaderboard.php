<?php

require_once 'php/Database.php';

$db = new Database();

$users = $db->getUsers();



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/leaderboard.css">
</head>

<body>
    <header>
        <h2 class="headerText">Leaderboard</h2>
    <a class="exit" href="index.php">Sortie</a>
    </header>
    
    <div class="boardSection">
       


        <div class="scrollBoard">

        <?php for ($i = 0; $i < count($users); $i++): ?>
            <div class="userDiv">
                <h1 class="number"> <?php echo $i +1  ?> </h1>
                <h1><?php echo $users[$i]['username'] ?></h1>
                <h1>score: <?php echo $users[$i]['score'] ?></h1>
            </div>


        <?php endfor; ?>


        </div>

        


    </div>
</body>

</html>