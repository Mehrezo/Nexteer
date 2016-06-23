<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ExecutionContext; // Ajouter par M_OU le 27/12/2012 - pour recupérer le $context
use Nexteer\PoBundle\Validator\VerifQuantite;

/**
 * Nexteer\PoBundle\Entity\delivery
 *
 * @ORM\Table()
 * @ORM\Entity
 ** //@Assert\Callback(methods={"quantiteValide"})
 */
class delivery
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
     * @var string $prnumber
     *
     * @ORM\Column(name="prnumber", type="string", length=100)
     */
    private $prnumber;

    /**
     * @var \DateTime $datelivraison
     *
     * @ORM\Column(name="datelivraison", type="date")
     */
    private $datelivraison;

    /**
     * @var string $delivery
     *
     * @ORM\Column(name="delivery", type="string", length=100)
     */
    private $delivery;

    /**
     * @var string $fichierattachment
     *
     * @ORM\Column(name="fichierattachment", type="string", length=255)
     * @Assert\File(
     *     maxSize = "3072k"
     * )
     */
    private $fichierattachment;
    
    /**
     * @var string $namefile
     * @ORM\Column(name="namefile", type="string", length=255)
     *
     */
    private $namefile;
    
    /**
     *
     * @VerifQuantite()
     */
    protected $elementsDelivery;

    public function __construct()
    {
        $this->elementsDelivery = new ArrayCollection();
    }

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
     * Set prnumber
     *
     * @param string $prnumber
     * @return delivery
     */
    public function setPrnumber($prnumber)
    {
        $this->prnumber = $prnumber;
    
        return $this;
    }

    /**
     * Get prnumber
     *
     * @return string 
     */
    public function getPrnumber()
    {
        return $this->prnumber;
    }

    /**
     * Set datelivraison
     *
     * @param \DateTime $datelivraison
     * @return delivery
     */
    public function setDatelivraison($datelivraison)
    {
        $this->datelivraison = $datelivraison;
    
        return $this;
    }

    /**
     * Get datelivraison
     *
     * @return \DateTime 
     */
    public function getDatelivraison()
    {
        return $this->datelivraison;
    }

    /**
     * Set delivery
     *
     * @param string $delivery
     * @return delivery
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    
        return $this;
    }

    /**
     * Get delivery
     *
     * @return string 
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set fichierattachment
     *
     * @param string $fichierattachment
     * @return delivery
     */
    public function setFichierattachment($file = null)
    {
        $this->fichierattachment = $file;
    
        return $this;
    }

    /**
     * Get fichierattachment
     *
     * @return string 
     */
    public function getFichierattachment()
    {
        return $this->fichierattachment;
    }
    
    public function getElementsDelivery()
    {
        return $this->elementsDelivery;
    }

    public function setElementsDelivery(ArrayCollection $elementsDelivery)
    {
        $this->elementsDelivery = $elementsDelivery;
    }
    
    
    /*public function quantiteValide(ExecutionContext $context)
    {
        // Vue qu'on a besoin de lacer des requetes SQl pour valider la quantité, j'ai ajouté la contrainte VerifQuantite  
      return true;
    }*/

    /**
     * Set namefile
     *
     * @param string $namefile
     * @return delivery
     */
    public function setNamefile($namefile)
    {
        $this->namefile = $namefile;
    
        return $this;
    }

    /**
     * Get namefile
     *
     * @return string 
     */
    public function getNamefile()
    {
        return $this->namefile;
    }
}