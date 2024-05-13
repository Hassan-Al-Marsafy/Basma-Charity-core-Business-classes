<?php
require_once ("CRUDinterface.php");
require_once ("C:\\xampp\htdocs\\BasmaGit\\Basma-Charity-core-Business-classes\\AbstractID.php");
require_once ("C:\\xampp\htdocs\\BasmaGit\\Basma-Charity-core-Business-classes\\model\db_connect.php");
require_once ("CRUDdonDetails.php");
class CRUDdonation extends AbstractID implements CRUDinterface{
    private $date;
    private $userId;
    private $accountantId;
    private $managerId;
    private $pdo;
    private $donationDetails = array();
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
    public function getDonationDetails() {
        return $this->donationDetails;
    }


    function insert() {
        $sql = "INSERT INTO donations (date, user_id, accountant_id, manager_id) VALUES (?, ?, ?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->date, $this->userId, $this->accountantId, $this->managerId]);
    }

    function update($id, $newDate, $newUserId, $newAccountantId, $newManagerId) {
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
    function readAllDetails() {
        $allDonationDetails = array();
        $sql = "SELECT * FROM donation_details WHERE donation_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id]);
        while ($row = $stmt->fetch()) {
            $donationDetail = new CRUDdonDetails($row['donation_id'], $row['donationType_id'], $row['quantity'], $this->pdo);
            array_push($this->donationDetails, $donationDetail); // Add the DonationDetails object to the donationDetails array
            array_push($allDonationDetails, $row); // Add the donation detail data to the allDonationDetails array
        }
        return $allDonationDetails;
    }
    function addDetail($donationDetailId, $donationTypeId, $quantity) {
        $donationDetail = new CRUDdonDetails($this->id, $donationTypeId, $quantity, $this->pdo);
        $donationDetail->insert();
        array_push($this->donationDetails, $donationDetail);
    }
}


?>