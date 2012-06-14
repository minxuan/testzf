<?php

// Ce fichier charge la config en utilisant le bootstrap de l'appli ZF
// (l'includepath a déjà été ajusté dans doctrine.php)

require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();

// récupère l'em initialisé par le bootstrap, et crée le helperSet nécessaire pour doctrine.php
// @see http://www.doctrine-project.org/docs/orm/2.1/en/reference/tools.html

$em = Zend_Registry::get('em');
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
