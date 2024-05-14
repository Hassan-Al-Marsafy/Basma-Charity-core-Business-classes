<?php
require_once ("CRUDinterface.php");
require_once ("../AbstractID.php");
require_once ("../model/db_connect.php");

class CRUDdonType implements CRUDinterface{
    private $type;
    private $pdo;

    function __construct($type, $pdo) {
        $this->type = $type;
        $this->pdo = $pdo;
    }

    // Getters and Setters
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    function insert() {
        $sql = "INSERT INTO donation_types (D_type_name) VALUES (?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->type]);
    }

    function update($id, $newType) {
        $sql = "UPDATE donation_types SET D_type_name=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$newType, $id]);
    }

    function read($id) {
        $sql = "SELECT * FROM donation_types WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function delete($id) {
        $sql = "DELETE FROM donation_types WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}


?>