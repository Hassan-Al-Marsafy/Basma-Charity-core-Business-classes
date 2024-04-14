<?php
include_once 'AbsManage.php';
class DonationType extends AbsManage {
    public $type;

    function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    function insert() {
        $lines = file('donationType.txt');
        foreach ($lines as $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $this->id) {
                echo "A donation type with this ID already exists.\n";
                return;
            }
        }
        $file = fopen('donationType.txt', 'a');
        fwrite($file, "$this->id,$this->type\n");
        fclose($file);
    }

    function update($id, $newType) {
        $lines = file('donationType.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                $lines[$key] = "$id,$newType\n";
                file_put_contents('donationType.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No donation type found with this ID.\n";
        }
    }

    function read($id) {
        $lines = file('donationType.txt');
        foreach ($lines as $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                return $donationType;
            }
        }
        echo "No donation type found with this ID.\n";
        return null;
    }

    function delete($id) {
        $lines = file('donationType.txt');
        $found = false;
        foreach ($lines as $key => $line) {
            $donationType = explode(',', $line);
            if ($donationType[0] == $id) {
                unset($lines[$key]);
                file_put_contents('donationType.txt', implode('', $lines));
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "No donation type found with this ID.\n";
        }
    }
}

// Create a new donation type
//$donationType = new DonationType(1, 'Money');
//$donationType->insert(); // This will save the donation type to the text file

// Update the donation type's type
//$donationType->update(1, 'Goods');

// Read the donation type's data from the text file
//$donationTypeData = $donationType->read(1);

// Delete the donation type
//$donationType->delete(1);

// Try to read the donation type's data after deletion
//$donationTypeData = $donationType->read(1);


?>