<?php

namespace TodoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TodoBundle\Entity\Task;
use TodoBundle\Form\Type\TaskType;

class TaskController extends Controller
{
    /**
     * @Route("/task/create", name="create_task")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $task=new Task($this->getUser());


        $form=$this->createForm(TaskType::class, $task);
        $form ->handleRequest($request);

        if($form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash('notice',$this->get('translator')->trans('message.addTaskSuccess'));

            return $this->redirect("/");

        }else{
            $this->addFlash('notice',$this->get('translator')->trans('message.addTaskFail'));
        }

        return $this->render('TodoBundle:Task:create.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    /**
     * @Route("/task/list" , name="list_task")
     */
    public function listAction(){
        $tasks = $this->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByUser($this->getUser());

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }

    /**
     * @Route("/task/listByDay" , name="list_task_by_day")
     */
    public function listByDayAction(){

        $tasks = $this->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByDay($this->getUser());

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }

    /**
     * @Route("/task/listByWeek" , name="list_task_by_week")
     */
    public function listByWeekAction(){

        $tasks = $this->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByWeek($this->getUser());

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }

    /**
     * @Route("/task/listByMonth" , name="list_task_by_month")
     */
    public function listByMonthAction(){

        $tasks = $this->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByMonth($this->getUser());

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }



    /**
     * @Route("/task/category/{id}", name="list_task_category", requirements={"id" = "\d+"})
     */
    public function listTaskAction(Request $request){

        $tasks=$this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByCategory(
                 $request->get('id')
            );

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }

    /**
     * @Route("/task/tag/{id}", name="list_task_tag", requirements={"id" = "\d+"})
     */
    public function listTaskTagAction(Request $request){

        $tasks=$this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByTag(
                $request->get('id')
            );

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }



}
