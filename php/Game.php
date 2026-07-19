<?php
header('Content-Type: application/json');

$db_word = 'apple';




if (isset($_POST['action'])) {

    $action = $_POST['action'];

    if ($action === "start") {
        $length = strlen($db_word);
        $letterOne = $db_word[0];
        $mod = 'start';

        echo json_encode([$length, $letterOne, $mod]);
    } else {
        $mod = 'word';

        
        $frontWord = $action;
        $word = $action;
        
        $copyWordDb = $db_word;

        $result = [];

        for ($i = 0; $i < strlen($db_word); $i++) {
            if ($frontWord[$i] === $db_word[$i]) {
                $result[] = 'red';
                $copyWordDb[$i] = '-';
                $frontWord[$i] = "_";
            }
            else{
                $result[] = 'blue';
            }
            
        }

        $indexArr = [];

        for ($z = 0; $z < strlen($db_word); $z++) {

            $indexResult = strpos($copyWordDb, $frontWord[$z]);

            $indexArr[] = $indexResult;

            if ($indexResult !== false) {
                $copyWordDb[$indexResult] = '-';
                $frontWord[$z] = "_";
                $result[$z] = 'yellow';
                
            } else {
                if ($indexResult !== false) {
                    $result[$z] = 'blue';
                }
            }
        }


        echo json_encode([$result, $word, $mod, $copyWordDb, $frontWord]);
    }
}












// $word = $action;
//         $mod = 'word';
//         $ttt = false;
//         $ddd = false;
//         $letterDelDDD = [];
//         $letterDelTTT = [];


        

//             $result = [];
//             for ($i = 0; $i < strlen($word); $i++) {

//                 $yellowCount = 0;
//                 for ($y = 0; $y < strlen($db_word); $y++) {


//                     if (strtolower($word[$i]) === strtolower($db_word[$y]) && $i === $y) {
                  
//                         $ttt = true;
                        
//                         $letterDelTTT[] = $db_word[$y];
//                         $letterDelTTT[] = $y;
                        
//                     } else if ($word[$i] === $db_word[$y]) { 
                     
//                         $ddd = true;
//                         $letterDelDDD[] = $db_word[$y];
//                         $letterDelDDD[] = $y;
                        
//                     }
//                 };
//                 if($ttt === true){
//                     $result[] = 'red';
//                     $ttt = false;
                   
//                     $db_word[$letterDelTTT[1]] = "-";
//                     $letterDelTTT = [];
//                     $letterDelDDD = [];
//                 }
//                 else if($ddd === true){
//                     $result[] = 'yellow';
//                     $ddd = false;
                 
                    
//                     $db_word[$letterDelDDD[1]] = "Y";
//                     $letterDelDDD = [];
//                     $letterDelTTT = [];

//                 }
//                 else{
//                     $result[] = 'blue';
//                     $ddd = false;
//                     $ttt = false;
//                 }
                
//             }

//             echo json_encode([$result, $word, $mod, $db_word, $letterDelDDD, $letterDelTTT]);