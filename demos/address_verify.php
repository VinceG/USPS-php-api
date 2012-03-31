<?php

require_once('../USPSAddressVerify.php');
$verify = new USPSAddressVerify('735FREEL4879');
$verify->setTestMode(true);

$address = new USPSAddress;
$address->setFirmName('Apartment');
$address->setApt('707');
$address->setAddress('5440 Tujunga Ave');
$address->setCity('North Hollywood');
$address->setState('CA');
$address->setZip5(91601);
$address->setZip4('');

$verify->addAddress($address);

print_r($verify->verify());
print_r($verify->getArrayResponse());
if($verify->isSuccess()) {
	
	echo 'Done';
} else {
	echo 'Error: ' . $verify->getErrorMessage();
}