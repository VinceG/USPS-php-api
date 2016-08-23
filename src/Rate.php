<?php

namespace USPS;

/**
 * USPS Rate calculator class
 * used to get a rate for shipping methods.
 *
 * @since  1.0
 *
 * @author Vincent Gabriel
 */
class Rate extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'RateV4';
    /**
     * @var array - list of all addresses added so far
     */
    protected $packages = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function getRate()
    {
        return $this->doRequest();
    }

    /**
     * returns array of all packages added so far.
     *
     * @return array
     */
    public function getPostFields()
    {
        return $this->packages;
    }

    /**
     * sets the type of call to perform domestic or international.
     *
     * @param $status
     *
     * @return array
     */
    public function setInternationalCall($status)
    {
        $this->apiVersion = $status === true ? 'IntlRateV2' : 'RateV4';
    }

    /**
     * Add other option for International & Insurance.
     *
     * @param string|int $key
     * @param string|int $value
     */
    public function addExtraOption($key, $value)
    {
        $this->packages[$key][] = $value;
    }

    /**
     * Add Package to the stack.
     *
     * @param RatePackage $data
     * @param string      $id   the address unique id
     */
    public function addPackage(RatePackage $data, $id = null)
    {
        $packageId = $id !== null ? $id : ((count($this->packages) + 1));

        $this->packages['Package'][] = array_merge(['@attributes' => ['ID' => $packageId]], $data->getPackageInfo());
    }
}
