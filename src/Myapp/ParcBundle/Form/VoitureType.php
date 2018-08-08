<?php

namespace Myapp\ParcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class VoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('serie', TextType::class,array('required'=>true, 'attr'=> array('placeholder'=>'Serie')))
                 ->add('file',FileType::class)
                ->add('date', DateType::class,array('format'=>'dd-MM-yyyy','years'=> range(1950,2050)))
                ->add('marque', TextType::class,array('required'=>true, 'attr'=> array('placeholder'=>'Marque')))
                ->add('modele',EntityType::class,array( // query choices from this entity
                 'class' => 'ParcBundle:Modele',// classe Modele ili on herite minou libelle
                    // use the User.username property as the visible option string
                  'choice_label' => 'libelle',

                   // used to render a select box, check boxes or radios
                  
                     'multiple' => FALSE,'required'=>TRUE
               
))
                    
   ->add('ajouter', SubmitType::class);               
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Myapp\ParcBundle\Entity\Voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_parcbundle_voiture';
    }


}
