<?php
include 'donationType.php';
include 'user.php';

class Manager {
    function testDonationType() {
        // Test DonationType class
        $donationType = new DonationType(1, 'Money');
        $donationType->insert();
        $donationType->update(1, 'Goods');
        $donationTypeData = $donationType->read(1);
        if ($donationTypeData !== null) {
            echo "Donation Type ID: $donationTypeData[0], Donation Type $donationTypeData[1] \n";
        }
        $donationType->delete(1);
    }
    function testDonationDetails(){
        // Test DonationDetails class
        $donationDetail = new DonationDetails(1, 1, 1, '$300');
        $donationDetail->insert();
        $donationDetail->update(1, 2, 2, '$400');
        $donationDetailData = $donationDetail->read(1);
        if ($donationDetailData !== null) {
            echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]\n";
        }
        $donationDetail->delete(1);
    }
    function testDonation(){
        // Test Donation class
        $donation = new Donation(1, '2024-04-13', 1, 2, 3);
        $donation->addDonationDetail(1, 1, '$300');
        $donation->update(1, '2024-04-14', 1, 2, 3, 1, '$400');
        $donation->read(1);
        $donation->delete(1);
    }
    function testUser(){
        // Test User class
        $user = new User(1, 'John Doe', 'donor');
        $user->addDonation(1, '2024-04-13', 1, 2, 3);
        $user->update(1, 'Jane Doe', 'not donor');
        $user->read(1);
        $user->readDonations(1);
        $user->delete(1);
    }
}

$manager = new Manager();
$manager->testDonationType();
$manager->testDonation();
$manager->testDonationDetails();
$manager->testUser();
?>
