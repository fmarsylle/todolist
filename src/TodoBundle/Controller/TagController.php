<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 23/03/16
 * Time: 11:44
 */

namespace TodoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TodoBundle\Entity\Tag;
use TodoBundle\Form\Type\TagType;

class TagController extends Controller
{

    /**
     * @Route("/tag/create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $tag=new Tag();

        $form=$this->createForm(TagType::class, $tag);
        $form ->handleRequest($request);

        if($form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            $this->addFlash('notice',$this->get('translator')->trans('message.addTagSuccess'));

            return $this->redirect("/");

        }else{
            $this->addFlash('notice',$this->get('translator')->trans('message.addTagFail'));
        }

        return $this->render('TodoBundle:Tag:create.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    /**
     * @Route("/tag/list")
     */
    public function listAction(){
        $tags = $this->getDoctrine()
            ->getRepository('TodoBundle:Tag')
            ->findAll();

        return $this->render('TodoBundle:Tag:list.html.twig',array(
            'tags'=>$tags
        ));
    }

}