<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    #[Route('/twig', name: 'app_twig')]
    public function index(): Response
    {
        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
        ]);
    }

    #[Route('/v', name: 'v')]
    public function va(): Response
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation            Symfony4','Description'=>'formation pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
            'nb_participants'=>1) ,
            array('ref'=>'form177','Titre'=>'Formation     SOA' ,
            'Description'=>'formation
            theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
            'Description'=>'formation
            theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12));
        $klasse='3A48 is the best';
        return $this->render('twig/test.html.twig', 
        [
            't'=>$klasse,
            'tab'=>$formations
        ]);
    }

    #[Route('/p/{id}', name: 'p')]
    public function p($id): Response
    {
        return $this->render('twig/show.html.twig', [
            'id' => $id,
        ]);
    }
}
