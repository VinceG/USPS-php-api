<?php

// Initiate and set the username provided from usps.
$delivery = new \USPS\FirstClassServiceStandards('xxxx');

// During test mode this seems not to always work as expected.
$delivery->setTestMode(true);

// Add the zip codes we want to know a shipping time between.
$delivery->addRoute('91730', '90025');

// Perform the call and print out the results.
var_dump($delivery->getServiceStandard());
var_dump($delivery->getArrayResponse());

// Check if it was completed
if ($delivery->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $delivery->getErrorMessage();
}
