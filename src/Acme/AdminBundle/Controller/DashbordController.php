<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DashbordController extends Controller
{
    /**
     * @Route("/{_locale}/dashbord/", name="dashbord")
     */
    public function dashbordAction(Request $request)
    {
        return $this->render('AdminBundle:Dashbord:dashbord.html.twig', array(
            // ...
        ));
    }

}
