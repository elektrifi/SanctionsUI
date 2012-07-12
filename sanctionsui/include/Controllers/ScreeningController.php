<?php

	function do_post_request_fopen($url, $data, $optional_headers= NULL) {
				
  		$params = array(	'http' => array(
       			      		'method' => 'POST',
           					'content' => $data
		            	));
  		if ($optional_headers !== null) {
	   		$params['http']['header'] = $optional_headers;
  		}
  		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
  		if (!$fp) {
    		throw new Exception("Problem with $url, $php_errormsg");
  		}
  		$response = @stream_get_contents($fp);
  		if ($response === false) {
	   		throw new Exception("Problem reading data from $url, $php_errormsg");
  		}
  			
		return $response;
	}

	function do_post_request_curl($url, $data, $optional_headers = NULL) {

       	set_time_limit(10);
       	// Get a session called $ch
        $ch = curl_init($url);
        
		$headers = array(
  				//"Expect:",
				//"Content-Type: application/xml"
				"POST /HTTP/1.1",
				//"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
				"Content-type: application/xml;charset=\"utf-8\"",
				//"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",            "Accept-Language: en-us,en;q=0.5",
				//"Accept-Encoding: gzip,deflate",
				//"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
				"Keep-Alive: 300",      
				"Connection: keep-alive"
		);		
		// An array of HTTP header fields to set, in the format of  
		// array('Content-type: text/plain', 'Content-length: 100') etc 		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

		// Set length of wait (in secs) for connection 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		
		// We want the content back
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // We want to forbid reuse
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        
        // The URL to fetch
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Don't check the hosts SSL certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Dont check for common name in SSL peer certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // TBC
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2678400);

        // Default is GET, we don't want this, we want PUT instead
        curl_setopt($ch, CURLOPT_HTTPGET, false );
        curl_setopt($ch, CURLOPT_POST, true );
        
        // Only for debugging please...
        curl_setopt($ch, CURLOPT_NOPROGRESS, false );
        
        // We want HTTP Headers back (e.g. for checking)
        curl_setopt($ch, CURLOPT_HEADER, true );
                                                       
		// Add the POST data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);        
                
        $buf = "";
        $buf = curl_exec($ch);
                
		// echo $buf;                
       	if($buf == ""){
        	$buf = '<?xml version="1.0" ?><error><statusMessage>POST error: Cannot reach Elektrifi server.</statusMessage></error>'; 
       	}
	    // echo "<pre>";
	    // print_r($params["http"]["content"]);
	    
       	$headers = curl_getinfo( $ch );
       	
       	$output = array();
       	$output[0] = $headers;
       	$output[1] = $buf;

		curl_close( $ch );
    	//return $buf;			

		// Debug if needed
		//$logger = Zend_Registry::get('logger');
  		//$logger->log('Headers are...' . var_dump($headers), Zend_Log::INFO);
  		//$logger->log('Response is...' . var_dump($buf), Zend_Log::INFO);
  				
    	return $output;
	}

	function do_get_request_curl($url, $optional_headers = NULL) {

       	set_time_limit(10);
       	// Get a session called $ch
        $ch = curl_init($url);
        
		$headers = array(
  				//"Expect:",
				//"Content-Type: application/xml"
				"GET /HTTP/1.1",
				//"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
				"Content-Type: application/xml;charset=\"utf-8\"",
				//"Content-Type: application/json;charset=\"utf-8\"",
				//"Accept: application/json",
				"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",            "Accept-Language: en-us,en;q=0.5",
				//"Accept-Encoding: gzip,deflate",
				//"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
				"Keep-Alive: 300",      
				"Connection: keep-alive"
		);		
		// An array of HTTP header fields to set, in the format of  
		// array('Content-type: text/plain', 'Content-length: 100') etc 		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

		// Set length of wait (in secs) for connection 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		
		// We want the content back
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // We want to forbid reuse
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        
        // The URL to fetch
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Don't check the hosts SSL certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Dont check for common name in SSL peer certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // TBC
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2678400);

        // Default is GET, we don't want this, we want PUT instead
        curl_setopt($ch, CURLOPT_HTTPGET, true );
        curl_setopt($ch, CURLOPT_POST, false );
        
        // Only for debugging please...
        curl_setopt($ch, CURLOPT_NOPROGRESS, false );
        
        // We want HTTP Headers back (e.g. for checking)
        curl_setopt($ch, CURLOPT_HEADER, true );
                                                       
        $buf = "";
        $buf = curl_exec($ch);
                
        //curl_close( $ch );
		// echo $buf;                
       	if($buf == ""){
        	$buf = '<?xml version="1.0" ?><error><statusMessage>GET error: Cannot reach Elektrifi server.</statusMessage></error>'; 
       	}
	    // echo "<pre>";
	    // print_r($params["http"]["content"]);

       	$headers = curl_getinfo( $ch );
       	
       	$output = array();
       	$output[0] = $headers;
       	$output[1] = $buf;

		curl_close( $ch );
    	//return $buf;			
    	
		// Debug if needed
		//$logger = Zend_Registry::get('logger');
  		//$logger->log('Headers are...' . var_dump($headers), Zend_Log::INFO);
  		//$logger->log('Response is...' . var_dump($buf), Zend_Log::INFO);
  						
    	return $output;       			
	}
	
	class ScreeningController extends CustomControllerAction
    {    	
    	var $response;
    	
        public function init()
        {
            parent::init();
            $this->breadcrumbs->addStep('Screening', $this->getUrl(null, 'screening'));

			//Zend_Registry::get('logger')->info('screening index init log message');

            // DOJO Data Grid..
            // See http://ossigeno.sourceforge.net/blog/content/article/how-to-integrate-a-dojo-data-grid-in-zend-framework
            
        }

        public function indexAction()
        {
            // nothing to do here, index.tpl will be displayed
            
            //Zend_Registry::get('logger')->info('testing screening index log message');
            $logger = Zend_Registry::get('logger');
          	$logger->setEventItem('module', $this->getRequest()->getModuleName());
          	$logger->setEventItem('controller', $this->getRequest()->getControllerName());
          	$logger->log('==============================================', Zend_Log::INFO);
        	$logger->log('screening index was called', Zend_Log::INFO);
            
        }
		
        public function checkadhocAction()
        {      
        	// Logging  	        
        	$logger = Zend_Registry::get('logger');
          	$logger->setEventItem('module', $this->getRequest()->getModuleName());
          	$logger->setEventItem('controller', $this->getRequest()->getControllerName());        	        	
        	
          	// Get all the details (all the data associated with the user's request)
        	$request = $this->getRequest();

        	// Prepare to do some integrity checking
        	$fp = new FormProcessor_ScreeningAdhoc($this);
        	
        	// Look for the POST request
        	if ($request->isPost()) {
        		
        		// If the request is kosher...
        		if ($fp->process($request)) {
        			
        			// Set up a session to store the user and results in
					$session = new Zend_Session_Namespace('checkadhoc');
					
					// Add the user_id to the session
					//$session->user_id = load($session->user_id);
					
        			// send the request to the service
					$url	= Zend_Registry::get('config')->rest->checkadhocurl;
					//$ch 	= curl_init($url);
					
					// ====== START OF DEBUG
					//$url =  'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction';
    				// The request parameters 
    				//$appid = 'YahooDemo'; 
    				//$context = 'Italian sculptors and painters of the renaissance favored the Virgin Mary for inspiration'; 
    				//$query = 'madonna'; 
				    // urlencode and concatenate the POST arguments 
				    //$data = 'appid='.$appid.'&context='.urlencode($context).'&query='.urlencode($query);
    				// ======= END OF DEBUG 
    				
        			$data 	= $fp->adhocname;
					$optional_headers = "application/xml";	
        			
					
					$responsearray = array();
					//$this->response = do_post_request_curl($url, $data, $optional_headers);
					$responsearray = do_post_request_curl($url, $data, $optional_headers);					
					//$logger->log('Service URL is...', Zend_Log::INFO);
					//$logger->log($url, Zend_Log::INFO);
					//$logger->log('Data sent is...', Zend_Log::INFO);
					//$logger->log($data, Zend_Log::INFO);					
  					//$logger->log('Response received is...', Zend_Log::INFO);
  					//$logger->log($this->response, Zend_Log::INFO);
  					//$logger->log($responsearray[1], Zend_Log::INFO);
  					
  					//$logger->log('Header received is...', Zend_Log::INFO);
  					//foreach ($responsearray[0] as $headerkey => $headervalue) {
  					//	$logger->log($headerkey . ' => ' . $headervalue, Zend_Log::INFO);
  					//}
  					
  					// Get the location from the response header
  					//$location = substr($this->response, 0, $info['location']);
  					//$location = substr($responsearray[1], 0, $info['location']);
  					
  					$location = "";
  					//$Explodedresponse = explode('\n', $responsearray[1]);
  					// Debug the result
  					/**
  					foreach($Explodedresponse as $responsepart) {
  						//$logger->log('Looking for location...' . $responsepart, Zend_Log::INFO);
  						$responsepart = strtolower($responsepart);  						
  						$pos = strpos($responsepart,'location:');
  						if ($pos === true ) {
  							$logger->log('Found location...' . $responsepart . ' at posn ' . $pos, Zend_Log::INFO);
  							$location = $responsepart;
  							break;
  						}   		
  						if (preg_match("/location/", $responsepart)) {
  							$logger->log('Found preg_match() location...' . $responsepart, Zend_Log::INFO);
  							$location = $responsepart;  							
  						}				
  					}
  					**/
  					// New way to do it
  					$responsearray[1] = strtolower($responsearray[1]);
  					if (preg_match("/location/", $responsearray[1])) {
  						
  						$startpos 	= strpos($responsearray[1], 'http:');
  						$endpos		= strpos($responsearray[1], 'content-length'); 
  						
  						// Extract the URL
  						//$logger->log('startpos is...' . $startpos, Zend_Log::INFO);
  						//$logger->log('endpos is...' . $endpos, Zend_Log::INFO);
  						
  						$location = substr($responsearray[1], $startpos, $endpos-$startpos);
  						//$logger->log('location is...' . $location, Zend_Log::INFO);
  					}
  					  					
  					//$location = substr_replace('location:', '', 0);
  					$location = trim($location);
  					//$logger->log('location is...' . $location, Zend_Log::INFO);
  					  					
  					// Close the connection
  					//curl_close( $ch );
  					
  					// Now get the JSON response
  					$fetchresult = do_get_request_curl($location);
  					
					// Get HTTP Status code from the response
					$status_code = array();
					preg_match('/\d\d\d/', $fetchresult[1], $status_code);

					$logger->log('GET status_code is...' . $status_code[0], Zend_Log::INFO);
					
					// Check the HTTP Status code
					switch( $status_code[0] ) {
						case 200:							
							// 	Success
							//$logger->log('GET response is...' . $fetchresult[1], Zend_Log::INFO);
							break;
						case 503:
							die('Your call to Elektrifi Web Services failed and returned an HTTP status of 503. That means: Service unavailable. An internal problem prevented us from returning data to you.');
							break;
						case 403:
							die('Your call to Elektrifi Web Services failed and returned an HTTP status of 403. That means: Forbidden. You do not have permission to access this resource or are over your rate limit.');
							break;
						case 400:
							// You may want to fall through here and read the specific XML error
							die('Your call to Elektrifi Web Services failed and returned an HTTP status of 400. That means:  Bad request. The parameters passed to the service did not match as expected. The exact error is returned in the XML response.');
							break;
						default:
							die('Your call to Elektrifi Web Services returned an unexpected HTTP status of:' . $status_code[0]);
					}
					
					// Manipulate the response to extract the JSON part...
					// ...XML response
					if (preg_match("/</", $fetchresult[1])) {
						
  						$startpos = strpos($fetchresult[1], '<');
  						$endpos	  = strlen($fetchresult[1]);   
  						
  						// Extract the URL
  						//$logger->log('XML startpos is...' . $startpos, Zend_Log::INFO);
  						//$logger->log('XML endpos is...' . $endpos, Zend_Log::INFO);
						
  						$xml 	= substr($fetchresult[1], $startpos, $endpos-$startpos);
						$json 	= Zend_Json::fromXml($xml, true);
  						//$logger->log('xml is...' . $json, Zend_Log::INFO);						
					}
															
					//$logger->log("Pretty-print...\n" . Zend_Json::prettyPrint($json, array("indent" => " ")), Zend_Log::INFO);

					// Decode the JSON (i.e. turn it into an object)
					//$result = Zend_Json::decode( $json, Zend_Json::TYPE_OBJECT );
					
					// Put the objects into the session
					//$session->result = $result;
										
					// Put the JSON into the session
					$session->json = $json;
					
        			// redirect to the response screen
  					//$logger->log('Now redirecting to /screening/checkadhocresponse...', Zend_Log::INFO);        			
					$this->_redirect('/screening/checkadhocresponse');
				}
        	}
        	
        	$this->view->fp = $fp;        	
        	
        }
        
        public function uploadfileAction()        
        {
        	Zend_Registry::get('logger')->info('testing uploadfile log message');
        }

        public function checkadhocresponseAction()
        {
        	// Retrieve the same session data as checkadhocAction
        	$session = new Zend_Session_Namespace('checkadhoc');        	
        	
        	// Logging
			//Zend_Registry::get('logger')->info('testing checkadhocresponse log message');
			$logger = Zend_Registry::get('logger');
          	$logger->setEventItem('module', $this->getRequest()->getModuleName());
          	$logger->setEventItem('controller', $this->getRequest()->getControllerName());
			//$logger->log('Response in checkadhocresponseAction is...', Zend_Log::INFO);
			//$logger->log($this->response, Zend_Log::INFO);
			
			// retrieve the same session namespace used in register
			//$session = new Zend_Session_Namespace('screening');

			// load the user record based on the stored user ID
			//$user = new DatabaseObject_User($this->db);
			//if (!$user->load($session->user_id)) {
			//	$this->_forward('checkadhoc');
			//	return;
			//}
			
			// Get the result from the session
			//$result = $session->result;
			$json = $session->json;

			// Logging
			//$logger->log('JSON (raw) in checkadhocresponseAction is...' . $json, Zend_Log::INFO);
			//$logger->log($json, Zend_Log::INFO);
						
			$this->view->json = $json;
			
			// DOJO Data Grid
			$dojoData= new Zend_Dojo_Data(’id’,$data,’id’);
			//$this->view->collection = array(array('id' => 1, 'name' => 'Linus'),
            //								array('id' => 2, 'name' => 'Rasmus'));			
			
        }
               
        function varDumpToString ($var) {
		
	    	ob_start();
    		var_dump($var);
    		$result = ob_get_clean();
    		return $result;
		}        
		 
    }
?>