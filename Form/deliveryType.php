<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Nexteer\PoBundle\Form\elementdeliveryType; // Ajouter par M_OU le 04/12/2012

class deliveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prnumber', 'text', array('read_only' => True, 'max_length' => 10))
            //->add('datelivraison', 'hidden')
            ->add('delivery', 'text', array('read_only' => True))
            ->add('fichierattachment', 'file', array('required' => False))
            ->add('elementsDelivery', 'collection', array('type' => new elementdeliveryType()));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nexteer\PoBundle\Entity\delivery'
        ));
    }

    public function getName()
    {
        return 'nexteer_pobundle_deliverytype';
    }
}
