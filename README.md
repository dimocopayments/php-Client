Payment Gateway Client
==============

1.) Include the autoloader
```
require_once('/path/to/client/autoload.php');
```

2.) Instantiate the "PaymentGateway\Client\Client" with your credentials, send the transaction and react on the result.
>>>>>>> master

```
$client = new Client("username", "password", "apiKey", "sharedSecret");

$customer = new Customer();
$customer->setBillingCountry("AT")
	->setEmail("customer@email.test");

$debit->setTransactionId("uniqueTransactionReference")
	->setSuccessUrl($redirectUrl)
	->setCancelUrl($redirectUrl)
	->setCallbackUrl($callbackUrl)
	->setAmount(10.00)
	->setCurrency('EUR')
	->setCustomer($customer);

$result = $client->debit($debit);

if ($result->isSuccess()) {
	//act depending on $result->getReturnType()
}

```
