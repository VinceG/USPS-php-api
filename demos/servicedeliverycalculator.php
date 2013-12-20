<?php
// Load the class
require_once('../USPSServiceDeliveryCalculator.php');

// Initiate and set the username provided from usps
$delivery = new USPSServiceDeliveryCalculator('xxxx');

// During test mode this seems not to always work as expected
$delivery->setTestMode(true);

// Add the zip code we want to lookup the city and state
$delivery->addRoute(3, '91730', '90025');

// Perform the call and print out the results
var_dump($delivery->getServiceDeliveryCalculation());
$foo = $delivery->getArrayResponse();
var_dump($foo);
var_dump($foo['SDCGetLocationsResponse']['NonEM'][0]['SchedDlvryDate']);

// Check if it was completed
if($delivery->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $delivery->getErrorMessage();
}
