<?php
/**
 * Load required classes
 */
require_once('USPSBase.php');
require_once('USPSAddress.php');

/**
 * USPS Address Verify Class
 * used to verify an address is valid
 * @since 1.0
 * @author Vincent Gabriel
 */
class USPSAddressVerify extends USPSBase {
	/**
	 * @var string - the api version used for this type of call
	 */
	protected $apiVersion = 'Verify';
	/**
	 * @var array - list of all addresses added so far
	 */
	protected $addresses = array();
	/**
	 * Perform the API call to verify the address
	 * @return string
	 */
	public function verify() {
		return $this->doRequest();
	}
	/**
	 * returns array of all addresses added so far
	 * @return array
	 */
	public function getPostFields() {
		return $this->addresses;
	}
	/**
	 * Add Address to the stack
	 * @param USPSAddress object $data
	 * @param string $id the address unique id
	 * @return void
	 */
	public function addAddress(USPSAddress $data, $id=null) {
		$packageId = $id !== null ? $id : ((count($this->addresses)+1));
		$this->addresses['Address'][] = array_merge(array('@attributes' => array('ID' => $packageId)), $data->getAddressInfo());
	}
}