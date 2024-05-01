<?php
require_once 'AbsManage.php';
require_once 'donationDetails.php';
class Donation extends AbsManage {
    private $date;
    private $userId;
    private $accountantId;
    private $managerId;
    private $donationDetails = array(); // Array to hold DonationDetails objects

    function __construct($id, $date, $userId, $accountantId, $managerId) {
        $this->id = $id;
        $this->date = $date;
        $this->userId = $userId;
        $this->accountantId = $accountantId;
        $this->managerId = $managerId;
    }

    // Getters and Setters
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getAccountantId() {
        return $this->accountantId;
    }

    public function setAccountantId($accountantId) {
        $this->accountantId = $accountantId;
    }

    public function getManagerId() {
        return $this->managerId;
    }

    public function setManagerId($managerId) {
        $this->managerId = $managerId;
    }

    public function getDonationDetails() {
        return $this->donationDetails;
    }

    // File manipulation functions
    function addDonationDetail($donationDetailId, $donationTypeId, $quantity) {
        $donationDetail = new DonationDetails($donationDetailId, $this->id, $donationTypeId, $quantity);
        $donationDetail->insert();
        array_push($this->donationDetails, $donationDetail);
    }
    function insert() {
        $lines = file('Files/donation.txt');
        foreach ($lines as $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $this->id) {
                return false;
            }
        }
        $file = fopen('Files/donation.txt', 'a');
        fwrite($file, "$this->id,$this->date,$this->userId,$this->accountantId,$this->managerId\n");
        fclose($file);
        return true;
    }

    function update($id, $newDate, $newUserId, $newAccountantId, $newManagerId, $newDonationTypeId, $newQuantity) {
        $lines = file('Files/donation.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                $lines[$key] = "$id,$newDate,$newUserId,$newAccountantId,$newManagerId\n";
                file_put_contents('Files/donation.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            return false;
        }
        foreach ($this->donationDetails as $donationDetail) {
            if ($donationDetail->getDonationId() == $this->id) {
                $donationDetail->update( $donationDetail->getId(),$donationDetail->getDonationId(),$newDonationTypeId,$newQuantity);
            }
        }
        return true;
    }

    function read($id) {
        $lines = file('Files/donation.txt');
        foreach ($lines as $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                return $donation;
            }
        }
        return false;
    }

    function readAllDonationDetails() {
        $allDonationDetails = array();
        $lines = file('Files/donationDetails.txt');
        foreach ($lines as $line) {
            $donationDetailData = explode(',', $line);
            if ($donationDetailData[1] == $this->id) { // If the donationId in the file matches this donation's id
                $donationDetail = new DonationDetails($donationDetailData[0], $donationDetailData[1], $donationDetailData[2], $donationDetailData[3]);
                array_push($this->donationDetails, $donationDetail); // Add the DonationDetails object to the donationDetails array
                array_push($allDonationDetails, $donationDetailData); // Add the donation detail data to the allDonationDetails array
            }
        }
        return $allDonationDetails;
    }
    
    

    function delete($id) {
        $lines = file('Files/donation.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                unset($lines[$key]);
                file_put_contents('Files/donation.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            return false;
        } else {
            // Delete all associated donation details
            foreach ($this->donationDetails as $donationDetail) {
                if ($donationDetail->getDonationId() == $this->id) {
                    $donationDetail->delete($donationDetail->getId()); // Pass the id of the DonationDetails object
                }
            }
        }
        return true;
    }
    
}


// Create a new Donation object
//$donation = new Donation(1, "1/1/2001", 1, 1, 1);
//$donation->insert();

// Call the addDonationDetail function
//$donation->addDonationDetail(1, 1, 1);

// Call the insert function
//$result = $donation->insert();
//if ($result === false) {
//    echo "A donation with this ID already exists."."<br>";
//}

// Call the update function
//$result = $donation->update(1, "2/2/2002", 2, 2, 2, 2, 2);
//if ($result === false) {
//    echo "No donation found with this ID."."<br>";
//}

// Call the read function
//$result = $donation->read(1);
//if ($result === false) {
//    echo "No donation found with this ID."."<br>";
//} else {
//    echo "Donation ID: $result[0], Date: $result[1], User ID: $result[2], Accountant ID: $result[3], Manager ID: $result[4]"."<br>";
//    echo "</br>";
//}

// Call the delete function
//$result = $donation->delete(1);
//if ($result === false) {
//    echo "No donation found with this ID."."<br>";
//}

//$allDonationDetails = $donation->readAllDonationDetails();
//foreach ($allDonationDetails as $donationDetail) {
//    echo "Donation Detail ID: $donationDetail[0], Donation ID: $donationDetail[1], Donation Type ID: $donationDetail[2], Quantity: $donationDetail[3]\n";
//   echo "</br>";
//}


?>
