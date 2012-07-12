<?php
    class FormProcessor_ScreeningAdhoc extends FormProcessor
    {

        public function __construct()
        {
            parent::__construct();

        }

        public function process(Zend_Controller_Request_Abstract $request)
        {        	
            $logger = Zend_Registry::get('logger');
        	//$logger->setEventItem('module', $this->getRequest()->getModuleName());
        	//$logger->setEventItem('controller', $this->getRequest()->getControllerName());        	        	
                    	
            // validate the adhoc input data
        	$this->adhocname = $this->sanitize($request->getPost('adhocname'));
            if (strlen($this->adhocname) == 0)
                $this->addError('adhocname', 'Please enter a customer name for screening');
            else {
            	$Explodedname = explode(' ', $this->adhocname);
            	// Always set the first name field to the very last word in the string
            	$lastname = $Explodedname[sizeof($Explodedname)-1];           	 
            	// Now fill in the rest of the name fields as far as possible
				$firstname = '';            	
            	for ($i = 1; $i <= sizeof($Explodedname); $i++) { 
            		
            		// This is the firstname, which can be any number of non-surnames
            		if ($i <= sizeof($Explodedname)-1) { 
            			$firstname = $firstname . " " . $Explodedname[$i-1];
            		}             		
            	}            	
            	$this->adhocname = "001" . ";" . trim($lastname) . ";" . trim($firstname) . ";" . "Individual";
            }
        	        	
            // return true if no errors have occurred
            return !$this->hasError();
        }
    }
?>