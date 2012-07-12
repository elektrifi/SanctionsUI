<?php
	header( "X-Test", "Testing" );
	setcookie( "TestCookie", "test-value" );
	var_dump( xdebug_get_headers() );
?>