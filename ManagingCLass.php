<?php
require_once 'donationType.php';
require_once 'user.php';
require_once 'donations.php';
require_once 'donationDetails.php';
require_once 'db_connect.php';

class Manager {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // DonationType functions
    function createDonationType($type) {
        return new DonationType($type, $this->pdo);
    }

    function insertDonationType(DonationType $donationType) {
        return $donationType->insert();
    }

    function updateDonationType($donationType, $id, $newType) {
        return $donationType->update($id, $newType);
    }

    function readDonationType($donationType, $id) {
        return $donationType->read($id);
    }

    function deleteDonationType($donationType, $id) {
        return $donationType->delete($id);
    }

    // DonationDetails functions
    function createDonationDetails($donationId, $donationTypeId, $quantity) {
        return new DonationDetails($donationId, $donationTypeId, $quantity, $this->pdo);
    }

    function insertDonationDetails(DonationDetails $donationDetails) {
        return $donationDetails->insert();
    }
    function updateDonationDetails($donationDetails, $id, $newDonationId, $newDonationTypeId, $newQuantity) {
        return $donationDetails->update($id, $newDonationId, $newDonationTypeId, $newQuantity);
    }

    function readDonationDetails($donationDetails, $id) {
        return $donationDetails->read($id);
    }

    function deleteDonationDetails($donationDetails, $id) {
        return $donationDetails->delete($id);
    }

    // Donation functions
    function createDonation($date, $userId, $accountantId, $managerId) {
        return new Donation($date, $userId, $accountantId, $managerId, $this->pdo);
    }

    function insertDonation(Donation $donation) {
        return $donation->insert();
    }

    function updateDonation($donation, $id, $newDate, $newUserId, $newAccountantId, $newManagerId, $newDonationTypeId, $newQuantity) {
        return $donation->update($id, $newDate, $newUserId, $newAccountantId, $newManagerId, $newDonationTypeId, $newQuantity);
    }

    function readDonation($donation, $id) {
        return $donation->read($id);
    }

    function deleteDonation($donation, $id) {
        return $donation->delete($id);
    }

    function readAllDonationsDetails($donation) {
        return $donation->readAllDonationDetails();
    }

    // User functions
    function createUser($name, $type) {
        return new User($name, $type, $this->pdo);
    }

    function insertUser(User $user) {
        return $user->insert();
    }

    function updateUser($user, $id, $newName, $newType) {
        return $user->update($id, $newName, $newType);
    }

    function readUser($user, $id) {
        return $user->read($id);
    }

    function deleteUser($user, $id) {
        return $user->delete($id);
    }

    function readAllUserDonations($user) {
        return $user->readAllDonations();
    }

    function deleteUserDonation($user, $donationId) {
        return $user->deleteDonation($donationId);
    }
}

// Create Manager
//$manager = new Manager($pdo);

// Test DonationType functions
//echo "Testing Manager's DonationType functions...<br>";
//$donationType = $manager->createDonationType('money');
//assert($manager->insertDonationType($donationType) == true);
//assert($manager->updateDonationType($donationType, 9, 'goods') == true);
//$readDonationType = $manager->readDonationType($donationType,9);
//assert($readDonationType != false);
//echo "DonationType id: {$readDonationType['id']}, type: {$readDonationType['D_type_name']}<br>";

// Test User functions
//echo "Testing Manager's User functions...<br>";
//$user = $manager->createUser('Hassan', 'Admin');
//assert($manager->insertUser($user) == true);
//assert($manager->updateUser($user, 5, 'Ali', 'User') == true);
//$readUser = $manager->readUser($user, 5);
//assert($readUser != false);
//echo "User id: {$readUser['id']}, name: {$readUser['user_name']}, type: {$readUser['user_type']}<br>";
//$readAllUserDonations = $manager->readAllUserDonations($user);
//foreach ($readAllUserDonations as $donation) {
//    echo "Donation id: {$donation['id']}, date: {$donation['date']}, user id: {$donation['user_id']}, accountant id: {$donation['accountant_id']}, manager id: {$donation['manager_id']}<br>";
//}

// Test Donation functions
//echo "Testing Manager's Donation functions...<br>";
//$donation = $manager->createDonation('2024-05-01',5, 1, 1);
//assert($manager->insertDonation($donation) == true);
//assert($manager->updateDonation($donation, 4, '2024-05-02', 5, 1, 1, 1, '600$') == true);
//$readDonation = $manager->readDonation($donation, 4);
//assert($readDonation != false);
//echo "Donation id: {$readDonation['id']}, date: {$readDonation['date']}, user id: {$readDonation['user_id']}, accountant id: {$readDonation['accountant_id']}, manager id: {$readDonation['manager_id']}<br>";
//$readAllDonationsDetails = $manager->readAllDonationsDetails($donation);
//foreach ($readAllDonationsDetails as $donationDetail) {
//    echo "DonationDetails id: {$donationDetail['id']}, donation id: {$donationDetail['donation_id']}, donation type id: {$donationDetail['donationType_id']}, quantity: {$donationDetail['quantity']}<br>";
//}

// Test DonationDetails functions
//echo "Testing Manager's DonationDetails functions...<br>";
//$donationDetails = $manager->createDonationDetails(1, 1, '400$');
//assert($manager->insertDonationDetails($donationDetails) == true);
//assert($manager->updateDonationDetails($donationDetails, 1, 1, 1, '500$') == true);
//$readDonationDetails = $manager->readDonationDetails($donationDetails, 1);
//assert($readDonationDetails != false);
//echo "DonationDetails id: {$readDonationDetails['id']}, donation id: {$readDonationDetails['donation_id']}, donation type id: {$readDonationDetails['donationType_id']}, quantity: {$readDonationDetails['quantity']}<br>";

//echo "All tests passed.<br>";
?>

