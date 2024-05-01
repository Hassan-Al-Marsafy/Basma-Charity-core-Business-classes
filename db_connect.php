<?php
// Include the classes
require_once 'DonationType.php';
require_once 'DonationDetails.php';
require_once 'Donations.php';
require_once 'User.php';
require_once 'ManagingClass.php';

// Database connection
$host = '127.0.0.1';
$db   = 'basma';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

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

// Test Donation functions
echo "Testing Manager's Donation functions...\n";
$donation = $manager->createDonation(1, '2024-05-01', 1, 1, 1);
assert($manager->insertDonation($donation) == true);
assert($manager->updateDonation($donation, 1, '2024-05-02', 1, 1, 1, 1, '600$') == true);
$readDonation = $manager->readDonation($donation, 1);
assert($readDonation != false);
echo "Donation id: {$readDonation['id']}, date: {$readDonation['date']}, user id: {$readDonation['user_id']}, accountant id: {$readDonation['accountant_id']}, manager id: {$readDonation['manager_id']}<br>";

// Test DonationDetails functions
echo "Testing Manager's DonationDetails functions...\n";
$donationDetails = $manager->createDonationDetails(1, 1, 1, '400$');
assert($manager->insertDonationDetails($donationDetails) == true);
assert($manager->updateDonationDetails($donationDetails, 1, 1, 1, '500$') == true);
$readDonationDetails = $manager->readDonationDetails($donationDetails, 1);
assert($readDonationDetails != false);
echo "DonationDetails id: {$readDonationDetails['id']}, donation id: {$readDonationDetails['donation_id']}, donation type id: {$readDonationDetails['donationType_id']}, quantity: {$readDonationDetails['quantity']}<br>";



//assert($manager->deleteDonationDetails($donationDetails, 1) == true);
//assert($manager->deleteDonation($donation, 1) == true);
//assert($manager->deleteUser($user, 1) == true);
//assert($manager->deleteDonationType($donationType, 1) == true);

echo "All tests passed.\n";
?>
