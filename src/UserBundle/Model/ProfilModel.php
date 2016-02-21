<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 29/01/16
 * Time: 19:42
 */

namespace UserBundle\Model;


use Acme\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class ProfilModel
{

    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    //get all contries
    public function listContries(){
        $query = $this->em->createQuery("SELECT p FROM UserBundle\Entity\Pays p");
        return $query->getResult();
    }

    //get all cities
    public function listCities(){
        $query = $this->em->createQuery("SELECT v FROM UserBundle\Entity\Ville v");
        return $query->getResult();
    }

    //get all langages
    public function listLangages(){
        $query = $this->em->createQuery("SELECT l FROM UserBundle\Entity\Langue l");
        return $query->getResult();
    }

    //get all Domaines
    public function listDomaines(){
        $query = $this->em->createQuery("SELECT d FROM UserBundle\Entity\Domaine d");
        return $query->getResult();
    }

    //get all Tools
    public function listTools(){
        $query = $this->em->createQuery("SELECT t FROM UserBundle\Entity\Tools t");
        return $query->getResult();
    }
}