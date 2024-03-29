<?php
    class UtilityController extends CustomControllerAction
    {
        public function captchaAction()
        {
            $session = new Zend_Session_Namespace('captcha');

            // check for existing phrase in session
            $phrase = null;
            if (isset($session->phrase) && strlen($session->phrase) > 0)
                $phrase = $session->phrase;

            $captcha = Text_CAPTCHA::factory('Image');

            $opts = array('font_size' => 14,
                          'font_path' => Zend_Registry::get('config')->paths->data,
                          'font_file' => 'VeraBd.ttf',
            			  'text_color' => '#DDFF99',
    					  'lines_color' => '#CCEEDD',
 						  'background_color' => '#555555'
            			);

            $captcha->init(235, 40, $phrase, $opts);

            // write the phrase to session
            $session->phrase = $captcha->getPhrase();

            // disable auto-rendering since we're outputting an image
            $this->_helper->viewRenderer->setNoRender();

            header('Content-type: image/png');
            echo $captcha->getCAPTCHAAsPng();
        }
    }
?>