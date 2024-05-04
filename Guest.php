<?php
require_once 'User.php';
require_once 'ManagingClass.php';
require_once 'DonationInterface.php';
require_once 'RestrictionInterface.php';

class Guest extends User implements DonationInterface,RestrictionInterface {
    private $manager;
    private $pdo;

    function __construct($name, $pdo, $manager) {
        parent::__construct($name, 'guest', $pdo);
        $this->manager = $manager;
        $this->manager->insertUser($this);
        $this->pdo = $pdo;
    }

    function signUp($password) {
        // Change user type to 'RegisteredUser'
        $this->setType('RegisteredUser');
    
        // Get the id of the guest
        $this->setId($this->pdo->lastInsertId());
    
        // Update the user in the database
        $this->manager->updateUser($this, $this->getId(), $this->getName(), $this->getType());
    
        // Add user id and password to login_info table
        $sql = "INSERT INTO login_info (id, password) VALUES (?, ?)";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$this->getId(), $password]);
    }
    function makeDonation($date, $accountantId, $managerId){
        $donation = $this->manager->createDonation($date, $this->getId(), $accountantId, $managerId);
        $this->manager->insertDonation($donation);
    }

    function readDonations() {
        $donations = $this->manager->readAllUserDonations($this);
        foreach ($donations as $donation) {
            echo "Donation id: {$donation->getId()}, date: {$donation->getDate()}, user id: {$donation->getUserId()}, accountant id: {$donation->getAccountantId()}, manager id: {$donation->getManagerId()}<br>";
        }
    }

    function readDonationDetails() {
        $donations = $this->manager->readAllUserDonations($this);
        foreach ($donations as $donation) {
            $donationDetails = $this->manager->readAllDonationsDetails($donation);
            foreach ($donationDetails as $detail) {
                echo "DonationDetails id: {$detail->getId()}, donation id: {$detail->getDonationId()}, donation type id: {$detail->getDonationTypeId()}, quantity: {$detail->getQuantity()}<br>";
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
    function RestrictUserPersonalInfoAccess($userType){}
}

// Create Manager
//$manager = new Manager($pdo);

// Test Guest functions
//echo "Testing Guest functions...<br>";

// Create a new guest
//$guest = new Guest('John Doe', $pdo, $manager);

// Sign up the guest
//assert($guest->signUp('password123') == true);

//$guest->makeDonation('2024-05-01', 1, 1);

// Read donations
//$guest->readDonations();

// Read donation details
//$guest->readDonationDetails();

//$guest->cancelDonation(11);

//echo "All tests passed.<br>";
?>
