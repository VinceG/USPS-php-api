<?php

require_once('../USPSRate.php');
$rate = new USPSRate;
$rate->setTestMode(true);
// Add package
$package = new USPSRatePackage;
$package->setService(USPSRatePackage::SERVICE_FIRST_CLASS);
$package->setFirstClassMailType(USPSRatePackage::MAIL_TYPE_LETTER);
$package->setZipOrigination(44106);
$package->setZipDestination(20770);
$package->setPounds(0);
$package->setOunces(3.5);
$package->setSize(USPSRatePackage::SIZE_REGULAR);
$package->setField('Machinable', true);

$rate->addPackage($package);

$package = new USPSRatePackage;
$package->setService(USPSRatePackage::SERVICE_FIRST_CLASS);
$package->setFirstClassMailType(USPSRatePackage::MAIL_TYPE_LETTER);
$package->setZipOrigination(44106);
$package->setZipDestination(20770);
$package->setPounds(0);
$package->setOunces(3.5);
$package->setSize(USPSRatePackage::SIZE_REGULAR);
$package->setField('Machinable', true);

$rate->addPackage($package);

$rate->getRate();
if($rate->isSuccess()) {
	echo 'Done';
} else {
	echo 'Error: ' . $rate->getErrorMessage();
}