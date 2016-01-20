<?php

// Initiate and set the username provided from usps
$verify = new \USPS\CityStateLookup('xxxx');

// During test mode this seems not to always work as expected
//$verify->setTestMode(true);

// Add the zip code we want to lookup the city and state
$verify->addZipCode('91730');

// Perform the call and print out the results
print_r($verify->lookup());
print_r($verify->getArrayResponse());

// Check if it was completed
if ($verify->isSuccess()) {
    echo 'Done';
} else {
    echo 'Error: ' . $verify->getErrorMessage();
}
