<?php

// Initiate and set the username provided from usps
$delivery = new \USPS\ServiceDeliveryCalculator('xxxx');

// During test mode this seems not to always work as expected
$delivery->setTestMode(true);

// Add the zip code we want to lookup the city and state
$delivery->addRoute(3, '91730', '90025');

// Perform the call and print out the results
var_dump($delivery->getServiceDeliveryCalculation());
var_dump($delivery->getArrayResponse());


// Check if it was completed
if ($delivery->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $delivery->getErrorMessage();
}
