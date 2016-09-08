<?php

require_once('autoload.php');

use USPS\RatePackage;

$rate = new \USPS\Rate('xxxx');
$rate->setInternationalCall(true);
$rate->addExtraOption('Revision', 2);

$package = new RatePackage;
$package->setPounds(15.12345678);
$package->setOunces(0);
$package->setField('Machinable', 'True');
$package->setField('MailType', 'Package');
$package->setField('GXG', array(
  'POBoxFlag' => 'Y',
  'GiftFlag' => 'Y'
));
$package->setField('ValueOfContents', 200);
$package->setField('Country', 'Australia');
$package->setField('Container', 'RECTANGULAR');
$package->setField('Size', 'LARGE');
$package->setField('Width', 10);
$package->setField('Length', 15);
$package->setField('Height', 10);
$package->setField('Girth', 0);
$package->setField('OriginZip', 18701);
$package->setField('CommercialFlag', 'N');
$package->setField('AcceptanceDateTime', '2016-07-05T13:15:00-06:00');
$package->setField('DestinationPostalCode', '2046');

// add the package to the rate stack
$rate->addPackage($package);
// Perform the request and print out the result
print_r($rate->getRate());
print_r($rate->getArrayResponse());
// Was the call successful
if ($rate->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $rate->getErrorMessage();
}