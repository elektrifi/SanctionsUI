<?php
	// Deprecated...
    //require_once('../include/Zend/Loader.php');
    require_once('Zend/Loader/Autoloader.php');
    // Deprecated, see http://apress.com/book/errata/743
    //Zend_Loader::registerAutoload();
    
    $autoloader = Zend_Loader_Autoloader::getInstance()->pushAutoloader(NULL, 'Smarty_' );
    $autoloader->setFallbackAutoloader(true);
    
    // See http://perlessence.com/2010/09/zend-framework-and-smarty-3/ for explanation of below
    //Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true)->pushAutoloader(NULL, 'Smarty_' );
    
    
    // load the application configuration
    $config = new Zend_Config_Ini('../settings.ini', 'development');
    Zend_Registry::set('config', $config);


    // create the application logger
    //$logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
    $logger = new Zend_Log();
    
    // attach writer to logging engine
    $writer = new Zend_Log_Writer_Stream($config->logging->file);
    $logger->addWriter($writer);
	
    // attach formatter to writer
    // $format = '%timestamp%: %priorityName%: %message%' . PHP_EOL;
	//$format = (isset($options['LogFormat'])) ? $options['LogFormat'] : '%timestamp% '
	//			.PHP_EOL.'%priorityName% (%priority%) [%module%] [%controller%] '
	//			.PHP_EOL.'%message%' . PHP_EOL.PHP_EOL
	//			.str_repeat("=",30). PHP_EOL;    
	// Alternative...
	$format = '%timestamp% %priorityName% (%priority%): '.
    	        '[%module%] [%controller%] %message%' . PHP_EOL;				
    $formatter = new Zend_Log_Formatter_Simple($format);
    $writer->setFormatter($formatter);    
    
    Zend_Registry::set('logger', $logger);
    // JF added this 
    //$logger->debug('JF testing logging in index.php');
	// write log message (different format)
    //$logger->log('index.php was called', Zend_Log::INFO);    
    
    // connect to the database
    $params = array('host'     => $config->database->hostname,
                    'username' => $config->database->username,
                    'password' => $config->database->password,
                    'dbname'   => $config->database->database);

    // JF added this (DEV ONLY!)
    // $logger->debug(varDumpToString($params));
    
    $db = Zend_Db::factory($config->database->type, $params);
    Zend_Registry::set('db', $db);


    // setup application authentication
    $auth = Zend_Auth::getInstance();
    $auth->setStorage(new Zend_Auth_Storage_Session());


    // handle the user request
    $controller = Zend_Controller_Front::getInstance();
    // JF added this line
    $controller->throwExceptions(true);    
    $controller->setControllerDirectory($config->paths->base .
                                        '/include/Controllers');
    $controller->registerPlugin(new CustomControllerAclManager($auth));

    
    // setup the view renderer
    $vr = new Zend_Controller_Action_Helper_ViewRenderer();
    $vr->setView(new Templater());
    $vr->setViewSuffix('tpl');
    Zend_Controller_Action_HelperBroker::addHelper($vr);

    
    $controller->dispatch();
    
    function varDumpToString ($var)
	{
    	ob_start();
    	var_dump($var);
    	$result = ob_get_clean();
    	return $result;
	}    
?>