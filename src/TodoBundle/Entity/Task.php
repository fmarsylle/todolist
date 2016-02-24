<?php

namespace TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100,nullable=false)
     */
    protected $label;
    /**
     * @ORM\Column(type="text",nullable=false)
     */
    protected $description;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updateAt;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $dueDate;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $remindAt;
    /**
     * @ORM\Column(type="integer",nullable=false)
     */
    protected $status;
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="tasks")
     */
    protected $category;


}

?>