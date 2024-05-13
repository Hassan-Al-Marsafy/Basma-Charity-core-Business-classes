<?php
require_once ("CRUDinterface.php");
class CRUDuser implements CRUDinterface{
    private $name;
    private $type;
    private $pdo;

    function __construct($name, $type, $pdo) {
        $this->name = $name;
        $this->type = $type;
        $this->pdo = $pdo;
    }

    // Getters and Setters
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }


    // Database manipulation functions
    function insert() {
        $sql = "INSERT INTO users (user_name, user_type) VALUES (?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->name, $this->type]);
    }


    function update($id, $newName, $newType) {
        $sql = "UPDATE users SET user_name=?, user_type=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        $result = $stmt->execute([$newName, $newType, $id]);
        if (!$result) {
            return false;
        }
        return true;
    }

    function read($id) {
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    

    function delete($id) {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([$id]);
        if (!$result) {
            return false;
        }
        return true;
    }
}

?>