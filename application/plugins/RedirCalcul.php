<?php
/**
 * class for always redirect to calcul
 */
class Application_Plugin_RedirCalcul extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // KLUDGE: don't write like 'Calcul' or 'index' in real project
        // use a constant or a variable
        $this->getRequest()->setControllerName('Calcul')
            ->setActionName('index');
    }
}
