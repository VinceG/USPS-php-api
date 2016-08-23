<?php

namespace USPS;

/**
 * Class PriorityMailServiceStandards.
 */
class PriorityMailServiceStandards extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'PriorityMail';
    /**
     * @var array - route added so far.
     */
    protected $route = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function getServiceStandard()
    {
        return $this->doRequest();
    }

    /**
     * returns array of all routes added so far.
     *
     * @return array
     */
    public function getPostFields()
    {
        return $this->route;
    }

    /**
     * Add route to the stack.
     *
     * @param $origin_zip
     * @param $destination_zip
     */
    public function addRoute($origin_zip, $destination_zip)
    {
        $this->route = [
            'OriginZip'      => $origin_zip,
            'DestinationZip' => $destination_zip,
        ];
    }
}
