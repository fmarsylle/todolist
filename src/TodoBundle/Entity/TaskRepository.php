<?php

namespace TodoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Validator\Constraints\DateTime;

class TaskRepository extends EntityRepository
{
    public function findByDay($user){

        return $this->findBetween(date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59'),$user);


    }

    public function findByWeek($user){

            $day=date('w');
            $startDate = date('Y-m-d 00:00:00', strtotime('monday this week')) ;
            $endDate = date('Y-m-d 23:59:59', strtotime('sunday this week')) ;

            return $this->findBetween($startDate,$endDate,$user);

    }

    public function findByMonth($user){


        $startDate = date('Y-m-01 00:00:00') ;
        $endDate = date('Y-m-t 23:59:59') ;

        return $this->findBetween($startDate,$endDate,$user);

    }


    public function findBetween($startDate,$endDate,$user){

        $qb=$this->getEntityManager()->createQueryBuilder();

        $qb->select('t')
            ->from('TodoBundle:Task','t')
            ->where('t.dueDate >= :from')
            ->andWhere('t.dueDate < :to')
            ->andWhere('t.user= :user')
            ->setParameter('from', $startDate)
            ->setParameter('to',$endDate)
            ->setParameter('user',$user);

        return $qb->getQuery()->getResult();



    }


    public function findByTag($id){
        $qb=$this->getEntityManager()->createQueryBuilder();

        $qb->select('t')
            ->from('TodoBundle:Task','t')
            ->innerJoin('t.tag', 't1' , Join::WITH, 't1.id = :tag')
            ->setParameter('tag', $id);



        return $qb->getQuery()->getResult();

    }


}