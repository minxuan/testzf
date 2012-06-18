<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Charge the configuration in the registre
     */
    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
        return $config;
    }

    /**
     * charge plugins
     */
    protected function _initPlugins()
    {
        $frontCtrl = Zend_Controller_Front::getInstance();
        // redirect to calcul
        $frontCtrl->registerPlugin(new Application_Plugin_RedirCalcul());
    }
}
