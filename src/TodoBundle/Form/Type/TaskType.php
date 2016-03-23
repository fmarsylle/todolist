<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 16/03/16
 * Time: 11:02
 */

namespace TodoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label',null,array(
                'label' => 'task.form.label'
            ))
            ->add('description',null,array(
                'label' => 'task.form.description'
            ))
            ->add('dueDate',null,array(
                'label' => 'task.form.dueDate'
            ))//, null, array('widget' => 'single_text'))
            ->add('remindAt',null,array(
                'label' => 'task.form.remindAt'
            ))//, null, array('widget' => 'single_text'))
            ->add('createdAt',null,array(
                'label' => 'task.form.createdAt'
            ))//, null, array('widget' => 'single_text'))
            ->add('updateAt',null,array(
                'label' => 'task.form.updateAt'
            ))//, null, array('widget' => 'single_text'))
            ->add('status',null,array(
                'label' => 'task.form.status'
            ))
            ->add('category',null,array(
                'label' => 'task.form.category'
            ))
            ->add('tag',null,array(
                'label' => 'task.form.tag'
            ))
            ->add('save', SubmitType::class,array(
                'label' => 'task.form.save'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodoBundle\Entity\Task',
        ));
    }

}