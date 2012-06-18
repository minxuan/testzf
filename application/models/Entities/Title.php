<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Title
 *
 * @Table(name="title")
 * @Entity(repositoryClass="Repositories\TitleRepository")
 */
class Title extends \Application_Models_Entity
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
     * @var string $label
     *
     * @Column(name="label", type="string", length=10, nullable=false)
     */
    protected $label;
}
