<?php
require_once('XMLParser.php');

class USPSBase {
	protected $username = '735FREEL4879';
	protected $password = '';
	/**
	 *  the error code if one exists
	 * @var integer
	 */
	protected $errorCode = 0;
	/**
	 * the error message if one exists
	 * @var string 
	 */
	protected $errorMessage = '';
	/**
	 *  the response message
	 * @var string
	 */
	protected $response = '';
	/**
	 *  the headers returned from the call made
	 * @var array
	 */
	protected $headers = '';
	protected $arrayResponse = array();
	protected $postFields = array();
	protected $apiVersion = '';
	
	public static $testMode = false;
	
	/**
	 * Default options for curl.
     */
	public static $CURL_OPTS = array(
	    CURLOPT_CONNECTTIMEOUT => 30,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_TIMEOUT        => 60,
	    CURLOPT_FRESH_CONNECT  => 1,
		CURLOPT_PORT		   => 80,
	    CURLOPT_USERAGENT      => 'usps-php',
	    CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_RETURNTRANSFER => true,
	  );
	
	protected function getXMLString() {
		// Add in the defaults
		$postFields = array(
			'@attributes' => array('USERID' => $this->username),
			'revision' => null,
		);
		
		// Add in the sub class data
		$postFields = array_merge($postFields, $this->getPostFields());
		
		$xml = XMLParser::createXML('RateV2Request', $postFields);
		print_r($xml->saveXML());
		return $xml->saveXML();
	}
	
	public function getPostData() {
		$fields = array('API' => $this->apiVersion, 'XML' => $this->getXMLString());
		return $fields;
	}
	
	public function setTestMode($value) {
		self::$testMode = (bool) $value;
	}
	
	/**
   	* Makes an HTTP request. This method can be overriden by subclasses if
   	* developers want to do fancier things or use something other than curl to
   	* make the request.
   	*
   	* @param String the URL to make the request to
   	* @param Array the parameters to use for the POST body
   	* @param CurlHandler optional initialized curl handle
   	* @return String the response text
   	*/
  	protected function doRequest($url, $ch=null) 
	{
    	if (!$ch) {
      		$ch = curl_init();
    	}
		
    	$opts = self::$CURL_OPTS;
    	$opts[CURLOPT_POSTFIELDS] = http_build_query($this->getPostData(), null, '&');
    	$opts[CURLOPT_URL] = $url;

		print_r($opts);
		
		// set options
		curl_setopt_array($ch, $opts);

		// execute
		$this->setResponse( curl_exec($ch) );
		$this->setHeaders( curl_getinfo($ch) );

		// fetch errors
		$this->setErrorCode( curl_errno($ch) );
		$this->setErrorMessage( curl_error($ch) );

		// Convert response to array
		$this->convertResponseToArray();
		
		// If it failed then set error code and message
		if($this->isError()) {
			$arrayResponse = $this->getArrayResponse();
			$this->setErrorCode( $arrayResponse['Error']['Number'] );
			$this->setErrorMessage( $arrayResponse['Error']['Description'] );
		}

		// close
		curl_close($ch);
		
		return $this->getResponse();
    }
	
	public function isError() {
		$headers = $this->getHeaders();
		$response = $this->getArrayResponse();
		// First make sure we got a valid response
		if($headers['http_code'] != 200) {
			return true;
		}
		
		// Make sure the response does not have error in it
		if(isset($response['Error'])) {
			return true;
		}
		
		// No error
		return false;
	}
	
	public function isSuccess() {
		return !$this->isError() ? true : false;
	}
	
	public function convertResponseToArray() {
		if($this->getResponse()) {
			$this->setArrayResponse(XML2Array::createArray($this->getResponse()));
		}
	}
	
	public function setArrayResponse($value) {
		$this->arrayResponse = $value;
	}
	
	public function getArrayResponse() {
		return $this->arrayResponse;
	}
	
	/**
	 * Set the response
	 *
	 * @param mixed the response returned from the call
	 * @return facebookLib object
	 */
	public function setResponse( $response='' )
	{
		$this->response = $response;
		return $this;
	}
	/**
	 * Get the response data
	 * 
	 * @return mixed the response data
	 */
	public function getResponse()
	{
		return $this->response;
	}
	/**
	 * Set the headers
	 *
	 * @param array the headers array
	 * @return facebookLib object
	 */
	public function setHeaders( $headers='' )
	{
		$this->headers = $headers;
		return $this;
	}
	/**
	 * Get the headers
	 * 
	 * @return array the headers returned from the call
	 */
	public function getHeaders()
	{
		return $this->headers;
	}
	/**
	 * Set the error code number
	 *
	 * @param integer the error code number
	 * @return facebookLib object
	 */
	public function setErrorCode($code=0)
	{
		$this->errorCode = $code;
		return $this;
	}
	/**
	 * Get the error code number
	 * 
	 * @return integer error code number
	 */
	public function getErrorCode()
	{
		return $this->errorCode;
	}
	/**
	 * Set the error message
	 *
	 * @param string the error message
	 * @return facebookLib object
	 */
	public function setErrorMessage($message='')
	{
		$this->errorMessage = $message;
		return $this;
	}
	/**
	 * Get the error code message
	 * 
	 * @return string error code message
	 */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}
}