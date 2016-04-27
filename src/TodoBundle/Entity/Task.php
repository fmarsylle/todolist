<?php

namespace TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TodoBundle\Entity\TaskRepository")
 * @ORM\Table(name="task")
 * @ORM\HasLifecycleCallbacks()
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

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="task" )
     */
    protected $tag;


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function timestamps(){
        if(is_null($this->createdAt)){
            $this->createdAt = new \DateTime;
        }
        $this->updateAt=new \DateTime();
    }

    public function __construct(User $user)
    {
        return $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param mixed $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return mixed
     */
    public function getRemindAt()
    {
        return $this->remindAt;
    }

    /**
     * @param mixed $remindAt
     */
    public function setRemindAt($remindAt)
    {
        $this->remindAt = $remindAt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


}

?>