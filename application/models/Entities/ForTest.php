<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForTest
 *
 * @Table(name="forTest")
 * @Entity(repositoryClass="Repositories\Repository")
 * @HasLifecycleCallbacks
 */
class ForTest extends \Application_Models_Entity
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer $fieldZ
     *
     * @Column(name="fieldZ", type="integer", nullable=true)
     */
    protected $fieldZ;

    /**
     * @var date $updateDate
     * 
     * @Column(name="updateDate", type="date", nullable=true)
     */
    protected $updateDate;

    /**
     * update the field updateDate automagicly
     */
    public function setUpdateDate()
    {
        $this->updateDate = new \DateTime();
        return $this;
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function prePersist()
    {
        $this->setUpdateDate();
    }
}
