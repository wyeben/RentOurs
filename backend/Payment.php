<?php

class Payment {
    private $amount;
    private $paymentMethod;
    private $transactionDetails;
    private $gatewayIntegrationDetails;
    
    public function __construct($amount, $paymentMethod, $transactionDetails, $gatewayIntegrationDetails) {
        $this->amount = $amount;
        $this->paymentMethod = $paymentMethod;
        $this->transactionDetails = $transactionDetails;
        $this->gatewayIntegrationDetails = $gatewayIntegrationDetails;
    }
    
    public function processPayment() {
        // Implementation
    }
    
    public function refundPayment() {
        // Implementation
    }
    
    public function getAmount() {
        return $this->amount;
    }
    
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }
    
    public function getTransactionDetails() {
        return $this->transactionDetails;
    }
    
    public function getGatewayIntegrationDetails() {
        return $this->gatewayIntegrationDetails;
    }
    
    public function setAmount($amount) {
        $this->amount = $amount;
    }
    
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
    }
    
    public function setTransactionDetails($transactionDetails) {
        $this->transactionDetails = $transactionDetails;
    }
    
    public function setGatewayIntegrationDetails($gatewayIntegrationDetails) {
        $this->gatewayIntegrationDetails = $gatewayIntegrationDetails;
    }
}

?>
