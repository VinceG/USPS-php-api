<?php
/**
 * Load required classes
 */
require_once('USPSBase.php');
require_once('USPSAddress.php');
/**
 * USPS Zip code lookup by city/state
 * used to find a zip code by city/state lookup
 * @since 1.0
 * @author Vincent Gabriel
 */
class USPSZipCodeLookup extends USPSBase {
  /**
   * @var string - the api version used for this type of call
   */
  protected $apiVersion = 'ZipCodeLookup';
  /**
   * @var array - list of all addresses added so far
   */
  protected $addresses = array();
  /**
   * Perform the API call
   * @return string
   */
  public function lookup() {
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
