<?php

namespace USPS;

/**
 * USPS Zip code lookup by city/state
 * used to find a zip code by city/state lookup.
 *
 * @since  1.0
 *
 * @author Vincent Gabriel
 */
class ZipCodeLookup extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'ZipCodeLookup';
    /**
     * @var array - list of all addresses added so far
     */
    protected $addresses = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function lookup()
    {
        return $this->doRequest();
    }

    /**
     * returns array of all addresses added so far.
     *
     * @return array
     */
    public function getPostFields()
    {
        return $this->addresses;
    }

    /**
     * Add Address to the stack.
     *
     * @param Address $data
     * @param string  $id   the address unique id
     */
    public function addAddress(Address $data, $id = null)
    {
        $packageId = $id !== null ? $id : ((count($this->addresses) + 1));

        $this->addresses['Address'][] = array_merge(['@attributes' => ['ID' => $packageId]], $data->getAddressInfo());
    }
}
