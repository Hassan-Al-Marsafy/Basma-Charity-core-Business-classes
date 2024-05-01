<?php
require_once 'donationType.php';
require_once 'user.php';
require_once 'donations.php';
require_once 'donationDetails.php';

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
?>
