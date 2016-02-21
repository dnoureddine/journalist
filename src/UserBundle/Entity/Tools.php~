<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tools
 *
 * @ORM\Table(name="tools")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ToolsRepository")
 */
class Tools
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
     * @ORM\Column(name="liblle", type="string", length=255)
     */
    private $liblle;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="tools")
     */
    private $users;


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
     * Set liblle
     *
     * @param string $liblle
     *
     * @return Tools
     */
    public function setLiblle($liblle)
    {
        $this->liblle = $liblle;

        return $this;
    }

    /**
     * Get liblle
     *
     * @return string
     */
    public function getLiblle()
    {
        return $this->liblle;
    }


    public function __construct()
    {
        $this->users= new ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Tools
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
}
