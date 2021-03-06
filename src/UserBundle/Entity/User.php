<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="user", cascade={"persist","remove"})
     */
    protected $experiences;


    /**
     * @ORM\OneToMany(targetEntity="Diplome", mappedBy="user", cascade={"persist","remove"})
     */
    protected $diplomes;

    /**
     * @var string
     *
     * @ORM\Column(name="nomr", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @var integer
     *
     * @ORM\Column(name="codepostal", type="integer", nullable=true)
     */
    private $codepostal;


    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var text
     *
     * @ORM\Column(name="page", type="text", nullable=true)
     */
    private $page;

    /**
     * @var text
     *
     * @ORM\Column(name="titre", type="text", nullable=true)
     */
    private $titre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="Domaine", inversedBy="users")
     * @ORM\JoinTable(name="user_domaine")
     */
    private $domaines;

    /**
     * @ORM\ManyToMany(targetEntity="Langue", inversedBy="users")
     * @ORM\JoinTable(name="user_langue")
     */
    private $langues;

    /**
     * @ORM\ManyToMany(targetEntity="Tools", inversedBy="users")
     * @ORM\JoinTable(name="user_tools")
     */
    private $tools;

    /**
     * @var Ville $ville
     *
     * @ORM\ManyToOne(targetEntity="Ville", inversedBy="users", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_ville", referencedColumnName="id")
     * })
     */
    private $ville;

    /**
     * @var Pays $pays
     *
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="users", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_pays", referencedColumnName="id")
     * })
     */
    private $pays;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->diplomes= new ArrayCollection();
        $this->experiences=new ArrayCollection();
        $this->domaines=new ArrayCollection();
        $this->langues=new ArrayCollection();
        $this->tools=new ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return User
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set codepostal
     *
     * @param integer $codepostal
     *
     * @return User
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return integer
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set page
     *
     * @param string $page
     *
     * @return User
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add experience
     *
     * @param \UserBundle\Entity\Experience $experience
     *
     * @return User
     */
    public function addExperience(\UserBundle\Entity\Experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \UserBundle\Entity\Experience $experience
     */
    public function removeExperience(\UserBundle\Entity\Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add diplome
     *
     * @param \UserBundle\Entity\Diplome $diplome
     *
     * @return User
     */
    public function addDiplome(\UserBundle\Entity\Diplome $diplome)
    {
        $this->diplomes[] = $diplome;

        return $this;
    }

    /**
     * Remove diplome
     *
     * @param \UserBundle\Entity\Diplome $diplome
     */
    public function removeDiplome(\UserBundle\Entity\Diplome $diplome)
    {
        $this->diplomes->removeElement($diplome);
    }

    /**
     * Get diplomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiplomes()
    {
        return $this->diplomes;
    }

    /**
     * Add domaine
     *
     * @param \UserBundle\Entity\Domaine $domaine
     *
     * @return User
     */
    public function addDomaine(\UserBundle\Entity\Domaine $domaine)
    {
        $this->domaines[] = $domaine;

        return $this;
    }

    /**
     * Remove domaine
     *
     * @param \UserBundle\Entity\Domaine $domaine
     */
    public function removeDomaine(\UserBundle\Entity\Domaine $domaine)
    {
        $this->domaines->removeElement($domaine);
    }

    /**
     * Get domaines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomaines()
    {
        return $this->domaines;
    }

    /**
     * Add langue
     *
     * @param \UserBundle\Entity\Langue $langue
     *
     * @return User
     */
    public function addLangue(\UserBundle\Entity\Langue $langue)
    {
        $this->langues[] = $langue;

        return $this;
    }

    /**
     * Remove langue
     *
     * @param \UserBundle\Entity\Langue $langue
     */
    public function removeLangue(\UserBundle\Entity\Langue $langue)
    {
        $this->langues->removeElement($langue);
    }

    /**
     * Get langues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLangues()
    {
        return $this->langues;
    }

    /**
     * Add tool
     *
     * @param \UserBundle\Entity\Tools $tool
     *
     * @return User
     */
    public function addTool(\UserBundle\Entity\Tools $tool)
    {
        $this->tools[] = $tool;

        return $this;
    }

    /**
     * Remove tool
     *
     * @param \UserBundle\Entity\Tools $tool
     */
    public function removeTool(\UserBundle\Entity\Tools $tool)
    {
        $this->tools->removeElement($tool);
    }

    /**
     * Get tools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTools()
    {
        return $this->tools;
    }

    /**
     * Set ville
     *
     * @param \UserBundle\Entity\Ville $ville
     *
     * @return User
     */
    public function setVille(\UserBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \UserBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param \UserBundle\Entity\Pays $pays
     *
     * @return User
     */
    public function setPays(\UserBundle\Entity\Pays $pays = null)
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
     * Set titre
     *
     * @param string $titre
     *
     * @return User
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
}
