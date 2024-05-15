<?php
require_once ("CRUDinterface.php");
require_once ("../AbstractID.php");
require_once ("../model/db_connect.php");
require_once ("CRUDdonation.php");
class CRUDuser extends AbstractID implements CRUDinterface{
    private $Username;
    private $type;
    private $name;
    private $pdo;
    private $donations = array();

    function __construct($Username, $type, $name) {
        $this->Username = $Username;
        $this->type = $type;
        $this->name=$name;
        $this->pdo = Database::getInstance()->getConnection(); // Get the Singleton database connection
    }

    // Getters and Setters
    public function getUserName() {
        return $this->Username;
    }

    public function setUserName($Username) {
        $this->Username = $Username;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getPdo() {
        return $this->pdo;
    }    

    public function getDonations() {
        return $this->donations;
    }

    // Database manipulation functions
    function insert() {
        try{
            $sql = "INSERT INTO users (user_name, user_type, name) VALUES (?, ?, ?)";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$this->Username, $this->type, $this->name]);
    
            // Get the ID of the newly inserted user
            $id = $this->pdo->lastInsertId();
            return $id;
        }
        catch(PDOException $e){
            // You might want to handle this exception differently
            // For example, you could re-throw the exception, or log the error message somewhere
            return false;
        }
    }
    
    function update($id, $newUserName, $newType, $newName) {
        $sql = "UPDATE users SET user_name=?, user_type=?, name=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$newUserName, $newType, $newName, $id]);
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
    function addDonation($date, $userId, $accountantId, $managerId) {
        $donation = new CRUDdonation($date, $userId, $accountantId, $managerId);
        $donation->insert();
        array_push($this->donations, $donation);
    }
    function readDonations() {
        $allUserDonations = array();
        $sql = "SELECT * FROM donations WHERE user_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id]);
        while ($row = $stmt->fetch()) {
            $donation = new CRUDdonation($row['date'], $row['user_id'], $row['accountant_id'], $row['manager_id']);
            array_push($this->donations, $donation); // Add the Donation object to the donations array
            array_push($allUserDonations, $donation); // Add the Donation object to the allUserDonations array
        }
        return $allUserDonations;
    }
    function readAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
    
}
?>