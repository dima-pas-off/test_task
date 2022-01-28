<?php

    require $_SERVER["DOCUMENT_ROOT"] . "/hidden/classes/Database.php";
    require $_SERVER["DOCUMENT_ROOT"] . "/hidden/classes/Validator.php";


    if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
        $database = new Database($_SERVER["DOCUMENT_ROOT"] . "/hidden/database.json");
        $validator = new Validator($_POST);

            if($validator->formSignUpValidation($database)) {
                echo json_encode(["STATUS" => "OK"]);
                $database->createNewUser($validator->form);
            }
            
            else {
                echo json_encode($validator->arrayErrors);
            }
    }
    else {
        die();
    }        
    
    

?>