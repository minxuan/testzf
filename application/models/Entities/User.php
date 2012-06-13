<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @Table(name="user")
 * @Entity(repositoryClass="Repositories\Repository")
 * @HasLifecycleCallbacks
 */
class User extends \Application_Models_Entity
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
     * @var string $name
     *
     * @Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @var string $email
     *
     * @Column(name="email", type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @var integer $idTitle
     *
     * @Column(name="idTitle", type="integer", nullable=true)
     */
    protected $idTitle;

    /**
     * @var Title
     *
     * @ManyToOne(targetEntity="Title")
     * @JoinColumns({
     *   @JoinColumn(name="idTitle", referencedColumnName="id")
     * })
     */
    protected $title;

    /**
     * @var date $updateDate
     * 
     * @Column(name="updateDate", type="date", nullable=true)
     */
    protected $updateDate;

    public function setIdTitle($idTitle)
    {
        $em = $this->getEntityManager();
        $title = $em->getRepository('\Entities\Title')->find($idTitle);
        if ($title instanceof \Entities\Title) {
            $this->idTitle = $idTitle;
            $this->title = $title;
        }
        return $this;
    }

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
