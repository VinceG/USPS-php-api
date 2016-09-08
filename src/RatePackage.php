<?php

namespace USPS;

/**
 * USPS Rate Package
 * used by the ups rate class to create packages represented as objects.
 *
 * @since  1.0
 *
 * @author Vincent Gabriel
 */
class RatePackage extends Rate
{
    /**
     * @var array - list of all packages added so far
     */
    protected $packageInfo = [];
    /**
     * Services constants.
     */
    const SERVICE_FIRST_CLASS = 'FIRST CLASS';
    const SERVICE_FIRST_CLASS_COMMERCIAL = 'FIRST CLASS COMMERCIAL';
    const SERVICE_FIRST_CLASS_HFP_COMMERCIAL = 'FIRST CLASS HFP COMMERCIAL';
    const SERVICE_PRIORITY = 'PRIORITY';
    const SERVICE_PRIORITY_COMMERCIAL = 'PRIORITY COMMERCIAL';
    const SERVICE_PRIORITY_HFP_COMMERCIAL = 'PRIORITY HFP COMMERCIAL';
    const SERVICE_EXPRESS = 'EXPRESS';
    const SERVICE_EXPRESS_COMMERCIAL = 'EXPRESS COMMERCIAL';
    const SERVICE_EXPRESS_SH = 'EXPRESS SH';
    const SERVICE_EXPRESS_SH_COMMERCIAL = 'EXPRESS SH COMMERCIAL';
    const SERVICE_EXPRESS_HFP = 'EXPRESS HFP';
    const SERVICE_EXPRESS_HFP_COMMERCIAL = 'EXPRESS HFP COMMERCIAL';
    const SERVICE_PARCEL = 'PARCEL';
    const SERVICE_MEDIA = 'MEDIA';
    const SERVICE_LIBRARY = 'LIBRARY';
    const SERVICE_ALL = 'ALL';
    const SERVICE_ONLINE = 'ONLINE';
    /**
     * First class mail type
     * required when you use one of the first class services.
     */
    const MAIL_TYPE_LETTER = 'LETTER';
    const MAIL_TYPE_FLAT = 'FLAT';
    const MAIL_TYPE_PARCEL = 'PARCEL';
    const MAIL_TYPE_POSTCARD = 'POSTCARD';
    const MAIL_TYPE_PACKAGE = 'PACKAGE';
    const MAIL_TYPE_PACKAGE_SERVICE = 'PACKAGE SERVICE';
    /**
     * Container constants.
     */
    const CONTAINER_VARIABLE = 'VARIABLE';
    const CONTAINER_FLAT_RATE_ENVELOPE = 'FLAT RATE ENVELOPE';
    const CONTAINER_PADDED_FLAT_RATE_ENVELOPE = 'PADDED FLAT RATE ENVELOPE';
    const CONTAINER_LEGAL_FLAT_RATE_ENVELOPE = 'LEGAL FLAT RATE ENVELOPE';
    const CONTAINER_SM_FLAT_RATE_ENVELOPE = 'SM FLAT RATE ENVELOPE';
    const CONTAINER_WINDOW_FLAT_RATE_ENVELOPE = 'WINDOW FLAT RATE ENVELOPE';
    const CONTAINER_GIFT_CARD_FLAT_RATE_ENVELOPE = 'GIFT CARD FLAT RATE ENVELOPE';
    const CONTAINER_FLAT_RATE_BOX = 'FLAT RATE BOX';
    const CONTAINER_SM_FLAT_RATE_BOX = 'SM FLAT RATE BOX';
    const CONTAINER_MD_FLAT_RATE_BOX = 'MD FLAT RATE BOX';
    const CONTAINER_LG_FLAT_RATE_BOX = 'LG FLAT RATE BOX';
    const CONTAINER_REGIONALRATEBOXA = 'REGIONALRATEBOXA';
    const CONTAINER_REGIONALRATEBOXB = 'REGIONALRATEBOXB';
    const CONTAINER_RECTANGULAR = 'RECTANGULAR';
    const CONTAINER_NONRECTANGULAR = 'NONRECTANGULAR';
    /**
     * Size constants.
     */
    const SIZE_LARGE = 'LARGE';
    const SIZE_REGULAR = 'REGULAR';

    /**
     * Set the service property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setService($value)
    {
        return $this->setField('Service', $value);
    }

    /**
     * Set the first class mail type property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setFirstClassMailType($value)
    {
        return $this->setField('FirstClassMailType', $value);
    }

    /**
     * Set the zip origin property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setZipOrigination($value)
    {
        return $this->setField('ZipOrigination', $value);
    }

    /**
     * Set the zip destination property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setZipDestination($value)
    {
        return $this->setField('ZipDestination', $value);
    }

    /**
     * Set the pounds property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setPounds($value)
    {
        return $this->setField('Pounds', $value);
    }

    /**
     * Set the ounces property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setOunces($value)
    {
        return $this->setField('Ounces', $value);
    }

    /**
     * Set the container property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setContainer($value)
    {
        return $this->setField('Container', $value);
    }

    /**
     * Set the size property.
     *
     * @param string|int $value
     *
     * @return object RatePackage
     */
    public function setSize($value)
    {
        return $this->setField('Size', $value);
    }

    /**
     * Add an element to the stack.
     *
     * @param string|int $key
     * @param string|int $value
     *
     * @return object USPSAddress
     */
    public function setField($key, $value)
    {
        $this->packageInfo[ucwords($key)] = $value;

        return $this;
    }

    /**
     * Returns a list of all the info we gathered so far in the current package object.
     *
     * @return array
     */
    public function getPackageInfo()
    {
        return $this->packageInfo;
    }
}
