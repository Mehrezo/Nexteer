<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Ajouter par M_OU le 27/11/2012 - indisponsable pour l'appel de la fonction isLibelleLegal
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; // Ajouter par M_OU le 27/11/2012 - indisponsable pour la validation @UniqueEntity.

/**
 * Nexteer\PoBundle\Entity\service
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields="libelle", message="Un article existe déjà avec ce titre.")
 */
class service
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return service
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    
    
    /**
     * @Assert\True(message = "Le champ libellé doit être different de la chaine 'Mehrez'")
     */
    public function isLibelleLegal()
    {
        if ($this->getLibelle() == 'Mehrez')
           return false;
        else 
           return true;
    }
}