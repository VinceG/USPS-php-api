<?php
require_once('USPSBase.php');
class USPSRate extends USPSBase {
	protected $apiVersion = 'RateV4';
	
	protected $packages = array();
	
	public function getRate() {
		$this->doRequest();
	}
	
	public function getPostFields() {
		return $this->packages;
	}
	
	/**
	* Add Package
	*/
	public function addPackage(USPSRatePackage $data, $id=null) {
		$packageId = $id !== null ? $id : ((count($this->packages)+1));
		$this->packages['Package'][] = array_merge(array('@attributes' => array('ID' => $packageId)), $data->getPackageInfo());
	}
}

class USPSRatePackage extends USPSRate {
	protected $packageInfo = array();
	
	/** 
	 * Services constants
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
	 * required when you use one of the first class services
	 */
	const MAIL_TYPE_LETTER = 'LETTER'; 
	const MAIL_TYPE_FLAT = 'FLAT'; 
	const MAIL_TYPE_PARCEL = 'PARCEL'; 
	const MAIL_TYPE_POSTCARD = 'POSTCARD'; 
	const MAIL_TYPE_PACKAGE_SERVICE = 'PACKAGE SERVICE'; 
	
	/**
	 * Container constants
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
	const CONTAINER_REGIONALRATEBOXC = 'REGIONALRATEBOXC';
	const CONTAINER_RECTANGULAR = 'RECTANGULAR';
	const CONTAINER_NONRECTANGULAR = 'NONRECTANGULAR';
	
	/**
	 * Size constants
	 */
	const SIZE_LARGE = 'LARGE';
	const SIZE_REGULAR = 'REGULAR';
	
	public function setService($service) {
		return $this->setField('Service', $service);
	}
	
	public function setFirstClassMailType($type) {
		return $this->setField('FirstClassMailType', $type);
	}
	
	public function setZipOrigination($zip) {
		return $this->setField('ZipOrigination', $zip);
	}
	
	public function setZipDestination($zip) {
		return $this->setField('ZipDestination', $zip);
	}
	
	public function setPounds($pounds) {
		return $this->setField('Pounds', $pounds);
	}
	
	public function setOunces($ounces) {
		return $this->setField('Ounces', $ounces);
	}
	
	public function setContainer($container) {
		return $this->setField('Container', $container);
	}
	
	public function setSize($size) {
		return $this->setField('Size', $size);
	}
	
	public function setField($key, $value) {
		$this->packageInfo[ ucwords($key) ] = $value;
		return $this;
	}
	
	public function getPackageInfo() {
		return $this->packageInfo;
	}
}