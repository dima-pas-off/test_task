<?php


 class Validator {
    public $form;
    public $arrayErrors = [];

    function __construct($form)
    {   
        foreach($form as &$field) {
            $field = str_replace(" ", "", $field);
        }
        unset($field);

        $this->form = $form;
    }


    private function checkForExpression($keyField, $valueField, $pattern) {
        if(!preg_match($pattern, $valueField)) {
            $this->arrayErrors[] = [
                "inputName" => $keyField,
                "description" => "preg"
            ];
        }
    }

    private function checkEmailValidation() {
        if(!filter_var($this->form["email"], FILTER_VALIDATE_EMAIL) && strlen($this->form["email"]) !== 0) {
            $this->arrayErrors[] = [
                "inputName" => "email",
                "description" => "valide" 
            ];
        }
    }

    private function checkForCompleteness($keyField, $valueField) {
        if(strlen($valueField) === 0) {
            $this->arrayErrors[] = [
                "inputName" => $keyField,
                "description" => "required"
            ];
        }
    }


    private function checkForMinLengthField($keyField, $valueField, $minLength) {
        if(strlen($valueField) >= 1 && strlen($valueField) < $minLength) {
            $this->arrayErrors[] = [
                "inputName" => $keyField,
                "description" => "minlength"
            ]; 
        }
    }


    private function checkForPasswordParity() {
        if(strlen($this->form["password"]) >= 6 &&  strcmp($this->form["password"], $this->form["confirm_password"])) {
            $this->arrayErrors[] = [
                "inputName" => "password",
                "description" => "equality"
            ];
        }
    }

    private function loginUniquenessCheck($database) {
        if(!$database->loginUniquenessCheck($this->form["login"])) {
            $this->arrayErrors[] = [
                "inputName" => "login",
                "description" => "unique"
            ];
        }
    }

    private function  emailUniquenessCheck($database) {
        if(!$database->emailUniquenessCheck($this->form["email"])) {
            $this->arrayErrors[] = [
                "inputName" => "email",
                "description" => "unique"
            ];
        }
    }


    public function userExistenceCheck($database) {
        if($database->userExistenceCheck($this->form["login"])) {
            if($database->passwordCheck($this->form["login"], $this->form["password"])) {
                return true;
            }
            else {
                $this->arrayErrors[] = [
                    "inputName" => "password",
                    "description" => "notfound"
                ];
            }
        }
        else {
            $this->arrayErrors[] = [
                "inputName" => "login",
                "description" => "notfound"
            ];

        }


        return false;
    }
    

    public function formSignInValidation() {
        foreach($this->form as $keyField => $valueField ) {
            $this->checkForCompleteness($keyField,$valueField);
        }

        $this->checkForMinLengthField("login", $this->form["login"], 6);
        $this->checkForMinLengthField("password", $this->form["password"], 6);
        $this->checkForExpression("password", $this->form["password"], "/(?=.*\d)(?=.*[a-z])/i");
    }


    public function formSignUpValidation() {

        $this->checkForMinLengthField("login", $this->form["login"], 6);
        $this->checkForMinLengthField("password", $this->form["password"], 6);
        $this->checkForExpression("password", $this->form["password"], "/(?=.*\d)(?=.*[a-z])/i");
        $this->checkForPasswordParity();
        $this->checkEmailValidation();
        $this->checkForExpression("name", $this->form["name"], "/^[a-z]{2}$/i");
        

        foreach($this->form as $keyField => $valueField ) {
            $this->checkForCompleteness($keyField,$valueField);
        }

        if(count($this->arrayErrors) === 0) {
            $this->loginUniquenessCheck(new Database("../hidden/database.json"));
            $this->checkEmailValidation(new Database("../hidden/database.json"));
            $this->emailUniquenessCheck(new Database("../hidden/database.json"));
        }

        return count($this->arrayErrors) === 0;
    }

 }


?>