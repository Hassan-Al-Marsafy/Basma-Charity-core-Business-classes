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
    function createDonationType($id, $type) {
        return new DonationType($id, $type, $this->pdo);
    }

    function insertDonationType($donationType) {
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
    function createDonationDetails($id, $donationId, $donationTypeId, $quantity) {
        return new DonationDetails($id, $donationId, $donationTypeId, $quantity, $this->pdo);
    }

    function insertDonationDetails($donationDetails) {
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
    function createDonation($id, $date, $userId, $accountantId, $managerId) {
        return new Donation($id, $date, $userId, $accountantId, $managerId, $this->pdo);
    }

    function insertDonation($donation) {
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
    function createUser($id, $name, $type) {
        return new User($id, $name, $type, $this->pdo);
    }

    function insertUser($user) {
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
$manager = new Manager($pdo);

// Test DonationType functions
echo "Testing Manager's DonationType functions...\n";
$donationType = $manager->createDonationType(1, 'money');
assert($manager->insertDonationType($donationType) == true);
assert($manager->updateDonationType($donationType, 1, 'goods') == true);
$readDonationType = $manager->readDonationType($donationType, 1);
assert($readDonationType != false);
echo "DonationType id: {$readDonationType['id']}, type: {$readDonationType['D_type_name']}<br>";

// Test User functions
echo "Testing Manager's User functions...\n";
$user = $manager->createUser(1, 'Hassan', 'Admin');
assert($manager->insertUser($user) == true);
assert($manager->updateUser($user, 1, 'Ali', 'User') == true);
$readUser = $manager->readUser($user, 1);
assert($readUser != false);
echo "User id: {$readUser['id']}, name: {$readUser['user_name']}, type: {$readUser['user_type']}<br>";
$readAllUserDonations = $manager->readAllUserDonations($user);
foreach ($readAllUserDonations as $donation) {
    echo "Donation id: {$donation['id']}, date: {$donation['date']}, user id: {$donation['user_id']}, accountant id: {$donation['accountant_id']}, manager id: {$donation['manager_id']}<br>";
}
//assert($manager->deleteUserDonation($user, 1) == true);

// Test Donation functions
echo "Testing Manager's Donation functions...\n";
$donation = $manager->createDonation(1, '2024-05-01', 1, 1, 1);
assert($manager->insertDonation($donation) == true);
assert($manager->updateDonation($donation, 1, '2024-05-02', 1, 1, 1, 1, '600$') == true);
$readDonation = $manager->readDonation($donation, 1);
assert($readDonation != false);
echo "Donation id: {$readDonation['id']}, date: {$readDonation['date']}, user id: {$readDonation['user_id']}, accountant id: {$readDonation['accountant_id']}, manager id: {$readDonation['manager_id']}<br>";
$readAllDonationsDetails = $manager->readAllDonationsDetails($donation);
foreach ($readAllDonationsDetails as $donationDetail) {
    echo "DonationDetails id: {$donationDetail['id']}, donation id: {$donationDetail['donation_id']}, donation type id: {$donationDetail['donationType_id']}, quantity: {$donationDetail['quantity']}\n";
}
// Test DonationDetails functions
echo "Testing Manager's DonationDetails functions...\n";
$donationDetails = $manager->createDonationDetails(1, 1, 1, '400$');
assert($manager->insertDonationDetails($donationDetails) == true);
assert($manager->updateDonationDetails($donationDetails, 1, 1, 1, '500$') == true);
$readDonationDetails = $manager->readDonationDetails($donationDetails, 1);
assert($readDonationDetails != false);
echo "DonationDetails id: {$readDonationDetails['id']}, donation id: {$readDonationDetails['donation_id']}, donation type id: {$readDonationDetails['donationType_id']}, quantity: {$readDonationDetails['quantity']}<br>";


assert($manager->deleteDonationDetails($donationDetails, 1) == true);
assert($manager->deleteDonation($donation, 1) == true);
assert($manager->deleteUser($user, 1) == true);
assert($manager->deleteDonationType($donationType, 1) == true);

echo "All tests passed.\n";
?>
