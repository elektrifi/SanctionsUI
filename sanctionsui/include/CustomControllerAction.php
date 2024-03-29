<?php
    class CustomControllerAction extends Zend_Controller_Action
    {
        public $db;
        public $breadcrumbs;

        public function init()
        {
            $this->db = Zend_Registry::get('db');

            $this->breadcrumbs = new Breadcrumbs();
            $this->breadcrumbs->addStep('Home', $this->getUrl(null, 'index'));
            
        }

        public function getUrl($action = null, $controller = null)
        {
            $url  = rtrim($this->getRequest()->getBaseUrl(), '/') . '/';
            $url .= $this->_helper->url->simple($action, $controller);

            return $url;
        }

        public function preDispatch()
        {
            $auth = Zend_Auth::getInstance();
            if ($auth->hasIdentity()) {
                $this->view->authenticated = true;
                $this->view->identity = $auth->getIdentity();
            }
            else
                $this->view->authenticated = false;
        }

        public function postDispatch()
        {
            $this->view->breadcrumbs = $this->breadcrumbs;
            $this->view->title = $this->breadcrumbs->getTitle();
        }

        public function sendJson($data)
        {
            $this->_helper->viewRenderer->setNoRender();

            $this->getResponse()->setHeader('content-type', 'application/json');
            echo Zend_Json::encode($data);
        }
    }
?>