<?php
require_once 'AbsManage.php';
require_once 'donations.php';
class User extends AbsManage {
    private $name;
    private $type;
    private $donations = array(); // Array to hold Donation objects

    function __construct($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    // Getters and Setters
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getDonations() {
        return $this->donations;
    }

    // File manipulation functions
    function insert() {
        $lines = file('Files/user.txt');
        foreach ($lines as $line) {
            $user = explode(',', $line);
            if ($user[0] == $this->id) {
                return false;
            }
        }
        $file = fopen('Files/user.txt', 'a');
        fwrite($file, "$this->id,$this->name,$this->type\n");
        fclose($file);
        return true;
    }
    function addDonation($donationId, $date, $userId, $accountantId, $managerId) {
        $donation = new Donation($donationId, $date, $userId, $accountantId, $managerId);
        array_push($this->donations, $donation);
    }
    
    function update($id, $newName, $newType) {
        $lines = file('Files/user.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                $lines[$key] = "$id,$newName,$newType\n";
                file_put_contents('Files/user.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            return false;
        }
        foreach ($this->donations as $donation) {
            if ($donation->getUserId() == $this->id) {
                foreach ($donation->getDonationDetails() as $donationDetail) {
                    $donation->update($donation->getId(), $donation->getDate(), $this->id, $donation->getAccountantId(), $donation->getManagerId(), $donationDetail->getDonationTypeId(), $donationDetail->getQuantity());
                }
            }
        }
        return true;
    }
    function read($id) {
        $lines = file('Files/user.txt');
        foreach ($lines as $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                return $user;
            }
        }
        return false;
    }
    function readDonations($id) {
        foreach ($this->donations as $donation) {
            if ($donation->getUserId() == $id) {
                $found = $donation->read($donation->getId());
                return $found;
            }
        }
        return false;
    }

    function readAllDonations() {
        $allUserDonations = array();
        $lines = file('Files/donation.txt');
        foreach ($lines as $line) {
            $donationData = explode(',', $line);
            if ($donationData[2] == $this->id) { // If the userId in the file matches this user's id
                $donation = new Donation($donationData[0], $donationData[1], $donationData[2], $donationData[3], $donationData[4]);
                array_push($this->donations, $donation); // Add the Donation object to the donations array
                array_push($allUserDonations, $donationData); // Add the donation data to the allUserDonations array
            }
        }
        return $allUserDonations;
    }
    
    

    function delete($id) {
        $lines = file('Files/user.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $user = explode(',', $line);
            if ($user[0] == $id) {
                unset($lines[$key]);
                file_put_contents('Files/user.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        return $found;
    }
    function deleteDonation($id) {
        $found = false;
        foreach ($this->donations as $key => $donation) {
            if ($donation->getId() == $id) {
                unset($this->donations[$key]);
                $donation->delete($id);
                $found = true;
                break;
            }
        }
        return $found;
    }
}

// Create a new User object
//$user = new User(1, "Hassan", "donor");
//$user->insert();
// Call the addDonation function
//$user->addDonation(1, "1/1/1", 1, 2, 2);
//$user->addDonation(2, "1/1/2", 1, 3, 3);

// Call the insert function
//$result = $user->insert();
//if ($result === false) {
//    echo "A user with this ID already exists."."<br>";
//}

// Call the update function
//$result = $user->update(1, "Walid", "not donor");
//if ($result === false) {
//    echo "No user found with this ID."."<br>";
//}

// Call the read function
//$result = $user->read(1);
//if ($result === false) {
//    echo "No user found with this ID."."<br>";
//} else {
//    echo "User ID: $result[0], User Name: $result[1], User Type: $result[2] ";
//    echo "</br>";
//}

// Call the readDonations function
//$result = $user->readDonations(1);
//if ($result === false) {
//    echo "No Donations found for this User ID."."<br>";
//} else {
//    echo "Donation ID: $result[0], Date: $result[1], User ID: $result[2], Accountant ID: $result[3], Manager ID: $result[4]"."<br>";
//   echo "</br>";
//}


// Call the delete function
//$result = $user->delete(1);
//if ($result === false) {
//    echo "No user found with this ID.\n";
//}

// Call the deleteDonation function
//$result = $user->deleteDonation(2);
//if ($result === false) {
//    echo "No Donation found with this ID.\n";
//}

//$allDonations = $user->readAllDonations();
//foreach ($allDonations as $donation) {
//    echo "Donation ID: $donation[0], Date: $donation[1], User ID: $donation[2], Accountant ID: $donation[3], Manager ID: $donation[4]"."<br>";
//    echo "</br>";
//}

?>
