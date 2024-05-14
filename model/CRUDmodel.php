<?php
require_once ("db_connect.php");
require_once ("..\\strategy\\CRUDuser.php");
require_once ("..\\strategy\\CRUDdonDetails.php");
require_once ("..\\strategy\\CRUDdonType.php");
require_once ("..\\strategy\\CRUDdonation.php");

class DonationDetails {
    private $operation;
    public function getOperation(){
        return $this->operation;
    }

    public function setOperation($operation){
        $this->operation = $operation;
        return $this;
    }
    
    function insertOperation() {
        $this->operation->insert();
    }

    function updateDonDetail($id, $newDonationId, $newDonationTypeId, $newQuantity) {
        $this->operation->update($id, $newDonationId, $newDonationTypeId, $newQuantity);
    }

    function updateDonType($id, $newType) {
        $this->operation->update($id,$newType);

    }
    
    
    function readOperation($id) {
        $this->operation->read($id);
    }
    
    function deleteOperation($id) {
        $this->operation->delete($id);
        
    }
    

    function updateDonation($id, $newDate, $newUserId, $newAccountantId, $newManagerId) {
        $this->operation->update($id, $newDate, $newUserId, $newAccountantId, $newManagerId);
    
    }
    function addDonationDetail($donationDetailId, $donationTypeId, $quantity) {
        $this->operation->addDetail($donationDetailId, $donationTypeId, $quantity);
    
    }
    
    function readAllDonationDetails() {
        $this->operation->readAllDetails();
    
    }
    

    function updateUser($id, $newUserName, $newType,$newName) {
        $this->operation->update($id, $newUserName, $newType, $newName);
    }
    
    function createDonation($donationId, $date, $userId, $accountantId, $managerId) {
        $this->operation->addDonation($donationId, $date, $userId, $accountantId, $managerId);
    }
    
    function readAllDonations() {
        $this->operation->readDonation();
    }
    
    
}

?>