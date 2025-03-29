<?php

class Database {
    public $db = null;

    public function connect_to_db() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=my_meetic", "root", "");
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }

    public function add_user_to_db($email, $password, $firstname, $lastname, $dob, $gender, $city) {
        if (!$this->db) {
            echo "Erreur : DB not initialied.\n";

            return;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $req = $this->db->prepare("INSERT INTO users (email, password, firstname, lastname, dob, gender, city) VALUES (:email, :password, :firstname, :lastname, :dob, :gender, :city)");
            $req->bindParam(":email", $email);
            $req->bindParam(":password", $password);
            $req->bindParam(":firstname", $firstname);
            $req->bindParam(":lastname", $lastname);
            $req->bindParam(":dob", $dob);
            $req->bindParam(":gender", $gender);
            $req->bindParam(":city", $city);
            $req->execute();

            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }

    public function get_user_from_db_by_email($email) {
        $is_deleted = 0;

        $req = $this->db->prepare("SELECT * FROM users WHERE email = :email AND is_deleted = :is_deleted");
        $req->bindParam(":email", $email);
        $req->bindParam(":is_deleted", $is_deleted);
        $req->execute();

        return $req->fetch();
    }

    public function get_user_from_db($id) {
        $req = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $req->bindParam(":id", $id);
        $req->execute();

        return $req->fetch();
    }

    public function do_user_exist($email) {
        $req = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $req->bindParam(":email", $email);
        $req->execute();

        return $req->fetch() != false;
    }

    public function get_users($id, $filters) {
        $is_deleted = 0;
        $gender = "'" . implode("','", $filters["gender"]) . "'";
        $hobbies = "'" . implode("','", $filters["hobbies"]) . "'";
        $city = "'" . implode("','", $filters["city"]) . "'";
        $age = "'" . implode("','", $filters["age"]) . "'";

        $req = $this->db->prepare("SELECT 
                email,
                firstname,
                lastname,
                dob,
                gender,
                city,
                profile_pic,
                GROUP_CONCAT(hobbies.name SEPARATOR ', ') AS 'hobbies'
            FROM users
            INNER JOIN hobbies ON users.id = hobbies.user_id AND 0 = hobbies.is_deleted
            WHERE users.id != :id 
            AND users.is_deleted = :is_deleted
            AND LOWER(users.gender) IN ($gender)
            AND LOWER(users.city) IN ($city)
            AND LOWER(hobbies.name) IN ($hobbies)
            AND TIMESTAMPDIFF(YEAR, dob, CURDATE()) IN ($age)
            GROUP BY users.id");
        $req->bindParam(":id", $id);
        $req->bindParam(":is_deleted", $is_deleted);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_CLASS);
    }
}
