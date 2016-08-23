<?php

namespace USPS;

/**
 * Class ServiceDeliveryCalculator.
 */
class ServiceDeliveryCalculator extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'SDCGetLocations';
    /**
     * @var array - route added so far.
     */
    protected $route = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function getServiceDeliveryCalculation()
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
     * @param      $mail_class      integer from 0 to 6 indicating the class of mail.
     *                              “0” = All Mail Classes
     *                              “1” = Express Mail
     *                              “2” = Priority Mail
     *                              “3” = First Class Mail
     *                              “4” = Standard Mail
     *                              “5” = Periodicals
     *                              “6” = Package Services
     * @param      $origin_zip      5 digit zip code.
     * @param      $destination_zip 5 digit zip code.
     * @param null $accept_date     string in the format dd-mmm-yyyy.
     * @param null $accept_time     string in the format HHMM.
     */
    public function addRoute($mail_class, $origin_zip, $destination_zip, $accept_date = null, $accept_time = null)
    {
        $route = [
            'MailClass'      => $mail_class,
            'OriginZIP'      => $origin_zip,
            'DestinationZIP' => $destination_zip,
        ];
        if (!empty($accept_date)) {
            $route['AcceptDate'] = $accept_date;
        }
        if (!empty($accept_time)) {
            $route['AcceptTime'] = $accept_time;
        }
        $this->route = $route;
    }
}
