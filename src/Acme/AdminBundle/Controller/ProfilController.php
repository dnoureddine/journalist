<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 10/02/16
 * Time: 22:57
 */

namespace Acme\AdminBundle\Controller;

use UserBundle\Model\ProfilModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ProfilController extends Controller
{

    /**
     * @Route("/{_locale}/profile/", name="profile")
     */
    public function profilAction()
    {
        $model=new ProfilModel($this->getDoctrine()->getEntityManager());
        $villes = $model->listCities();
        $payss = $model->listContries();
        $domaines=$model->listDomaines();
        $langues = $model->listLangages();
        $tools = $model->listTools();

        return $this->render('AdminBundle:Profil:profil_2.html.twig',array("villes"=>$villes,
            "payss"=>$payss, "domaines"=>$domaines, "langues"=>$langues, "tools"=>$tools));

    }

}