<?php
include_once 'AbsManage.php';
include 'donations.php';
class User extends AbsManage {
    public $name;
    public $type;
    public $donations = array(); // Array to hold Donation objects

    function __construct($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->insert(); // Automatically insert the new User object into the text file
    }

    function addDonation($donationId, $date, $userId, $accountantId, $managerId) {
        $donation = new Donation($donationId, $date, $userId, $accountantId, $managerId);
        array_push($this->donations, $donation);
        $donation->insert(); // Insert the donation into the text file
    }

    function insert() {
        $lines = file('user.txt');
        foreach ($lines as $line) {
            $user = explode(',', $line);
            if ($user[0] == $this->id) {
                echo "A user with this ID already exists.\n";
                return;
            }
        }
        $file = fopen('user.txt', 'a');
        fwrite($file, "$this->id,$this->name,$this->type\n");
        fclose($file);
    }

    function update($id, $newName, $newType) {
        $lines = file('user.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                $lines[$key] = "$id,$newName,$newType\n";
                file_put_contents('user.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No user found with this ID.\n";
        }
        foreach ($this->donations as $donation) {
            if ($donation->userId == $this->id) {
                foreach ($donation->donationDetails as $donationDetail) {
                    $donation->update($donation->id, $donation->date, $this->id, $donation->accountantId, $donation->managerId, $donationDetail->donationTypeId, $donationDetail->quantity);
                }
            }
        }
    }

    function read($id) {
        $lines = file('user.txt');
        foreach ($lines as $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                echo "User ID: $user[0], Name: $user[1], Type: $user[2]\n";
                return $user;
            }
        }
        echo "No user found with this ID.\n";
        return null;
    }

    function readDonations($id) {
        foreach ($this->donations as $donation) {
            if ($donation->userId == $this->id) {
                $donation->read($donation->id);
            }
        }
    }

    function delete($id) {
        $lines = file('user.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                unset($lines[$key]);
                file_put_contents('user.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No user found with this ID.\n";
        }
    }
}

// Create a new user and automatically insert it into the text file
//$user = new User(1, 'John Doe','donor');

// Add a new donation to the user and insert it into the text file
//$user->addDonation(1, '2024-04-13', 1, 2, 3);

// Update the user and all its associated donations
//$user->update(1, 'Jane Doe', 'not donor');

// Read the user and all its associated donations
//$userData = $user->read(1);

//$userdonation = $user->readDonations(1);
// Delete the user and all its associated donations
//$user->delete(1);

?>