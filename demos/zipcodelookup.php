<?php

require_once('../USPSZipCodeLookup.php');
$verify = new USPSZipCodeLookup('735FREEL4879');
$verify->setTestMode(true);

$address = new USPSAddress;
$address->setFirmName('Apartment');
$address->setApt('707');
$address->setAddress('5440 Tujunga Ave');
$address->setCity('North Hollywood');
$address->setState('CA');

$verify->addAddress($address);

print_r($verify->lookup());
print_r($verify->getArrayResponse());
if($verify->isSuccess()) {
	
	echo 'Done';
} else {
	echo 'Error: ' . $verify->getErrorMessage();
}