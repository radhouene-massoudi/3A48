<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
