<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/st', name: 'wt')]
class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/msg', name: 'yyy')]
    public function showmsg(): Response
    {
        
        return $this->render('3A47/showmsg.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/detail/{name}', name: 'yyy')]
    public function showdetail($name): Response
    {
        
        return $this->render('3A47/showmsg.html.twig', [
            't' => $name,
        ]);
    }
}
