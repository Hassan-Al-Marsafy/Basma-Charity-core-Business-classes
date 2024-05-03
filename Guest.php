<?php
require_once 'User.php';
require_once 'ManagingClass.php';

class Guest extends User {
    private $manager;
    private $pdo;

    function __construct($id, $name, $pdo, $manager) {
        parent::__construct($id, $name, 'guest', $pdo);
        $this->manager = $manager;
        $this->manager->insertUser($this);
        $this->pdo = $pdo;
    }

    function signUp($password) {
        // Change user type to 'RegisteredUser'
        $this->setType('RegisteredUser');
        $this->manager->updateUser($this, $this->getId(), $this->getName(), $this->getType());

        // Add user id and password to login_info table
        $sql = "INSERT INTO login_info (id, password) VALUES (?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->getId(), $password]);
    }

    function makeDonation($id, $date, $accountantId, $managerId){
        $donation = $this->manager->createDonation($id, $date, $this->getId(), $accountantId, $managerId);
        $this->manager->insertDonation($donation);
    }
    

    function readDonations() {
        $donations = $this->manager->readAllUserDonations($this);
        foreach ($donations as $donation) {
            echo "Donation id: {$donation->getId()}, date: {$donation->getDate()}, user id: {$donation->getUserId()}, accountant id: {$donation->getAccountantId()}, manager id: {$donation->getManagerId()}\n";
        }
    }

    function readDonationDetails() {
        $donations = $this->manager->readAllUserDonations($this);
        foreach ($donations as $donation) {
            $donationDetails = $this->manager->readAllDonationsDetails($donation);
            foreach ($donationDetails as $detail) {
                echo "DonationDetails id: {$detail->getId()}, donation id: {$detail->getDonationId()}, donation type id: {$detail->getDonationTypeId()}, quantity: {$detail->getQuantity()}\n";
            }
        }
    }

    function cancelDonation($donationId) {
        // Get all donations of the user
        $donations = $this->manager->readAllUserDonations($this);

        // Find the donation with the same user id and donation id
        foreach ($donations as $donation) {
            if ($donation->getId() == $donationId && $donation->getUserId() == $this->getId()) {
                // Delete the donation
                return $this->manager->deleteDonation($donation, $donationId);
            }
        }

        // If no matching donation is found, return false
        return false;
    }
}

?>
