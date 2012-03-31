<?php

class USPSAddress {
	protected $addressInfo = array();
	
	public function setAddress($value) {
		return $this->setField('Address2', $value);
	}
	
	public function setApt($value) {
		return $this->setField('Address1', $value);
	}
	
	public function setCity($value) {
		return $this->setField('City', $value);
	}
	
	public function setState($value) {
		return $this->setField('State', $value);
	}
	
	public function setZip4($value) {
		return $this->setField('Zip4', $value);
	}
	
	public function setZip5($value) {
		return $this->setField('Zip5', $value);
	}
	
	public function setFirmName($value) {
		return $this->setField('FirmName', $value);
	}	
	
	public function setField($key, $value) {
		$this->addressInfo[ ucwords($key) ] = $value;
		return $this;
	}
	
	public function getAddressInfo() {
		return $this->addressInfo;
	}
}