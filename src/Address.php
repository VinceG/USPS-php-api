<?php

namespace USPS;

/**
 * USPS Address Class
 * used across other class to create addresses represented as objects.
 *
 * @since  1.0
 *
 * @author Vincent Gabriel
 */
class Address
{
    /**
     * @var array list of all key=>value pairs we added so far for the current address
     */
    protected $addressInfo = [];

    /**
     * Set the address2 property.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setAddress($value)
    {
        return $this->setField('Address2', $value);
    }

    /**
     * Set the address1 property usually the apt or suit number.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setApt($value)
    {
        return $this->setField('Address1', $value);
    }

    /**
     * Set the city property.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setCity($value)
    {
        return $this->setField('City', $value);
    }

    /**
     * Set the state property.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setState($value)
    {
        return $this->setField('State', $value);
    }

    /**
     * Set the zip4 property - zip code value represented by 4 integers.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setZip4($value)
    {
        return $this->setField('Zip4', $value);
    }

    /**
     * Set the zip5 property - zip code value represented by 5 integers.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setZip5($value)
    {
        return $this->setField('Zip5', $value);
    }

    /**
     * Set the firmname property.
     *
     * @param string|int $value
     *
     * @return object Address
     */
    public function setFirmName($value)
    {
        return $this->setField('FirmName', $value);
    }

    /**
     * Add an element to the stack.
     *
     * @param string|int $key
     * @param string|int $value
     *
     * @return object Address
     */
    public function setField($key, $value)
    {
        $this->addressInfo[ucwords($key)] = $value;

        return $this;
    }

    /**
     * Returns a list of all the info we gathered so far in the current address object.
     *
     * @return array
     */
    public function getAddressInfo()
    {
        return $this->addressInfo;
    }
}
