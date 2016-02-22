<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 10/02/16
 * Time: 22:57
 */

namespace Acme\AdminBundle\Controller;

use Acme\AdminBundle\Model\Encryption;
use Acme\AdminBundle\Model\UserModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Diplome;
use UserBundle\Entity\Experience;
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

    /**
     * @Route("/{_locale}/informations/", name="informations")
     */
    public function informationsAction(Request $req)
    {
        $message="";
        $isValid=true;
        /** verfier que les parametres nom, prenom, titre, dans la requete */
        $titre = $req->get("titre");
        $nom = $req->get("nom");
        $prenom = $req->get("prenom");
        $status = $req->get("status");

        /** validate the attributes */

        /** if valide make change */
        if($isValid){
             $model = new UserModel($this->getDoctrine()->getEntityManager());
             $user=$model->getUser(1);
            if($user!=null){
                $user->setTitre($titre);
                $user->setNom($nom);
                $user->setPrenom($prenom);
                if($status==null){
                    $user->setStatus(false);
                }
                else{
                    $user->setStatus(true);
                }

                /*** update user **/
                $model->updateUser($user);
                $message="You changes have been successfuly done.";
            }else{
                $message="This action can not be done, because of authentification problem.";
            }


        }else{
            $message="This Change can not be done !!!";
        }

        $output = array("message"=>$message, "form"=>"informations", "action"=>"update");
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/{_locale}/contact/", name="contact")
     */
    public function contactAction(Request $req)
    {
        $message="";
        $isValid=true;
        $modelProfil = new ProfilModel($this->getDoctrine()->getEntityManager());
        /** verfier que les parametres dans la requete */
        $email = $req->get("email");
        $tel = $req->get("tel");
        $fax = $req->get("fax");
        $webpage = $req->get("webpage");
        $rue = $req->get("rue");
        $codepostal = $req->get("codepostal");
        $ville = $modelProfil->getVille($req->get("ville"));
        $pays = $modelProfil->getPays($req->get("pays"));


        /** validate the attributes */

        /** if valide make change */
        if($isValid){
            $model = new UserModel($this->getDoctrine()->getEntityManager());
            $user=$model->getUser(1);
            if($user!=null){

                $user->setEmail($email);
                $user->setTel($tel);
                $user->setFax($fax);
                $user->setPage($webpage);
                $user->setRue($rue);
                if(intval($codepostal)!=0){
                    $user->setCodepostal(intval($codepostal));
                }
                if($ville!=null){
                    $user->setVille($ville);
                }
                if($pays!=null){
                    $user->setPays($pays);
                }

                /*** update user **/
                $model->updateUser($user);
                $message="You changes have been successfuly done.";
            }else{
                $message="This action can not be done, because of authentification problem.";
            }


        }else{
            $message="This Change can not be done !!!";
        }

        $output = array("message"=>$message, "form"=>"contact", "action"=>"update");
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/{_locale}/diplomes/", name="diplomes")
     */
    public function diplomesAction(Request $req)
    {
        $message="";
        $action="";
        $isValid=true;
        $modelProfil = new ProfilModel($this->getDoctrine()->getEntityManager());
        $encryption = new Encryption();
        /** verfier que les parametres dans la requete */
        $titre = $req->get("titre");
        $institut = $req->get("institut");
        $date = $req->get("date");
        $description = $req->get("description");
        $idDiplome=$req->get("idDiplome");



        /** validate the attributes */

        /** if valide make change */
        if($isValid){
            $model = new UserModel($this->getDoctrine()->getEntityManager());
            $user=$model->getUser(1);
            if($user!=null){
                /***** we test if the id of diplome is not null, if it's than we create a new diplome */
                if($idDiplome!=null){
                    /**  we modify this diplome */
                    $diplome = $modelProfil->getDiplome($idDiplome);
                    if($diplome!=null) {
                        $diplome->setTitre($titre);
                        $diplome->setInstitut($institut);
                        $diplome->setDescription($description);
                        $diplome->setDate(new \DateTime($date));

                        $modelProfil->updateDiplome($diplome);
                        $message = "You changes have been successfuly done";
                    }else{
                        $message="Your Changes can not be done !.";
                    }

                    $action="update";

                }else{
                    /*** diplome has not been created, and we create it right here */
                    $diplome = new Diplome();
                    $diplome->setTitre($titre);
                    $diplome->setInstitut($institut);
                    $diplome->setDescription($description);
                    $diplome->setUser($user);
                    $diplome->setDate(new \DateTime($date));

                    $idDiplome= $modelProfil->addDiplome($diplome);
                    $idDiplomeEncripted = $encryption->encode($idDiplome);
                    $action="persist";
                    $message="You changes have been successfuly done";
                }
            }else{
                /** if user dos not exist */
                $message="This action can not be done, because of authentification problem.";
            }


        }else{
            /** if parametres are  not valid */
            $message="This Change can not be done !!!";
        }

        /** delete diplome if param action=delete */
        if ($req->get("delete")!=null) {
            $modelProfil->deleteDiplome($idDiplome);
            $action="delete";
            $message="You changes have been successfuly done";
        }

        $output = array("message"=>$message, "action"=>$action, "form"=>"diplomes", "idDiplome"=>$idDiplome);
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);
    }


    /**
     * @Route("/{_locale}/experiences/", name="experiences")
     */
    public function experiencesAction(Request $req)
    {
        $message="";
        $action="";
        $isValid=true;
        $modelProfil = new ProfilModel($this->getDoctrine()->getEntityManager());
        $encryption = new Encryption();
        /** verfier que les parametres dans la requete */
        $titre = $req->get("titre");
        $firstdate = $req->get("firstdate");
        $seconddate = $req->get("seconddate");
        $description = $req->get("description");
        $idExperience=$req->get("idExperience");



        /** validate the attributes */

        /** if valide make change */
        if($isValid){
            $model = new UserModel($this->getDoctrine()->getEntityManager());
            $user=$model->getUser(1);
            if($user!=null){
                /***** we test if the id of Experience is not null, if it's than we create a new Experience */
                if($idExperience!=null){
                    /**  we modify this diplome */
                    $experience = $modelProfil->getExperience($idExperience);
                    if($experience!=null) {
                        $experience->setTitre($titre);
                        $experience->setDescription($description);
                        $experience->setDatestart(new \DateTime($firstdate));
                        $experience->setDateend(new \DateTime($seconddate));

                        $modelProfil->updateExperience($experience);
                        $message = "You changes have been successfuly done";
                    }else{
                        $message="Your Changes can not be done !.";
                    }

                    $action="update";

                }else{
                    /*** diplome has not been created, and we create it right here */
                    $experience = new Experience();
                    $experience->setTitre($titre);
                    $experience->setDescription($description);
                    $experience->setDatestart(new \DateTime($firstdate));
                    $experience->setDateend(new \DateTime($seconddate));
                    $experience->setUser($user);

                    $idExperience= $modelProfil->addExperience($experience);
                    $idExperienceEncripted = $encryption->encode($idExperience);
                    $action="persist";
                    $message="You changes have been successfuly done";
                }
            }else{
                /** if user dos not exist */
                $message="This action can not be done, because of authentification problem.";
            }


        }else{
            /** if parametres are  not valid */
            $message="This Change can not be done !!!";
        }

        /** delete diplome if param action=delete */
        if ($req->get("delete")!=null) {
            $modelProfil->deleteExperience($idExperience);
            $action="delete";
            $message="You changes have been successfuly done";
        }

        $output = array("message"=>$message, "action"=>$action, "form"=>"experiences", "idExperience"=>$idExperience);
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);
    }


    /**
     * @Route("/{_locale}/test/", name="test")
     */
    public function testAction(Request $req)
    {
        return new Response("Test");
    }

}