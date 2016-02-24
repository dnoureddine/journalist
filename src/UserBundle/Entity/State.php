<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="state")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\StateRepository")
 */
class State
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="states")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $pays;

    /**
     * @ORM\OneToMany(targetEntity="Ville", mappedBy="state", cascade={"persist","remove"})
     */
    protected $villes;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->villes= new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return State
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pays
     *
     * @param \UserBundle\Entity\Pays $pays
     *
     * @return State
     */
    public function setPays(\UserBundle\Entity\Pays $pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \UserBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Add ville
     *
     * @param \UserBundle\Entity\Ville $ville
     *
     * @return State
     */
    public function addVille(\UserBundle\Entity\Ville $ville)
    {
        $this->villes[] = $ville;

        return $this;
    }

    /**
     * Remove ville
     *
     * @param \UserBundle\Entity\Ville $ville
     */
    public function removeVille(\UserBundle\Entity\Ville $ville)
    {
        $this->villes->removeElement($ville);
    }

    /**
     * Get villes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVilles()
    {
        return $this->villes;
    }
}
