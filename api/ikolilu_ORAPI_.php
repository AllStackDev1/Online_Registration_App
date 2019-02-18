<?php
	class CreateFunction 
	{
		private $apiPathURL;
		
		function __construct($apiPathURL)
		{

			$this->apiPathURL = $apiPathURL;

		}

		function GetEndPoint()
		{
			if($this->apiPathURL){
				$this->requestinfo = explode('/',$this->apiPathURL);
				$this->endpoint = $this->requestinfo[6];
				return $this->endpoint;
			}
		}
	}
