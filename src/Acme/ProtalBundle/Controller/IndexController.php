<?php

namespace Acme\ProtalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{
    /**
     * @Route("/admin/{_locale}/")
     */
    public function indexAction()
    {
        return $this->render('ProtalBundle:pages:index.html.twig');
    }
}
