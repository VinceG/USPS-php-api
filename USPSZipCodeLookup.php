<?php
require_once('USPSBase.php');
require_once('USPSAddress.php');
class USPSZipCodeLookup extends USPSBase {
	protected $apiVersion = 'ZipCodeLookup';
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
	public function addAddress(USPSAddress $data, $id=null) {
		$packageId = $id !== null ? $id : ((count($this->addresses)+1));
		$this->addresses['Address'][] = array_merge(array('@attributes' => array('ID' => $packageId)), $data->getAddressInfo());
	}
}