<?php
require_once('USPSBase.php');
require_once('USPSAddress.php');
class USPSAddressVerify extends USPSBase {
	protected $apiVersion = 'Verify';
	protected $addresses = array();
	public function verify() {
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