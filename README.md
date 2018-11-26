Payment Gateway Client
==============

# Installation

Add this package as dependency to your composer.json file:

```
{
    "require": {
        "dimocopayments/php-client": "dev-master"
    }
}
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


# Usage

1.) Include the autoloader (if not already done via Composer autoloader)
```
require_once('/path/to/client/autoload.php');
```

2.) Instantiate the "PaymentGateway\Client\Client" with your credentials, send the transaction and react on the result.

```
$client = new Client("username", "password", "apiKey", "sharedSecret");

$customer = new Customer();
$customer->setBillingCountry("AT")
	->setEmail("customer@email.test");

$debit = new Debit();
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
