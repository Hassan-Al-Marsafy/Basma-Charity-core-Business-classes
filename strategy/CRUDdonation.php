<?php
require_once ("CRUDinterface.php");
class CRUDdonation implements CRUDinterface{
    private $date;
    private $userId;
    private $accountantId;
    private $managerId;
    private $pdo;

    function __construct($date, $userId, $accountantId, $managerId, $pdo) {
        $this->date = $date;
        $this->userId = $userId;
        $this->accountantId = $accountantId;
        $this->managerId = $managerId;
        $this->pdo = $pdo;
    }

    // Getters and Setters
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getAccountantId() {
        return $this->accountantId;
    }

    public function setAccountantId($accountantId) {
        $this->accountantId = $accountantId;
    }

    public function getManagerId() {
        return $this->managerId;
    }

    public function setManagerId($managerId) {
        $this->managerId = $managerId;
    }

    function insert() {
        $sql = "INSERT INTO donations (date, user_id, accountant_id, manager_id) VALUES (?, ?, ?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->date, $this->userId, $this->accountantId, $this->managerId]);
    }

    function update($id, $newDate, $newUserId, $newAccountantId, $newManagerId, $newDonationTypeId, $newQuantity) {
        $sql = "UPDATE donations SET date=?, user_id=?, accountant_id=?, manager_id=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        $result = $stmt->execute([$newDate, $newUserId, $newAccountantId, $newManagerId, $id]);
        if (!$result) {
            return false;
        }
        return true;
    }

    function read($id) {
        $sql = "SELECT * FROM donations WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    function delete($id) {
        $sql = "DELETE FROM donations WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([$id]);
        if (!$result) {
            return false;
        }
        return true;
    }
}


?>