<?php

require_once(dirname(dirname(__FILE__)).'/vendor/autoload.php');

$client = new \PaymentGateway\Client\Client('username', 'password', 'api-key', 'shared-secret');
$valid = $client->validateCallbackWithGlobals();
var_dump($valid);
$callbackResult = $client->readCallback(file_get_contents('php://input'));

$myTransactionId = $callbackResult->getTransactionId();
$gatewayTransactionId = $callbackResult->getReferenceId();

if ($callbackResult->getResult() == \PaymentGateway\Client\Callback\Result::RESULT_OK) {
    //payment ok

    //finishCart();

} elseif ($callbackResult->getResult() == \PaymentGateway\Client\Callback\Result::RESULT_ERROR) {
    //payment failed, handle errors
    $errors = $callbackResult->getErrors();

}

echo "OK";
die;