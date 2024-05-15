<?php
require_once ("CRUDinterface.php");
require_once ("../AbstractID.php");
require_once ("../model/db_connect.php");
class CRUDdonDetails implements CRUDinterface{

    private $donationId;
    private $donationTypeId;
    private $quantity;
    private $pdo;

    function __construct($donationId, $donationTypeId, $quantity) {
        $this->donationId = $donationId;
        $this->donationTypeId = $donationTypeId;
        $this->quantity = $quantity;
        $this->pdo = Database::getInstance()->getConnection(); // Get the Singleton database connection
    }

    // Getters and Setters
    public function getDonationId() {
        return $this->donationId;
    }

    public function setDonationId($donationId) {
        $this->donationId = $donationId;
    }

    public function getDonationTypeId() {
        return $this->donationTypeId;
    }

    public function setDonationTypeId($donationTypeId) {
        $this->donationTypeId = $donationTypeId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Database manipulation functions
    function insert() {
        $sql = "INSERT INTO donation_details (donation_id, donationType_id, quantity) VALUES (?, ?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->donationId, $this->donationTypeId, $this->quantity]);
    }

    function update($id, $newDonationId, $newDonationTypeId, $newQuantity) {
        $sql = "UPDATE donation_details SET donation_id=?, donationType_id=?, quantity=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$newDonationId, $newDonationTypeId, $newQuantity, $id]);
    }

    function read($id) {
        $sql = "SELECT * FROM donation_details WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function delete($id) {
        $sql = "DELETE FROM donation_details WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}


?>