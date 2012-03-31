<?php
require_once('USPSBase.php');
class USPSCityStateLookup extends USPSBase {
	protected $apiVersion = 'CityStateLookup';
	protected $addresses = array();
	public function lookup() {
		$this->doRequest();
	}
	
	public function getPostFields() {
		return $this->addresses;
	}
	/**
	* Add Address
	*/
	public function addZipCode($zip5, $zip4='', $id=null) {
		$packageId = $id !== null ? $id : ((count($this->addresses)+1));
		$this->addresses['ZipCode'][] = array_merge(array('@attributes' => array('ID' => $packageId)), array('Zip5' => $zip5, 'Zip4' => $zip4));
	}
}