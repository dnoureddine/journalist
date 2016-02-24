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
        $query->setMaxResults(20);
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

    //list de diplomes d un user
    function listDiplomes($user){
        if($user!=null){
            return $user->getDiplomes();
        }else{
            return null;
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

    //list de experiences d un user
    function listExperiences($user){
        if($user!=null){
            return $user->getExperiences();
        }else{
            return null;
        }
    }


    //get langue
    function getLangue($id){
        $langue = $this->em->find("UserBundle\Entity\Langue", $id);
        return $langue ;
    }

    //get Domaine
    function getDomaine($id){
        $domaine = $this->em->find("UserBundle\Entity\Domaine", $id);
        return $domaine ;
    }

    //get Tools
    function getTools($id){
        $tools = $this->em->find("UserBundle\Entity\Tools", $id);
        return $tools ;
    }


    //add langues
    function addLangues($user, $langues){

        if($langues!=null){
            //remove the old langues
            $tousLangues=$this->listLangages();
            foreach($tousLangues as $langue){
                if($langue!=null && $user!=null){
                    $user->removeLangue($langue);
                    $langue->removeUser($user);
                    $this->em->flush();
                }
            }

            //add the new langues
            foreach($langues as $idLangue){
                $langue=$this->getLangue($idLangue);
                if($langue!=null && $user!=null){
                    $user->addLangue($langue);
                    $langue->addUser($user);
                    $this->em->flush();
                }
            }
        }
    }

    //list des Langues d 'un user
    function listUserLangues($user){
        if($user!=null){
            return $user->getLangues();
        }else{
            return null;
        }
    }

    //add Tools
    function addTools($user, $tools){
        if($tools!=null){
            //remove the old tools
            $tousTools=$this->listTools();
            foreach($tousTools as $tool){
                if($tool!=null && $user!=null){
                    $user->removeTool($tool);
                    $tool->removeUser($user);
                    $this->em->flush();
                }
            }

            //add the new tools
            foreach($tools as $idTool){
                $tool=$this->getTools($idTool);
                if($tool!=null && $user!=null){
                    $user->addTool($tool);
                    $tool->addUser($user);
                    $this->em->flush();
                }
            }
        }
    }

    //list des tools d 'un user
    function listUserTools($user){
        if($user!=null){
            return $user->getTools();
        }else{
            return null;
        }
    }


    //add domaines
    function addDomaines($user, $domaines){
        if($domaines!=null){
            //remove the old tools
            $tousDomaines=$this->listDomaines();
            foreach($tousDomaines as $domaine){
                if($domaine!=null && $user!=null){
                    $user->removeDomaine($domaine);
                    $domaine->removeUser($user);
                    $this->em->flush();
                }
            }

            //add the new tools
            foreach($domaines as $idDomaines){
                $domaine=$this->getDomaine($idDomaines);
                if($domaine!=null && $user!=null){
                    $user->addDomaine($domaine);
                    $domaine->addUser($user);
                    $this->em->flush();
                }
            }
        }
    }

    //list des domaines d 'un user
    function listUserDomaines($user){
        if($user!=null){
            return $user->getDomaines();
        }else{
            return null;
        }
    }

}