<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 31/01/16
 * Time: 17:36
 */

namespace Acme\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class)
            ->add('note', TextareaType::class)
            ->add('save', SubmitType::class);
    }

    public function getName()
    {
        return 'project';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\AdminBundle\Entity\Project',
        ));
    }

}