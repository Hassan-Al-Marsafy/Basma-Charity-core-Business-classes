<?php
require_once 'IManage.php';
require_once 'AbstractID.php';
require_once 'donations.php';

class User extends AbstractID implements IManage {
    private $name;
    private $type;
    private $pdo;
    private $donations = array(); // Array to hold Donation objects

    function __construct($id, $name, $type, $pdo) {
        $this->id = $id;
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

    public function getDonations() {
        return $this->donations;
    }

    // Database manipulation functions
    function insert() {
        $sql = "INSERT INTO users (id, user_name, user_type) VALUES (?, ?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->id, $this->name, $this->type]);
    }

    function addDonation($donationId, $date, $userId, $accountantId, $managerId) {
        $donation = new Donation($donationId, $date, $userId, $accountantId, $managerId, $this->pdo);
        $donation->insert();
        array_push($this->donations, $donation);
    }

    function update($id, $newName, $newType) {
        $sql = "UPDATE users SET user_name=?, user_type=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        $result = $stmt->execute([$newName, $newType, $id]);
        if (!$result) {
            return false;
        }
        foreach ($this->donations as $donation) {
            if ($donation->getUserId() == $this->id) {
                foreach ($donation->getDonationDetails() as $donationDetail) {
                    $donation->update($donation->getId(), $donation->getDate(), $this->id, $donation->getAccountantId(), $donation->getManagerId(), $donationDetail->getDonationTypeId(), $donationDetail->getQuantity());
                }
            }
        }
        return true;
    }

    function read($id) {
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function readAllDonations() {
        $allUserDonations = array();
        $sql = "SELECT * FROM donations WHERE user_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id]);
        while ($row = $stmt->fetch()) {
            $donation = new Donation($row['id'], $row['date'], $row['user_id'], $row['accountant_id'], $row['manager_id'], $this->pdo);
            array_push($this->donations, $donation); // Add the Donation object to the donations array
            array_push($allUserDonations, $donation); // Add the Donation object to the allUserDonations array
        }
        return $allUserDonations;
    }
    

    function delete($id) {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([$id]);
        if (!$result) {
            return false;
        } else {
            // Delete all associated donations
            foreach ($this->donations as $donation) {
                if ($donation->getUserId() == $this->id) {
                    $donation->delete($donation->getId()); // Pass the id of the Donation object
                }
            }
        }
        return true;
    }
}
?>
