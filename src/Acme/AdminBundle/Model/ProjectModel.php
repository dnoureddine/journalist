<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 29/01/16
 * Time: 19:42
 */

namespace Acme\AdminBundle\Model;


use Acme\AdminBundle\Entity\Project;
use Doctrine\ORM\EntityManager;

class ProjectModel
{

    private  $em;

    function __construct(EntityManager $em)
    {
      $this->em=$em;
    }

    //create new Project
    public function createProject(Project $project){
        $this->em->persist($project);
        $this->em->flush();
    }

    //get project by id project
    public function getProject($id){
        $project = $this->getDoctrine()
            ->getRepository('AdminBundle:Project')
            ->find($id);

        if (!$project) {
            throw $this->createNotFoundException(
                'No Project found !!!'
            );
        }
        else{
            return $project;
        }
    }

    //update a project
    public function updateProject(Project $project){
         $this->em->persist($project);
         $this->em->flush();
    }

    //delete a project
    public function deleteProject($id){
        $project = $this->em->find("Acme\AdminBundle\Entity\Project",$id);
        if($project!=null) {
            $this->em->remove($project);
            $this->em->flush();
        }
    }

    //get list of projects
    public function listProjects($idClient,$min,$max){
        $query = $this->em->createQuery("SELECT p FROM Acme\AdminBundle\Entity\Project p");
        $query->setFirstResult($min);
        $query->setMaxResults($max);
        return $query->getResult();
    }

    //mettre un Projet dans la poubelle
    public function mettrePoubelle($idProject){
        $project = $this->em->find("Acme\AdminBundle\Entity\Project",2);
        if($project!=null){
            $project->setPoubelle(true);
            $this->em->merge($project);
            $this->em->flush();
        }
    }

    //restaurer un Project de La Poubelle
    public function restaurerProjects($idProject){
        $project = $this->em->find("Acme\AdminBundle\Entity\Project",$idProject);
        if($project!=null){
            $project->setPoubelle(false);
            $this->em->merge($project);
            $this->em->flush();
        }
    }


    //list of accomplished projects
    public function listDoneProjects($idClient,$min,$max){

    }

    //list of projects encours
    public function listEncoursProjects($idClient,$min,$max){

    }

    //list of projects expired
    public function listExpiredProjects($idClient,$min,$max){

    }

}