<?php

namespace TodoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;


    public function login(){

    }

    private function getClient(){

        $this->client = static::createClient();
    }

    public function testNewTaskForm(){
        $this->getClient();

        $crawler = $this->client->request('GET','/task/create');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $this->assertContains('Save',$this->client->getResponse()->getContent());

    }

    public function testNewTaskSuccess(){
        $this->getClient();
        $crawler = $this->client->request('GET','/task/create');
        $form=$crawler->filter('button[type=submit]')->form();

        $data=array(
            'task[label]' => 'task 1',
            'task[description]' => 'go to the supermarket',
            'task[status]' => 1
        );


        $this->client->submit($form,$data);

        $this->assertEquals(302,$this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();

        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $this->assertContains('message.addTaskSuccess',$this->client->getResponse()->getContent());
    }

    public function testNewTaskFail(){
        $this->getClient();
        $crawler = $this->client->request('GET','/task/create');
        $form=$crawler->filter('button[type=submit]')->form();

        $data=array(
            'task[label]' => 'task 1',
            'task[description]' => 'go to the supermarket',
            'task[status]' => 'TEST'
        );


        $this->client->submit($form,$data);

        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $this->assertContains('message.addTaskFail',$this->client->getResponse()->getContent());

    }

    public function testNewTaskServorError(){
        $this->getClient();
        $crawler = $this->client->request('GET','/task/create');
        $form=$crawler->filter('button[type=submit]')->form();


        $this->client->submit($form);

        $this->assertEquals(500,$this->client->getResponse()->getStatusCode());

    }

    public function testEmptyList(){
        $this->getClient();
        $crawler = $this->client->request('GET','/task/list');
        $this->assertNotContains('task.emptyList',$this->client->getResponse()->getContent());
    }

    public function testNonEmptyList(){
        $this->getClient();
        $crawler = $this->client->request('GET','/task/list');
        $this->assertContains('task.emptyList',$this->client->getResponse()->getContent());
    }

}
