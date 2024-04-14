<?php
include_once 'AbsManage.php';
class DonationDetails extends AbsManage {
    public $donationId;
    public $donationTypeId;
    public $quantity;

    function __construct($id, $donationId, $donationTypeId, $quantity) {
        $this->id = $id;
        $this->donationId = $donationId;
        $this->donationTypeId = $donationTypeId;
        $this->quantity = $quantity;
    }

    function insert() {
        $lines = file('donationDetails.txt');
        foreach ($lines as $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $this->id) {
                echo "A donation detail with this ID already exists.\n";
                return;
            }
        }
        $file = fopen('donationDetails.txt', 'a');
        fwrite($file, "$this->id,$this->donationId,$this->donationTypeId,$this->quantity\n");
        fclose($file);
    }

    function update($id, $newDonationId, $newDonationTypeId, $newQuantity) {
        $lines = file('donationDetails.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationDetails = explode(',', $line);
                $lines[$key] = "$id,$newDonationId,$newDonationTypeId,$newQuantity\n";
                file_put_contents('donationDetails.txt', implode('', $lines));
                $found = true;
                break;
        }
        if (!$found) {
            echo "No donation detail found with this ID.\n";
        }
    }

    function read($id) {
        $lines = file('donationDetails.txt');
        foreach ($lines as $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $id) {
                return $donationDetails;
            }
        }
        echo "No donation detail found with this ID.\n";
        return null;
    }

    function delete($id) {
        $lines = file('donationDetails.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationDetails = explode(',', $line);
            if ($donationDetails[0] == $id) {
                unset($lines[$key]);
                file_put_contents('donationDetails.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No donation detail found with this ID.\n";
        }
    }
}
// Create a new donation detail
//$donationDetail = new DonationDetails(1, 1, 1, '$300');
//$donationDetail->insert(); // This will save the donation detail to the text file

// Update the donation detail's donation ID, donation type ID, and quantity
//$donationDetail->update(1, 2, 2, '$400');

// Read the donation detail's data from the text file
//$donationDetailData = $donationDetail->read(1);


// Delete the donation detail
//$donationDetail->delete(1);

// Try to read the donation detail's data after deletion
//$donationDetailData = $donationDetail->read(1);


?>