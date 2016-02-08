<?php

namespace Acme\AdminBundle\Controller;

use Acme\AdminBundle\Model\Encryption;
use Acme\AdminBundle\Model\TrashModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrashController extends Controller
{
    /**
     * @Route("/{_locale}/trash")
     */
    public function trashAction()
    {

        $model = new TrashModel($this->getDoctrine()->getEntityManager());
        $nbProject = count($model->listTrashedProjects(1,0,100));

        $trashedObjects = array("project"=>$nbProject);
        return $this->render('AdminBundle:Trash:trash.html.twig', array("trashedObjects"=>$trashedObjects));
    }


    /**
     * @Route("/{_locale}/trash/trashedprojects",name="trashedprojects")
     */
    public function trashedprojectsAction()
    {
        return $this->render('AdminBundle:Trash:projects.html.twig');
    }

    /**
     * @Route("/{_locale}/trash/ajaxtrashedProjects",name="ajaxtrashedProjects")
     */
    public function ajaxtrashedProjectsAction(Request $request)
    {
        $encryption = new Encryption();
        $model=new TrashModel($this->getDoctrine()->getEntityManager());
        $projects=$model->listTrashedProjects(1,0,100);

        $output = array(
            'data' => array()
        );

        foreach ($projects as $project) {
            $date=$project->getDateCreation();
            $dateFormat="-------";
            $projectId=$encryption->encode($project->getId());
            if($date!=null){
                $dateFormat=$date->format('Y-m-d');
            }
            $output['data'][] = [
                'title' => $project->getTitle(),
                'note' => $project->getNote(),
                'date' => $dateFormat,
                'action'=>'<a href="editProject/'.$projectId.'" class="actions"><i class="fa fa-fw fa-edit"></i></a> <a href="deleteProject/'.$projectId.'" class="actions"><i class="fa fa-fw fa-trash-o"></i></a>'
            ];
        }

        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);
    }
}
