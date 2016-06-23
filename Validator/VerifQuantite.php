<?php

namespace Nexteer\PoBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
* @Annotation
*/
class VerifQuantite extends Constraint
{
public $message = "delivery.erreur.quantite.saisie";

public function validatedBy()
    {
        return 'nexteer_verifquantite'; // Ici, on fait appel à l'alias du service voir le fichier services.yml
    }
}

