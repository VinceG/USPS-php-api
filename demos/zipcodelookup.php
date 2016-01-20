<?php

// Initiate and set the username provided from usps
$zipcode = new \USPS\ZipCodeLookup('xxxx');

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

// Add the address object to the zipcode lookup class
$zipcode->addAddress($address);

// Perform the call and print out the results
print_r($zipcode->lookup());
print_r($zipcode->getArrayResponse());

// Check if it was completed
if ($zipcode->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $zipcode->getErrorMessage();
}
