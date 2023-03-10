<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class BaseController extends AbstractController
{
   
    #[Route('/base', name: 'app_base')]
    public function afficheS(QuestionRepository $repository)
    {
    //Affichage simple
       $s= $repository->findBy(['id_user' => 3]);
        return $this->render("base/index.html.twig",
        ["id"=>$s]);
                      }
                      #[Route('/{id}', name: 'app_question_index', methods: ['GET'])]
                      public function ind(QuestionRepository $questionRepository, SerializerInterface $Serializer): Response
                      {$question=$questionRepository->findAll();
                          
                          $json= $Serializer->serialize($question, 'json');
                          return new Response($json);
                      }  
                      
                     
                      }

