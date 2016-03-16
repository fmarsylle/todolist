<?php

namespace TodoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
