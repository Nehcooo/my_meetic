<?php

require_once "Database.php";

class User extends Database {
    private $id = null;
    private $email = null;
    private $password = null;
    private $firstname = null;
    private $lastname = null;
    private $dob = null;
    private $gender = null;
    private $city = null;
    private $profile_pic = null;

    public function __construct($id) {
        $this->connect_to_db();

        $user = $this->get_user_from_db($id);

        $this->id = $user["id"];
        $this->email = $user["email"];
        $this->password = $user["password"];
        $this->firstname = $user["firstname"];
        $this->lastname = $user["lastname"];
        $this->dob = $user["dob"];
        $this->gender = $user["gender"];
        $this->city = $user["city"];
        $this->profile_pic = $user["profile_pic"];
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getCity() {
        return $this->city;
    }

    public function getProfilePic() {
        return $this->profile_pic;
    }

    public function getHobbies() {
        $user_id = $this->getId();
        $is_deleted = 0;

        $req = $this->db->prepare("SELECT GROUP_CONCAT(name SEPARATOR ', ') AS hobbies FROM hobbies WHERE user_id = :user_id AND is_deleted = :is_deleted");
        $req->bindParam(":user_id", $user_id);
        $req->bindParam(":is_deleted", $is_deleted);
        $req->execute();

        return $req->fetchColumn();
    }

    public function updateInfo($name, $value) {
        if ($name == "password") {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $id = $this->getId();

        $req = $this->db->prepare("UPDATE users SET $name = :$name WHERE id = :id");
        $req->bindParam(":" . $name, $value);
        $req->bindParam(":id", $id);
        $req->execute();

        $this->$name = $value;
    }

    public function updateHobbies($newHobbies) {
        $user_id = $this->getId();
        $is_deleted = 1;

        $req = $this->db->prepare("UPDATE hobbies SET is_deleted = :is_deleted WHERE user_id = :user_id");
        $req->bindParam(":is_deleted", $is_deleted);
        $req->bindParam(":user_id", $user_id);
        $req->execute();

        foreach ($newHobbies as $hobbie) {
            $this->add_hobbie($hobbie);
        }
    }
    
    public function add_hobbie($name) {
        $is_deleted = 0;
        $user_id = $this->getId();

        $req = $this->db->prepare("INSERT INTO hobbies (user_id, name, is_deleted) VALUES (:user_id, :name, :is_deleted)");
        $req->bindParam(":user_id", $user_id);
        $req->bindParam(":name", $name);
        $req->bindParam(":is_deleted", $is_deleted);
        $req->execute();
    }

    public function delete() {
        $is_deleted = 1;
        $id = $this->getId();

        $req = $this->db->prepare("UPDATE users SET is_deleted = :is_deleted WHERE id = :id");
        $req->bindParam(":id", $id);
        $req->bindParam(":is_deleted", $is_deleted);
        $req->execute();
    }
}
