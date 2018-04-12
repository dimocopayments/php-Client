<?php

require_once(dirname(dirname(__FILE__)).'/autoload.php');

$client = new \PaymentGateway\Client\Client('username', 'password', 'apiKey', 'sharedSecret');

$customer = new \PaymentGateway\Client\Data\Customer();
$customer
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setEmail('john@smith.com')
    ->setIpAddress('123.123.123.123');
//add further customer details if necessary

$debit = new \PaymentGateway\Client\Transaction\Debit();
$debit->setAmount(9.99)
    ->setCurrency('EUR')
    ->setCallbackUrl('https://myhost.com/path/to/my/callbackHandler')
    ->setSuccessUrl('https://myhost.com/checkout/successPage')
    ->setErrorUrl('https://myhost.com/checkout/errorPage')
    ->setDescription('One pair of shoes')
    ->setCustomer($customer);

//if token acquired via payment.js
if (isset($token)) {
    $debit->setTransactionToken($token);
}

//for recurring transactions
if (isset($isRecurringTransaction)) {
    $debit->setReferenceTransactionId($referenceIdFromFirstTransaction);
}

$result = $client->debit($debit);

$gatewayReferenceId = $result->getReferenceId(); //store it in your database

if ($result->getReturnType() == \PaymentGateway\Client\Transaction\Result::RETURN_TYPE_ERROR) {
    //error handling
    $errors = $result->getErrors();
    //cancelCart();

} elseif ($result->getReturnType() == \PaymentGateway\Client\Transaction\Result::RETURN_TYPE_REDIRECT) {
    //redirect the user
    header('Location: '.$result->getRedirectUrl());
    die;
} elseif ($result->getReturnType() == \PaymentGateway\Client\Transaction\Result::RETURN_TYPE_PENDING) {
    //payment is pending, wait for callback to complete

    //setCartToPending();

} elseif ($result->getReturnType() == \PaymentGateway\Client\Transaction\Result::RETURN_TYPE_FINISHED) {
    //payment is finished, update your cart/payment transaction

    //finishCart();
}
