<?php

namespace Nexteer\PoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;

class AnnonceRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('adresse_debut','places_autocomplete', array(
                'prefix' => 'js_prefix_',
                'types'  => array(AutocompleteType::GEOCODE),
                'async' => false,
                'language' => 'fr',
                /*'component_restrictions' => array(
                    AutocompleteComponentRestriction::COUNTRY => 'FR'),*/
                'attr' => array('class' => 'imput_gmaps')

            ))
            ->add('adresse_fin','places_autocomplete', array(
                'prefix' => 'js_prefix_',
                'types'  => array(AutocompleteType::GEOCODE),
                'async' => false,
                'language' => 'fr',
                /*'component_restrictions' => array(
                    AutocompleteComponentRestriction::COUNTRY => 'FR'),*/
                'attr' => array('class' => 'imput_gmaps')

            ))
            ->add('dateOperation', 'datetime', array(
                'widget' => 'choice',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'date')
            ))
        ;
    }

    public function getName() {
        return 'nexteer_pobundle_recherche_annonces';
    }
}
