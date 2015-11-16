# Get it started.

In this chapter we are going to setup payum package and do simple purchase using paypal express checkout. 
Look at sandbox to find more examples.

## Installation

```bash
php composer.phar require payum/payum-laravel-package payum/xxx
```

_**Note**: Where payum/xxx is a payum package, for example it could be payum/paypal-express-checkout-nvp. Look at [supported gateways](https://github.com/Payum/Core/blob/master/Resources/docs/supported-gateways.md) to find out what you can use._

_**Note**: Use payum/payum if you want to install all gateways at once._

Now you have all codes prepared and ready to be used.

## Configuration

```php
// bootstrap/start.php

App::resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
    $payumBuilder
        // this method registers filesystem storages, consider to change them to something more
        // sophisticated, like eloquent storage
        ->addDefaultStorages()

        ->addGateway('paypal_ec', [
            'factory' => 'paypal_express_checkout',
            'username' => 'EDIT ME',
            'password' => 'EDIT ME',
            'signature' => 'EDIT ME',
            'sandbox' => true
        ])
    ;
});
```

## Prepare payment

Lets create a controller where we prepare the payment details.

```php
<?php
// app/controllers/PaypalController.php

use Payum\LaravelPackage\Controller\PayumController;

class PaypalController extends PayumController
{
	public function prepareExpressCheckout()
	{
        $storage = $this->getPayum()->getStorage('Payum\Core\Model\ArrayObject');

        $details = $storage->create();
        $details['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';
        $details['PAYMENTREQUEST_0_AMT'] = 1.23;
        $storage->update($details);

        $captureToken = $this->getPayum()->getTokenFactory()->createCaptureToken('paypal_ec', $details, 'payment_done');

        return \Redirect::to($captureToken->getTargetUrl());
	}
}
```

Here's you may want to modify a `payment_done` route. 
It is a controller where the payer will be redirected after the payment is done, whenever it is success failed or pending.
Read a [dedicated chapter](payment_done_controller.md) about how the payment done controller may look like.

Back to [index](index.md).