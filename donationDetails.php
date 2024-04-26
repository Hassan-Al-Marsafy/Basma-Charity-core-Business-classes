<?php
require_once 'AbsManage.php';
class DonationDetails extends AbsManage {
    private $donationId;
    private $donationTypeId;
    private $quantity;

    function __construct($id, $donationId, $donationTypeId, $quantity) {
        $this->id = $id;
        $this->donationId = $donationId;
        $this->donationTypeId = $donationTypeId;
        $this->quantity = $quantity;
    }

    // Getters and Setters
    public function getDonationId() {
        return $this->donationId;
    }

    public function setDonationId($donationId) {
        $this->donationId = $donationId;
    }

    public function getDonationTypeId() {
        return $this->donationTypeId;
    }

    public function setDonationTypeId($donationTypeId) {
        $this->donationTypeId = $donationTypeId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // File manipulation functions
    function insert() {
        $lines = file('Files/donationDetails.txt');
        foreach ($lines as $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $this->id) {
                return false;
            }
        }
        $file = fopen('Files/donationDetails.txt', 'a');
        fwrite($file, "$this->id,$this->donationId,$this->donationTypeId,$this->quantity\n");
        fclose($file);
        return true;
    }

    function update($id, $newDonationId, $newDonationTypeId, $newQuantity) {
        $lines = file('Files/donationDetails.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $id) {
                $lines[$key] = "$id,$newDonationId,$newDonationTypeId,$newQuantity\n";
                file_put_contents('Files/donationDetails.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        return $found;
    }

    function read($id) {
        $lines = file('Files/donationDetails.txt');
        foreach ($lines as $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $id) {
                return $donationDetails;
            }
        }
        return false;
    }

    function delete($id) {
        $lines = file('Files/donationDetails.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $id) {
                unset($lines[$key]);
                file_put_contents('Files/donationDetails.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        return $found;
    }
}

// Create a new DonationDetails object
//$donationDetail = new DonationDetails(1, 1, 1, 1);

// Call the insert function
//$result = $donationDetail->insert();
//if ($result === false) {
//    echo "A donation detail with this ID already exists."."<br>";
//}

// Call the update function
//$result = $donationDetail->update(1, 2, 2, 2);
//if ($result === false) {
//    echo "No donation detail found with this ID."."<br>";
//}

// Call the read function
//$result = $donationDetail->read(1);
//if ($result === false) {
//    echo "No donation detail found with this ID."."<br>";
//} 
//else {
//    echo "Donation Detail ID: $result[0], Donation ID: $result[1], Donation Type ID: $result[2], Quantity: $result[3]"."<br>";
//    echo "</br>";
//}

// Call the delete function
//$result = $donationDetail->delete(1);
//if ($result === false) {
//    echo "No donation detail found with this ID."."<br>";
//}

?>
