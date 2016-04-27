<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 23/03/16
 * Time: 11:30
 */

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TodoBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use TodoBundle\Form\Type\CategoryType;


class CategoryController extends controller
{
    /**
     * @Route("/category/create" , name="create_category")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $category=new Category();

        $form=$this->createForm(CategoryType::class, $category);
        $form ->handleRequest($request);

        if($form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('notice',$this->get('translator')->trans('message.addCategorySuccess'));

            return $this->redirect("/");

        }else{
            $this->addFlash('notice',$this->get('translator')->trans('message.addCategoryFail'));
        }

        return $this->render('TodoBundle:Category:create.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    /**
     * @Route("/category/list" , name="list_category")
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository('TodoBundle:Category')
            ->findAll();

        return $this->render('TodoBundle:Category:list.html.twig', array(
            'categories' => $categories
        ));

    }

}