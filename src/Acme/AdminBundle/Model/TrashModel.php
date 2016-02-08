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

class TrashModel
{

    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    //*********************** Project ************************

    public function listTrashedProjects($idClient,$min,$max){
        $query = $this->em->createQuery("SELECT p FROM Acme\AdminBundle\Entity\Project p where p.poubelle=:x ");
        $query->setParameter("x",true);
        $query->setFirstResult($min);
        $query->setMaxResults($max);
        return $query->getResult();
    }



}