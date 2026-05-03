<?php
header('Content-Type: application/json');

$db_word = 'cropar';




if (isset($_POST['word'])) {


    $word = $_POST['word'];


    if ($word === $db_word) {
        echo json_encode(true);
    } else {
        

        for ($i = 0; $i < strlen($word); $i++) {
                $letter = 'blue';
            for ($y = 0; $y < strlen($db_word); $y++) {
                if ($word[$i] === $db_word[$y] && $i === $y) {
                    $letter = 'red';
                }
                else if($word[$y] === $db_word[$i]) {
                    $letter = 'yellow';
                }
        
                
            };
            $result[] = $letter;
        }

        echo json_encode($result);
    }
};
