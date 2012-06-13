<?php

/**
 * Base class for all the entities, define some method useful
 *
 */
abstract class Application_Models_Entity
{

    protected $_em = null;

    public function __construct()
    {
        $this->_em = $this->getEntityManager();
    }

    /**
     * method get intelligent
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return $this->$name;
        }
    }

    /**
     * method set intelligent
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            $this->$name = $value;
            return $this;
        }
    }

    /**
     * get entity manager
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return \Zend_Registry::get('em');
    }

    /**
     * set more fields with data in an array
     * @param array $data
     * @return Entity
     */
    public function fromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
        return $this;
    }

    /**
     * return the data of an entity in format array
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $metadata = $this->getEntityManager()->getClassMetadata(get_class($this));
        foreach ($metadata->fieldNames as $property) {
            $result[$property] = $this->__get($property);
        }
        return $result;
    }
}
