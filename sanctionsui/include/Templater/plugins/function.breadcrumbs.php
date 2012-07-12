<?php
    function smarty_function_breadcrumbs($params, $smarty)
    {
        $defaultParams = array('trail'     => array(),
                               'separator' => ' &gt; ',
                               'truncate'  => 40);

        // initialize the parameters
        foreach ($defaultParams as $k => $v) {
            if (!isset($params[$k]))
                $params[$k] = $v;
        }

        // load the truncate modifier
        // Deprecated...JF commented out
        //if ($params['truncate'] > 0)
        //    require_once $smarty->_get_plugin_filepath('modifier', 'truncate');

        if ($params['truncate'] > 0 ) {
			if (method_exists($smarty, '_get_plugin_filepath')) {
	        //handle with Smarty version 2
    		    require_once $smarty->_get_plugin_filepath('modifier', 'truncate');
 	   	} else {
    	    //handle with Smarty version 3
        	foreach ($smarty->plugins_dir as $value) {
            	$filepath = $value . "/modifier.truncate.php";
            	if (file_exists($filepath)) {
	                require_once $filepath;
    	        }
	        }
	    }   }      	    
            
        $links = array();
        $numSteps = count($params['trail']);
        for ($i = 0; $i < $numSteps; $i++) {
            $step = $params['trail'][$i];

            // truncate the title if required
            if ($params['truncate'] > 0)
                $step['title'] = smarty_modifier_truncate($step['title'],
                                                          $params['truncate']);

            // build the link if it's set and isn't the last step
            if (strlen($step['link']) > 0 && $i < $numSteps - 1) {
                $links[] = sprintf('<a href="%s" title="%s">%s</a>',
                                   htmlSpecialChars($step['link']),
                                   htmlSpecialChars($step['title']),
                                   htmlSpecialChars($step['title']));
            }
            else {
                // either the link isn't set, or it's the last step
                $links[] = htmlSpecialChars($step['title']);
            }
        }

        // join the links using the specified separator
        return join($params['separator'], $links);
    }
?>