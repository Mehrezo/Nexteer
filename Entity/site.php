<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\site
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nexteer\PoBundle\Entity\siteRepository")
 */
class site
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
     * @var integer $pays_id
     *
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\pays")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
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
     * Set libelle
     *
     * @param string $libelle
     * @return site
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
     * Set pays_id
     *
     * @param integer $paysId
     * @return site
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
    
    public function __toString(){
 	return $this->getLibelle();
   }
}