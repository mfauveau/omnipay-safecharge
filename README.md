# Omnipay: SafeCharge

**SafeCharge Direct Gateway driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/mfauveau/omnipay-safecharge.png?branch=master)](https://travis-ci.org/mfauveau/omnipay-safecharge)
[![Latest Stable Version](https://poser.pugx.org/mfauveau/omnipay-safecharge/version.png)](https://packagist.org/packages/mfauveau/omnipay-safecharge)
[![Total Downloads](https://poser.pugx.org/mfauveau/omnipay-safecharge/d/total.png)](https://packagist.org/packages/mfauveau/omnipay-safecharge)

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements [SafeCharge](http://www.safecharge.com/) Gateway support for Omnipay.

If you are looking for the "SafeCharge Cashier" implementation see [Omnipay Gate2Shop](https://github.com/mfauveau/omnipay-gate2shop). It's the same thing except for the endpoint URL.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "mfauveau/omnipay-safecharge": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Usage

The following gateways are provided by this package:

* SafeCharge Direct Gateway (without support for 3D secure at this time, feel free to do a PR ;))

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

### Setup

```php
$gateway = Omnipay::create('Safecharge');
$gateway->initialize(array(
    'username' => 'AccountTestTRX',
    'password' => 'password',
    'testMode' => true,
    'vendorId' => 'Vendor ID',
    'websiteId' => 'Website ID'
));
```

### Authorize

```php
$cardData = [
    'name'          => 'John Doe',
    'number'        => '4000021059386316',
    'expiryMonth'   => '06',
    'expiryYear'    => '2016',
    'cvv'           => '123'
];

try {
    $response = $gateway->authorize([
        'amount' => '100.00',
        'currency' => 'USD',
        'card' => $cardData
    ])->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        print $response->getMessage();
    }
} catch (Exception $e) {
    print $e->getMessage();
}
```

### Purchase

```php
$cardData = [
    'name'          => 'John Doe',
    'number'        => '4000021059386316',
    'expiryMonth'   => '06',
    'expiryYear'    => '2016',
    'cvv'           => '123'
];

try {
    $response = $gateway->purchase([
        'amount'    => '100.00',
        'currency'  => 'USD',
        'card'      => $cardData
    ])->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        print $response->getMessage();
    }
} catch (Exception $e) {
    print $e->getMessage();
}
```

### Purchase using a Token

```php
try {
    $response = $gateway->purchase([
        'amount'        => '100.00',
        'currency'      => 'USD',
        'token'         => 'XXXXXXXXXXXXXXXXXXXXX',
        'transactionId' => '123456789'
    ])->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        print $response->getMessage();
    }
} catch (Exception $e) {
    print $e->getMessage();
}
```

### Void

```php
try {
    $response = $gateway->void([
        'amount'        => '100.00',
        'currency'      => 'USD',
        'token'         => 'XXXXXXXXXXXXXXXXXXXXX',
        'transactionId' => '123456789',
        'authCode'      => '12345',
        'expMonth'      => '06',
        'expYear'       => '2016'
    ])->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        print $response->getMessage();
    }
} catch (Exception $e) {
    print $e->getMessage();
}
```

### Refund

```php
try {
    $response = $gateway->refund([
        'amount'        => '100.00',
        'currency'      => 'USD',
        'token'         => 'XXXXXXXXXXXXXXXXXXXXX',
        'transactionId' => '123456789',
        'authCode'      => '12345',
        'expMonth'      => '06',
        'expYear'       => '2016'
    ])->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        print $response->getMessage();
    }
} catch (Exception $e) {
    print $e->getMessage();
}
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/mfauveau/omnipay-safecharge/issues),
or better yet, fork the library and submit a pull request.
