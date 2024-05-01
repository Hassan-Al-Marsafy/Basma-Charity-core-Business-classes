<?php
require_once 'IManage.php';
require_once 'AbstractID.php';
class DonationType extends AbstractID implements IManage {
    private $type;

    function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    // Getters and Setters
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // File manipulation functions
    function insert() {
        $lines = file('Files/donationType.txt');
        foreach ($lines as $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $this->id) {
                return false;
            }
        }
        $file = fopen('Files/donationType.txt', 'a');
        fwrite($file, "$this->id,$this->type\n");
        fclose($file);
        return true;
    }

    function update($id, $newType) {
        $lines = file('Files/donationType.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                $lines[$key] = "$id,$newType\n";
                file_put_contents('Files/donationType.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        return $found;
    }

    function read($id) {
        $lines = file('Files/donationType.txt');
        foreach ($lines as $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                return $donationType;
            }
        }
        return false;
    }

    function delete($id) {
        $lines = file('Files/donationType.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                unset($lines[$key]);
                file_put_contents('Files/donationType.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        return $found;
    }
}

// Create a new DonationType object
//$donationType = new DonationType(1, "money");

// Call the insert function
//$result = $donationType->insert();
//if ($result === false) {
//    echo "A donation type with this ID already exists."."<br>";
//}

// Call the update function
//$result = $donationType->update(1, "goods");
//if ($result === false) {
//    echo "No donation type found with this ID."."<br>";
//}

// Call the read function
//$result = $donationType->read(1);
//if ($result === false) {
//    echo "No donation type found with this ID."."<br>";
//} else {
//    echo "Donation Type ID: $result[0], Donation Type: $result[1] "."<br>";
//    echo "</br>";
//}

// Call the delete function
//$result = $donationType->delete(1);
//if ($result === false) {
//    echo "No donation type found with this ID."."<br>";
//}

?>