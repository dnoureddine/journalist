<?php

namespace Acme\AdminBundle\Controller;

use Acme\AdminBundle\Entity\Project;
use Acme\AdminBundle\Form\ProjectType;
use Acme\AdminBundle\Model\ProjectModel;
use Acme\AdminBundle\Model\Encryption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    /**
     * @Route("/{_locale}/project/projects", name="projects")
     */
    public function projectsAction(Request $request)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $model=new ProjectModel($this->getDoctrine()->getEntityManager());
            $project->setDateCreation(new \DateTime("now"));
            $model->createProject($project);
        }

        return $this->render(
            'AdminBundle:Project:projects.html.twig',array("form"=>$form->createView())
        );
    }


    /**
     * @Route("/{_locale}/project/ajaxProjects",name="ajaxProjects")
     */
    public function ajaxProjectsAction(Request $request)
    {
        $encryption = new Encryption();
        $model=new ProjectModel($this->getDoctrine()->getEntityManager());
        $projects=$model->listProjects(1,0,100);

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

    /**
     * @Route("/{_locale}/project/deleteProject/{id}",name="deleteProject")
     */
    public function deleteProjectAction(Request $request,$id)
    {
        $encryption = new Encryption();
        $message="";
        $model=new ProjectModel($this->getDoctrine()->getEntityManager());
        try{
            $model->mettrePoubelle($encryption->decode($id));
            $message="succed";
        }catch (Exception $ex){
            $message=$ex->getMessage();
        }

        return new Response($message);
    }

}
