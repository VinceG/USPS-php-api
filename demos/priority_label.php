<?php

// Initiate and set the username provided from usps
$label = new \USPS\PriorityLabel('xxxx');

// During test mode this seems not to always work as expected
$label->setTestMode(true);

$label->setFromAddress('John', 'Doe', '', '5161 Lankershim Blvd', 'North Hollywood', 'CA', '91601', '# 204', '', '8882721214');
$label->setToAddress('Vincent', 'Gabriel', '', '230 Murray St', 'New York', 'NY', '10282');
$label->setWeightOunces(1);
$label->setField(36, 'LabelDate', '03/12/2014');

//$label->setField(32, 'SeparateReceiptPage', 'true');

// Perform the request and return result
$label->createLabel();

//print_r($label->getArrayResponse());
//print_r($label->getPostData());
//var_dump($label->isError());

// See if it was successful
if ($label->isSuccess()) {
    //echo 'Done';
    //echo "\n Confirmation:" . $label->getConfirmationNumber();

    $label = $label->getLabelContents();

    if ($label) {
        $contents = base64_decode($label);
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="label.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($contents));
        echo $contents;
        exit;
    }
} else {
    echo 'Error: ' . $label->getErrorMessage();
}
