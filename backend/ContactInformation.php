<?php

class ContactInformation {
    private $phoneNumber;
    private $emailAddress;
    private $accountNumber;
    
    public function __construct($phoneNumber, $emailAddress, $accountNumber) {
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
        $this->accountNumber = $accountNumber;
    }
    
    public function updatePhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
    
    public function updateEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
    }
    
    public function updateAccountNumber($accountNumber) {
        $this->accountNumber = $accountNumber;
    }
    
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    
    public function getEmailAddress() {
        return $this->emailAddress;
    }
    
    public function getAccountNumber() {
        return $this->accountNumber;
    }
}

?>
