<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;

class currencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('country_name')
            ->add('used')
        ;

        $builder->add('adresse','places_autocomplete', array(
            'prefix' => 'js_prefix_',
            'types'  => array(AutocompleteType::GEOCODE),
            'async' => false,
            'language' => 'fr',
            'allow_extra_fields' => 'Mehrez',

            /*'component_restrictions' => array(
                AutocompleteComponentRestriction::COUNTRY => 'FR'),*/
            'attr' => array('class' => 'imput_gmaps')

        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nexteer\PoBundle\Entity\currency'
        ));
    }

    public function getName()
    {
        return 'nexteer_pobundle_currencytype';
    }
}
