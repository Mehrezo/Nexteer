<?php

namespace Nexteer\PoBundle\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use Doctrine\ORM\EntityManager;// Ajouter par M_OU le 29/12/2012 - appeller l'entity manager pour lancer des requetes BDD
use Symfony\Component\HttpFoundation\Request; // Ajouter par M_OU le 29/12/2012 - appeller le request


class VerifQuantiteValidator extends ConstraintValidator
{
    private $request;
    private $em;

    // Les arguments déclarés dans la définition du service arrivent au constructeur
    // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
    public function __construct(Request $request, EntityManager $em)
    {
        $this->request = $request;
        $this->em      = $em;
    }
    
    public function validate($value, Constraint $constraint)
    {
        foreach ($value as $obj_po) {
            $tmp_po = $this->em->getRepository('NexteerPoBundle:paymentorder')->find($obj_po->getOrderindex());
            // On verifie que la qty saisie est <= à la qty commandée
            if ($tmp_po->getQuantite() < $obj_po->getQuantite()) {
                $this->context->addViolation($constraint->message);
            }
            else {
                //On verifie que la somme des qty déjà livrées + la qty saisie est <= la qty commandée...
                //echo '<pre>';print_r($obj_po->getOrderindex());echo '</pre>';
                $nb_qty = $this->em->createQueryBuilder();
                $nb_qty->select('SUM(ed.quantite) as nbQtyDelivery')
                            ->add('from', 'NexteerPoBundle:elementdelivery ed')
                            ->where('ed.orderindex = '.$obj_po->getOrderindex())
                        ;
                $nbqty_tmp = $nb_qty->getQuery()->getResult();                
                if (($nbqty_tmp[0]['nbQtyDelivery'] +  $obj_po->getQuantite()) > $tmp_po->getQuantite())
                $this->context->addViolation( 'delivery.erreur.element_delivery.nbdepassequantite');
            }
        }
    }
}

