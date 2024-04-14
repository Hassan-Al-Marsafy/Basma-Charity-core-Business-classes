<?php
include_once 'AbsManage.php';
include 'donationDetails.php';
class Donation extends AbsManage {
    public $date;
    public $userId;
    public $accountantId;
    public $managerId;
    public $donationDetails = array(); // Array to hold DonationDetails objects

    function __construct($id, $date, $userId, $accountantId, $managerId) {
        $this->id = $id;
        $this->date = $date;
        $this->userId = $userId;
        $this->accountantId = $accountantId;
        $this->managerId = $managerId;
        $this->insert(); // Automatically insert the new Donation object into the text file
    }

    function addDonationDetail($donationDetailId, $donationTypeId, $quantity) {
        $donationDetail = new DonationDetails($donationDetailId, $this->id, $donationTypeId, $quantity);
        array_push($this->donationDetails, $donationDetail);
        $donationDetail->insert(); // Insert the donation detail into the text file
    }

    // insert, update, read, delete methods go here

    function insert() {
        $lines = file('donation.txt');
        foreach ($lines as $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $this->id) {
                echo "A donation with this ID already exists.\n";
                return;
            }
        }
        $file = fopen('donation.txt', 'a');
        fwrite($file, "$this->id,$this->date,$this->userId,$this->accountantId,$this->managerId\n");
        fclose($file);
    }

    function update($id, $newDate, $newUserId, $newAccountantId, $newManagerId, $newDonationTypeId, $newQuantity) {        $lines = file('donation.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                $lines[$key] = "$id,$newDate,$newUserId,$newAccountantId,$newManagerId\n";
                file_put_contents('donation.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No donation found with this ID.\n";
        }
        foreach ($this->donationDetails as $donationDetail) {
            if ($donationDetail->donationId == $this->id) {
                $donationDetail->update( $donationDetail->id,$donationDetail->donationId,$newDonationTypeId,$newQuantity);
            }
        }
    }

    function read($id) {
        $lines = file('donation.txt');
        foreach ($lines as $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]\n";
                // Read all associated donation details
                foreach ($this->donationDetails as $donationDetail) {
                    if ($donationDetail->donationId == $this->id) {
                        $donationDetailData = $donationDetail->read($donationDetail->id);
                        if ($donationDetailData !== null) {
                            echo "Donation Detail ID: $donationDetailData[0], Donation ID: $donationDetailData[1], Donation Type ID: $donationDetailData[2], Quantity: $donationDetailData[3]\n";
                        }
                    }
                }

                return $donation;
            }
        }
        echo "No donation found with this ID.\n";
        return null;
    }

    function delete($id) {
        $lines = file('donation.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donation = explode(',', $line);
            if ($donation[0] == $id) {
                unset($lines[$key]);
                file_put_contents('donation.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No donation found with this ID.\n";
        } else {
            // Delete all associated donation details
            foreach ($this->donationDetails as $donationDetail) {
                if ($donationDetail->donationId == $this->id) {
                    $donationDetail->delete($donationDetail->id); // Pass the id of the DonationDetails object
                }
            }
        }
    }
    
}

// Create a new donation and automatically insert it into the text file
//$donation = new Donation(1, '2024-04-13', 1, 2, 3);

// Add a new donation detail to the donation and insert it into the text file
//$donation->addDonationDetail(1, 1, 300); // Note: the quantity is a number, not a string

// Add another donation detail to the donation and insert it into the text file
//$donation->addDonationDetail(2, 1, 400); // Note: the quantity is a number, not a string

// Update the donation and all its associated donation details
//$donation->update(1, '2024-04-14', 2, 3, 4, 1, 500);

// Read the donation and all its associated donation details
//$donationData = $donation->read(1);

// Delete the donation and all its associated donation details
//$donation->delete(1);


?>