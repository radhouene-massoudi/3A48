<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Student;
use App\Form\St2Type;
use App\Form\StudentType;
use App\Repository\ClassroomRepository;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/MM', name: 'MM')]
    public function index(): Response
    {
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/getStudents', name: 'getStudents')]
    public function getStudents(ManagerRegistry $em): Response
    {
        $repo=$em->getRepository(Student::class);
        $result=$repo->findAll();
        
        return $this->render('student/show.html.twig', [
            'students' => $result,
        ]);
    }

    #[Route('/fecthStudents', name: 'fecthStudents')]
    public function fecthStudents(StudentRepository $repo): Response
    {
        $result=$repo->findAll();
        
        return $this->render('student/show.html.twig', [
            'students' => $result,
        ]);
    }


    #[Route('/remove/{id}', name: 'remove')]
    public function removeStudent($id,ManagerRegistry $mr,StudentRepository $repo): Response
    {
        $st=$repo->find($id);//select * from student wehere id=id
        $em=$mr->getManager();
        $em->remove($st);
        $em->flush();
        
        return  $this->redirectToRoute('fecthStudents');;
    }


    #[Route('/addst', name: 'addst')]
    public function addproduct(ManagerRegistry $mg,Request $req): Response
    {
        $p=new Student();

        $form=$this->createForm(StudentType::class,$p);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
      
$em=$mg->getManager();
$em->persist($p);
$em->flush();

}
return $this->render('student/addst.html.twig', [
    'f' => $form->createView(),
]);
    }


    #[Route('/getclass', name: 'getclass')]
    public function getclass(ManagerRegistry $em): Response
    {
        $repo=$em->getRepository(Classroom::class);
        $result=$repo->findAll();
        
        return $this->render('classroom/show.html.twig', [
            'classrooms' => $result,
        ]);
    }

    #[Route('/stadd/{id}', name: 'addstydentsss')]
    public function addsttt(ManagerRegistry $mg,Request $req,$id,ClassroomRepository $repo): Response
    {
        $p=new Student();

        $form=$this->createForm(St2Type::class,$p);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $c=$repo->find($id);
      $p->setClassroom($c);
$em=$mg->getManager();
$em->persist($p);
$em->flush();

}
return $this->render('student/addst.html.twig', [
    'f' => $form->createView(),
]);
    }
}
