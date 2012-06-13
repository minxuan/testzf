<?php
class Application_Bootstrap_Resource_Doctrine extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        require 'Doctrine/ORM/Tools/Setup.php';
        \Doctrine\ORM\Tools\Setup::registerAutoloadDirectory(ROOT_PATH . "/library");

        $options = $this->getOptions();
        $paths = array($options['entities']['path']);
        $isDevMode = true;

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        // for entities
        $classLoader = new \Doctrine\Common\ClassLoader(
            'Entities', $options['entities']['path']
        );
        $classLoader->register();

        // for repository
        $classLoader =
            new \Doctrine\Common\ClassLoader(
                'Repositories', $options['entities']['path'] . '/Entities'
            );
        $classLoader->register();

        // for use em easily in entities
        $em = \Doctrine\ORM\EntityManager::create($options['conn'], $config);
        Zend_Registry::set('em', $em);

        /*
        // only for debug
        $sqlLogger = new Application_SqlLogger(
            new Zend_Log_Writer_Stream(
                ROOT_PATH . "/Application/data/log/sql.log"
            )
        );

        $config->setSQLLogger($sqlLogger);
        */
        return $em;
    }
}
