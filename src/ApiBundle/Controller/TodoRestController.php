<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use TodoBundle\Entity\Task;

class TodoRestController extends FOSRestController
{


    /*
     * @Get("/api/task/{id}")
     * @ParamConverter("task",class="TodoBundle:Task",options={"mapping":{"id":"id"}})
     *
     */
    public function getTask(Task $task){
        $json=$this->get('serializer')->serialize($task,'json');

        return new JsonResponse($json);
    }
}
