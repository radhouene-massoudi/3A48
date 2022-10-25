<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 * 
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function add(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Student[] Returns an array of Student objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Student
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function fetchStudent()
    {
        $em=$this->getEntityManager();
      $req=  $em->createQuery('select s.id,c.name from App\Entity\Student s join s.classroom c');
    return $req->getResult();
    }
    public function fetchStudentbyKlass($klasss)
    {
        $em=$this->getEntityManager();
      $req=  $em->createQuery('select s.id,c.name from App\Entity\Student s join s.classroom c where c.name=:k');
    $req->setParameter('k',$klasss);
      return $req->getResult();
    }  
    public function selectAll()
       {
        $student=false;
         $req=$this
         ->createQueryBuilder('s');
         if($student==false){
            $req->select('s.name t')
            ->join('s.classroom','c')
            ->addSelect('c.name');
         }
         
         $res=$req->getQuery()
         ->getResult();
         dd($res);
           
       }
       public function selectByKlass($klass)
       {
        //$student=false;
        //dd($klass);
         $req=$this
         ->createQueryBuilder('s');
         if($klass!=null){
            $req->select('s.name t')
            ->join('s.classroom','c')
            ->addSelect('c.name')
            ->where('c.name=:t')
            ->setParameter('t',$klass);
         }
         
         $res=$req->getQuery()
         ->getResult();
         dd($res);
           
       }
}
