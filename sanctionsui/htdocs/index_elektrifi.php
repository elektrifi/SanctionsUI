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
    $logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
    Zend_Registry::set('logger', $logger);
    // JF added this 
    $logger->debug('JF testing logging in index.php');

    
    // connect to the database
    $params = array('host'     => $config->database->hostname,
                    'username' => $config->database->username,
                    'password' => $config->database->password,
                    'dbname'   => $config->database->database);

    
    $db = Zend_Db::factory($config->database->type, $params);
    Zend_Registry::set('db', $db);    
    // JF added this line
    $db->query('select 1');


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
?>