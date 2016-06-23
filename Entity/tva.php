<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\tva
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class tva
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
     * @var float $valeur
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\pays")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     * @var pays_id $pays_id
     */
    private $pays_id;


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
     * Set valeur
     *
     * @param integer $valeur
     * @return tva
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set pays_id
     *
     * @param integer $paysId
     * @return tva
     */
    public function setPaysId($paysId)
    {
        $this->pays_id = $paysId;
    
        return $this;
    }

    /**
     * Get pays_id
     *
     * @return integer 
     */
    public function getPaysId()
    {
        return $this->pays_id;
    }
}