<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class elementdeliveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('id_delivery')
            ->add('orderindex', 'hidden', array('required' => False))
            ->add('quantite','integer', array('required' => False, 'label' => ' ', 'max_length' => 3, 'attr' => array('style' => "width: 40;")))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nexteer\PoBundle\Entity\elementdelivery'
        ));
    }

    public function getName()
    {
        return 'nexteer_pobundle_elementdeliverytype';
    }
}
