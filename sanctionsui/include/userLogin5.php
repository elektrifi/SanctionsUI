<?php 
	function doLoginAction() {
    	$filter = new Zend_Filter_Input($_POST);
    	if (!($login = $filter->testAlnum('login'))) {
	        echo "Login field should contains only alphanumeric characters.\n";
	    } else if (!($password = $filter->testAlnum('password'))) {
        	echo "Password field should contains only alphanumeric characters.\n";
    	} else if (!('joe' == $login && 'secret' == $password)) {
	        echo 'Wrong login/password.';
	    } else {
        	echo 'url:/Login/Success/';
    	}
	}
 
    function successAction() {
        echo 'Congratulations! You are in.';
    }
?>