<?php
    class Templater extends Zend_View_Abstract
    {
        protected $_path;
        protected $_engine;

        public function __construct()
        {
            $config = Zend_Registry::get('config');

            require_once('Smarty/Smarty.class.php');

            $this->_engine = new Smarty();
            $this->_engine->template_dir = $config->paths->templates;
            $this->_engine->compile_dir = sprintf('%s/tmp/templates_c',
                                                  $config->paths->data);

            //$this->_engine->plugins_dir = array($config->paths->base .
            //                                    '/include/Smarty/plugins',
            //                                    'plugins');
            
            $this->_engine->plugins_dir = 
            			array(	$config->paths->base . '/include/Smarty/plugins',
            					$config->paths->base . '/include/Templater/plugins',
                        		'plugins');

            // JF bit of debugging...
		    // create the application logger
    		//$logger2 = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
    		//Zend_Registry::set('logger2', $logger2);
    		
    		//$logger2->debug('--------------------');
    		//echo "----------------\n";
    		
    		//$size = count($this->_engine->plugins_dir); 
    		//$logger2->debug("Plugins_dir size = {$size}"); 
    		//echo "Plugins_dir size = {$size}\n";  
	        
    		//foreach ($this->_engine->plugins_dir as $value) {
	        //	$logger2->debug("Processing $value\n");
	        //	echo "Processing $value\n";
	        //}
	        
	        //$logger2->debug('--------------------');
            //echo "----------------\n";
            				
            // JF specifics (see http://akrabat.com/php/extending-zend_view_interface-for-use-with-smarty/)
            $this->_engine->error_reporting = (E_ALL ^ E_NOTICE);
			// 	Render variables XSS safe by default.
        	$this->_engine->default_modifiers = array('escape:"htmlall"');        	            
            
        }

        public function getEngine()
        {
            return $this->_engine;
        }

        public function __set($key, $val)
        {
            $this->_engine->assign($key, $val);
        }

        public function __get($key)
        {
            return $this->_engine->get_template_vars($key);
        }

        public function __isset($key)
        {
            return $this->_engine->get_template_vars($key) !== null;
        }

        public function __unset($key)
        {
            $this->_engine->clear_assign($key);
        }

        public function assign($spec, $value = null)
        {
            if (is_array($spec)) {
                $this->_engine->assign($spec);
                return;
            }

            $this->_engine->assign($spec, $value);
        }

        public function clearVars()
        {
            $this->_engine->clear_all_assign();
        }

        public function render($name)
        {
            return $this->_engine->fetch(strtolower($name));
        }

        public function _run()
        { }
    }
?>