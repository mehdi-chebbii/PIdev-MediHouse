<?php

namespace App\Controller;
use App\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReclamationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReclamationType;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
 class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/frontbase.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    #[Route('/afficheREC', name: 'afficheR')]

      public function AfficheR(ReclamationRepository $repository)
      {
          $c= $repository->findAll();
          return $this->render("reclamation/listR.html.twig", ["reclamations"=>$c]);
          
        }
        #[Route('/afficheRECl', name: 'afficheRl')]

      public function AfficheRl(ReclamationRepository $repository)
      {
          $c= $repository->findAll();
          return $this->render("reclamation/addrec.html.twig", ["reclamation"=>$c]);
          
        }
       /* #[Route('/affREC/{id}', name: 'affR')]

      public function AffR(ReclamationRepository $repository,$id,ReponseRepository $Reponserepository)
      {
          $r= $Reponserepository->get_reponse($id);
          $c= $repository->find($id);
          
          return $this->render("reclamation/frontREC.html.twig", [
        "reclamations"=>$c,
        "reponse"=>$r]);
        }*/
        
        #[Route('/affREC/{id}', name: 'affR')]

        public function AffR(ReclamationRepository $repository,$id,ReponseRepository $Reponserepository)
        {
            $Reclamation= $repository->find($id);
            $r= $Reponserepository->get_reponse($id);
            return $this->render("reclamation/frontREC.html.twig", ["reclamation"=>$Reclamation,"reponse"=>$r]);
          }
    
        #[Route('/addReclamation', name: 'app_addReclamation')]
        public function addReclamation(ManagerRegistry $doctrine,Request $request)
        {
            $Reclamation= new Reclamation();
            $form=$this->createForm(ReclamationType::class,$Reclamation); 
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $em =$doctrine->getManager() ;
                $em->persist($Reclamation);
                $em->flush();
                return $this->redirectToRoute("afficheRl");
            }
            return $this->renderForm("reclamation/front.html.twig",
                array("formClass"=>$form));
        }
         #[Route('/afficheview/{id}', name: 'afficheView')]

      public function Afficheview(ReclamationRepository $repository,$id)
      {
          $Reclamation= $repository->find($id);
          
          return $this->render("reclamation/View.html.twig", ["reclamation"=>$Reclamation]);
        }
    
        
         
         #[Route('/suppE/{id}', name: 'supprimerR')]

        public function suppC(ManagerRegistry $doctrine,$id,ReclamationRepository $repository)
          {
          //récupérer le classroom à supprimer
              $Reclamation= $repository->find($id);
          //récupérer l'entity manager
              $em= $doctrine->getManager();
              $em->remove($Reclamation);
              $em->flush();
              return $this->redirectToRoute("afficheR");
          } 
          #[Route('/updatC/{id}', name: 'updateR')]

    public function updatC(ManagerRegistry $doctrine,$id,ReclamationRepository $repository,Request $request)
      {
      //récupérer le Reclamation à supprimer
          $Reclamation= $repository->find($id);
          $newReclamation= new Reclamation();
          $form=$this->createForm(ReclamationType::class,$newReclamation);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em =$doctrine->getManager() ;
            $Reclamation->setEmail($newReclamation->getEmail());
            $Reclamation->setSujet($newReclamation->getSujet());
            $Reclamation->setDescreption($newReclamation->getDescreption());
            $Reclamation->setDateReclamation($newReclamation->getDateReclamation());
           // $Reclamation->setEtat($newReclamation->getEtat());
            $em->flush();
            return $this->redirectToRoute("afficheR");
        }
        return $this->renderForm("reclamation/updateR.html.twig",
        array("formClass"=>$form));
      } 

    }

