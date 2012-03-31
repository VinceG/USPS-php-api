<?php

require_once('../USPSCityStateLookup.php');
$verify = new USPSCityStateLookup('735FREEL4879');
$verify->setTestMode(true);

$verify->addZipCode('91601');

print_r($verify->lookup());
print_r($verify->getArrayResponse());
if($verify->isSuccess()) {
	
	echo 'Done';
} else {
	echo 'Error: ' . $verify->getErrorMessage();
}