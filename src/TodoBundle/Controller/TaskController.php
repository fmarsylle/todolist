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
     * @Route("/task/create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $task=new Task();

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
     * @Route("/task/list")
     */
    public function listAction(){
        $tasks = $this->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findAll();

        return $this->render('TodoBundle:Task:list.html.twig',array(
            'tasks'=>$tasks
        ));
    }
}
