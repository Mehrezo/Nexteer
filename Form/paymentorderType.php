<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class paymentorderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arnumber')
            ->add('pays')
            ->add('site')
            ->add('departement')
            ->add('prnumber')
            ->add('applicant')
            ->add('orderindex')
            ->add('Item')
            ->add('description')
            ->add('quantite')
            ->add('unitemesure')
            ->add('unitprice')
            ->add('amount')
            ->add('deliverydate')
            ->add('glaccount')
            ->add('detailcc')
            ->add('total')
            ->add('currency')
            ->add('requestdate')
            ->add('Remarque')
            ->add('phonenoapp')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nexteer\PoBundle\Entity\paymentorder'
        ));
    }

    public function getName()
    {
        return 'nexteer_pobundle_paymentordertype';
    }
}
