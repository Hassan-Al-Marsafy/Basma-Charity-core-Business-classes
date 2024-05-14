<?php
class User{
    private $usr;
    public function getUser(){
        return $this->usr;
    }

    public function setUser($usr){
        $this->usr = $usr;
        return $this;
    }
    // Database manipulation functions
    function insertUser() {
        $res = $this->usr->insert();
        return $res;
    }

    function createDonation($donationId, $date, $userId, $accountantId, $managerId) {
        $this->usr->addDonation($donationId, $date, $userId, $accountantId, $managerId);
    }

    function updateUser($id, $newName, $newType) {
        $this->usr->update($id, $newName, $newType);
    }

    function readUser($id) {
        $this->usr->read($id);
    }

    function readAllDonations() {
        $this->usr->readDonation();
    }
    

    function delete($id) {
        $this->usr->delete($id);
    }
}
?>
