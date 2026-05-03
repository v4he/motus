<?php 
header('Content-Type: application/json');



if(isset($_POST['word'])){

$word = $_POST['word'];
    echo json_encode($word);
}



?>