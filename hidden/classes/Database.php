<?php


    class Database {

        public $database;
        private $filePath;

        function __construct($filePath)
        {
            $this->filePath = $filePath;
            $this->database = json_decode(file_get_contents($filePath), TRUE);
        }

        public function createNewUser($dataUser) {
            $this->database["users"][] = [
                "login" => $dataUser["login"],
                "password" => password_hash($dataUser["password"], PASSWORD_DEFAULT),
                "email" => $dataUser["email"],
                "name" => $dataUser["name"]
            ];

            file_put_contents($this->filePath, json_encode($this->database));
        }

        public function readUser($login) {
            foreach($this->database["users"] as $user) {
                if($user["login"] === $login) {
                    return $user;
                }
            }
        }

        public function updateUser($login, $arrayNewField) {
            foreach($this->database["users"] as $key => $user) {
                if($user["login"] === $login) {
                    
                    if(isset($arrayNewField["login"])) {
                        $this->database["users"][$key]["login"] = $arrayNewField["login"];
                    }

                    if(isset($arrayNewField["password"])) {
                        $this->database["users"][$key]["password"] = password_hash($arrayNewField["password"], PASSWORD_DEFAULT);
                    }

                    if(isset($arrayNewField["email"])) {
                        $this->database["users"][$key]["email"] = $arrayNewField["email"];
                    }

                    if(isset($arrayNewField["name"])) {
                        $this->database["users"][$key]["name"] = $arrayNewField["name"];
                    }

                }
            }
            file_put_contents($this->filePath, json_encode($this->database));
        }

        public function deleteUser($login) {
            foreach($this->database["users"] as $key => $user) {
                if($user["login"] === $login) {
                    unset($this->database["users"][$key]);
                    file_put_contents($this->filePath, json_encode($this->database));
                }
            }
        }


        

        public function numberOfRecords() {
            return count($this->database["users"]);
        }

        public function loginUniquenessCheck($login) {
            foreach($this->database["users"] as $field) {
                if($field["login"] === $login) {
                    return false;
                }
            }
            return true;
        }

        public function emailUniquenessCheck($email) {
            foreach($this->database["users"] as $field) {
                if($field["email"] === $email) {
                    return false;
                }
            }
            return true;
        }


        public function userExistenceCheck($login) {
            foreach($this->database["users"] as $user) {
                if($user["login"] === $login) {
                    return true;
                }
            }
            return false;
        }

        public function passwordCheck($login, $password) {
            foreach($this->database["users"] as $user) {
                if($this->userExistenceCheck($login)) {
                    if(password_verify($password, $user["password"])) {
                        return true;
                    }
                }
            }
            return false;
        }
    }


?>