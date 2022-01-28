<?php
    session_start();
    require $_SERVER["DOCUMENT_ROOT"] . "/hidden/classes/Database.php";
    require $_SERVER["DOCUMENT_ROOT"] . "/hidden/classes/Validator.php";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $database = new Database($_SERVER["DOCUMENT_ROOT"] . "/hidden/database.json");
        $validator = new Validator($_POST);
        $validator->formSignInValidation();  
        
        if(count($validator->arrayErrors) !== 0) {
            echo json_encode($validator->arrayErrors);
            die();
        }

        if($validator->userExistenceCheck($database)) {
            echo json_encode(["STATUS" => "OK"]);
            setcookie("login", $validator->form["login"], 0, '/');
            $_SESSION["login"] = $validator->form["login"];
            die();
        }
        else {
            echo json_encode($validator->arrayErrors);
        }
    }
    else {
        die();
    }

?>