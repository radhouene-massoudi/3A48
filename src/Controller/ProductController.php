<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\PType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/addproduct', name: 'addproduct')]
    public function addproduct(ManagerRegistry $mg,Request $req,ProductRepository $repo): Response
    {
        $p=new Product();

        $form=$this->createForm(PType::class,$p);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $id=$p->getId();
    $pV=$repo->find($id);
            $name=$p->getName();
            $d=$id.' '.$name;
            $p->setDescription($d);
     //  dd($req);
// $p->setName('tv');
// $p->setId(12345);
// $p->setDescription('cc;vnsd;v');
if($pV==null){
$em=$mg->getManager();
$em->persist($p);
$em->flush();
}
}
return $this->render('product/addp.html.twig', [
    'f' => $form->createView(),
]);
    }

    #[Route('/update/{id}', name: 'updateproduct')]
    public function updateproduct(ManagerRegistry $mg,$id,Request $req,ProductRepository $repo): Response
    {
        $p=$repo->find($id);
        $form=$this->createForm(PType::class,$p);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $id=$p->getId();
    
            $name=$p->getName();
            $d=$id.' '.$name;
            $p->setDescription($d);
   $em=$mg->getManager();

$em->flush();

}
return $this->renderForm('product/addp.html.twig', [
    'f' => $form,
]);
    }
}
