<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('prenom')->add('tel')->add('adresse')
        ->add('agence' , EntityType::class , array(
            'class' => 'AdminBundle\Entity\Agence',
            'choice_label' => 'libelle',
            'expanded' => false,
            'multiple' => false
        ))
        ->add('image', FileType::class , array(
            'label' => 'png or jpg image only', 
            'data_class' => null,
            'required' => false 
        ));;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Agent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_agent';
    }


}
