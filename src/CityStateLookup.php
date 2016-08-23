<?php

namespace USPS;

/*
 * USPS City/State lookup
 * used to find a city/state by a zipcode lookup
 * @since 1.0
 * @author Vincent Gabriel
 */
class CityStateLookup extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'CityStateLookup';
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
     * Add zip zip code to the stack.
     *
     * @param string $zip5 - zip code 5 integers
     * @param string $zip4 - optional 4 integers zip code
     * @param string $id   the address unique id
     *
     * @return void
     */
    public function addZipCode($zip5, $zip4 = '', $id = null)
    {
        $packageId = $id !== null ? $id : ((count($this->addresses) + 1));
        $zipCodes = ['Zip5' => $zip5];
        if ($zip4) {
            $zipCodes['Zip4'] = $zip4;
        }
        $this->addresses['ZipCode'][] = array_merge(['@attributes' => ['ID' => $packageId]], $zipCodes);
    }
}
