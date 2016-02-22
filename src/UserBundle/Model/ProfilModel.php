<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 29/01/16
 * Time: 19:42
 */

namespace UserBundle\Model;


use Symfony\Component\Config\Definition\Exception\Exception;
use UserBundle\Entity\Experience;
use UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use UserBundle\Entity\Diplome;

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

    //get a city by id
    function getVille($id){
        $ville = $this->em->find("UserBundle\Entity\Ville", $id);
        return $ville;
    }

    //get a contry by id
    function getPays($id){
        $pays = $this->em->find("UserBundle\Entity\Pays", $id);
        return $pays;
    }

    //add diplome
    function addDiplome(Diplome $diplome){
            $this->em->persist($diplome);
            $this->em->flush();
            return $diplome->getId();
    }

    //update Diplome
    function updateDiplome(Diplome $diplome){
        $this->em->merge($diplome);
        $this->em->flush();
    }

    //get Diplome
    function getDiplome($id){
        $diplome = $this->em->find("UserBundle\Entity\Diplome", $id);
        return $diplome;
    }


    //delete a diplome
    public function deleteDiplome($id){
        $diplome = $this->em->find("UserBundle\Entity\Diplome",$id);
        if($diplome!=null) {
            $this->em->remove($diplome);
            $this->em->flush();
        }
    }


    //add diplome
    function addExperience(Experience $experience){
        $this->em->persist($experience);
        $this->em->flush();
        return $experience->getId();
    }

    //update Diplome
    function updateExperience(Experience $experience){
        $this->em->merge($experience);
        $this->em->flush();
    }

    //get Diplome
    function getExperience($id){
        $experience = $this->em->find("UserBundle\Entity\Experience", $id);
        return $experience;
    }


    //delete a diplome
    public function deleteExperience($id){
        $experience = $this->em->find("UserBundle\Entity\Experience",$id);
        if($experience!=null) {
            $this->em->remove($experience);
            $this->em->flush();
        }
    }
}