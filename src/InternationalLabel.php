<?php

namespace USPS;

/**
 * Class InternationalLabel.
 */
class InternationalLabel extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'ExpressMailIntl';
    /**
     * @var array - route added so far.
     */
    protected $fields = [];

    protected $contents = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function createLabel()
    {
        // Add contents
        if ($this->contents && count($this->contents)) {
            $this->setField(31, 'ShippingContents', $this->contents);
        }

        // Add missing required
        $this->addMissingRequired();

        // Sort them
        // Hack by the only way this will work properly
        // since usps wants the tags to be in
        // a certain order
        ksort($this->fields, SORT_NUMERIC);

        // remove the \d. from the key
        foreach ($this->fields as $key => $value) {
            $newKey = str_replace('.', '', $key);
            $newKey = preg_replace('/\d+\:/', '', $newKey);
            unset($this->fields[$key]);
            $this->fields[$newKey] = $value;
        }

        return $this->doRequest();
    }

    /**
     * Return the USPS confirmation/tracking number if we have one.
     *
     * @return string|bool
     */
    public function getConfirmationNumber()
    {
        $response = $this->getArrayResponse();
        // Check to make sure we have it
        if (isset($response[$this->getResponseApiName()])) {
            if (isset($response[$this->getResponseApiName()]['BarcodeNumber'])) {
                return $response[$this->getResponseApiName()]['BarcodeNumber'];
            }
        }

        return false;
    }

    /**
     * Return the USPS label as a base64 encoded string.
     *
     * @return string|bool
     */
    public function getLabelContents()
    {
        $response = $this->getArrayResponse();
        // Check to make sure we have it
        if (isset($response[$this->getResponseApiName()])) {
            if (isset($response[$this->getResponseApiName()]['LabelImage'])) {
                return $response[$this->getResponseApiName()]['LabelImage'];
            }
        }

        return false;
    }

    /**
     * returns array of all fields added.
     *
     * @return array
     */
    public function getPostFields()
    {
        return $this->fields;
    }

    /**
     * Add shipping contents.
     *
     * @param      $description
     * @param      $value
     * @param      $pounds
     * @param      $ounces
     * @param int  $quantity
     * @param null $tarrifNumber
     * @param null $countryOfOrigin
     *
     * @return object
     */
    public function addContent(
        $description,
        $value,
        $pounds,
        $ounces,
        $quantity = 1,
        $tarrifNumber = null,
        $countryOfOrigin = null
    ) {
        $this->contents['ItemDetail'][] = [
            'Description'     => $description,
            'Quantity'        => $quantity,
            'Value'           => $value,
            'NetPounds'       => $pounds,
            'NetOunces'       => $ounces,
            'HSTariffNumber'  => $tarrifNumber,
            'CountryOfOrigin' => $countryOfOrigin,
        ];

        return $this;
    }

    /**
     * Set the from address.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $address2
     * @param string $zip4
     * @param string $phone
     * @param string $middleName
     *
     * @return object
     */
    public function setFromAddress(
        $firstName,
        $lastName,
        $company,
        $address,
        $city,
        $state,
        $zip,
        $address2 = null,
        $zip4 = null,
        $phone = null,
        $middleName = null
    ) {
        $this->setField(5, 'FromFirstName', $firstName);
        $this->setField(6, 'FromMiddleInitial', $middleName);
        $this->setField(7, 'FromLastName', $lastName);
        $this->setField(8, 'FromFirm', $company);
        $this->setField(9, 'FromAddress1', $address2);
        $this->setField(10, 'FromAddress2', $address);
        $this->setField(11, 'FromCity', $city);
        $this->setField(12, 'FromState', $state);
        $this->setField(13, 'FromZip5', $zip);
        $this->setField(14, 'FromZip4', $zip4);
        $this->setField(15, 'FromPhone', $phone);

        return $this;
    }

    /**
     * Set the to address.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $province
     * @param string $country
     * @param string $zip
     * @param string $address2
     * @param string $poBoxFlag
     * @param string $phone
     * @param null   $fax
     * @param null   $email
     *
     * @return object
     *
     * @internal param string $state
     * @internal param string $zip4
     */
    public function setToAddress(
        $firstName,
        $lastName,
        $company,
        $address,
        $city,
        $province,
        $country,
        $zip,
        $address2 = null,
        $poBoxFlag = 'N',
        $phone = null,
        $fax = null,
        $email = null
    ) {
        $this->setField(16, 'ToFirstName', $firstName);
        $this->setField(17, 'ToLastName', $lastName);
        $this->setField(18, 'ToFirm', $company);
        $this->setField(19, 'ToAddress1', $address2);
        $this->setField(20, 'ToAddress2', $address);
        $this->setField(21, 'ToCity', $city);
        $this->setField(22, 'ToProvince', $province);
        $this->setField(23, 'ToCountry', $country);
        $this->setField(24, 'ToPostalCode', $zip);
        $this->setField(25, 'ToPOBoxFlag', $poBoxFlag);
        $this->setField(26, 'ToPhone', $phone);
        $this->setField(27, 'ToFax', $fax);
        $this->setField(28, 'ToEmail', $email);

        return $this;
    }

    /**
     * Set any other requried string make sure you set the correct position as well
     * as the position of the items matters.
     *
     * @param int    $position
     * @param string $key
     * @param string $value
     *
     * @return object
     */
    public function setField($position, $key, $value)
    {
        $this->fields[$position.':'.$key] = $value;

        return $this;
    }

    /**
     * Set package weight in ounces.
     *
     * @param $weight
     *
     * @return $this
     */
    public function setWeightOunces($weight)
    {
        $this->setField(33, 'GrossOunces', $weight);

        return $this;
    }

    /**
     * Set package weight in ounces.
     *
     * @param $weight
     *
     * @return $this
     */
    public function setWeightPounds($weight)
    {
        $this->setField(32, 'GrossPounds', $weight);

        return $this;
    }

    /**
     * Add missing required elements.
     *
     * @return void
     */
    protected function addMissingRequired()
    {
        $required = [
            '1:Option'           => '',
            '1.1:Revision'       => '2',
            '4:ImageParameters'  => '',
            '30:Container'       => 'NONRECTANGULAR',
            '32:GrossPounds'     => '',
            '33:GrossOunces'     => '',
            '34:ContentType'     => 'Documents',
            '35:Agreement'       => 'Y',
            '36:ImageType'       => 'PDF',
            '37:ImageLayout'     => 'ALLINONEFILE',
            '38:POZipCode'       => '',
            '39:LabelDate'       => '',
            '40:HoldForManifest' => 'N',
            '41:Size'            => 'LARGE',
            '42:Length'          => '',
            '43:Width'           => '',
            '44:Height'          => 'false',
            '45:Girth'           => '',
        ];

        // We need to add additional fields based on api we are using
        switch ($this->apiVersion) {
            case 'ExpressMailIntl':
                $required = array_merge($required, [
                    '29:NonDeliveryOption' => 'Return',
                ]);
                break;
            case 'PriorityMailIntl':
                $required = array_merge($required, [
                    '29:NonDeliveryOption' => 'Return',
                    '31.1:Insured'         => 'N',
                    '40.1:EELPFC'          => '',
                ]);
                break;
            case 'FirstClassMailIntl':
                $required = array_merge($required, [
                    '30.1:FirstClassMailType' => 'PARCEL',
                    '31.1:Insured'            => 'N',
                    '33.1:Machinable'         => 'false',
                    '40.1:EELPFC'             => '',
                ]);
                break;
        }

        foreach ($required as $item => $value) {
            $explode = explode(':', $item);
            if (!isset($this->fields[$item])) {
                $this->setField($explode[0], $explode[1], $value);
            }
        }
    }
}
