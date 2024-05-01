<?php
require_once 'donationType.php';
require_once 'user.php';
require_once 'donations.php';
require_once 'donationDetails.php';

class Manager {
    // DonationType functions
    function createDonationType($id, $type) {
        return new DonationType($id, $type);
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
        return new DonationDetails($id, $donationId, $donationTypeId, $quantity);
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
        return new Donation($id, $date, $userId, $accountantId, $managerId);
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
        return new User($id, $name, $type);
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

$manager = new Manager();

// Test DonationType functions
echo "<b>Testing DonationType functions:</b><br>";
$donationType = $manager->createDonationType(1, 'Money');
$result = $manager->insertDonationType($donationType);
if ($result === false) {
    echo "A donation type with this ID already exists.<br>";
}
$result = $manager->updateDonationType($donationType, 1, 'Goods');
if ($result === false) {
    echo "No donation type found with this ID.<br>";
}
$donationTypeData = $manager->readDonationType($donationType, 1);
if ($donationTypeData !== false) {
    echo "Donation Type ID: $donationTypeData[0], Donation Type: $donationTypeData[1] <br>";
}
$result = $manager->deleteDonationType($donationType, 1);
if ($result === false) {
    echo "No donation type found with this ID.<br>";
}

// Test DonationDetails functions
echo "<b>Testing DonationDetails functions:</b><br>";
$donationDetail = $manager->createDonationDetails(1, 1, 1, '$300');
$result = $manager->insertDonationDetails($donationDetail);
if ($result === false) {
    echo "A donation detail with this ID already exists.<br>";
}
$result = $manager->updateDonationDetails($donationDetail, 1, 2, 2, '$400');
if ($result === false) {
    echo "No donation detail found with this ID.<br>";
}
$donationDetailData = $manager->readDonationDetails($donationDetail, 1);
if ($donationDetailData !== false) {
    echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]<br>";
}
$result = $manager->deleteDonationDetails($donationDetail, 1);
if ($result === false) {
    echo "No donation detail found with this ID.<br>";
}

// Test Donation functions
echo "<b>Testing Donation functions:</b><br>";
$donation = $manager->createDonation(1, '2024-04-13', 1, 2, 3);
$result = $manager->insertDonation($donation);
if ($result === false) {
    echo "A donation with this ID already exists.<br>";
}
$result = $manager->updateDonation($donation, 1, '2024-04-14', 1, 2, 3, 1, '$400');
if ($result === false) {
    echo "No donation found with this ID.<br>";
}
$donationData = $manager->readDonation($donation, 1);
if ($donationData !== false) {
    echo "Donation ID: $donationData[0], Date: $donationData[1], User ID: $donationData[2], Accountant ID: $donationData[3], Manager ID: $donationData[4]<br>";
}
$result = $manager->deleteDonation($donation, 1);
if ($result === false) {
    echo "No donation found with this ID.<br>";
}
$allDonations = $manager->readAllDonationsDetails($donation);
foreach ($allDonations as $donationD) {
    echo "Donation Detail ID: $donationD[0], Donation ID: $donationD[1], Donation Type ID: $donationD[2], Quantity: $donationD[3]<br>";
    echo "</br>";
}

// Test User functions
echo "<b>Testing User functions:</b><br>";
$user = $manager->createUser(1, 'John Doe', 'donor');
$result = $manager->insertUser($user);
if ($result === false) {
    echo "A user with this ID already exists.<br>";
}
$result = $manager->updateUser($user, 1, 'Jane Doe', 'Not a donor');
if ($result === false) {
    echo "No user found with this ID.<br>";
}
$userData = $manager->readUser($user, 1);
if ($userData !== false) {
    echo "User ID: $userData[0], Name: $userData[1], Type: $userData[2]<br>";
}
$result = $manager->deleteUser($user, 1);
if ($result === false) {
    echo "No user found with this ID.<br>";
}
$allUserDonations = $manager->readAllUserDonations($user);
foreach ($allUserDonations as $donation) {
    echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]<br>";
}
$result = $manager->deleteUserDonation($user, 1);
if ($result === false) {
    echo "No Donation found with this ID.<br>";
}
?>
