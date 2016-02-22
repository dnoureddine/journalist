<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 29/01/16
 * Time: 19:42
 */

namespace Acme\AdminBundle\Model;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;

class UserModel
{

    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /* get user */
    public function getUser($id)
    {
        $user = $this->em->find("UserBundle\Entity\User",$id);
        return $user;
    }

    /* update user informations */
    public function updateUser(User $user){
        $this->em->merge($user);
        $this->em->flush();
    }



}