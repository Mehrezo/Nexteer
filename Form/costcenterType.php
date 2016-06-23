<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class costcenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('costcenter')
            ->add('description')
            ->add('pays_id')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nexteer\PoBundle\Entity\costcenter'
        ));
    }

    public function getName()
    {
        return 'nexteer_pobundle_costcentertype';
    }
}
