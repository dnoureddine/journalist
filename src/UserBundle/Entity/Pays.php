<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\PaysRepository")
 */
class Pays
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
     * @var string
     *
     * @ORM\Column(name="sortname", type="string", length=255)
     */
    private $sortname;

    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="pays", cascade={"persist","remove"})
     */
    protected $states;

    /**
     *  @var ArrayCollection $users
     * @ORM\OneToMany(targetEntity="User", mappedBy="pays", cascade={"persist", "remove", "merge"})
     */
    private $users;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->users= new ArrayCollection();
        $this->states=new ArrayCollection();
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
     * @return Pays
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
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Pays
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }



    /**
     * Set sortname
     *
     * @param string $sortname
     *
     * @return Pays
     */
    public function setSortname($sortname)
    {
        $this->sortname = $sortname;

        return $this;
    }

    /**
     * Get sortname
     *
     * @return string
     */
    public function getSortname()
    {
        return $this->sortname;
    }

    /**
     * Add state
     *
     * @param \UserBundle\Entity\State $state
     *
     * @return Pays
     */
    public function addState(\UserBundle\Entity\State $state)
    {
        $this->states[] = $state;

        return $this;
    }

    /**
     * Remove state
     *
     * @param \UserBundle\Entity\State $state
     */
    public function removeState(\UserBundle\Entity\State $state)
    {
        $this->states->removeElement($state);
    }

    /**
     * Get states
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStates()
    {
        return $this->states;
    }
}
