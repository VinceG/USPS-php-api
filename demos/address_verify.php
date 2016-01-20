<?php

// Initiate and set the username provided from usps
$verify = new \USPS\AddressVerify('xxxx');

// During test mode this seems not to always work as expected
//$verify->setTestMode(true);

// Create new address object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
$address = new \USPS\Address;
$address->setFirmName('Apartment');
$address->setApt('100');
$address->setAddress('9200 Milliken Ave');
$address->setCity('Rancho Cucomonga');
$address->setState('CA');
$address->setZip5(91730);
$address->setZip4('');

// Add the address object to the address verify class
$verify->addAddress($address);

// Perform the request and return result
print_r($verify->verify());
print_r($verify->getArrayResponse());

var_dump($verify->isError());

// See if it was successful
if ($verify->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $verify->getErrorMessage();
}
