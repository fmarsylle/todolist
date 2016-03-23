<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 23/03/16
 * Time: 11:29
 */

namespace TodoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                'label' => 'category.form.name'
            ))
            ->add('description',null,array(
                'label' => 'category.form.description'
            ))
            ->add('color',null,array(
                'label' => 'category.form.color'
            ))
            ->add('save', SubmitType::class,array(
                'label' => 'task.form.save'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodoBundle\Entity\Category',
        ));
    }
}