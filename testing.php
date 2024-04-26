<?php
require_once 'donationType.php';
require_once 'user.php';
require_once 'donations.php';
require_once 'donationDetails.php';

class Manager {
    function testDonationType() {
        // Test DonationType class
        echo "<b>Donation Type Testing</b>";
        echo "</br>";
        $donationType = new DonationType(1, 'Money');
        $result = $donationType->insert();
        if ($result === false) {
            echo "A donation type with this ID already exists.";
        }
        $donationTypeData = $donationType->read(1);
        if ($donationTypeData !== false) {
            echo "Donation Type ID: $donationTypeData[0], Donation Type: $donationTypeData[1]";
            echo "</br>";
        }
        $donationType->update(1, 'Goods');
        $donationTypeData = $donationType->read(1);
        if ($donationTypeData !== false) {
            echo "Donation Type ID: $donationTypeData[0], Donation Type: $donationTypeData[1]";
            echo "</br>";
        }
        $donationType->delete(1);
        $donationTypeData = $donationType->read(1);
        if ($donationTypeData !== false) {
            echo "Donation Type ID: $donationTypeData[0], Donation Type: $donationTypeData[1]";
            echo "</br>";
        }
        
        echo "</br>";
    }
    function testDonationDetails(){
        // Test DonationDetails class
        echo "<b>Donation Details Testing</b>";
        echo "</br>";
        $donationDetail = new DonationDetails(1, 1, 1, '$300');
        $result = $donationDetail->insert();
        if ($result === false) {
            echo "A donation detail with this ID already exists.";
        }
        $donationDetailData = $donationDetail->read(1);
        if ($donationDetailData !== false) {
            echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]";
            echo "</br>";
        }
        $donationDetail->update(1, 2, 2, '$400');
        $donationDetailData = $donationDetail->read(1);
        if ($donationDetailData !== false) {
            echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]";
            echo "</br>";
        }
        $donationDetail->delete(1);
        $donationDetailData = $donationDetail->read(1);
        if ($donationDetailData !== false) {
            echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]";
            echo "</br>";
        }
        echo "</br>";
    }
    function testDonation(){
        // Test Donation class
        echo "<b>Donations Testing</b>";
        echo "</br>";
        $donation = new Donation(1, '2024-04-13', 1, 2, 3);
        $donation->addDonationDetail(1, 1, '$300');
        $donationData = $donation->read(1);
        if ($donationData !== false) {
            echo "Donation ID: $donationData[0], Date: $donationData[1], User ID: $donationData[2], Accountant ID: $donationData[3], Manager ID: $donationData[4]";
            echo "</br>";
        }
        $donation->update(1, '2024-04-14', 1, 2, 3, 1, '$400');
        $donationData = $donation->read(1);
        if ($donationData !== false) {
            echo "Donation ID: $donationData[0], Date: $donationData[1], User ID: $donationData[2], Accountant ID: $donationData[3], Manager ID: $donationData[4]";
            echo "</br>";
        }
        $donation->delete(1);
        $donationData = $donation->read(1);
        if ($donationData !== false) {
            echo "Donation ID: $donationData[0], Date: $donationData[1], User ID: $donationData[2], Accountant ID: $donationData[3], Manager ID: $donationData[4]";
            echo "</br>";
        }
        echo "</br>";
    }
    function testUser(){
        // Test User class
        echo "<b>User Testing</b>";
        echo "</br>";
        $user = new User(1, 'John Doe', 'donor');
        $userData = $user->read(1);
        if ($userData !== false) {
            echo "User ID: $userData[0], Name: $userData[1], Type: $userData[2]";
            echo "</br>";
        }
        $user->addDonation(1, '2024-04-13', 1, 2, 3);
        $user->readDonations(1);
        $user->addDonation(2, '2024-04-13', 1, 1, 1);
        $userDonations = $user->readAllDonations();
        foreach ($userDonations as $donation) {
            echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]";
            echo "</br>";
        }
        $user->deleteDonation(1);
        $userDonations = $user->readAllDonations();
        foreach ($userDonations as $donation) {
            echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]";
            echo "</br>";;
        }
        $user->deleteDonation(2);
        $userDonations = $user->readAllDonations();
        foreach ($userDonations as $donation) {
            echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]";
            echo "</br>";
        }
        $user->update(1, 'Jane Doe', 'Not a donor');
        $userData = $user->read(1);
        if ($userData !== false) {
            echo "User ID: $userData[0], Name: $userData[1], Type: $userData[2]";
            echo "</br>";
        }
        $user->delete(1);
        $userData = $user->read(1);
        if ($userData !== false) {
            echo "User ID: $userData[0], Name: $userData[1], Type: $userData[2]";
            echo "</br>";
        }
    }
}

$manager = new Manager();
$manager->testDonationType();
$manager->testDonationDetails();
$manager->testDonation();
$manager->testUser();
?>