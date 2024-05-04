<?php
// First interface with Donate and cancelDonation functions
interface DonationInterface {
    public function makeDonation($date, $accountantId, $managerId);
    public function cancelDonation($donationId);
}
?>