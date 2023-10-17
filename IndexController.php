<?php
require 'vendor/autoload.php'; 
class IndexController extends Zend_Controller_Action
{
    private $smarty;
    public function init()
    {   
        $this->smarty = new Smarty();
        $this->smarty->setCompileDir(APPLICATION_PATH .'/templates_c');
        $this->smarty->setCacheDir(APPLICATION_PATH . '/views/cache');
           }

    public function addAction()
    {
        $action = $this->_getParam('action'); // Get the action name
        $filename = Add.php . '/actions/' . $action . '.php';

        if (file_exists($filename)) {
            require_once $filename;
        } else {
                    }

        // Render the "add.tpl" template
        $this->view->render('views/add.tpl');
    }

    public function updateAction()
    {
        // Include a file named 'update.php' in a specific format
        $action = $this->_getParam('action'); // Get the action name
        $filename = Update.php . '/actions/' . $action . '.php';

        if (file_exists($filename)) {
            require_once $filename;
        } else {
                    }

        // Render the "update.tpl" template
        $this->view->render('views/update.tpl');
    }

    public function deleteAction()
    {
        // Include a file named 'delete.php' in a specific format
        $action = $this->_getParam('action'); // Get the action name
        $filename = Delete.php . '/actions/' . $action . '.php';

                            }
             
}
?>