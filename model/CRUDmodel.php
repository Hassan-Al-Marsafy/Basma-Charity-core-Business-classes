<?php
require_once ("db_connect.php");
require_once ("../strategy/CRUDuser.php");
require_once ("../strategy/CRUDdonDetails.php");
require_once ("../strategy/CRUDdonType.php");
require_once ("../strategy/CRUDdonation.php");
require_once ("../observer/DonObserver.php");
require_once ("../decorator/EmailDecorator.php");
require_once ("../decorator/PasswordDecorator.php");
class CRUDmodel {
    private $observers = array();
    private $operation;
    
    public function getOperation(){
        return $this->operation;
    }

  public function setOperation($operation)
  {
    $this->operation = $operation;
    return $this;
  }

  function insertOperation()
  {
    $x = $this->operation->insert();
    $this->notifyAllObservers();

    return $x;
  }

  function updateDonDetail($id, $newDonationId, $newDonationTypeId, $newQuantity)
  {
    $this->operation->update($id, $newDonationId, $newDonationTypeId, $newQuantity);
  }

  function updateDonType($id, $newType)
  {
    $this->operation->update($id, $newType);

  }


  function readOperation($id)
  {
    return $this->operation->read($id);
  }

  function deleteOperation($id)
  {
    return $this->operation->delete($id);
  }


    function updateDonation($id, $newDate, $newUserId, $newAccountantId, $newManagerId) {
        $this->operation->update($id, $newDate, $newUserId, $newAccountantId, $newManagerId);
    
    }
    function addDonationDetail($donationTypeId, $quantity) {
        $this->operation->addDetail($donationTypeId, $quantity);
    
    }
    
    function readAllDonationDetails() {
        return $this->operation->readAllDetails();
    
    }
    

  function updateUser($id, $newUserName, $newType, $newName)
  {
    return $this->operation->update($id, $newUserName, $newType, $newName);
  }

  function createDonation($donationId, $date, $userId, $accountantId, $managerId)
  {
    $this->operation->addDonation($donationId, $date, $userId, $accountantId, $managerId);
  }

  function readAllUserDonations($id)
  {
    return $this->operation->readDonations($id);
  }

  function readAllDonTypes()
  {
    return $this->operation->readAll();
  }

  function readAllDonDetails()
  {
    return $this->operation->readAll();
  }

  function readAllDonations()
  {
    return $this->operation->readAll();
  }
  function readUsers()
  {
    return $this->operation->readAllUsers();
  }

  //observer
  public function attach($observer)
  {
    array_push($this->observers, $observer);
  }

  public function notifyAllObservers()
  {
    foreach ($this->observers as $obs) {
      $obs->update();
    }
  }

}


?>